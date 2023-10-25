<?php

namespace App\Http\Livewire\Subscription;

use App\Models\SubscriptionPlan;
use App\Services\SubscriptionService;
use App\Traits\SweetAlert;
use Livewire\Component;

class Index extends Component
{
    use SweetAlert;

    public $plan_refs = [];

    /**
     * Load Initial Datas
     */
    public function mount()
    {
        $this->plan_refs = SubscriptionPlan::active()->get();
    }

    protected $listeners = [
        'confirmSetPlan',
        'confirmCancelPlan',
    ];

    public function setPlan($plan_id)
    {
        $this->confirm('Are you sure?', 'your previous subscription will be cancelled once new subscription is approved, Continue?', [
            'onConfirm' => 'confirmSetPlan',
            'params' => [
                'plan_id' => $plan_id,
            ],
        ]);
    }

    public function cancelPlan($plan_id)
    {
        $this->confirm('Are you sure?', 'Cancel this plan', [
            'onConfirm' => 'confirmCancelPlan',
            'params' => [
                'plan_id' => $plan_id,
            ],
        ]);
    }

    public function confirmSetPlan($params, SubscriptionService $subscription)
    {
        $plan_id = $params['plan_id'];

        if (!$subscription->exists($plan_id)) {
            return $this->error('Oopps!', 'This plan is not available');
        }

        $response = $subscription->subscribe(auth()->user()->id, $plan_id);

        if ($response['status'] == 404) {
            return $this->error('Oopps!', $response['message']);
        }

        $this->flashSuccess('Plan Upgraded', $response['message']);

        return redirect(route('payment'))->with(['status' => SUBS_STATUS_PENDING]);
    }

    public function confirmCancelPlan($params, SubscriptionService $subscription)
    {
        $plan_id = $params['plan_id'];

        $response = $subscription->unsubscribe(auth()->user()->id, $plan_id);

        if ($response['status'] == 404) {
            return $this->error('Oopps!', $response['message']);
        }

        $this->flashSuccess('Plan Cancelled', $response['message']);

        return redirect(route('home'));
    }

    public function render()
    {
        return view('livewire.subscription.index');
    }
}
