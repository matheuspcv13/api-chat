<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\InformacaoUsuario;

class InformacoesUsuario extends Controller
{
    protected $model;
    protected $request;

    public function __construct(Request $request)
    {
        $this->model = new InformacaoUsuario();
        $this->request = $request;
    }

    public function index()
    {
        // Exemplo de retorno de todas as informações de usuário
        $informacoes = $this->model->all();
        return response()->json($informacoes);
    }
}
