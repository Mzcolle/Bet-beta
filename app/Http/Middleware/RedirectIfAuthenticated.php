<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
public function handle($request, Closure $next)
{
    if ($request->bearerToken()) {
        try {
            if (auth('api')->check()) {
                app()->setLocale(auth('api')->user()->language);
            }
        } catch (\Exception $e) {
            // Ignora erro
        }
    }

    return $next($request);
}
}
