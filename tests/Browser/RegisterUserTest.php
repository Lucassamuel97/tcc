<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Database\Factories\UserFactory;
use App\User;


class RegisterUserTest extends DuskTestCase
{
    /** @test */
    public function testExample()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/')
                    ->assertSee('Manutenções Preventivas');
        });
    }

     /** @test */
     public function check_if_login_function_is_working(){
        $this->browse(function (Browser $browser) {
            $browser->visit('/login')
                    ->type('email', 'lukassamuka88@gmail.com')
                    ->type('password', '12345678')
                    ->press('Login')
                    ->assertPathis('/')
                    ->assertSee('Você está logado!');
        });
     }

     /** @test */
     public function check_if_the_create_users_function_is_working(){
        $user = factory(User::class)->create([
            'is_admin' => 1,
        ]);

        $user2 = factory(User::class)->make();

        $this->browse(function ($browser) use ($user, $user2){
            $browser->loginAs($user)
                  ->visit('/users')
                  ->assertSee('Novo Usuário')
                  ->clickLink('Novo Usuário')
                  ->assertPathis('/users/create')
                  ->value('#name',$user2->name)
                  ->value('#email',$user2->email)
                  ->value('#password', '12345678')
                  ->value('#password-confirm','12345678')
                  ->press('Gravar')
                  ->assertPathis('/users');
        });
     }
}
