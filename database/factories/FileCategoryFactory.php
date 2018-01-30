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

$factory->define(App\Category::class, function (Faker $faker) {
	return [
		'name' => $slug = $faker->unique()->randomElement($array = array ('Code', 'Templates', 'Photoshop', 'Images', 'Graphics', 'Icons', 'Fonts')),
		'slug' => str_slug($slug),
		'created_at' =>$faker->dateTimeBetween($startDate = '-2 years', $endDate = 'now', $timezone = null),
		'updated_at' =>$faker->dateTimeBetween($startDate = '-2 years', $endDate = 'now', $timezone = null)
	];
});
