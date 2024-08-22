<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\InformacoesUsuario;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $data = $request->validate([
            'name' => ['required', 'string'],
            'email' => ['required', 'email', 'unique:users'],
            'password' => ['required', 'confirmed', 'min:4']
        ]);

        $data['password'] = Hash::make($data['password']); // criptografando senha

        $user = User::create($data); // criando usuarios e resgatando seu objeto
        $token = $user->createToken('auth_token')->plainTextToken; // criando token e retornando em forma de texto simples

        if (isset($user->id)) {
            $dataInfo = ['user_id' => $user->id, 'username' => 'user_' . Str::random(5)];

            InformacoesUsuario::create($dataInfo);
        }

        return response()->json([
            'user' => $user,
            'token' => $token
        ], 201);
    }

    public function login(Request $request)
    {
        $data = $request->validate([
            'email' => ['required', 'email', 'exists:users'],
            'password' => ['required', 'min:4']
        ]);

        $user = User::where('email', $data['email'])->first(); // buscando usuario

        // verificando se nao usuario foi encontrato ou se a senha nao corresponde
        if (!$user || !Hash::check($data['password'], $user->password)) {
            return response([
                'message' => 'Dados Inválidos',
            ], 401);
        }

        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'user' => $user,
            'token' => $token
        ], 200);
    }

    public function logout(Request $request)
    {

        $request->user()->tokens()->delete();

        return ['message' => 'Voce saiu...'];
    }
}
