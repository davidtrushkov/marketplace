<?php

namespace App\Http\Controllers\Account;

use App\Http\Controllers\Controller;
use App\Http\Requests\Account\StoreAvatarFormRequest;

class AvatarController extends Controller
{


	/**
	 * Create and store image in database for user avatar.
	 *
	 * @param StoreAvatarFormRequest $request
	 *
	 * @return \Illuminate\Http\RedirectResponse
	 */
    public function store(StoreAvatarFormRequest $request) {

    	if (request('avatar')) {

		    // Get the current user
		    $user = auth()->user();

		    // Get the current file uploaded
		    $avatar = request()->file( 'avatar' );

		    // Get the file name
		    $avatarName = sha1( $avatar->getClientOriginalName() );

		    // Get the file extension
		    $avatarExtension = $avatar->getClientOriginalExtension();

		    // Combine the image name and extension
		    $image = "{$avatarName}.{$avatarExtension}";

		    // Move the file to a path with the image name
		    $request->file( 'avatar' )->move(
			    base_path() . '/public/images/avatars/', $image
		    );

		    // Set the users avatar to the image
		    $user->avatar = $image;

		    // Save the image to database
		    $user->save();

		    return back();
	    } else {
    		return back();
	    }
    }
}
