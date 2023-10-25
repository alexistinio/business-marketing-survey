<?php

namespace App\Providers;

use App\Events\MessageEvent;
use App\Events\SubscriptionEvent;
use App\Events\SurveyEvent;
use App\Events\UserProfileEvent;
use App\Listeners\ChatListener;
use App\Listeners\NewRegisteredUserWelcomeListener;
use App\Listeners\SubscriptionListener;
use App\Listeners\SurveyListener;
use App\Listeners\UserProfileListener;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event to listener mappings for the application.
     *
     * @var array<class-string, array<int, class-string>>
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
            NewRegisteredUserWelcomeListener::class,
        ],
        SubscriptionEvent::class => [
            SubscriptionListener::class,
        ],
        SurveyEvent::class => [
            SurveyListener::class,
        ],
        UserProfileEvent::class => [
            UserProfileListener::class,
        ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Determine if events and listeners should be automatically discovered.
     *
     * @return bool
     */
    public function shouldDiscoverEvents()
    {
        return false;
    }
}
