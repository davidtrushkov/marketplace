<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
	    DB::table('roles')->insert([
		    'name' => 'admin'
	    ]);

	    DB::table('users')->insert([
		    'name' => 'David Trushkov',
		    'email' => 'davidisback4good@hotmail.com',
		    'password' => bcrypt('d16331633'),
		    'remember_token' => str_random(10),
		    'verified' => 1,
		    'token' => '',
		    'created_at' => \Carbon\Carbon::now()->format('Y-m-d H:i:s'),
		    'updated_at' => \Carbon\Carbon::now()->format('Y-m-d H:i:s'),
	    ]);

	    DB::table('user_role')->insert([
		    'user_id' => 1,
		    'role_id' => 1
	    ]);

	    $this->call(UserTableSeeder::class);
	    $this->call(FilesTableSeeder::class);
	    $this->call(FileUploadsTableSeeder::class);
    }
}
