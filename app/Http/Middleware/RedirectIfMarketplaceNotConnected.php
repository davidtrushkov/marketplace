<?php

namespace App\Http\Middleware;

use Closure;

class RedirectIfMarketplaceNotConnected
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
    	// If a user does not have a stripe ID, then redirect with error
    	if (!auth()->user()->stripe_id) {
    		return redirect()->route('account.connect');
	    }

        return $next($request);
    }
}
