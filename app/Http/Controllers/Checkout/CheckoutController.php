<?php

namespace App\Http\Controllers\Checkout;

use App\File;
use App\Http\Requests\Checkout\FreeCheckoutRequest;
use App\Http\Controllers\Controller;
use App\Jobs\Checkout\CreateSale;
use Illuminate\Http\Request;
use Stripe\Charge;

class CheckoutController extends Controller
{

	/** Process the Free checkout for a file along with its uploads.
	 * @param FreeCheckoutRequest $request
	 * @param File $file
	 *
	 * @return \Illuminate\Http\RedirectResponse
	 */
    public function free (FreeCheckoutRequest $request, File $file) {

    	// Check if the file is free
    	if (!$file->isFree()) {
		    return back();
	    }

	    // Create a 'Job' to create a sale
	    $this->dispatch(new CreateSale($file, $request->email));

	    return back()->withSuccess('We\'ve emailed your download link to you. ');
    }


	/**
	 * @param Request $request
	 * @param File $file
	 *
	 * @return mixed
	 */
    public function payment(Request $request, File $file) {

	    try {
		    $charge = Charge::create([
			    'amount' => $file->price * 100,
			    'currency' => 'usd',
			    'description' => 'Charge for: '. str_limit($file->title, 100),
			    'source' => $request->stripeToken,
			    'application_fee' => floor($file->calculateCommission() * 100),
			    'metadata' => [
			    	'file_identifier' => $file->identifier,
				    'file_title' => $file->title,
				    'file_short_description' => $file->overview_short,
				    'file_user' => $file->user->name
			    ]
		    ], [
			    'stripe_account' => $file->user->stripe_id
		    ]);
	    } catch (\Exception $e) {
		    return back()->withError('Something went wrong while processing your payment.');
	    }

	    // Create a 'Job' to create a sale
	    $this->dispatch(new CreateSale($file, $request->stripeEmail));

	    return back()->withSuccess('Payment complete. We\'ve emailed your download link to you.');
    }
}
