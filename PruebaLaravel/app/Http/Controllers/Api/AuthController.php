<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
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
}
