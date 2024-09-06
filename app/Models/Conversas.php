<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Conversas extends Model
{
    use HasFactory;
    protected $fillable = ["user_id", "conversa_id", "sequencia"];

    public function rules()
    {
        return [
            "user_id" => "required",
        ];
    }
}
