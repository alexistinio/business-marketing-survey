<?php

namespace App\Listeners;

use App\Events\UserProfileEvent;
use App\Notifications\UserNotification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class UserProfileListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  \App\Events\UserProfile  $event
     * @return void
     */
    public function handle(UserProfileEvent $event)
    {
        $event->user1->notify(new UserNotification($event->user2, $event->title, $event->message));
    }
}
