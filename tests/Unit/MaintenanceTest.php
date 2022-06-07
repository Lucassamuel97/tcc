<?php

namespace Tests\Unit;
use App\Models\Maintenance;
use App\Models\Machine;
use Tests\TestCase;
use App\User;

class MaintenanceTest extends TestCase
{
     /** @test */
     public function check_if_maintenance_columns_is_correct()
     {
         $maintenance = new Maintenance;
 
         $expected = [
            'description',
            'machine_id',
            'range_hodometro',
            'range_months',
            'last_hodometro',
            'last_months',
            'user_id',
            'limit_date',
            'limit_hodometro'
         ];
 
         $arrayCompared = array_diff($expected, $maintenance->getFillable());
 
         $this->assertEquals(0,count($arrayCompared));
     }

     /** @test */
     public function checks_relation_with_machine()
     {
        $user = factory(User::class)->create();
        $machine = factory(Machine::class)->create();

        $maintenance = factory(Maintenance::class)->create([
            'description' => 'Trocar Filtro', 
            'machine_id'=>  $machine->id,
            'user_id'=> $user->id,
        ]);

        $machine2 = $maintenance->relMachine;
        
        $this->assertEquals($machine->id,$machine2->id);
     }
}
