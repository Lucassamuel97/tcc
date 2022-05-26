<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\UpdateHodometro;
use App\Models\Machine;
use App\User;
use Tests\CreatesApplication;
use Illuminate\Validation\ValidationException;

class UpdateHodometroTest extends TestCase
{
    use CreatesApplication;
    use RefreshDatabase;
    
    protected function signIn($user = null){
        $user = $user ?? factory(User::class)->create();
        $this->actingAs($user);
        return $this;
    }

    /** @test */
    public function authenticated_user_can_view_all_machines()
    {
        $this->withoutExceptionHandling();
        $this->signIn();

        $machine = factory(Machine::class)->create();
        
        $machine2 = factory(Machine::class)->create();
     
        $response = $this->get('/updateHodometro');

        $response->assertSee($machine->description);
        $response->assertSee($machine2->description);
    }

    /** @test */
    public function authenticated_users_can_update_hodometro()
    {
        $this->withoutExceptionHandling();
        $this->signIn();

        $machine = factory(Machine::class)->create();
        
        $updateHodometro = factory(UpdateHodometro::class)->make([
            'machine_id'=>  $machine->id,
        ]);

        $this->post('/updateHodometro', $updateHodometro->toArray());      
        
        $this->assertEquals(1, UpdateHodometro::all()->count());
    }

    /** @test */
    public function unauthenticated_users_cannot_update_hodometro()
    {
        $machine = factory(Machine::class)->create();
        $updateHodometro = factory(UpdateHodometro::class)->make([
            'machine_id'=>  $machine->id,
        ]);
       
        $this->post('/updateHodometro', $updateHodometro->toArray())   
        ->assertRedirect('/login');
    }

    /** @test */
    public function authenticated_user_can_view_launch_history()
    {
        $this->withoutExceptionHandling();
        $this->signIn();

        $machine = factory(Machine::class)->create();
        
        $updateHodometro = factory(UpdateHodometro::class)->make([
            'machine_id'=>  $machine->id,
            'hodometro'=> 100,
        ]);

        $updateHodometro2 = factory(UpdateHodometro::class)->make([
            'machine_id'=>  $machine->id,
            'hodometro'=> 200,
        ]);
     
        $response = $this->get('/updateHodometro/'.$machine->id);

        $response->assertSee($updateHodometro2->hodometro);
        $response->assertSee($updateHodometro->hodometro);
    }

    /** @test */
    public function unauthenticated_users_cannot_view_launch_history()
    {

        $machine = factory(Machine::class)->create();
        
        $updateHodometro = factory(UpdateHodometro::class)->make([
            'machine_id'=>  $machine->id,
            'hodometro'=> 100,
        ]);
     
        $this->get('/updateHodometro/'.$machine->id)  
        ->assertRedirect('/login');
    }

}
