<?php

namespace App\Notifications;

use App\Models\Base\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class NewRegistrant extends Notification
{
    use Queueable;

    public function __construct(public User $user)
    {}

    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
            ->subject('New human being signed up')
            ->greeting('Hello dear owner of me!')
            ->line('A human being has taken it upon itself to join Truth Transparent. It dubs itself "' . $this->user->name . '".')
            ->line('Thank you for being you. (And please don\'t forget about me!)');
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            //
        ];
    }
}
