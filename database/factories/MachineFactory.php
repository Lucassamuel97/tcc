<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Machine;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

$factory->define(Machine::class, function (Faker $faker) {
    return [
        'description' => "trator teste ".$faker->randomNumber(2),
        'status' => "1",
        'hodometro' => $faker->randomNumber(3),
        'identification_number' => Str::random(10),
    ];
});
