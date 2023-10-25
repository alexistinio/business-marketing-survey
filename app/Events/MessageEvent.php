<?php

namespace App\Events;

use App\Models\User;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class MessageEvent implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $user;
    public $user_from;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(User $user, User $user_from)
    {
        $this->user = $user;
        $this->user_from = $user_from;
    }

    public function broadcastAs()
    {
        return 'message-notification';
    }

    public function broadcastWith()
    {
        return [
            'user' => $this->user,
            'user_from' => $this->user_from,
        ];
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new Channel('message-notification');
    }
}
