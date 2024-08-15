<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $data = $request->validate([
            'name' => ['required', 'string'],
            'email' => ['required', 'email', 'unique:users'],
            'password' => ['required', 'min:4']
        ]);

        $data['password'] = Hash::make($data['password']); // criptografando senha

        $user = User::create($data); // criando usuarios e resgatando seu objeto
        $token = $user->createToken('auth_token')->plainTextToken; // criando token e retornando em forma de texto simples

        return [
            'user' => $user,
            'token' => $token
        ];
    }

    public function login (Request $request)
    {
        $data = $request->validate([
            'email' => ['required', 'email', 'exists:users'],
            'password' => ['required', 'min:4']
        ]);

        $user = User::where('email', $data['email'])->first(); // buscando usuario

        // verificando se nao usuario foi encontrato ou se a senha nao corresponde
        if(!$user || !Hash::check($data['password'], $user->password))
        {
            return response([
                'message' => 'Dados Inválidos',
            ], 401);
        }

        $token = $user->createToken('auth_token')->plainTextToken;

        return [
            'user' => $user,
            'token' => $token
        ];
    }
}
