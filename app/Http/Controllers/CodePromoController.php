<?php

namespace App\Http\Controllers;

use App\Models\Code_Promo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class CodePromoController extends Controller
{
    public function generatePromoCode(Request $request)
{
    $promoCode = Code_Promo::create([
        'code' => strtoupper(str_random(8)), // Génère un code promo aléatoire de 8 caractères
        'discount' => 10.00, // Exemple : 10% de réduction
        'expires_at' => now()->addDays(30), // Le code expire dans 30 jours
    ]);

    // Envoi du code promo par email à l'utilisateur
    Mail::to($request->user()->email)->send(new Code_Promo($promoCode));

    return redirect()->route('layouts.home')->with('success', 'Le code promo a été envoyé à votre email!');
}

}
