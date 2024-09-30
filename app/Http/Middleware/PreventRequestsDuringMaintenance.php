<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Foundation\Http\Exceptions\MaintenanceModeException;

class PreventRequestsDuringMaintenance
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (app()->isDownForMaintenance()) {
            throw new MaintenanceModeException;
        }

        return $next($request);
    }
}
