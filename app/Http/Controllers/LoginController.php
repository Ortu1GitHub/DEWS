<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class LoginController extends Controller
{
    public function login(Request $request)
    {
        // Validar los datos del formulario
        $data = $request->validate([
            'name' => 'required|string',
            'password' => 'required|string',
        ]);

        // Obtener las credenciales del usuario
        $credentials = $request->only('name', 'password');

        // Intentar autenticar al usuario
        if (Auth::attempt($credentials)) {
            $user = Auth::user();

            // Verificar si el usuario fue autenticado correctamente
            if (!$user) {
                return response()->json([
                    'success' => false,
                    'message' => 'Usuario no encontrado tras la autenticación.',
                ], 500);
            }

            // Intentar generar un token de Sanctum
            try {
                $token = $user->createToken('API Token')->plainTextToken;
            } catch (\Exception $e) {
                return response()->json([
                    'success' => false,
                    'message' => 'Error al generar el token.',
                    'error' => $e->getMessage(),
                ], 500);
            }

            // Respuesta exitosa con el token generado
            return response()->json([
                'success' => true,
                'message' => 'Autenticación exitosa.',
                'token' => $token,
                'user' => $user,
            ]);
        }
    
        // Si las credenciales son incorrectas
        return response()->json([
            'success' => false,
            'message' => 'Autenticación fallida. Verifica tus credenciales.',
        ], 401);
    }

    public function testLogin(Request $request)
    {
        if (Auth::check()) {
            return response()->json([
                'message' => 'Usuario autenticado previamente',
                'user' => Auth::user(),
            ]);
        }

        return response()->json([
            'message' => 'Usuario no autenticado previamente',
        ], 401);
    }


    public function displayDataUserLogged(Request $request)
    {
        // Obtener el usuario autenticado
        //$user = Auth::user();
        $user = $request->only('name', 'password');
            return response()->json([
                'success' => true,
                'user' => $user // Devolvemos los datos del usuario autenticado
            ]);
        
    }

}
