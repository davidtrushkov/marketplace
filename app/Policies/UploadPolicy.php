<?php

namespace App\Policies;

use App\User;
use App\Upload;
use Illuminate\Auth\Access\HandlesAuthorization;

class UploadPolicy
{
    use HandlesAuthorization;

	public function touch(User $user, Upload $upload) {
		// Compare the user ID =  the upload user ID
		return $user->id == $upload->user_id;
	}
}
