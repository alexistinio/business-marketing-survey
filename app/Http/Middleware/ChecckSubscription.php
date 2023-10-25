<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class ChecckSubscription
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
        $user = auth()->user();

        if (! $user->hasRole('superadmin')) {
            $subscription = $user->latestSubscription();

            if (! $subscription || $subscription->end_timestamp->lte(now())) {
                abort(404);
                return;
            }
        }

        return $next($request);
    }
}
