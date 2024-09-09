<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Conversas extends Model
{
    use HasFactory;
    protected $fillable = ["sender_id", "receiver_id", "message", "seen", "sequency"];

    public function rules()
    {
        return [
            "user_id" => "required",
        ];
    }
}
