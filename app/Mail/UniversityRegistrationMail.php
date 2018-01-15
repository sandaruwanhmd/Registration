<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class UniversityRegistrationMail extends Mailable
{
    use Queueable, SerializesModels;

    private $mailData;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($mailData)
    {
        $this->mailData = $mailData;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return 
            $this->subject('UNIVERSITY ADMIN CREATED')
            ->view('emails.UniversityAdminRegistration')
            ->with($this->smailData);
    }
}
