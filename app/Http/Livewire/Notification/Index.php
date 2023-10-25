<?php

namespace App\Http\Livewire\Notification;

use Livewire\Component;

class Index extends Component
{
    public function render()
    {
        $notifications = auth()->user()->notifications;

        auth()->user()->unreadNotifications->markAsRead();

        return view('livewire.notification.index', [
            'notifications' => $notifications,
        ]);
    }
}
