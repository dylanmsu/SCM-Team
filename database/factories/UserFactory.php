<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\User;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(User::class, function (Faker $faker) {
    return [
        'first_name' => $faker->firstName($gender = null),
        'last_name' => $faker->lastName,
        'email' => $faker->unique()->safeEmail,
        'email_verified_at' => now(),
        'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
        'remember_token' => Str::random(10),
        'created_at' => null,
        'updated_at' => null,
        'username' => $faker->userName,
        'theme' => null,
        'lang'  => null,
        'role_id' => 2,
        'birth_day' => now(),
        'birth_place' => 'Oostende',
        'address' => 'nijverheidstraat, 12',
        'postal_code' => 8450,
        'residence' => 'Bredene',
        'province' => 'West-Vlaanderen',
        'country' => 'Belgie',
        'mobile_phone' => '+32470296996' 
    ];
});
