<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    use HasFactory;
    protected $table = 'fct_messages';

    protected $fillable = [
        'user_id_from',
        'user_id_to',
        'message',
        'chat_room_id'
    ];

    public function chatRoom()
    {
        return $this->belongsTo(ChatRoom::class, 'chat_room_id');
    }

    public function user_from()
    {
        return $this->belongsTo(User::class, 'user_id_from');
    }

    public function user_to()
    {
        return $this->belongsTo(User::class, 'user_id_to');
    }
}
