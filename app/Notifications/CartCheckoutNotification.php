<?php

namespace App\Notifications;

use App\Mail\CatCheckOutMailMessage;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class CartCheckoutNotification extends Notification
{
    use Queueable;

    public $commande;
    public $commandeProduit;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($commande)
    {
        $this->commande = $commande;
        // $this->commandeProduit = $commandeProduit;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail','database'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new CatCheckOutMailMessage($this->commande,$notifiable))
                ->to($notifiable->email,$notifiable->name)
            ->cc("landryshopping@gmail.com");
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            'message'=>"vous avez effectuer une commande le ".now()
        ];
    }
}
