<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Facades\JWTAuth;

class AuthController extends Controller
{
    public function login(Request $request): \Illuminate\Http\JsonResponse
    {
        $credentials = $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);

        if (!$token = JWTAuth::attempt($credentials)) {
            return response()->json(['error' => 'Credenciais inválidas'], 401);
        }

        // Verificar se é administrador
        $userCheckAdmin = User::where('username', $credentials['username'])->first();
        if ($userCheckAdmin && $userCheckAdmin->profile === 'ADMINISTRADOR') {
            if (Hash::check($credentials['password'], $userCheckAdmin->password)) {
                $token = JWTAuth::fromUser($userCheckAdmin);
                return response()->json([
                    'token' => $token,
                    'user' => $userCheckAdmin,
                ], 200);
            } else {
                return response()->json(['message' => 'Senha incorreta'], 401);
            }
        }

        $user = User::FindOrCreate([
            'username' => $credentials['username'],
        ]);

        $token = JWTAuth::fromUser($user);

        return response()->json([
            'token' => $token,
            'user' => $user,
        ], 200);
    }

    public function logout(Request $request): \Illuminate\Http\JsonResponse
    {
        try {
            JWTAuth::invalidate(JWTAuth::getToken());
            return response()->json(['message' => 'Terminada sessão com sucesso'], 200);
        } catch (JWTException $e) {
            return response()->json(['error' => 'Falha ao terminar. Tente novamente'], 500);
        }
    }
}
