<?php

use Illuminate\Database\Seeder;

class FileCategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
	public function run()
	{
		factory(App\Category::class, 7)->create();
	}
}
