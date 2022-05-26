<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\MaintenanceCheck;
use Faker\Generator as Faker;
use Illuminate\Support\Str;
    
$factory->define(MaintenanceCheck::class, function (Faker $faker) {
    return [
        'maintenance_id' => '1',
        'user_id' => '1',
        'price' => $faker->randomNumber(3),
        'note' => 'Nota checagem',
        'hodometro' => $faker->randomNumber(3),
    ];
});
