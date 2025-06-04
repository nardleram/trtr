<?php

namespace App\Mail;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Support\Facades\URL;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Queue\SerializesModels;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Contracts\Queue\ShouldQueue;

class EmailVerification extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    public $url;

    public function __construct(public User $user)
    {
        $this->url = URL::temporarySignedRoute('verify.email', now()->addHour(1), [
            'id' => $user->id,
            'hash' => sha1($user->email),
        ]);
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Email verification (Truth Transparent registration)',
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.notifications.verify-email',
        );
    }
}