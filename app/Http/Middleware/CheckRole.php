<?php

namespace App\Http\Middleware;


use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Closure;
use Illuminate\Support\Facades\Auth;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle($request, Closure $next, $role)
    {
        if (!Auth::check() || Auth::user()->rol !== $role) {
            abort(403, 'Acceso no autorizado.');
        }

        return $next($request);
    }
}
