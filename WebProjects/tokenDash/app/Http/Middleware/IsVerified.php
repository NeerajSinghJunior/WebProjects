<?php

namespace App\Http\Middleware;

use Closure;
use Jrean\UserVerification\Exceptions\UserNotVerifiedException;

class IsVerified
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
        if(! is_null($request->user()) && ! $request->user()->verified) {
            $request->session()->flush();
            return redirect()->route('unverified');
        }

        return $next($request);
    }
}
