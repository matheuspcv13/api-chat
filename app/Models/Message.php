<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    use HasFactory;
    protected $table = 'mensagens';
    protected $fillable = ["conversa_id", "user_id", "mensagens", "file_path"];
}
