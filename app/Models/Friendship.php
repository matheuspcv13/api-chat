<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Friendship extends Model
{
    use HasFactory;
    protected $table = 'friendship';
    protected $fillable = ['user_id', 'friend_id', 'status', 'username'];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * Relacionamento: O amigo que recebeu a solicitação de amizade.
     */
    public function friend()
    {
        return $this->belongsTo(User::class, 'friend_id');
    }
}