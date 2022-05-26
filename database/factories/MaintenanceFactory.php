<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Maintenance;
use Faker\Generator as Faker;
use Illuminate\Support\Str;
    
$factory->define(Maintenance::class, function (Faker $faker) {
    return [
        'description'=>'Manutenção Descrição',
        'machine_id'=> '1',
        'user_id'=> '1',
        'range_hodometro'=> '100',
        'range_months'=> '12',
        'last_hodometro'=> '0',
        'last_months'=> '2021-01-01',
        'limit_date'=> '2021-12-01',
        'limit_hodometro'=> '100',
    ];
});
