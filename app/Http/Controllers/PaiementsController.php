<?php

namespace App\Http\Controllers;

use App\Models\Carts;
use App\Models\Categorie;
use App\Models\Commandes;
use App\Models\Paiements;
use App\Models\Produits;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Stripe\Checkout\Session as StripeSession;

class PaiementsController extends Controller
{
public function redirectToCMI(Request $request)
{
    $orderId = uniqid(); // ID unique pour l'identifiant de commande
    $amount = session('total', 0); // Total du panier
    $clientId = config('services.cmi.client_id');
    $currency = config('services.cmi.currency');
    $returnUrl = config('services.cmi.return_url');
    $callbackUrl = config('services.cmi.callback_url');
    $hashKey = config('services.cmi.secret_key');

    // Formater le montant pour CMI (sans virgule)
    $formattedAmount = number_format($amount, 2, '', '');

    // Générer le hachage
    $hashString = "$clientId|$orderId|$formattedAmount|$currency|$callbackUrl|$hashKey";
    $hash = hash('sha256', $hashString);

    // Rediriger vers la page de paiement
    return view('payment.cmi', [
        'clientId' => $clientId,
        'orderId' => $orderId,
        'amount' => $formattedAmount,
        'currency' => $currency,
        'returnUrl' => $returnUrl,
        'callbackUrl' => $callbackUrl,
        'hash' => $hash,
    ]);
}

public function handleReturn(Request $request)
{
    {
        // Handle the response from CMI here
        $paymentStatus = $request->input('status');

        if ($paymentStatus === 'APPROVED') {
            // Payment was successful
            return view('payment.success');
        } else {
            // Payment failed
            return view('payment.failed');
        }
    }
}

public function handleCallback(Request $request)
{
    // Traitez la notification de CMI (si nécessaire)
    // Par exemple : mise à jour de l'état de la commande
}


}
