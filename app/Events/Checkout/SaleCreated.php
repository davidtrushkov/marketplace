<?php

namespace App\Events\Checkout;

use App\Sale;
use Illuminate\Queue\SerializesModels;;
use Illuminate\Foundation\Events\Dispatchable;

class SaleCreated
{
    use Dispatchable, SerializesModels;


    public $sale;


	/**
	 * SaleCreated constructor.
	 *
	 * @param Sale $sale
	 */
    public function __construct(Sale $sale)
    {
        $this->sale = $sale;
    }
}
