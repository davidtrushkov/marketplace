<?php

namespace App\Http\Controllers\Account;

use App\Sale;
use Carbon\Carbon;
use App\Http\Controllers\Controller;
use App\Notifications\PasswordChanged;
use App\Http\Requests\Account\PasswordStoreRequest;
use App\Http\Requests\Account\UpdateSettingsRequest;

class AccountController extends Controller {


	/**
	 * Get the main view from a users account area.
	 *
	 * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
	 */
    public function index() {

	    // Get all sales from the beginning of the current month till now for current user.
    	$salesThisMonth = Sale::where('user_id', '=', auth()->user()->id)
	        ->where('created_at', '>', Carbon::now()->firstOfMonth())
		    ->where('sale_price', '>', 0)
		    ->selectRaw('DATE_FORMAT(created_at, "%m/%d") as day, sum(sale_price) as sale_price')
		    ->groupBy('day')
		    ->pluck('sale_price', 'day');

	    // Get all the sales there ever was for this user (and limit to 24 months that user had sales so the bar chart doesn't overflow with too much data).
	    $overallSales = Sale::where('user_id', '=', auth()->user()->id)
	                 ->where('sale_price', '>', 0)
		             ->selectRaw('DATE_FORMAT(created_at, "%Y/%m") as year, sum(sale_price) as sale_price')
	                 ->groupBy('year')
		             ->limit(24)
	                 ->pluck('sale_price', 'year');

	    return view('account.index', compact('salesThisMonth', 'overallSales'));
    }


	/**
	 * Update user settings on account page.
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
	 * Return the view for all the files the current user has bought.
	 *
	 * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
	 */
    public function boughtIndex() {

	    $boughtFiles = Sale::boughtUserId()->latest()->paginate(8);

    	return view('account.bought.index', compact('boughtFiles'));
    }


	/**
	 * Return the view for all the files the current user has sold.
	 *
	 * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
	 */
    public function filesSold() {

    	$filesSold = Sale::where('user_id', auth()->user()->id)->latest()->paginate(15);

    	return view('account.sold.index', compact('filesSold'));
    }


	/**
	 * Get the view for all the unread notifications for current user.
	 *
	 * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
	 */
    public function getUnreadNotifications() {

	    $unreadNotifications = auth()->user()->unreadNotifications()->paginate(15);

    	return view('account.notifications.index', compact('unreadNotifications'));
    }


	/**
	 * Get the view for all the notification's for the current user.
	 *
	 * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
	 */
	public function getAllNotifications() {

		$notifications = auth()->user()->notifications()->paginate(15);

		return view('account.notifications.all-notifications', compact('notifications'));
	}


	/**
	 * Get the view for a particular notification for the current user.
	 * @param $id
	 *
	 * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
	 */
	public function showNotification($id) {

    	$notification = auth()->user()->notifications->where('id', $id)->first();

    	if (!$notification) {
    		return back();
	    }

    	return view('account.notifications.show', compact('notification'));
	}


	/**
	 * Mark a notification as "read" in database.
	 *
	 * @param $id
	 *
	 * @return \Illuminate\Http\RedirectResponse
	 */
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
	 * Get the view to change a users password.
	 *
	 * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
	 */
	public function changePassword() {
    	return view('account.password.index');
	}


	/**
	 * Change a users password.
	 *
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
