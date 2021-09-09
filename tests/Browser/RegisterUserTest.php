<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;
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
}
