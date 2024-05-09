<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    use HasFactory;

    protected $fillable = [ //avoiding mass asignment
        'content',
        'chat_id',
        'sender_user_id',
        'receiver_user_id',
    ];

    public function chat(){
        return $this->belongsTo(Chat::class);
    }
}
