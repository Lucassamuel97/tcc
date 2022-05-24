<?php

namespace Tests\Unit;
use App\Models\MaintenanceCheck;
use PHPUnit\Framework\TestCase;

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
}
