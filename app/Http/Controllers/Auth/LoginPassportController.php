<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;

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

        return response()->json(['Usuario registrado' => $user], 201);
    }

    public function loginEmailOrName(Request $request)
    {
        // Validar los datos del body
        $data = $request->validate([
            'name_or_email' => 'required|string',
            'password' => 'required|string',
        ]);
    
        // Intentar autenticar al usuario con name o email
        if (Auth::attempt(['email' => $data['name_or_email'], 'password' => $data['password']]) ||
            Auth::attempt(['name' => $data['name_or_email'], 'password' => $data['password']])) {
            
            $user = Auth::user();
    
            // Generar el token de acceso con Passport
            $token = $user->createToken('token')->accessToken;
    
            // Retornar respuesta con el token
            return response()->json(['token' => $token], 200);
        }
    
        // Si no se encuentra al usuario o las credenciales son incorrectas
        return response()->json(['error' => 'Usuario o contraseña incorrectos'], 401);
    }
    
    public function getUserData(Request $request)
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
        
        // Revocar todos los tokens del usuario
        try {
            $user->tokens->each(function ($token) {
                $token->delete();
            });
    
            return response()->json(['message' => 'Cierre de sesión exitoso. Todos los tokens han sido revocados.'], 200);
        } catch (\Exception $e) {
            Log::error('Error al revocar los tokens', ['error' => $e->getMessage()]);
            return response()->json(['error' => 'Error al cerrar sesión', 'message' => $e->getMessage()], 500);
        }
    }
}
