<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SetDefaultLanguage
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        try {
            // Verifica se o usuário está autenticado via JWT
            if ($request->bearerToken() && auth('api')->check()) {
                $user = auth('api')->user();
                
                // Verifica se o usuário tem o campo 'language' antes de tentar definir
                if ($user && property_exists($user, 'language')) {
                    app()->setLocale($user->language);
                }
            }
        } catch (\Exception $e) {
            // Captura qualquer exceção para evitar erros 500
            // Você pode logar o erro se necessário
            // \Log::error('SetDefaultLanguage Error: ' . $e->getMessage());
        }

        return $next($request);
    }
}