<?php

namespace App\Listeners\Checkout;

use App\Events\Checkout\SaleCreated;
use App\Mail\Checkout\SaleConfirmationToBuyer;

class SendEmailToBuyer
{

	/**
	 * @param SaleCreated $event
	 */
    public function handle(SaleCreated $event)
    {
	    \Mail::to($event->sale->buyer_email)->send(new SaleConfirmationToBuyer($event->sale));
    }
}
