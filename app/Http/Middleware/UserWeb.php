<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class UserWeb
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
        if (Auth::user() and (Auth::user()->role_id == 5 or Auth::user()->role_id == 4)) {
            return $next($request);
        } else {
            return redirect('/');
        }
    }
}
