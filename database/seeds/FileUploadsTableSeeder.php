<?php

use Illuminate\Database\Seeder;

class FileUploadsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
	    factory(App\Upload::class, 100)->create();
    }
}
