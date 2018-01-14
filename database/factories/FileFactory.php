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

$factory->define(App\File::class, function (Faker $faker) {

	$live = rand(0, 1);

	return [
		'identifier' => uniqid(),
		'user_id' => App\User::all()->random()->id,
		'title' => $faker->sentence($nbWords = 4),
		'overview_short' => $faker->sentence,
		'overview' => $faker->text($maxNbChars = 500),
		'price' => $faker->randomFloat($nbMaxDecimals = 2, $min = 0, $max = 125),
		'live' => $live,
		'approved' => $live,
		'finished' => $live,
		'created_at' =>$faker->dateTimeBetween($startDate = '-3 years', $endDate = 'now', $timezone = null),
		'updated_at' =>$faker->dateTimeBetween($startDate = '-2 years', $endDate = 'now', $timezone = null)
	];
});



$factory->define(App\Comment::class, function (Faker $faker) {

	return [
		'body' => $faker->sentence,
		'user_id' => App\User::all()->random()->id,
	];
});