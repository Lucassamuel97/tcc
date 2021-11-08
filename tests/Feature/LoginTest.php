<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\CreatesApplication;
use Illuminate\Foundation\Testing\WithFaker;
use App\User;
use Auth;
use Tests\TestCase;
use Illuminate\Validation\ValidationException;

class LoginTest extends TestCase
{
    use CreatesApplication;
    use RefreshDatabase;

    /** @test */
    public function redirect_unauthenticated_user()
    {
        $response = $this->get('/home')
        ->assertRedirect('/login');
    }

    /** @test */
    public function authenticate_user()
    {
        $this->withoutExceptionHandling();
        
        $user = factory(User::class)->create();
        
        $user = [
            "email" => $user->email,
            "password" => "12345678"
        ];

        $response = $this->get('/login')
        ->assertStatus(200);

        $response = $this->post('/login', $user)
        ->assertRedirect('/home');
    }

    /** @test */
    public function wrong_user_data_validation(){
        $this->withoutExceptionHandling();
        
        $user = factory(User::class)->create();
        
        $user = [
            "email" =>  $user->email,
            "password" => "123456789" //senha errada
        ];

        $this->expectException(ValidationException::class);
        $response = $this->post('/login', $user);

    }
}
