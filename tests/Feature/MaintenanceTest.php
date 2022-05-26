<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Machine;
use App\Models\Maintenance;
use App\User;
use Tests\CreatesApplication;
use Illuminate\Validation\ValidationException;

class MaintenanceTest extends TestCase
{
    use CreatesApplication;
    use RefreshDatabase;

    protected function signIn($user = null){
        $user = $user ?? factory(User::class)->create();
        $this->actingAs($user);
        return $this;
    }

    /** @test */
    public function authenticated_user_can_read_all_the_maintenances()
    {
        $this->withoutExceptionHandling();
        $this->signIn();

        $machine = factory(Machine::class)->create();

        $maintenance1 = factory(Maintenance::class)->create([
            'description' => 'Trocar Filtro', 
            'machine_id'=>  $machine->id,
        ]);

        $maintenance2 = factory(Maintenance::class)->create([
            'description' => 'Revisar freios', 
            'machine_id'=>  $machine->id,
        ]);

        
        $response = $this->get('/maintenance/'.$machine->id);

        $response->assertSee($maintenance1->description);
        $response->assertSee($maintenance2->description);
    }

    /** @test */
    public function authenticated_users_can_create_a_new_maintenance()
    {
        $this->withoutExceptionHandling();
        $this->signIn();

        $machine = factory(Machine::class)->create();

        $maintenance = factory(Maintenance::class)->make([
            'description' => 'Trocar Filtro', 
            'machine_id'=>  $machine->id,
            'range_hodometro' => '100',
            'range_months'    => '6',
            'last_hodometro'  => '100',
            'last_months'     => '2022-05-24',
            'limit_hodometro' => '200',
        ]);
        
        $this->post('/maintenance', $maintenance->toArray());      
        $this->assertEquals(1, Maintenance::all()->count());
    }

    /** @test */
    public function unauthenticated_users_cannot_create_a_maintenance()
    {
        $maintenance = factory(Maintenance::class)->make();
        $this->post('/maintenance', $maintenance->toArray())     
         ->assertRedirect('/login');
    }

    /** @test */
    public function a_user_can_read_a_maintenance_to_edit()
    {
        $this->withoutExceptionHandling();
        $this->signIn();
  
        $machine = factory(Machine::class)->create();
        $maintenance = factory(Maintenance::class)->create([
            'description' => 'Trocar Filtro', 
            'machine_id'=>  $machine->id,
        ]);
        
        $response = $this->get('/maintenance/'.$maintenance->id.'/edit/');

        $response->assertSee($maintenance->description)
            ->assertSee($maintenance->range_hodometro);
    }

    /** @test */
    public function maintenance_registration_validation(){
        $this->signIn();

        $maintenance = factory(Maintenance::class)->make([
            'description' => null,
        ]);

        $this->withoutExceptionHandling();

        $this->expectException(ValidationException::class);
        $this->expectExceptionMessage('The given data was invalid.');
        $this->post(route('maintenance.store'), $maintenance->toArray());
    }

    /** @test */
    public function the_user_can_update_the_maintenance(){
        
        $this->withoutExceptionHandling();
        $this->signIn();

        $machine = factory(Machine::class)->create();
        $maintenance = factory(Maintenance::class)->create([
            'description' => 'Trocar Filtro', 
            'machine_id'=>  $machine->id,
        ]);
        
        $maintenance->description = "Troca filtro atualizado";

        $this->put('/maintenance/'.$maintenance->id, $maintenance->toArray());
       
        $this->assertDatabaseHas('maintenances',['id'=> $maintenance->id , 'description' => 'Troca filtro atualizado']);
        $this->assertDatabaseHas('maintenances',['id'=> $maintenance->id , 'range_hodometro' => $maintenance->range_hodometro]);
    }

    /** @test */
    public function unauthorized_user_cannot_update_the_maintenance(){
        
        $user = factory(User::class)->create();
        $machine = factory(Machine::class)->create();
        $maintenance = factory(Maintenance::class)->create([
            'description' => 'Trocar Filtro', 
            'machine_id'=>  $machine->id,
            'user_id' =>  $user->id,
        ]);
        
        $maintenance->description = "Manutenção atualizada";

        $this->put('/maintenance/'.$maintenance->id, $maintenance->toArray())
        ->assertStatus(302)
        ->assertRedirect('/login');
    }


    /** @test */
    public function authorized_user_can_delete_the_maintenance(){

        $this->signIn();

        $machine = factory(Machine::class)->create();
        $maintenance = factory(Maintenance::class)->create([
            'machine_id'=>  $machine->id,
        ]);

        $this->delete('/maintenance/'.$maintenance->id);

        $this->assertDatabaseMissing('maintenances',['id'=> $maintenance->id]);
    }
}
