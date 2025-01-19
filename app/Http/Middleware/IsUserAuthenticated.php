<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class IsUserAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Si el usuario ya está autenticado, lo bloqueamos (redirigimos a otra página o mostramos un mensaje)
        if (Auth::check()) {
            return response()->json([
                'success' => false,
                'message' => 'Usuario ya autenticado por middlewre custom'
            ]);
        }

        // Si el usuario no está autenticado, dejamos que continúe con la solicitud
        return $next($request);
    }
}
