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
		'avatar' => $faker->image('public/images/files/cover',1000,700, null, false),
		'youtube_url' => 'https://www.youtube.com/watch?v=Ff6bi8rkLpg',
		'vimeo_url' => 'https://vimeo.com/99232333',
		'created_at' =>$faker->dateTimeBetween($startDate = '-2 years', $endDate = 'now', $timezone = null),
		'updated_at' =>$faker->dateTimeBetween($startDate = '-2 years', $endDate = 'now', $timezone = null)
	];
});



$factory->define(App\Comment::class, function (Faker $faker) {

	$file = rand(1, 30);

	return [
		'user_id' => App\User::all()->random()->id,
		'parent_id' => null,
		'body' => $faker->sentence,
		'commentable_id' => $file,
		'commentable_type' => 'App\File',
		'created_at' =>$faker->dateTimeBetween($startDate = '-1 years', $endDate = 'now', $timezone = null),
		'updated_at' =>$faker->dateTimeBetween($startDate = '-1 years', $endDate = 'now', $timezone = null)
	];
});