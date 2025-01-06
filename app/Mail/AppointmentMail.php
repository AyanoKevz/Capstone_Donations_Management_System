<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class AppointmentMail extends Mailable
{
    use Queueable, SerializesModels;

    public $appointmentDate;
    public $appointmentTime;
    public $chapterName;
    public $firstName;
    public $lastName;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($firstName, $lastName, $appointmentDate, $appointmentTime, $chapterName)
    {
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->appointmentDate = $appointmentDate;
        $this->appointmentTime = $appointmentTime;
        $this->chapterName = $chapterName;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $logoPath = public_path('assets/img/systemLogo.png');
        return $this->subject("Appointment Schedule for Orientation")
            ->view('emails.appointment')
            ->with([
                'logoPath' => $logoPath,
            ]);
    }
}
