<?php
namespace App\Mail;

use App\Models\CodePromo;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class PromoCodeMail extends Mailable
{
    use Queueable, SerializesModels;

    public $promoCode;

    public function __construct(CodePromo $promoCode)
    {
        $this->promoCode = $promoCode;
    }

    public function build()
    {
        return $this->subject('Votre code promo')
                    ->view('emails.promoCode');  // Spécifier la vue 'emails.promoCode'
    }
}
