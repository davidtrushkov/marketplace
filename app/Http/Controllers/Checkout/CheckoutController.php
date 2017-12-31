<?php

namespace App\Http\Controllers\Checkout;

use App\File;
use App\Http\Requests\Checkout\FreeCheckoutRequest;
use App\Http\Controllers\Controller;
use App\Jobs\Checkout\CreateSale;

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
}
