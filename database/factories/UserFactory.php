<?php

use Faker\Generator as Faker;

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

$factory->define(App\User::class, function (Faker $faker) {

    static $password;

    return [
        'name' => $faker->firstName,
        'email' => $faker->unique()->safeEmail,
        'password' => $password ?: $password = bcrypt('secret'),
        'remember_token' => str_random(10),
	    'verified' => 1,
	    'token' => '',
	    'avatar' => '',
	    'stripe_id' => '',
	    'stripe_key' => '',
        'created_at' =>$faker->dateTimeBetween($startDate = '-2 years', $endDate = 'now', $timezone = null),
        'updated_at' =>$faker->dateTimeBetween($startDate = '-2 years', $endDate = 'now', $timezone = null)
    ];
});