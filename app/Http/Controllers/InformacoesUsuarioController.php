<?php

namespace App\Http\Controllers;

use App\Models\InformacoesUsuario;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Support\Facades\Redis;

class InformacoesUsuarioController extends Controller implements HasMiddleware
{
    public static function middleware()
    {
        return [
            new Middleware('auth:sanctum', except: ['index', 'show'])
        ];
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return InformacoesUsuario::all();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // $data = $request->validate([
        //     'username' => ['required', 'min:4', 'max:15', 'unique:informacoes_usuarios']
        // ]);

        // $data['user_id'] = $request->user()->id;

        // $info = $request->user()->info()->create($data);

        // return $info;
    }

    /**
     * Display the specified resource.
     */
    public function show(InformacoesUsuario $informacoesUsuario)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(InformacoesUsuario $informacoesUsuario)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(User $user, Request $request)
    {
        $data = $request->validate([
            'username' => ['required', 'min:4', 'max:15', 'unique:informacoes_usuarios'],
            'data_nascimento' => ['date'],
            'photo' => ['required']

        ]);

        $data['user_id'] = $request->user()->id;

        $info = $request->user()->info()->create($data);

        return $info;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(InformacoesUsuario $informacoesUsuario)
    {
        //
    }
}
