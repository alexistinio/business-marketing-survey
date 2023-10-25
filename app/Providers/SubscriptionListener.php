<?php

namespace App\Providers;

use App\Providers\Subscription;
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
     * @param  \App\Providers\Subscription  $event
     * @return void
     */
    public function handle(Subscription $event)
    {
        //
    }
}
