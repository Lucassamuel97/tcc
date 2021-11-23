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
        
        factory(Maintenance::class)->create(['description' => 'Trocar Filtro de óleo do motor']);
        factory(Maintenance::class)->create(['description' => 'Trocar Óleo do motor']);
        factory(Maintenance::class)->create(['description' => 'Trocar Óleo do eixo dianteiro redução final']);
        factory(Maintenance::class)->create(['description' => 'Trocar Óleo do eixo dianteiro diferencial']);
        factory(Maintenance::class)->create(['description' => 'Trocar Filtro da transmissão de sucção primário']);
        factory(Maintenance::class)->create(['description' => 'Trocar Filtro da transmissão de sucção secundário']);
        factory(Maintenance::class)->create(['description' => 'Trocar Filtro de combustível']);
        factory(Maintenance::class)->create(['description' => 'Trocar Filtro de combustível de linha']);
        factory(Maintenance::class)->create(['description' => 'Trocar Filtro de ar motor primário']);
        factory(Maintenance::class)->create(['description' => 'Trocar Filtro de ar motor secundário']);
        factory(Maintenance::class)->create(['description' => 'Trocar Filtro de ar externo da cabine']);
        factory(Maintenance::class)->create(['description' => 'Trocar Filtro de recirculação de ar da cabine']);
        
     }
}
