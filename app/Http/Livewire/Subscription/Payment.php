<?php

namespace App\Http\Livewire\Subscription;

use App\Models\Subscription;
use Livewire\Component;

class Payment extends Component
{
    public $subscription = null;

    public function mount()
    {
        $this->subscription = Subscription::where('user_id', auth()->user()->id)
            ->orderBy('id', 'desc')
            ->first();
    }

    public function render()
    {
        return view('livewire.subscription.payment');
    }
}
