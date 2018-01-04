<?php

namespace App\Http\Controllers\Account;

use GuzzleHttp\Client as Guzzle;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class MarketPlaceConnectController extends Controller
{


	/**
	 * MarketPlaceConnectController constructor.
	 */
	public function __construct() {
		$this->middleware(['auth', 'has.marketplace']);
	}


	/**
	 * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
	 */
	public function index() {

		session(['stripe_token' => str_random(60)]);

		return view('account.marketplace.index');
	}


	/**
	 * @param Request $request
	 * @param Guzzle $guzzle
	 *
	 * @return \Illuminate\Http\RedirectResponse
	 */
	public function store(Request $request, Guzzle $guzzle) {

		// If no request code found, return redirect to account connect route.
		if (!$request->code) {
			return redirect()->route('account.connect');
		}

		// If no session found, return redirect to account connect route.
		if ($request->state !== session('stripe_token')) {
			return redirect()->route('account.connect');
		}

		$stripeRequest = $guzzle->request('POST', 'https://connect.stripe.com/oauth/token', [
			'form_params' => [
				'client_secret' => config('services.stripe.secret'),
				'code' => $request->code,
				'grant_type' => 'authorization_code'
			]
		]);

		$stripeRequest = json_decode($stripeRequest->getBody());

		$request->user()->update([
			'stripe_id' => $stripeRequest->stripe_user_id,
			'stripe_key' => $stripeRequest->stripe_publishable_key,
		]);

		return  redirect()->route('account')->withSuccess('You have connected your Stripe account.');

	}
}
