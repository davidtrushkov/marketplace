<?php

namespace App\Http\Controllers\Admin;

use App\Sale;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AdminController extends Controller {


	/**
	 * Return admin main dashboard.
	 *
	 * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
	 */
    public function index() {

    	// Get all sales from the beginning of the current month till now.
	    $salesThisMonth = Sale::where('created_at', '>', Carbon::now()->firstOfMonth())
	                      ->where('sale_price', '>', 0)
	                      ->selectRaw('DATE_FORMAT(created_at, "%m/%d") as day, sum(sale_price) as sale_price')
	                      ->groupBy('day')
	                      ->pluck('sale_price', 'day');

	    // Get all the sales there ever was.
	    $overallSales = Sale::where('sale_price', '>', 0)
	                    ->selectRaw('DATE_FORMAT(created_at, "%Y/%m") as year, sum(sale_price) as sale_price')
	                    ->groupBy('year')
	                    ->pluck('sale_price', 'year');

	    return view('admin.index', compact('salesThisMonth', 'overallSales'));
    }


	/**
	 * Get a list of all current signed up users.
	 *
	 * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
	 */
    public function users() {

    	$users = User::latest()->paginate(50);

    	return view('admin.users.index', compact('users'));
    }


	/**
	 * Start impersonating a user. Login as them.
	 *
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
	 *
	 * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
	 */
    public function destroyImpersonate() {

    	session()->forget('impersonate');

    	return redirect('/');
    }

}
