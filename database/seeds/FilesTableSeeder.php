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
	    $file = factory(App\File::class)->create();

	    $comments = factory(\App\Comment::class, 50)->create()->each(function ($comment) use ($file) {
		    $comment->replies()->saveMany($this->createComments($comment, $file,4));
	    });

	    $file->comments()->saveMany($comments);
    }



    protected function createComments($comment, $file, $depth = 3, $currentDepth = 0) {

    	if ($currentDepth === $depth) {
    		return;
	    }

    	return $comment->replies()->saveMany(
    		factory(\App\Comment::class, 3)->create()->each(function ($reply) use ($depth, $currentDepth, $file) {
			    $file->comments()->save($reply);

			    $this->createComments($reply, $file, $depth, ++$currentDepth);
		    })
	    );
    }
}
