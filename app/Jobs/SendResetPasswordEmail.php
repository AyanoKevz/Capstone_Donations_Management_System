<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class SendResetPasswordEmail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $user;
    public $emailData;

    public function __construct($user, $emailData)
    {
        $this->user = $user;
        $this->emailData = $emailData;
    }

    public function handle()
    {
        Mail::send('emails.reset-password', $this->emailData, function ($message) {
            $message->to($this->user->email);
            $message->subject('Reset Password');
        });
    }
}
