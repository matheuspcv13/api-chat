<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

class EmailVerificationController extends Controller
{
    public function verify(EmailVerificationRequest $request)
    {
        $user = $request->user();

        if ($user->hasVerifiedEmail()) {
            return Response::json([
                'message' => 'Email already verified',
                'redirect' => url('/email-already-verified')
            ], 200);
        }

        if ($user->markEmailAsVerified()) {
            event(new \Illuminate\Auth\Events\Verified($user));
        }

        redirect()->route('email');
    }
}
