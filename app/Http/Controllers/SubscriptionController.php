<?php

namespace App\Http\Controllers;

class SubscriptionController extends Controller
{
    public function index()
    {
        return view('view.subscription.index');
    }

    public function payment()
    {
        if (auth()->user()->latestSubscription()) {
            return redirect(route('home'));
        }

        return view('view.subscription.payment');
    }
}
