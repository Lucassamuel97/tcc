<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Machine;
use Faker\Generator as Faker;

$factory->define(Machine::class, function (Faker $faker) {
    return [
        'description' => $faker->sentence,
        'status' => "1",
        'hodometro' => Str::random(10),
        'identification_number' => Str::random(10),
    ];
});
