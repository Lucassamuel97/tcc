<?php

namespace Tests\Unit;

use App\Models\MaintenanceCheck;
use App\Models\Maintenance;
use App\Models\Machine;
use Tests\TestCase;
use App\User;

class MaintenanceCheckTest extends TestCase
{
    /** @test */
    public function check_if_maintenance_check_columns_is_correct()
    {
        $maintenanceCheck = new MaintenanceCheck;

        $expected = [
            'maintenance_id',
            'user_id',
            'price',
            'note',
            'hodometro'
        ];

        $arrayCompared = array_diff($expected, $maintenanceCheck->getFillable());

        $this->assertEquals(0,count($arrayCompared));
    }

    /** @test */
    public function checks_relation_with_other_models()
    {
       $user = factory(User::class)->create();
       $machine = factory(Machine::class)->create();

       $maintenance = factory(Maintenance::class)->create([
           'machine_id'=>  $machine->id,
           'user_id'=> $user->id,
       ]);

       $accomplish = factory(MaintenanceCheck::class)->create([
        'maintenance_id'=>  $maintenance->id,
        'user_id'=> $user->id,
        ]);

       $maintenance2 = $accomplish->relMaintenances;
       $user2 = $accomplish->relUsers;
       
       $this->assertEquals($maintenance->id,$maintenance2->id);
       $this->assertEquals($user->id,$user2->id);
    }
    
    
}
