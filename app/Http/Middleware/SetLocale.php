<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;

class SetLocale
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
        // Si l'utilisateur est authentifié et a une langue définie
        if (Auth::check() && Auth::user()->langue) {
            // Définir la langue de l'application
            App::setLocale(Auth::user()->langue);
        }

        return $next($request);
    }
}
