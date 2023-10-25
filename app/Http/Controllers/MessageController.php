<?php

namespace App\Http\Controllers;

use App\Events\MessageEvent;
use App\Events\MessageSent;
use App\Models\Message;
use App\Models\User;
use App\Services\ChatService;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    public function index($id = null)
    {
        return view('view.message.index', compact('id'));
    }

    public function fetchMessage()
    {
    }

    public function sendMessage(Request $request, ChatService $chatService)
    {

        $user = auth()->user();
        $user_to = $request->input('user_to');
        $message = $request->input('message');
        $chat_room = $chatService->getChatRoom($user->id, $user_to);

        Message::create([
            'user_id_from' => $user->id,
            'user_id_to' => $user_to,
            'message' => $message,
            'chat_room_id' => $chat_room->id
        ]);

        broadcast(new MessageSent($user, User::find($user_to), $message, $chat_room->chat_id))->toOthers();
        broadcast(new MessageEvent(User::find($user_to), $user))->toOthers();

        return ['status' => 200];
    }

    public function readMessage(Request $request)
    {
        $chat_room_id = $request->input('chat_room_id');
    }
}
