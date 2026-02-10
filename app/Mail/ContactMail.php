<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ContactMail extends Mailable
{
    use Queueable, SerializesModels;

    public $data;

    public function __construct($data)
    {
        $this->data = $data;
    }

    public function build()
    {
        return $this->subject('Nottbell Portfolio: ' . $this->data['subject'])
                    // replyTo membuat kamu bisa langsung membalas ke email si pengirim
                    ->replyTo($this->data['email'], $this->data['name'])
                    ->view('emails.contact');
    }
}
