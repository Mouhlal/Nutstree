<?php
namespace App\Mail;

use App\Models\Code_Promo; // Assurez-vous que le modèle est correctement importé
use App\Models\CodePromo;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class PromoCodeMail extends Mailable
{
    use Queueable, SerializesModels;

    public $promoCode;

    /**
     * Créer une nouvelle instance de message.
     *
     * @param CodePromo $promoCode
     */
    public function __construct(CodePromo $promoCode)
    {
        $this->promoCode = $promoCode;
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Code Promo Mail',
        );
    }


    public function content(): Content
    {
        $code = $this->promoCode->code;
        $discount = $this->promoCode->discount;
        $expiration = $this->promoCode->expires_at;
        return new Content(
            view: 'emails.promoCode',
            with: [
                'code' => $code,
                'discount' => $discount,
                'expiration' => $expiration,
            ],
        );

    }

    /**
     * Construire le message.
     *
     */
    public function attachments(): array
    {
        return [];
    }
}
