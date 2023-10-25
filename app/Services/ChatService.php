<?php

namespace App\Services;

use App\Models\ChatRoom;
use App\Models\Message;

class ChatService {

    public function chatRoomExists($sender_id, $reciever_id)
    {
        $exists = ChatRoom::where('user_ids', implode(',', [$sender_id, $reciever_id]))->where('status_id', STATUS_ACTIVE)->exists();
        $exists = !$exists ? ChatRoom::where('user_ids', implode(',',[$reciever_id, $sender_id]))->where('status_id', STATUS_ACTIVE)->exists() : $exists;

        return $exists;
    }

    public function createRoom($sender_id, $reciever_id)
    {
        if(!$this->chatRoomExists($sender_id, $reciever_id)){
            $chat_room = ChatRoom::create([
                'user_ids' => implode(',', [$sender_id, $reciever_id]),
                'chat_id' => str()->random(14),
                'status_id' => STATUS_ACTIVE,
            ]);

            return $chat_room;
        }
    }

    public function getChatRoomKey($sender_id, $reciever_id)
    {
        $chat_room = ChatRoom::select('chat_id')->where('user_ids', implode(',', [$sender_id, $reciever_id]))
        ->where('status_id', STATUS_ACTIVE)
        ->first();

        if(!$chat_room) {
            $chat_room = ChatRoom::select('chat_id')->where('user_ids', implode(',', [$reciever_id, $sender_id]))
            ->where('status_id', STATUS_ACTIVE)
            ->first();
        }

        return $chat_room ? $chat_room->chat_id : null;
    }

    public function getChatRoom($sender_id, $reciever_id)
    {
        $chat_room = ChatRoom::where('user_ids', implode(',', [$sender_id, $reciever_id]))
        ->where('status_id', STATUS_ACTIVE)
        ->first();

        if(!$chat_room) {
            $chat_room = ChatRoom::where('user_ids', implode(',', [$reciever_id, $sender_id]))
            ->where('status_id', STATUS_ACTIVE)
            ->first();
        }

        return $chat_room ? $chat_room : null;
    }
}
