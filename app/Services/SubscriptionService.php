<?php

namespace App\Services;

use App\Events\SubscriptionEvent;
use App\Models\Subscription;
use App\Models\SubscriptionPlan;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class SubscriptionService
{
    public function subscribe($user_id, $plan_id, $is_final = false)
    {
        try {
            DB::beginTransaction();

            if ($is_final) {
                $currentSubscription = User::find($user_id)->latestSubscription();
                if ($currentSubscription) {
                    Subscription::where('user_id', $user_id)
                        ->where('plan_id', $currentSubscription->plan_id)
                        ->update(['status_id' => SUBS_STATUS_CANCELLED]);
                }
            }

            $plan = SubscriptionPlan::find($plan_id);

            $create_data = $is_final ? [
                'start_timestamp' => now(),
                'end_timestamp' => date('Y-m-d h:i:s', strtotime('+' . $plan->duration_month . ' months', strtotime(now()))),
                'purchase_timestamp' => now(),
                'status_id' => SUBS_STATUS_ACTIVE,
            ] : [
                'start_timestamp' => null,
                'end_timestamp' => null,
                'purchase_timestamp' => now(),
                'status_id' => SUBS_STATUS_PENDING,
            ];

            $subscription = Subscription::where('user_id', $user_id)
                ->where('status_id', SUBS_STATUS_PENDING)
                ->first();

            $user = User::find($user_id);

            if ($subscription) {
                $message = 'Subscription is pending.';
                $subscription->update(array_merge($create_data, ['plan_id' => $plan_id]));
            } else {
                $subscription = Subscription::where('user_id', $user_id)
                    ->where('plan_id', $plan_id)
                    ->first();

                if ($subscription) {
                    $subscription->update(array_merge($create_data, ['status_id' => SUBS_STATUS_ACTIVE]));
                } else {
                    $subscription = Subscription::firstOrCreate([
                        'user_id' => $user_id,
                        'plan_id' => $plan_id,
                    ], $create_data);
                }

                $message = "Account Upgraded.";
            }

            // Send Notification
            if ($is_final) {
                $user->update(['role_id' => ROLE_PREMIUM_USER]);
                $message = 'Account upgraded to premium.';

                event(new SubscriptionEvent($user, $subscription, 'subscribe'));
            } else {
                event(new SubscriptionEvent($user, $subscription, 'pending'));
            }


            DB::commit();

            return response_success($message);
        } catch (\Exception $e) {
            DB::rollBack();

            return response_error($e->getMessage());
        }
    }

    public function unsubscribe($user_id, $plan_id)
    {
        try {
            DB::beginTransaction();

            $unsubscribe = Subscription::where('user_id', $user_id)->where('plan_id', $plan_id);

            $unsubscribe->update([
                'status_id' => SUBS_STATUS_CANCELLED,
            ]);

            $user = User::find($user_id);

            if ($user->role_id == ROLE_ADMIN_USER) {
                return response_error("This user can't be change role");
            }

            $user->update([
                'role_id' => ROLE_USER
            ]);

            // Send Notification
            event(new SubscriptionEvent($user, $unsubscribe->first(), 'unsubscribe'));

            DB::commit();

            return response_success('Plan has been cancelled');
        } catch (\Exception $e) {
            DB::rollBack();

            return response_error($e->getMessage());
        }
    }

    public function exists($subscription_id)
    {
        return SubscriptionPlan::find($subscription_id)->exists();
    }

    public function hasCurrentSubscription($user_id)
    {
        return Subscription::where('user_id', $user_id)
            ->where('start_timestamp', '<=', now())
            ->where('end_timestamp', '>=', now())
            ->where('status_id', SUBS_STATUS_ACTIVE)
            ->orderBy('id', 'desc')
            ->first();
    }
}
