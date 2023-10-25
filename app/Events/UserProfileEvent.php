<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class UserProfileEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $user1, $user2;
    public $title;
    public $message;

    /**
     * Create a new event instance.
     * @param $user1 is the user to be notified
     * @param $user2 the in charge of the event
     * @return void
     */
    public function __construct($user1, $user2, $title, $message)
    {
        $this->user1 = $user1;
        $this->user2 = $user2;
        $this->title = $title;
        $this->message = $message;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('channel-name');
    }
}
