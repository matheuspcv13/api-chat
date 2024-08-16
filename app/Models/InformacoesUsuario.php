<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class InformacoesUsuario extends Model
{
    use HasFactory;

    protected $fillable = ['username', 'image_path', 'data_nascimento', 'telefone', 'user_id'];

    public function user()
    {
        return $this->hasOne(User::class);
    }
}
