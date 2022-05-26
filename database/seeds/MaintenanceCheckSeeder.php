<?php

use Illuminate\Database\Seeder;
use App\Models\MaintenanceCheck;

class MaintenanceCheckSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(MaintenanceCheck $maintenanceCheck){
        factory(MaintenanceCheck::class)->create();
    }
}
