<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\MaintenanceCheck;
use App\Models\MaintenancePostpone;
use App\Models\Machine;
use App\Models\Maintenance;
use App\User;
use Tests\CreatesApplication;
use Illuminate\Validation\ValidationException;

class MaintenanceCheckTest extends TestCase
{
    use CreatesApplication;
    use RefreshDatabase;
    
    protected function signIn($user = null){
        $user = $user ?? factory(User::class)->create();
        $this->actingAs($user);
        return $this;
    }

    /** @test */
    public function authenticated_users_can_check_maintenance()
    {
        $this->withoutExceptionHandling();
       
        $user = factory(User::class)->create();
        $this->signIn($user);

        $machine = factory(Machine::class)->create();
        
        $maintenance = factory(Maintenance::class)->create([
            'machine_id'=>  $machine->id,
            'user_id'=> $user->id,
        ]);
        
        $accomplish = factory(MaintenanceCheck::class)->make();

        $this->post($machine->id.'/maintenance/accomplish', $accomplish->toArray());      
        
        $this->assertEquals(1, MaintenanceCheck::all()->count());
    }
    
    /** @test */
    public function unauthenticated_users_cannot_check_maintenance()
    {
       $machine = factory(Machine::class)->create();
       $accomplish = factory(MaintenanceCheck::class)->make();
       
       $this->post($machine->id.'/maintenance/accomplish', $accomplish->toArray())    
        ->assertRedirect('/login');
    }

    /** @test */
    public function authenticated_users_can_postpone_maintenance()
    {
        $this->withoutExceptionHandling();
        
        $user = factory(User::class)->create();
        $this->signIn($user);

        $machine = factory(Machine::class)->create();
        
        $maintenance = factory(Maintenance::class)->create([
            'machine_id'=>  $machine->id,
            'user_id'=> $user->id,
        ]);
        
        $postpone = factory(MaintenancePostpone::class)->make([
            'maintenance_id'=>  $maintenance->id,
            'user_id'=> $user->id,
        ]);

        $this->post($machine->id.'/maintenance/postpone', $postpone->toArray());      
        
        $this->assertEquals(1, MaintenancePostpone::all()->count());
    }

    /** @test */
    public function unauthenticated_users_cannot_postpone_maintenance()
    {
       $machine = factory(Machine::class)->create();
       $postpone = factory(MaintenancePostpone::class)->make();
       
       $this->post($machine->id.'/maintenance/postpone', $postpone->toArray())    
        ->assertRedirect('/login');
    }

    /** @test */
    public function authenticated_users_can_view_maintenance_history()
    {
        $this->withoutExceptionHandling();
        $user = factory(User::class)->create();
        $this->signIn($user);

        $machine = factory(Machine::class)->create();
        
        $maintenance = factory(Maintenance::class)->create([
            'machine_id'=>  $machine->id,
            'user_id'=> $user->id,
        ]);
        
        $accomplish = factory(MaintenanceCheck::class)->create([
            'maintenance_id'=>  $maintenance->id,
            'user_id'=> $user->id,
            'note' => 'Nota checagem manutenção',
        ]);

        $response = $this->get('/maintenance/'.$maintenance->id.'/historic');

        $response->assertSee($accomplish->note);
    }

    /** @test */
    public function authenticated_users_can_view_all_maintenances()
    {
        $this->withoutExceptionHandling();
        $user = factory(User::class)->create();
        $this->signIn($user);

        $machine = factory(Machine::class)->create();
        
        $maintenance = factory(Maintenance::class)->create([
            'machine_id'=>  $machine->id,
            'user_id'=> $user->id,
        ]);
        
        $response = $this->json('GET',  $machine->id.'/maintenanceCheck/' ,['q'=>$maintenance->description]);
        $response->assertSee($maintenance->description);

        $response = $this->json('GET',  $machine->id.'/maintenanceCheck/' ,['order'=> 2]);
        $response->assertSee($maintenance->description);

        $response = $this->json('GET',  $machine->id.'/maintenanceCheck/' ,['order'=> 3]);
        $response->assertSee($maintenance->description);
    }

}
