<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class WebAuthController extends Controller
{
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            $token = $user->createToken('auth_token')->plainTextToken;

            return redirect()->intended('/api/email-already-verified')->header('Authorization', 'Bearer ' . $token);
        }

        return redirect()->back()->withErrors([
            'message' => 'Credenciais inválidas',
        ]);
    }
}