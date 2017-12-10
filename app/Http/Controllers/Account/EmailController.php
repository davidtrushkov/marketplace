<?php

namespace App\Http\Controllers\Account;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Notifications\Notifiable;
use App\Notifications\EmailVerification;

class EmailController extends Controller {

	use Notifiable;


	/**
	 * Get the user token, and check if email is confirmed.
	 * -- confirmEmail located in User.php Model.
	 *
	 * @param $token
	 * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
	 */
	public function confirmEmail($token) {
		// Get the user with token, or fail.
		User::whereToken($token)->firstOrFail()->confirmEmail();

		// Flash a success message saying user has been confirmed.
		return redirect('/')->withSuccess('You are now confirmed.');
	}


	/**
	 * Send a email verification code to user if they have not gotten the email when they registered.
	 *
	 * @return \Illuminate\Http\RedirectResponse
	 */
	public function confirmEmailAgain() {

		$user = auth()->user();

		$user->notify(new EmailVerification($user));

		return back()->withSuccess('Email verification code sent to your email. Please check spam folder to.');
	}

}