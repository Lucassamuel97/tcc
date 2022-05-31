<?php
namespace Tests\Unit;

use App\Models\UpdateHodometro;
use App\Models\Machine;
use Tests\TestCase;
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

    /** @test */
    public function checks_relation_with_other_models()
    {
       $user = factory(User::class)->create();
       $machine = factory(Machine::class)->create();

       $updateHodometro = factory(UpdateHodometro::class)->create([
        'machine_id'=>  $machine->id,
        'user_id'=> $user->id,
        ]);

       $machine2 = $updateHodometro->relMachine;
       $user2 = $updateHodometro->relUser;
       
       $this->assertEquals($machine->id,$machine2->id);
       $this->assertEquals($user->id, $user2->id);
    }
}
