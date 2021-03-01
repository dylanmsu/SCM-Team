<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\User;
use App\BoardData;
use Faker\Generator as Faker;

$factory->define(BoardData::class, function (Faker $faker) {
    return [
        'board' => $faker->randomElement($array = array ('A','B')),
        'temperature' => $faker->randomFloat($nbMaxDecimals = 2, $min = 15, $max = 20),
        'humidity' => $faker->randomFloat($nbMaxDecimals = 2, $min = 0, $max = 100),
        'lightLevel' => $faker->randomFloat($nbMaxDecimals = 0, $min = 15, $max = 1023),
        'created_at' => $faker->dateTimeBetween($startDate = 'now', $endDate = '+7 days', $timezone = 'CEST'),
    ];
});