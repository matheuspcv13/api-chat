<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckEmailVerified
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        // Verifica se o usuário está autenticado e se o e-mail foi verificado
        // if (Auth::check() && !Auth::user()->hasVerifiedEmail()) {
        //     return response()->json([
        //         'message' => 'Por favor, verifique seu e-mail antes de acessar este recurso.'
        //     ], 403); // Código de status 403: Forbidden
        // }

        return $next($request);
    }
}