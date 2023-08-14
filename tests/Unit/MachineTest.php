<?php

namespace Tests\Unit;
use App\Models\Machine;
use PHPUnit\Framework\TestCase;

class MachineTest extends TestCase
{
    /** @test */
    public function check_if_machine_columns_is_correct()
    {
        $machine = new Machine;

        
        $expected = [
            'manufacturer',
            'status',
            'description',
            'identification_number',
            'engine_number',
            'serial_number',
            'mounting_number',
            'year_manufacture',
            'model',
            'hodometro'
        ];

        $arrayCompared = array_diff($expected, $machine->getFillable());

        $this->assertEquals(0,count($arrayCompared));
    }
}
