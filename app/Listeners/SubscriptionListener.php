<?php

namespace App\Listeners;

use App\Events\SubscriptionEvent;
use App\Notifications\SubscriptionNotification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class SubscriptionListener
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
     * @param  \App\Events\SubscriptionEvent  $event
     * @return void
     */
    public function handle(SubscriptionEvent $event)
    {
        if ($event->method == 'subscribe') {
            $title = "Subscribe";
            $message = "You subscribe to " . $event->subscription->plan->text . " plan";
        } elseif ($event->method == 'unsubscribe') {
            $title = "Unsubscribe";
            $message = "You Unsubscribe to " . $event->subscription->plan->text . " plan";
        } elseif ($event->method == 'expired') {
            $title = "Expired";
            $message = "Your " . $event->subscription->plan->text . " Plan already expired";
        } elseif ($event->method == 'pending') {
            $title = "Subscription Pending";
            $message = "Your " . $event->subscription->plan->text . " Plan is pending.";
        }

        $event->user->notify(new SubscriptionNotification($event->subscription, $event->method, $title, $message));
    }
}
