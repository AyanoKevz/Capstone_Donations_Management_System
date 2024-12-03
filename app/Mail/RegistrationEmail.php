<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class RegistrationEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $username;
    public $role;

    /**
     * Create a new message instance.
     *
     * @param string $username
     * @param string $role
     */
    public function __construct($username, $role)
    {
        $this->username = $username;
        $this->role = $role;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $logoPath = public_path('assets/img/systemLogo.png');
        return $this->subject('Thank You for Registering!')
            ->view('emails.registration')
            ->with([
                'username' => $this->username,
                'role' => $this->role,
                'logoPath' => $logoPath,
            ]);
    }
}
