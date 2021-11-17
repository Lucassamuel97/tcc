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
        factory(Machine::class, 2)->create();
    }
}
