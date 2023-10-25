<?php

namespace App\Events;

use App\Models\Message;
use App\Models\User;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class MessageSent implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $user;
    public $user_to;
    public $message;
    public $chat_room_key;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(User $user, User $user_to, $message, $chat_room_key = null)
    {
        $this->user = $user;
        $this->user_to = $user_to;
        $this->message = $message;
        $this->chat_room_key = $chat_room_key;
    }


    public function broadcastAs()
    {
        return 'message';
    }

    public function broadcastWith()
    {
        return [
            'message' => $this->message,
            'chat_room_key' => $this->chat_room_key,
            'user' => $this->user,
            'user_to' => $this->user_to
        ];
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel("chat.{$this->chat_room_key}");
    }
}
