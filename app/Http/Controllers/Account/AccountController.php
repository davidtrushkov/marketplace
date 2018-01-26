<?php

namespace App\Http\Controllers\Account;

use App\Http\Requests\Account\PasswordStoreRequest;
use App\Http\Requests\Account\UpdateSettingsRequest;
use App\Notifications\PasswordChanged;
use App\Sale;
use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;

class AccountController extends Controller
{

	/**
	 * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
	 */
    public function index() {
	    return view('account.index');
    }


	/**
	 *  Update user settings on account page.
	 *
	 * @param UpdateSettingsRequest $request
	 *
	 * @return \Illuminate\Http\RedirectResponse
	 */
	public function update(UpdateSettingsRequest $request) {

		$request->user()->update($request->only(['name']));

		return redirect()->back()->withSuccess('Settings updated.');
	}


	/**
	 * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
	 */
    public function boughtIndex() {

	    $boughtFiles = Sale::boughtUserId()->latest()->paginate(8);

    	return view('account.bought.index', compact('boughtFiles'));
    }


	/**
	 * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
	 */
    public function filesSold() {

    	$filesSold = Sale::where('user_id', auth()->user()->id)->latest()->paginate(15);

    	return view('account.sold.index', compact('filesSold'));
    }


    public function getUnreadNotifications() {

	    $unreadNotifications = auth()->user()->unreadNotifications()->paginate(15);

    	return view('account.notifications.index', compact('unreadNotifications'));
    }


	public function getAllNotifications() {

		$notifications = auth()->user()->notifications()->paginate(15);

		return view('account.notifications.all-notifications', compact('notifications'));
	}


	public function showNotification($id) {

    	$notification = auth()->user()->notifications->where('id', $id)->first();

    	if (!$notification) {
    		return back();
	    }

    	return view('account.notifications.show', compact('notification'));
	}


	public function markAsRead($id) {

		$notification = auth()->user()->notifications->where( 'id', $id )->first();

		if (!$notification) {
			return back();
		} else {
			$notification->update( [ 'read_at' => now() ] );
		}

		return redirect( route( 'get.all.notifications' ) )->withSuccess( 'Notification marked as read' );
	}


	/**
	 * Get the view to chnage a users password.
	 * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
	 */
	public function changePassword() {
    	return view('account.password.index');
	}


	/**
	 * Change a users password.
	 * @param PasswordStoreRequest $request
	 *
	 * @return mixed
	 */
	public function changePasswordStore(PasswordStoreRequest $request) {

		$request->user()->update([
			'password' => bcrypt($request->password)
		]);

		$user = $request->user();

		$user->notify(new PasswordChanged($user));

		return back()->withSuccess('Password updated successfully!');
	}
}
