<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\User::class, function (Faker\Generator $faker) {
    static $password;

    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'password' => $password ?: $password = bcrypt('secret'),
        'typeUser_id' => 2,
        'remember_token' => str_random(10),
    ];
});

$factory->define(App\Tool::class, function (Faker\Generator $faker) {
	
    return [
        'name' => $faker->unique()->sentence($nbWords = 3, $variableNbWords = true),
        'description' => $faker->sentence($nbWords = 6),
        'toolType_id' => $faker->numberBetween($min = 1, $max = 7)
    ];
});