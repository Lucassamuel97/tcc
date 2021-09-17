<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Machine;
use App\User;
use Tests\CreatesApplication;
use Illuminate\Validation\ValidationException;

class MachineTest extends TestCase
{
    
    use CreatesApplication;
    use RefreshDatabase;
    
    protected function signIn($user = null){
        $user = $user ?? factory(User::class)->create();
        $this->actingAs($user);
        return $this;
    }

    /** @test */
    public function authenticated_user_can_read_all_the_machines()
    {
        $this->withoutExceptionHandling();
        $this->signIn();

        $machine = factory(Machine::class)->create();
        $machine2 = factory(Machine::class)->create();
     
        $response = $this->get('/machines');

        $response->assertSee($machine->description);
        $response->assertSee($machine2->description);
    }

    /** @test */
    public function authenticated_users_can_create_a_new_machine()
    {
        $this->withoutExceptionHandling();
        $this->signIn();

        $machine = factory(Machine::class)->make();
        
        $this->post('/machines', $machine->toArray());      
        $this->assertEquals(1, Machine::all()->count());
    }

     /** @test */
     public function unauthenticated_users_cannot_create_a_machine()
     {
        $machine = factory(Machine::class)->make();
        $this->post('/machines', $machine->toArray())     
         ->assertRedirect('/login');
     }

    /** @test */
    public function a_user_can_read_a_machine()
    {
        $this->withoutExceptionHandling();
        $this->signIn();

        $machine = factory(Machine::class)->create();
        
        $response = $this->get('/machines/'.$machine->id);

        $response->assertSee($machine->description)
            ->assertSee($machine->hodometro);
    }


     /** @test */
     public function a_user_can_read_a_machine_to_edit()
     {
         $this->withoutExceptionHandling();
         $this->signIn();
 
         $machine = factory(Machine::class)->create();
         
         $response = $this->get('/machines/'.$machine->id.'/edit');
 
         $response->assertSee($machine->description)
             ->assertSee($machine->hodometro);
     }

    /** @test */
    public function machine_registration_validation(){
        $this->signIn();

        $machine = factory(Machine::class)->make([
            'description' => null,
        ]);

        $this->withoutExceptionHandling();

        $this->expectException(ValidationException::class);
        $this->expectExceptionMessage('The given data was invalid.');
        $this->post(route('machines.store'), $machine->toArray());
    }

    /** @test */
    public function the_user_can_update_the_machine(){
        
        $this->withoutExceptionHandling();
        $this->signIn();

        $machine = factory(Machine::class)->create();
        
        $machine->description = "Maquinario atualizado";

        $this->put('/machines/'.$machine->id, $machine->toArray());
        
        $this->assertDatabaseHas('machines',['id'=> $machine->id , 'description' => 'Maquinario atualizado']);
        $this->assertDatabaseHas('machines',['id'=> $machine->id , 'hodometro' => $machine->hodometro]);
    }

     /** @test */
     public function unauthorized_user_cannot_update_the_machine(){
        
        $machine = factory(Machine::class)->create();
        
        $machine->description = "Maquinario atualizado";

        $this->put('/machines/'.$machine->id, $machine->toArray())
        ->assertStatus(302)
        ->assertRedirect('/login');
    }

    /** @test */
    public function authorized_user_can_delete_the_machine(){

        $this->signIn();

        $machine = factory(Machine::class)->create();

        $this->delete('/machines/'.$machine->id);

        $this->assertDatabaseMissing('machines',['id'=> $machine->id]);
    }
}
