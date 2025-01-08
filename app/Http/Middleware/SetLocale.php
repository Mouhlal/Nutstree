<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App;

class SetLocale
{
    public function handle($request, Closure $next)
    {
        $locale = session('locale', config('app.locale'));
        app()->setLocale($locale);
        return $next($request);
    }
}
