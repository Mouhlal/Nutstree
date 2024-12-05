<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class SyncCartSession
{
    public function handle($request, Closure $next)
    {
        if (Auth::check()) {
            app('App\Http\Controllers\CartsController')->syncSessionCart();
        }

        return $next($request);
    }
}
