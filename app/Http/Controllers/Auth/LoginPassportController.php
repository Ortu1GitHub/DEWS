<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class LoginPassportController extends Controller
{
    public function register(Request $request)
    {
        // Validación de los datos
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        // Crear el nuevo usuario
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        // Generar el token para el usuario
        $token = $user->createToken('JSON token')->accessToken;

        // Retornar respuesta con el token
        return response()->json(['token' => $token], 201);
    }

    public function loginEmailOrName(Request $request)
    {
        // Validación de los datos
        $validator = Validator::make($request->all(), [
            'email_or_name' => 'required|string',
            'password' => 'required|string|min:8',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        // Intentar obtener al usuario por email o nombre
        $user = User::where('email', $request->email_or_name)
                    ->orWhere('name', $request->email_or_name)
                    ->first();

                    if (!$user) {
                        return response()->json(['error' => 'Credenciales inválidas'], 401);
                    }
                
                    // Verificar la contraseña
                    if (!Hash::check($request->password, $user->password)) {
                        return response()->json(['error' => 'Credenciales inválidas'], 401);
                    }
                
                    // Generar el token de acceso con Passport
                    try {
                        $token = $user->createToken('User Access Token')->accessToken;
                    } catch (\Exception $e) {
                        return response()->json(['error' => 'No se pudo generar el token', 'message' => $e->getMessage()], 500);
                    }
                
                    if (!$token) {
                        return response()->json(['error' => 'Token no generado correctamente'], 500);
                    }
                
                    // Retornar respuesta con el token
                    return response()->json(['token' => $token], 200);
    }

    public function getUserData(Request $request)
    {
        // Retornar los datos del usuario autenticado
        return response()->json([
            //El método Request::user() proporciona los datos del usuario autenticado automáticamente.
            'user' => $request->user(),
        ], 200);
    }

    /*
    public function logout(Request $request)
    {
        // Obtener el usuario autenticado
        $user = $request->user();

        if ($user) {
            // Revocar todos los tokens del usuario
            $user->tokens()->delete();

            return response()->json(['message' => 'Cierre de sesión exitoso. Todos los tokens han sido revocados.'], 200);
        }

        return response()->json(['error' => 'No se pudo procesar la solicitud'], 400);
    }
    */

    public function logout(Request $request)
{
    $user = $request->user(); // Obtenemos el usuario autenticado

    if (!$user) {
        return response()->json(['error' => 'Usuario no autenticado o token inválido'], 401);
    }

    // Revocar todos los tokens del usuario
    try {
        $user->tokens()->delete();
        return response()->json(['message' => 'Cierre de sesión exitoso. Todos los tokens han sido revocados.'], 200);
    } catch (\Exception $e) {
        return response()->json(['error' => 'Error al cerrar sesión', 'message' => $e->getMessage()], 500);
    }
}
}
