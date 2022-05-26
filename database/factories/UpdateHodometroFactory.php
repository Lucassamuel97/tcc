<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\UpdateHodometro;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

$factory->define(UpdateHodometro::class, function (Faker $faker) {
    return [
        'machine_id' => '1',
        'user_id' => '1',
        'hodometro' => $faker->randomNumber(4),
    ];
});