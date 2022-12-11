<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class CatCheckOutMailMessage extends Mailable
{
    use Queueable, SerializesModels;

    public $detail;
    public $commande;
    public $commandeProduit;
    public $notifiable;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($commande,$notifiable){
        // $this->detail = $detail;
        $this->commande = $commande;
        $this->notifiable = $notifiable;
    }
    

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('mail.cat-check-out-mail-message');
    }
}
