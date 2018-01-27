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

$factory->define(App\Sale::class, function (Faker $faker) {

	$user_id =  App\User::all()->random()->id;

	$file_id = \App\File::where('user_id', '=', $user_id)->first();

	return [
		'identifier' => uniqid(),
		'user_id' => $user_id,
		'bought_user_id' => App\User::all()->random()->id,
		'file_id' => $file_id,
		'buyer_email' => $faker->email,
		'sale_price' => $faker->randomFloat($nbMaxDecimals = 2, $min = 0, $max = 125),
		'sale_commission' => $faker->randomFloat($nbMaxDecimals = 2, $min = 0, $max = 50),
		'created_at' =>$faker->dateTimeBetween($startDate = '-2 years', $endDate = 'now', $timezone = null),
		'updated_at' =>$faker->dateTimeBetween($startDate = '-2 years', $endDate = 'now', $timezone = null)
	];
});