<?php

namespace App\Notifications;

use App\Models\Base\User;
use App\Models\Comment;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class CommentAdded extends Notification
{
    use Queueable;

    public function __construct(public Comment $comment, public User $user)
    {}

    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
            ->subject('New comment added')
            ->greeting('Hello ' . $this->user->name . '!')
            ->line('A comment has been added to an article at Truth Transparent.')
            ->action('View comment', route('articles.show', $this->comment->commentable->slug))
            ->line('Thank you for joining our conversation.');
    }

    public function toArray(object $notifiable): array
    {
        return [
            //
        ];
    }
}
