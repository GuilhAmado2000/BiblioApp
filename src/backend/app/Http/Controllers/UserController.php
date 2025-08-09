<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Exception;

class UserController extends Controller
{
    public function index(): \Illuminate\Http\JsonResponse
    {
        $allUsers = User::all();
        return response()->json($allUsers);
    }

    public function create(Request $request): \Illuminate\Http\JsonResponse
    {
        $validated = $request->validate([
            'username' => 'required|string|min:2|max:30|unique:users,username',
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => [
                'required',
                'string',
                'min:8',
                'regex:/[a-z]/',      // pelo menos uma letra minúscula
                'regex:/[A-Z]/',      // pelo menos uma letra maiúscula
                'regex:/[0-9]/',      // pelo menos um número
                'regex:/[\W_]/',      // pelo menos um caractere especial
                'confirmed'           // confirma com password_confirmation
            ],
        ]);

        try {
            $user = User::FindOrCreate([
                'username' => $validated['username'],
                'name' => $validated['name'],
                'email' => $validated['email'],
                'password' => $validated['password'],
            ]);

            return response()->json(['message' => 'Criado leitor com sucesso!', 'user' => $user], 201);

        } catch (Exception $exception) {
            return response()->json(['message' => 'Falha ao criar leitor', 'error' => $exception->getMessage()], 500);
        }
    }
}
