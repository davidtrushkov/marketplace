<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{

    public function index() {
	    return view('admin.index');
    }


	/**
	 * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
	 */
    public function users() {

    	$users = User::latest()->paginate(50);

    	return view('admin.users.index', compact('users'));
    }


	/**
	 * Start impersonating a user. Login as them.
	 * @param Request $request
	 * @param $id
	 *
	 * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
	 */
    public function impersonate(Request $request, $id) {

    	if (!auth()->user()->isAdmin()) {
		    $user = User::where( 'id', '=', $id )->first();

		    session()->put( 'impersonate', $user->id );

		    return redirect( '/' );
	    }

	    return back();
    }


	/**
	 * Stop impersonating a user. Remove session.
	 * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
	 */
    public function destroyImpersonate() {

    	session()->forget('impersonate');

    	return redirect('/');
    }
}
