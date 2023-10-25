<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class SubscriptionEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $subscription, $method, $user;

    /**
     * Create a new event instance.
     * @param $subscription
     * @param string $method = subscribe/unsubscribe/expired
     * @return void
     */
    public function __construct($user, $subscription, $method)
    {
        $this->user = $user;
        $this->subscription = $subscription;
        $this->method = $method;
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
