<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string|min:6',
        ]);

        //Buscar usuario por email
        $user = User::where('email', $request->email)->first();

        //Verificar contraseña
        if (!$user || !Hash::check($request->password, $user->password)) {
            return response()->json([
                'success' => false,
                'message' => 'Credenciales inválidas'
            ], 401);
        }

        //Crear token de acceso
        //Tendra el nombre del rol

        $token = $user->createToken($user->role)->plainTextToken;

        return response()->json([
            'success' => true,
            'message'=> 'Inicio de sesión exitoso',
            'data' => [
                'user' => $user,
                'token' => $token
            ]
        ], 200); 
    }


    //Post api logout
    public function logout(Request $request)
    {
        //Revoke el token del usuario autenticado
        $request->user()->currentAccessToken()->delete();

        return response()->json([
            'success' => true,
            'message' => 'Cierre de sesión exitoso'
        ], 200);
    }

    //Post api register - Crear nuevo usuario
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|string|min:6|confirmed',
            'role' => 'sometimes|string|in:user,admin,cliente'
        ]);

        try {
            //Crear nuevo usuario
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'role' => $request->role ?? 'user'
            ]);

            //Crear token de acceso
            $token = $user->createToken($user->role)->plainTextToken;

            return response()->json([
                'success' => true,
                'message' => 'Usuario registrado exitosamente',
                'data' => [
                    'user' => $user,
                    'token' => $token
                ]
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error al registrar usuario: ' . $e->getMessage()
            ], 500);
        }
    }
}
