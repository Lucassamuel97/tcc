<?php

namespace Tests\Feature;


use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Tests\CreatesApplication;
use Illuminate\Validation\ValidationException;
use App\User;

class HomeTest extends TestCase
{
    use CreatesApplication;
    use RefreshDatabase;
    
    protected function signIn($user = null){
        $user = $user ?? factory(User::class)->create();
        $this->actingAs($user);
        return $this;
    }

    /** @test */
    public function authenticated_user_can_read_home()
    {
        $this->withoutExceptionHandling();
        $this->signIn();
     
        $response = $this->get('/home');

        $response->assertSee("Dashboard");
    }
}
