<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Tests\CreatesApplication;
use Illuminate\Validation\ValidationException;
use App\User;

class ReportTest extends TestCase
{
    use CreatesApplication;
    use RefreshDatabase;

    protected function signIn($user = null){
        $user = $user ?? factory(User::class)->create();
        $this->actingAs($user);
        return $this;
    }

    /** @test */
    public function authenticated_user_can_read_reports()
    {
        $this->withoutExceptionHandling();
        $this->signIn();
     
        $response = $this->get('/report/maintenances');

        $response->assertSee("Relatório de Manutenções por maquinário");
    }

    /** @test */
    public function authenticated_user_can_read_maintenance_reports()
    {
         $this->withoutExceptionHandling();
         $this->signIn();
        
        $response = $this->get('/maintenances/report/');
        $response->assertStatus(200);
        
        $response = $this->json('GET','/maintenances/report/', [
            'status'=>'1',
        ]); 
        $response->assertStatus(200);
        $response = $this->json('GET','/maintenances/report/', [
            'user'=> '1',
            'machine'=> '1',
            'initial_date'=>'2020-12-01',
            'final_date'=>'2022-12-01',
            'status'=>'2',
            ]); 
        $response->assertStatus(200);
    }

     /** @test */
    public function authenticated_user_can_read_reports_expenses()
    {
        $this->withoutExceptionHandling();
        $this->signIn();
     
        $response = $this->get('/report/maintenances/expenses');

        $response->assertSee("Relatório de Gastos com Manutenções");
    }

    /** @test */
    public function authenticated_user_can_read_maintenance_reports_expenses()
    {
         $this->withoutExceptionHandling();
         $this->signIn();
      
        $response = $this->get('report/maintenances/expenses/pdf');
        $response->assertStatus(200);
        $response = $this->json('GET','report/maintenances/expenses/pdf', [
            'user'=> '1',
            'machine'=> '1',
            'initial_date'=>'2020-12-01',
            'final_date'=>'2022-12-01',
            ]); 
        $response->assertStatus(200);
    }
}
