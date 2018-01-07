<?php

namespace App\Http\Controllers\Account;

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

}
