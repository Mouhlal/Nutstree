<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;

class CommandeCanceled extends Notification
{
    use Queueable;

    protected $commande;

    /**
     * Create a new notification instance.
     *
     * @param $commande
     */
    public function __construct($commande)
    {
        $this->commande = $commande;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail']; // Notification par email
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
            ->subject('Commande annulée')
            ->greeting('Bonjour ' . $this->commande->user->name)
            ->line('Votre commande #' . $this->commande->numCom . ' a été annulée.')
            ->line('Total de la commande : ' . number_format($this->commande->totalPrix, 2) . ' MAD')
            ->action('Voir la commande', url('/commandes/' . $this->commande->id))
            ->line('Merci d\'avoir choisi Nutstree!');
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
            // Données à enregistrer dans la base de données si nécessaire
            'commande_id' => $this->commande->id,
            'status' => 'canceled',
        ];
    }
}
