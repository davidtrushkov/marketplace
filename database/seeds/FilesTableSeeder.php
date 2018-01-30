<?php

use Illuminate\Database\Seeder;

class FilesTableSeeder extends Seeder {


    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
	    factory(App\File::class, 60)->create();
	    factory(App\Comment::class, 400)->create();
    }
}
