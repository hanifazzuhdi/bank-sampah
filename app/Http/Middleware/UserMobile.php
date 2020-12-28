<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class UserMobile
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
        if (Auth::user() and (Auth::user()->role_id == 1 or Auth::user()->role_id == 2 or Auth::user()->role_id == 3)) {
            return $next($request);
        } else {
            return abort(403);
        }
    }
}
