<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\User;
use App\Vehicle_comment;
use Faker\Generator as Faker;

$factory->define(Vehicle_comment::class, function (Faker $faker) {
    return [
        'remarks' => 'Hello World! :>', 
        'creator' => User::all()->random()->id,
    ];
});
