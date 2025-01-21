<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class LoginController extends Controller
{
    public function login(Request $request)
    {
        //Comprobar si el usuario esta logado ya
        if (Auth::guard('api')->check()) {
            return response()->json([
                'success' => true,
                'message' => 'Usuario ya autenticado',
            ]);
        }

        // Validar los datos del formulario
        $data = $request->validate([
            'name' => 'required|string',
            'password' => 'required|string',
        ]);

        // Intentar autenticar al usuario
        if (Auth::attempt($data)) {
            $user = Auth::user();

            // Verificar si el usuario se encuentra en BBDD
            if (!$user) {
                return response()->json([
                    'success' => false,
                    'message' => 'Usuario no encontrado en la autenticación',
                ], 500);
            }

            // Se genera el token
            $token = $user->createToken('API Token')->plainTextToken;

            // Respuesta exitosa con el token generado
            return response()->json([
                'success' => true,
                'message' => 'Autenticación exitosa.',
                'token' => $token,
                'user' => $user,
            ]);
        }
    
        //Si llego hasta aqui las credenciales son incorrectas incorrectas
        return response()->json([
            'success' => false,
            'message' => 'Autenticación fallida. Verifica tus credenciales.',
        ], 401);
    }


    public function displayDataUserLogged(Request $request)
    {
              // Se obtiene el usuario 
              $user=Auth::guard('api')->user();
            return response()->json([
                'success' => true,
                'message' => 'Devolvemos los datos del usuario autenticado',
                'user' => $user // 
            ]);
    }

    public function logout(Request $request)
    {
        // Se obtiene el usuario 
        $user=Auth::guard('api')->user();
    
        // Revocar todos los tokens del usuario autenticado
        $user->tokens()->delete();
    
        return response()->json([
            'success' => true,
            'message' => 'Sesión cerrada exitosamente',
        ]);

    }

    public function hello(Request $request)
    {
        // Se muestra un mensaje de bienvenida
        return response()->json([
            'success' => true,
            'message' => 'WELCOME TO ORTU API. ENJOY!'
        ]);
   
    }


}
