<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class InquiryReply extends Mailable
{
    use Queueable, SerializesModels;

    public $inquiry;
    public $messageContent;

    public function __construct($inquiry, $subject, $messageContent)
    {
        $this->inquiry = $inquiry;
        $this->subject = $subject;
        $this->messageContent = $messageContent;
    }


    public function build()
    {
        $logoPath = public_path('assets/img/systemLogo.png');

        return $this->view('emails.inquiryReply')
            ->subject($this->subject)
            ->with([
                'inquiry' => $this->inquiry,
                'messageContent' => $this->messageContent,
                'logoPath' => $logoPath,
            ]);
    }
}
