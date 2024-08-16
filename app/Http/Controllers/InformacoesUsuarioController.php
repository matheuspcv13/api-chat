<?php

namespace App\Http\Controllers;

use App\Models\InformacoesUsuario;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;

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
    public function index(Request $request)
    {
        InformacoesUsuario::all();
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'username' => ['required', 'min:4', 'max:15', 'unique:informacoes_usuarios']
        ]);

        $data['user_id'] = $request->user()->id;

        $info = $request->user()->info()->create($data);

        return $info;
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
    public function update()
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(InformacoesUsuario $informacoesUsuario)
    {
        //
    }
}
