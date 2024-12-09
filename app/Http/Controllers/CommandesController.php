<?php

namespace App\Http\Controllers;

use App\Models\Commandes;
use App\Models\Commandes_produits;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommandesController extends Controller
{

    public function index()
{
    $user = Auth::user();
    $commandes = Commandes::where('user_id', $user->id)->get();
    foreach ($commandes as $commande) {
        $commande->dateCom = Carbon::parse($commande->dateCom);
    }
    return view('commandes.index', compact('commandes'));
}


public function store(Request $request)
{
    $request->validate([
        'location' => 'required|string|max:255',
    ]);

    $user = Auth::user();

    // Création de la commande
    $commande = Commandes::create([
        'numCom' => 'CMD-' . strtoupper(uniqid()),
        'dateCom' => now(),
        'user_id' => $user->id,
        'location' => $request->location,
        'status' => 'pending',
        'totalPrix' => $user->cartItems->sum(fn($item) => $item->product->prix * $item->quantity),
    ]);

    // Ajout des produits à la commande
    foreach ($user->cartItems as $cartItem) {
        Commandes_produits::create([
            'commande_id' => $commande->id,
            'produit_id' => $cartItem->product->id,
            'quantity' => $cartItem->quantity,
            'prix' => $cartItem->product->prix,
        ]);

        // Optionnel : Décrémenter le stock du produit
        $cartItem->product->decrement('quantite', $cartItem->quantity);
    }

    // Vider le panier de l'utilisateur
    $user->cartItems()->delete();

    return redirect()->route('commandes.index')->with('success', 'Commande passée avec succès !');
}

public function cancel($id)
    {
        // Trouver la commande
        $commande = Commandes::findOrFail($id);

        // Vérifier si la commande peut être annulée (par exemple, si elle n'est pas déjà annulée)
        if ($commande->status !== 'canceled') {
            $commande->status = 'canceled';
            $commande->save();
            // Retourner un message de succès
            return redirect()->route('commandes.index')->with('success', 'Commande annulée avec succès!');
        }

        return redirect()->route('commandes.index')->with('error', 'Cette commande est déjà annulée.');
    }

}
