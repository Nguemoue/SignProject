<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SendEmailVerificationMail extends Mailable
{
    use Queueable, SerializesModels;

    public $notifiable;
    public $url;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($notifiable,$url)
    {
        $this->notifiable = $notifiable;
        $this->url = $url;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('verification_mail');
    }
}
