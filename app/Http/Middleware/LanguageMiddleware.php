<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;

class LanguageMiddleware
{
    public function handle($request, Closure $next)
    {
        // Si une langue est dans la session, on l'utilise, sinon on utilise la langue par défaut
        $lang = Session::get('lang', config('app.locale'));
        App::setLocale($lang);

        return $next($request);
    }
}
