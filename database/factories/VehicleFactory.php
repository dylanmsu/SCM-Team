<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Vehicle;
use Faker\Generator as Faker;

$factory->define(Vehicle::class, function (Faker $faker) {
    return [
        'category' => $faker->randomElement($array = array ('motorwagen','diesellocomotief','stoomlocomotief','werfvoertuig','rijtuig','wagen','andere')),
        'name' => $faker->bothify('??####'), 
        'state' => 'in_dienst', 
        'type' => $faker->randomElement($array = array ('smal', 'normaal'))
    ];
});
