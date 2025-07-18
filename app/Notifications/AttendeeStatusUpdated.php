<?php

namespace App\Notifications;

use App\Models\LAAttendee;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;

class AttendeeStatusUpdated extends Notification
{
    use Queueable;

    public $attendee;

    public function __construct(LAAttendee $attendee)
    {
        $this->attendee = $attendee;
    }

    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
            ->greeting("Hello " . $notifiable->name)
            ->line("Your registration status for the event '{$this->attendee->event->title}' has been updated.")
            ->line("New Status: **{$this->attendee->status}**")
            ->action('View Event', route('events.show', $this->attendee->event))
            ->line('Thank you for using Event Manager!');
    }
}
