<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InformacaoUsuario extends Model
{
    use HasFactory;

    protected $fillable = ['username', 'image_path'];
}
