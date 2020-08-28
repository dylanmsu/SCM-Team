<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Splitflap;
use Faker\Generator as Faker;

$factory->define(Splitflap::class, function (Faker $faker) {
    return [
        'board' => $faker->randomElement($array = array ('A','B')), 
        'align' => $faker->randomElement($array = array ('left','center','right')), 
        'first_text' => $faker->word, 
        'second_text' => $faker->word, 
        'icon_index' => rand(5, 15), 
        'time' => $faker->dateTimeBetween($startDate = 'now', $endDate = '+30 days', $timezone = 'CEST'),
        'creator' => 1
    ];
});
