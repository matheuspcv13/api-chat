<?php

namespace App\Http\Controllers;

use App\Models\InformacoesUsuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\User;

class InformacoesUsuarioController extends Controller
{
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
    public function store(Request $request) {}

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
    public function update(Request $request)
    {
        $data = $request->validate([
            'username' => ['required', 'min:4', 'max:15', 'unique:informacoes_usuarios,username,' . $request->user()->id],
            'data_nascimento' => ['required', 'date_format:Y-m-d'],
        ]);
        
        $info = InformacoesUsuario::where('user_id', $request->user()->id)->first();
        
        if ($info) {

            // if ($request->hasFile('photo')) {

            //     if ($info->photo) {
            //         Storage::disk('public')->delete($info->photo);
            //     }
        
            //     // Armazena a nova foto e atualiza o caminho
            //     $photoPath = $request->file('photo')->store('photos', 'public');
            //     $data['photo'] = $photoPath;
            //     $data['photo_url'] = Storage::url($photoPath);
            // }
        
            $info->update($data);
            
            return response()->json($info);
        } else {
            return response()->json(['error' => 'User info not found'], 404);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(InformacoesUsuario $informacoesUsuario)
    {
        //
    }
}
