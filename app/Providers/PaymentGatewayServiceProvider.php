<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Stripe\Stripe;

class PaymentGatewayServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        Stripe::setApiKey(config('services.stripe.secret'));
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
