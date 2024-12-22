<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App;

class SetLocale
{
    public function handle(Request $request, Closure $next)
    {
        // Vérifier si la langue existe dans la session, sinon utiliser la langue par défaut
        $locale = session('locale', config('app.locale'));

        // Changer la langue de l'application
        App::setLocale($locale);

        return $next($request);
    }
}
