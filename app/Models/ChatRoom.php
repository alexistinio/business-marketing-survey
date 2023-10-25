<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChatRoom extends Model
{
    use HasFactory;

    protected $table = "fct_message_chat_room";

    protected $fillable = [
        'user_ids',
        'chat_id',
        'status_id',
    ];

    public function messages()
    {
        return $this->hasMany(Message::class, 'chat_room_id');
    }
}
