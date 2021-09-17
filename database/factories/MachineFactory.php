<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Machine;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

$factory->define(Machine::class, function (Faker $faker) {
    return [
        'description' => $faker->sentence,
        'status' => "1",
        'hodometro' => $faker->randomNumber(5),
        'identification_number' => Str::random(10),
    ];
});
