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

$factory->define(App\Upload::class, function (Faker $faker) {

	$user_id = App\User::all()->random()->id;

	$file_id = \App\File::where('user_id', '=', $user_id)->first();

	return [
		'user_id' => $user_id,
		'file_id' => $file_id,
		'filename' => $faker->image('public/images/fake',1000,700, null, false),
		'size' => $faker->numberBetween($min = 1000, $max = 1000000),
		'approved' => rand(0, 1),
		'created_at' =>$faker->dateTimeBetween($startDate = '-3 years', $endDate = 'now', $timezone = null),
		'updated_at' =>$faker->dateTimeBetween($startDate = '-2 years', $endDate = 'now', $timezone = null)
	];
});