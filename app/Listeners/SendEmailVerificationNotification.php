<?php

namespace App\Listeners;

use App\Events\Registered;
use App\Mail\EmailVerification;
use app\Contracts\MustVerifyEmail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendEmailVerificationNotification
{
    public function handle(Registered $event): void
    {
        if ($event->user instanceof MustVerifyEmail && ! $event->user->hasVerifiedEmail()) {
            Mail::to($event->user)->send(new EmailVerification($event->user));
        }
    }
}
