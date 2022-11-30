<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class CartCheckoutNotification extends Notification
{
    use Queueable;

    public $arr;
    public $prix;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($arr,$prix)
    {
        $this->arr = $arr;
        $this->prix = $prix;
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

        return (new MailMessage)
                ->line('Felcitiation pour votre commande.')
                ->line('vous avez effectuez une commande le : '.now())
                ->line("prix depenser: ".$this->prix)
                ->line("produit / quantite / sous-total")
                ->lines($this->arr)
                ->line('Thank you for using our application!');
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
