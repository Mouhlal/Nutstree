<?php

namespace App\Mail;

use App\Models\Commandes;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class CommandeMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     */
    public function __construct(private Commandes $commandes)
    {
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Commande Mail',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        $numCom = $this->commandes->numCom ;
        $dateCom = $this->commandes->dateCom;
        $total = $this->commandes->totalPrix;
        return new Content(
            view: 'emails.commandes',
            with: [
                'numCom' => $numCom,
                'dateCom' => $dateCom,
                'total' => $total,
                ],
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}
