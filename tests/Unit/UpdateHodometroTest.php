<?php
namespace Tests\Unit;
use App\Models\UpdateHodometro;
use PHPUnit\Framework\TestCase;
use App\User;

class UpdateHodometroTest extends TestCase
{
    /** @test */
    public function check_if_update_hodometro_columns_is_correct()
    {
        
        $updateHodometro = new UpdateHodometro([
        'machine_id' => '1',
        'user_id' => '1',
        'hodometro' => '200'
        ]);
 
        $expected = [
            'machine_id',
            'user_id',
            'hodometro'
        ];
        
        $arrayCompared = array_diff($expected, $updateHodometro->getFillable());
 
        $this->assertEquals(0,count($arrayCompared));
    }
}
