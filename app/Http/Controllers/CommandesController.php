<?php

namespace App\Http\Controllers;

use App\Mail\CommandeMail;
use App\Models\Commandes;
use App\Models\Commandes_produits;
use App\Notifications\CommandeCanceled;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Notification;

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
        if (!Auth::check()) {
            return redirect()->route('auth.showLogin')->with('error', 'Vous devez être connecté pour passer une commande.');
        }
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
        // Envoi d'une notification
        Mail::to($commande->user->email)->send(new CommandeMail($commande));
        return redirect()->route('commandes.index')->with('success', 'Commande passée avec succès !');
    }

    public function cancel($id)
    {
        // Trouver la commande
        $commande = Commandes::findOrFail($id);
        // Vérifier si la commande est déjà annulée
        if ($commande->status === 'canceled') {
            return back()->with('error', 'Cette commande est déjà annulée.');
        }
        // Annuler la commande
        $commande->update(['status' => 'canceled']);
        // Envoyer la notification à l'utilisateur
        Notification::route('mail', $commande->user->email)
                    ->notify(new CommandeCanceled($commande));

        return back()->with('success', 'La commande a été annulée et un e-mail vous a été envoyé.');
    }

        public function deleteOrder($id)
    {
        $order = Commandes::findOrFail($id);

        // Vous pouvez ajouter une vérification pour vous assurer que l'utilisateur peut supprimer cette commande
        // Par exemple, si l'utilisateur connecté est celui qui a passé la commande
        if ($order->user_id !== auth()->id()) {
            return redirect()->back()->withErrors('Vous ne pouvez pas supprimer cette commande.');
        }

        // Supprimer la commande
        $order->delete();

        // Rediriger avec un message de succès
        return redirect()->route('commandes.index')->with('success', 'Commande supprimée avec succès.');
    }


}

