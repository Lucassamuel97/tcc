<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $this->call(UserSeeder::class);
        $this->call(MachineSeeder::class);
        $this->call(MaintenanceSeeder::class);
        // $this->call(MaintenanceCheckSeeder::class);
    }
}
