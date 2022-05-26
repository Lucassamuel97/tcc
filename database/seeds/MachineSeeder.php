<?php

use Illuminate\Database\Seeder;
use App\Models\Machine;

class MachineSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Machine $machine){
        factory(Machine::class)->create([
            'description' => 'Trator 5070E John Deere',  
            'year_manufacture' => '2022'              
            ]);
    }
}
