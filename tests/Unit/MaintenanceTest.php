<?php

namespace Tests\Unit;
use App\Models\Maintenance;
use PHPUnit\Framework\TestCase;

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
}
