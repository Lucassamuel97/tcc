<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UserTest extends TestCase
{
    // /** @test */
    // public function testApplication()
    // {
    //     $user = factory(App\User::class)->create();

    //     $this->actingAs($user)
    //          ->withSession(['foo' => 'bar'])
    //          ->visit('/')
    //          ->see('Hello, '.$user->name);
    // }


    /** @test */
    public function check_if_user_columns_is_correct()
    {
        $user = new User;

        $expected = [
            'name',
            'email',
            'password'
        ];

        $arrayCompared = array_diff($expected, $user->getFillable());

        $this->assertEquals(0,count($arrayCompared));
    }
}
