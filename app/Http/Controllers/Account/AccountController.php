<?php

namespace App\Http\Controllers\Account;

use App\Http\Requests\Account\UpdateSettingsRequest;
use App\Sale;
use App\Http\Controllers\Controller;

class AccountController extends Controller
{

	/**
	 * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
	 */
    public function index() {
	    return view('account.index');
    }


	/**
	 * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
	 */
    public function boughtIndex() {

	    $boughtFiles = Sale::boughtUserId()->latest()->paginate(8);

    	return view('account.bought.index', compact('boughtFiles'));
    }


	/**
	 *  Update user settings on account page.
	 *
	 * @param UpdateSettingsRequest $request
	 *
	 * @return \Illuminate\Http\RedirectResponse
	 */
    public function update(UpdateSettingsRequest $request) {

    	if (request('avatar_id')) {
		    $request->user()->update($request->only(['name', 'avatar_id']));
	    } else {
		    $request->user()->update($request->only(['name']));
	    }

	    return redirect()->back()->withSuccess('Settings updated.');
    }

}
