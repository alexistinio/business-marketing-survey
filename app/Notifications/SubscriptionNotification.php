<?php

namespace App\Notifications;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class SubscriptionNotification extends Notification
{
    use Queueable;

    public $subscription;
    public $title;
    public $message;
    public $subscription_action;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($subscription, $subscription_action, $title, $message)
    {
        $this->subscription = $subscription;
        $this->title = $title;
        $this->message = $message;
        $this->subscription_action = $subscription_action;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['database'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->line('The introduction to the notification.')
            ->action('Notification Action', url('/'))
            ->line('Thank you for using our application!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        $user = User::find($this->subscription->user_id);

        return [
            'type' => 'subscription',
            'name' => $user->name,
            'email' => $user->email,
            'subscription_id' =>  $this->subscription->id,
            'start_timestamp' => $this->subscription->start_timestamp,
            'end_timestamp' => $this->subscription->end_timestamp,
            'purchase_timestamp' => $this->subscription->purchase_timestamp,
            'subscription_method' => $this->subscription_action,
            'title' => $this->title ?? null,
            'message' => $this->message ?? null
        ];
    }
}
