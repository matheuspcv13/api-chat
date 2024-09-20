<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Messages extends Model
{
    use HasFactory;
    protected $fillable = [
        "conversa_id",
        "user_id",
        "mensagem",
        "file_path"
    ];

    public function conversation()
    {
        return $this->hasOne(Conversas::class);
    }
}
