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
            $user = User::where('email', $credentials['email'])->first();
    
            $token = $user->createToken('auth_token')->plainTextToken;

            if (!$user->hasVerifiedEmail()) {

                $user->markEmailAsVerified();
            }
    
            return redirect()->route('email.verificado');
        }
    
        return redirect()->back()->withErrors([
            'message' => 'Credenciais inválidas',
        ]);
    }
}