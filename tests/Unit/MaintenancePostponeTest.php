<?php

namespace Tests\Unit;

use App\Models\MaintenancePostpone;
use App\Models\Maintenance;
use App\Models\Machine;
use Tests\TestCase;
use App\User;

class MaintenancePostponeTest extends TestCase
{
    /** @test */
    public function check_if_maintenance_postpone_columns_is_correct()
    {
        $maintenancepostpone = new MaintenancePostpone;

        $expected = [
            'maintenance_id',
            'user_id',
            'postpone_months',
            'postpone_hodometro',
            'note'
        ];

        $arrayCompared = array_diff($expected, $maintenancepostpone->getFillable());

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

       $postpone = factory(MaintenancePostpone::class)->create([
        'maintenance_id'=>  $maintenance->id,
        'user_id'=> $user->id,
        ]);

       $maintenance2 = $postpone->relMaintenances;
       $user2 = $postpone->relUsers;
       
       $this->assertEquals($maintenance->id,$maintenance2->id);
       $this->assertEquals($user->id,$user2->id);
    } 
}
