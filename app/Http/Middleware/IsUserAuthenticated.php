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
       // Si el usuario está no esta autenticado
       if (!Auth::guard('api')->check()) {
        return response()->json([
            'success' => false,
            'message' => 'Acceso denegado: Usuario no autenticado',
        ], 401);
        
    }
    
    return $next($request);

    }
}
