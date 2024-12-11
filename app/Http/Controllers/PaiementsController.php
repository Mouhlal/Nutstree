<?php

namespace App\Http\Controllers;

use App\Models\Commandes;
use App\Models\Paiements;
use Illuminate\Http\Request;
use Stripe\Stripe;
use Stripe\Checkout\Session as StripeSession;

class PaiementsController extends Controller
{
    public function cashOnDelivery($commandeId)
    {
        $commande = Commandes::findOrFail($commandeId);

        $commande->status = 'pending-cash';
        $commande->save();

        return redirect()->back()->with('success', 'Votre commande a été confirmée pour un paiement à la livraison.');
    }
}
