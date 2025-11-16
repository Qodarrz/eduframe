<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class RedirectIfNotGuest
{
    public function handle($request, Closure $next, $guard = 'guest')
    {
        if (!Auth::guard($guard)->check()) {
            return redirect()->route('guest.login');
        }
        return $next($request);
    }
}
