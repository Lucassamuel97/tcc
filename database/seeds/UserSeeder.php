<?php

use Illuminate\Database\Seeder;
use App\User;

class UserSeeder extends Seeder
{
    public function run(User $User)
    {
        $User->create([
            'name'=>'Lucas Samuel',
            'email'=> 'lukassamuka88@gmail.com',
            'is_admin'=> '1',
            'password'=>bcrypt('12345678'),
        ]);

        factory(User::class, 25)->create();
    }
}
