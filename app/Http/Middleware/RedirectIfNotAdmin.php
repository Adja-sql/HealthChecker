<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RedirectIfNotAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    /*public function handle(Request $request, Closure $next): Response
    {
        return $next($request);
    }*/

    /*public function handle($request, Closure $next)
    {
        // Vérifier si l'utilisateur est un administrateur
        if (Auth::check() && Auth::user()->role === 'A') {
            return $next($request);
        }

        // Rediriger les utilisateurs non-admins vers leur dashboard
        return redirect('/dashboard');
    }*/

    public function handle(Request $request, Closure $next)
    {
        if (Auth::check() && Auth::user()->role === 'A') {
            return $next($request); // Admin accède à la route
        }

        return redirect('/dashboard'); // Redirige les non-admins vers le dashboard des utilisateurs
    }
}
