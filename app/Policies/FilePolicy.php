<?php

namespace App\Policies;

use App\File;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class FilePolicy
{
    use HandlesAuthorization;

	/**
	 * Check if a user can make changes to a file.
	 * @param User $user
	 * @param File $file
	 *
	 * @return bool
	 */
    public function touch(User $user, File $file) {
    	// Compare the user ID =  the file user ID
	    return $user->id == $file->user_id;
    }
}
