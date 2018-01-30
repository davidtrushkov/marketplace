<?php

use Illuminate\Database\Seeder;

class SalesTableSeeder extends Seeder
{
	public function run()
	{
		factory(App\Sale::class, 300)->create();
	}
}
