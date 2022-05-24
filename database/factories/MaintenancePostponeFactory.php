<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use App\Models\MaintenancePostpone;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

$factory->define(MaintenancePostpone::class, function (Faker $faker) {
    return [
        'maintenance_id' => '1',
        'user_id' => '1',
        'postpone_months' => $faker->randomNumber(1),
        'postpone_hodometro' => $faker->randomNumber(2),
        'note' => 'Nota checagem',
    ];
});
