<?php

namespace App\Http\Middleware\Admin;

use Closure;

class Impersonate
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
    	if (session()->has('impersonate')) {
    		\Auth::onceUsingId(session('impersonate'));
	    }

        return $next($request);
    }
}
