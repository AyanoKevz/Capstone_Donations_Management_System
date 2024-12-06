<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class AccountRejectedMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Build the message.
     */
    public function build()
    {
        $logoPath = public_path('assets/img/systemLogo.png');
        return $this->subject('Account Verification Failed')
            ->view('emails.account_not_verified')
            ->with([
                'logoPath' => $logoPath,
            ]);
    }
}
