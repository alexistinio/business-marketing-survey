<?php

namespace App\Http\Middleware;

use App\Events\SubscriptionEvent;
use App\Models\Subscription;
use App\Models\User;
use Closure;
use Illuminate\Http\Request;

class NotificationMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        // check subscription
        if (auth()->check() && auth()->user()) {
            if (!auth()->user()->hasRole('superadmin')) {
                $subscription = Subscription::where('user_id', auth()->user()->id)
                    ->orderBy('id', 'desc')
                    ->first();

                if ($subscription && $subscription->status_id != SUBS_STATUS_PENDING) {
                    if ($subscription->start_timestamp->lte(now()) && $subscription->end_timestamp->lte(now())) {
                        if ($subscription->status_id == SUBS_STATUS_ACTIVE) {
                            $subscription->update(['status_id' => SUBS_STATUS_EXPIRED]);

                            User::find(auth()->user()->id)->update(['role_id' => ROLE_USER]);

                            event(new SubscriptionEvent(auth()->user(), $subscription, 'expired'));
                        }
                    }
                }
            }
        }

        return $next($request);
    }
}
