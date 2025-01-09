<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ValidateStudentId
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */

     public function handle(Request $request, Closure $next)
     {
         // Obtener el parámetro 'id' de la ruta
         $id = $request->route('id');
 
         // Verificar si el 'id' es numérico, entero y positivo
         if ( !is_numeric($id) || intval($id) != $id || intval($id) <= 0) {
             return response()->json([
                'sucess'=>false,
                'message' => 'ID invalido. Debe ser un valor entero positivo mayor que 0',
                'status' => 400
            ]);
         }
 
         return $next($request);
     }
}
