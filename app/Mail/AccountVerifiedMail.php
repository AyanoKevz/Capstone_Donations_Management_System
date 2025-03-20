<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class AccountVerifiedMail extends Mailable
{
    use Queueable, SerializesModels;
    public $username;
    public $role;


    /**
     * Create a new message instance.
     */
    public function __construct($username, $role)
    {
        $this->username = $username;
        $this->role = $role;
    }

    public function build()
    {
        $logoPath = public_path('assets/img/systemLogo.png');
        return $this->subject("Your Account Has Been Active")
            ->view('emails.account_verified')
            ->with([
                'logoPath' => $logoPath,
            ]);
    }
}
