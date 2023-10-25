<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class SurveyNotifcation extends Notification
{
    use Queueable;

    public $survey;
    public $title;
    public $message;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($survey, $title, $message)
    {
        $this->survey = $survey;
        $this->title = $title;
        $this->message = $message;
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
        if($this->survey->is_private) {
            $groups = $this->survey->groups;
        }

        return [
            'type' => 'survey',
            'title' => $this->title,
            'message' => $this->message,
            'user_id' => $this->survey->user_id,
            'survey_id' => $this->survey->id,
            'is_private' => $this->survey->is_private,
            'groups' => isset($groups) ? $groups : []
        ];
    }
}
