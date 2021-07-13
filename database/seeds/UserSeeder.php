<?php

use Illuminate\Database\Seeder;
use App\User;

class UserSeeder extends Seeder
{
    public function run(User $User)
    {
        $User->create([
            'name'=>'Lucas Samuel',
            'email'=>'lukassamuka88@gmail.com',
            'password'=>bcrypt('12345678'),
        ]);
    }
}
