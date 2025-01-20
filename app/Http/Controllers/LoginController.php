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


    
    public function AmIAuthenticated(Request $request)
    {
        // Depuración inicial para verificar los datos enviados en la solicitud
        $requestData = $request->all();
        //var_dump('Datos recibidos en la solicitud:', $requestData);
        Log::info('Datos recibidos en la solicitud:', $requestData);
    
        // Verifica si el usuario está autenticado
        if (Auth::check()) {
            // Obtén el usuario autenticado
            $user = Auth::user();
    
            // Verifica si el campo 'name' está presente en la solicitud y lo compara con el usuario autenticado
            $nameMatches = $request->has('name') && trim(strtolower($request->name)) === trim(strtolower($user->name));
    
            return response()->json([
                'authenticated' => true,
                'message' => 'Usuario autenticado previamente.',
                'name_matches' => $nameMatches,
                'user' => $user,
            ]);
        }
    
        // Respuesta en caso de que el usuario no esté autenticado
        return response()->json([
            'authenticated' => false,
            'message' => 'Usuario no autenticado.',
            'user' => null,
        ]);
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
