<?php

namespace App\Http\Controllers\Checkout;

use App\Http\Controllers\Controller;

class WebHooksController extends Controller {

	public function handle() {
		die(var_dump(request()->all()));
	}

}