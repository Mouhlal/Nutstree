<?php

namespace App\Http\Controllers;

use App\Models\Carts;
use App\Models\Categorie;
use App\Models\Commandes;
use App\Models\Paiements;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Stripe\Checkout\Session as StripeSession;

class PaiementsController extends Controller
{
    public function initiatePayment(Request $request, Commandes $order)
{
    $cmiUrl = config('services.cmi.url');
    $merchantId = config('services.cmi.merchant_id');
    $hashKey = config('services.cmi.hash_key');
    $returnUrl = route('payment.callback');
    $cancelUrl = route('payment.cancel');

    // Données à envoyer au CMI
    $data = [
        'clientid' => $merchantId,
        'oid' => $order->numCom, // Numéro de commande
        'amount' => number_format($order->totalPrix, 2, '.', ''), // Format requis
        'okUrl' => $returnUrl, // URL en cas de succès
        'failUrl' => $cancelUrl, // URL en cas d’échec
        'currency' => config('services.cmi.currency'),
        'rnd' => microtime(),
        'storetype' => '3d_pay_hosting',
        'lang' => 'fr', // Langue : 'fr' ou 'en'
    ];

    // Création de la signature
    $data['hash'] = base64_encode(
        pack('H*', hash('sha512', implode('', array_values($data)) . $hashKey))
    );

    // Affichage du formulaire pour redirection automatique
    return view('payment.redirect', compact('cmiUrl', 'data'));
}

public function handleCallback(Request $request)
{
    $hashKey = config('services.cmi.hash_key');
    $data = $request->except('HASH');

    // Validation de la signature
    $calculatedHash = base64_encode(
        pack('H*', hash('sha512', implode('', array_values($data)) . $hashKey))
    );

    if ($request->HASH !== $calculatedHash) {
        return redirect()->route('cart.show')->with('error', 'Signature invalide.');
    }

    $order = Commandes::where('numCom', $request->oid)->first();
    if (!$order) {
        return redirect()->route('cart.show')->with('error', 'Commande introuvable.');
    }

    if ($request->ProcReturnCode === '00') {
        $order->update(['status' => 'paid']);

        Paiements::create([
            'commande_id' => $order->id,
            'amount' => $order->totalPrix,
            'payment_method' => 'Carte Bancaire',
            'transaction_id' => $request->TransId,
            'status' => 'paid',
        ]);

        return redirect()->route('commande.details', ['order' => $order->id])
                         ->with('success', 'Paiement réussi.');
    }

    return redirect()->route('cart.show')->with('error', 'Le paiement a échoué.');
}

public function handleCancel()
{
    return redirect()->route('cart.show')->with('error', 'Paiement annulé.');
}


}
