<?php

namespace App\Traits;

use Illuminate\Support\Facades\Mail;
use App\Mail\EmailVerification;

trait MustVerifyEmail
{
    public function hasVerifiedEmail(): bool
    {
        return ! is_null($this->email_verified_at);
    }

    public function markEmailAsVerified(): bool
    {
        return $this->forceFill([
            'email_verified_at' => $this->freshTimestamp(),
        ])->save();
    }

    public function setNewEmailForVerification(): void
    {
        $this->forceFill([
            'email' => $this->new_email,
            'new_email' => null,
            'email_verified_at' => null
        ])->save();
    }

    public function sendEmailVerificationNotification(): void
    {
        //Need to catch error when user enters incorrect email!!
        Mail::to($this)->send(new EmailVerification($this));
    }

    public function getEmailForVerification(): string
    {
        return $this->email;
    }
}