<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class AccountUpdated extends Mailable
{
    use Queueable, SerializesModels;

    public $details;

    public function __construct($details)
    {
        $this->details = $details;
    }

    public function build()
    {

        $logoPath = public_path('assets/img/systemLogo.png');
        return $this->subject('Account Updated Notification')
            ->view('emails.account_updated')
            ->with([
                'logoPath' => $logoPath,
            ]);
    }
}
