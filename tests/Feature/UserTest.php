<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\WithFaker;
use App\User;
use Auth;
use Tests\TestCase;
use Tests\CreatesApplication;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UserTest extends TestCase
{
    use CreatesApplication;
    use RefreshDatabase;

    protected function signIn($user = null){
        $user = $user ?? factory(User::class)->create(['is_admin' => 1]);
        $this->actingAs($user);
        return $this;
    }

    /** @test */
    public function authenticated_user_can_read_all_the_users()
    {

        $this->withoutExceptionHandling();
        $this->signIn();

        $user = factory(User::class)->create();
        $user2 = factory(User::class)->create();

        $response = $this->get('/users');

        $response->assertSee($user->name);
        $response->assertSee($user->email);
        $response->assertSee($user2->name);
    }

    /** @test */
    public function authenticated_users_can_create_a_new_user()
    {
        $this->signIn();

        $userData = [
            "name" => "Lucas Samuel Teste",
            "is_admin" => "0",
            "email" => "teste@boeing.com.br",
            "password" => "12345678",
            "password_confirmation" => "12345678"
        ];

        $response = $this->get('/users')
        ->assertStatus(200);

        $this->post('/users', $userData);      
        $this->assertEquals(2,User::all()->count());
    }

     /** @test */
    public function unauthenticated_users_cannot_create_a_new_user()
    {
        $userData = [
            "name" => "Lucas Samuel Teste",
            "is_admin" => "0",
            "email" => "teste@boeing.com.br",
            "password" => "12345678",
            "password_confirmation" => "12345678"
        ];
        $this->post('/users', $userData)     
        ->assertRedirect('/login');
    }

    /** @test */
    public function an_administrator_can_read_a_user()
    {
        $this->withoutExceptionHandling();
        
        $user = factory(User::class)->create([
            'is_admin' => 1,
        ]);
        
        $this->signIn($user);

        $response = $this->get('/users/'.Auth::id().'/edit');

        $response->assertSee($user->name)
            ->assertSee($user->email);
    }

    /** @test */
    public function user_registration_validation(){

        $this->withoutExceptionHandling();
        $this->signIn();

        $user = [
            "name" => null,
            "is_admin" => "0",
            "email" => null,
            "password" => null,
            "password_confirmation" => "12345678"
        ];

        $this->post('/users', $user)
            ->assertSessionHasErrors('name')
            ->assertSessionHasErrors('email')
            ->assertSessionHasErrors('password');
    }

    /** @test */
    public function authorized_user_can_update_the_user(){
        
        $this->withoutExceptionHandling();
        $this->signIn();

        $user = factory(User::class)->create();
        
        $userUpdate = [
            "id" => $user->id,
            "name" => "Updated Name",
            "is_admin" => "0",
            "email" => "update@email.com.br",
            "password" => "12345678",
            "password_confirmation" => "12345678"
        ];
        
        $this->put('/users/'.$user->id, $userUpdate);
        
        $this->assertDatabaseHas('users',['id'=> $user->id , 'name' => 'Updated Name']);
        $this->assertDatabaseHas('users',['id'=> $user->id , 'email' => 'update@email.com.br']);
    }

     /** @test */
     public function unauthorized_user_cannot_update_the_user(){
        
        $user = factory(User::class)->create([
            'is_admin' => 0,
        ]);
        
        $this->signIn($user);
        
        $user2 = factory(User::class)->create();
        $userUpdate = [
            "id" => $user2->id,
            "name" => "Updated Name",
            "is_admin" => "0",
            "email" => "update@email.com.br",
            "password" => "12345678",
            "password_confirmation" => "12345678"
        ];

        $response = $this->put('/users/'.$user2->id, $userUpdate);
        $response->assertStatus(403);
    }

    /** @test */
    public function authorized_user_can_delete_the_user(){

        $this->signIn();

        $userDelete = factory(User::class)->create();

        $this->delete('/users/'.$userDelete->id);

        $this->assertDatabaseMissing('users',['id'=> $userDelete->id]);
    }

    /** @test */
    public function unauthorized_user_cannot_delete_the_user(){
        
        $user = factory(User::class)->create([
            'is_admin' => 0,
        ]);
        
        $this->signIn($user);

        $userDelete = factory(User::class)->create();

        $response = $this->delete('/users/'.$userDelete->id);

        $response->assertStatus(403);
    }
}
