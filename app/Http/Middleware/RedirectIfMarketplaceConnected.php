<?php

namespace App\Http\Middleware;

use Closure;

class RedirectIfMarketplaceConnected
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
	    // If a user does have a stripe ID, then redirect to users account area
	    if (auth()->user()->stripe_id) {
		    return redirect()->route('account');
	    }

        return $next($request);
    }
}
