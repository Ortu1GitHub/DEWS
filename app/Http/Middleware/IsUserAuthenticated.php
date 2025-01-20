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
       // Si el usuario está autenticado
       if (Auth::check()) {
        return response()->json([
            'success' => true,
            'message' => 'Usuario autenticado por middleware custom',
        ]);
    }

    // Si el usuario no está autenticado, responder inmediatamente con un error
    return response()->json([
        'success' => false,
        'message' => 'Acceso denegado: usuario no autenticado',
    ], 401); // Código 401: Unauthorized
    }
}
