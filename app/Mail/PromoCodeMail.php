<?php
namespace App\Mail;

use App\Models\Code_Promo;
use App\Models\PromoCode;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class PromoCodeMail extends Mailable
{
    use Queueable, SerializesModels;

    public $promoCode;

    public function __construct(Code_Promo $promoCode)
    {
        $this->promoCode = $promoCode;
    }

    public function build()
    {
        return $this->subject('Votre code promo!')
                    ->view('emails.promo_code')
                    ->with(['promoCode' => $this->promoCode->code]);
    }
}
