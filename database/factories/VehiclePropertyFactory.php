<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Vehicle_property;
use Faker\Generator as Faker;

$factory->define(Vehicle_property::class, function (Faker $faker) {
    return [
        'key' => $faker->word, 
        'value' => $faker->word,
        'type' => 'general'
    ];
});
