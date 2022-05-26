<?php

use Illuminate\Database\Seeder;
use App\Models\Maintenance;

class MaintenanceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Maintenance $maintenance){

        factory(Maintenance::class)->create([
            'description' => 'Trocar Filtro de óleo do motor', 
            'range_hodometro' => 100,
            'limit_hodometro'=> '100',
            'range_months'=> '10',
            'last_months'=> '2021-01-01',
            'limit_date'=> '2021-12-01',
        ]);
        
        // factory(Maintenance::class)->create([
        //     'description' => 'Trocar Óleo do motor',
        //     'range_hodometro' => 100
        // ]);
        // factory(Maintenance::class)->create([
        //     'description' => 'Trocar Óleo do eixo dianteiro redução final',
        //     'range_hodometro' => 100
        // ]);
        // factory(Maintenance::class)->create([
        //     'description' => 'Trocar Óleo do eixo dianteiro diferencial',
        //     'range_hodometro' => 100
        // ]);
        // factory(Maintenance::class)->create([
        //     'description' => 'Trocar Filtro da transmissão de sucção primário',
        //     'range_hodometro' => 100
        // ]);
        // factory(Maintenance::class)->create([
        //     'description' => 'Trocar Filtro da transmissão de sucção secundário',
        //     'range_hodometro' => 100
        // ]);
        // factory(Maintenance::class)->create([
        //     'description' => 'Trocar Filtro de combustível'
        // ]);
        // factory(Maintenance::class)->create([
        //     'description' => 'Trocar Filtro de combustível de linha'
        // ]);
        // factory(Maintenance::class)->create([
        //     'description' => 'Trocar Filtro de ar motor primário'
        // ]);
        // factory(Maintenance::class)->create([
        //     'description' => 'Trocar Filtro de ar motor secundário'
        // ]);
        // factory(Maintenance::class)->create([
        //     'description' => 'Trocar Filtro de ar externo da cabine'
        // ]);
        // factory(Maintenance::class)->create([
        //     'description' => 'Trocar Filtro de recirculação de ar da cabine'
        // ]);
        
    }
}
