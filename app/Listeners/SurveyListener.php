<?php

namespace App\Listeners;

use App\Events\SurveyEvent;
use App\Notifications\SurveyNotifcation;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class SurveyListener
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
     * @param  \App\Events\SurveyEvent  $event
     * @return void
     */
    public function handle(SurveyEvent $event)
    {
        $event->user->notify(new SurveyNotifcation($event->survey, $event->title, $event->message));
    }
}
