<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class AdminNotificationMail extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    public $name, $email, $phone, $resumePath;

    public function __construct($name, $email, $phone, $resumePath)
    {
        $this->name = $name;
        $this->email = $email;
        $this->phone = $phone;
        $this->resumePath = $resumePath;
    }

    public function build()
        {
            return $this->subject('New Job Application Received')
                        ->view('email.admin')
                        ->attach($this->resumePath);
        }
}
