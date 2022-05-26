<?php

namespace Tests\Unit;
use App\Models\MaintenancePostpone;
use PHPUnit\Framework\TestCase;

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
}
