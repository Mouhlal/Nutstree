<?php

namespace App\Http\Controllers;

use App\Http\Requests\CheckoutRequest;
use App\Mail\CommandeMail;
use App\Models\Carts;
use App\Models\Categorie;
use App\Models\Commandes;
use App\Models\Commandes_produits;
use App\Models\DeliveryFee;
use App\Models\Paiements;
use App\Models\Produits;
use App\Models\User;
use App\Notifications\CommandeCanceled;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Notification;
use Illuminate\Validation\Rule;
use Monarobase\CountryList\CountryList;
use Illuminate\Support\Str;

use mPDF;

class CommandesController extends Controller
{

    public function checkout()
    {
        $categories = Categorie::all();
        $countries = (new CountryList())->getList('fr');
        $cartItems = collect();
        $deliveryFee = 0;

        if (Auth::check()) {
            $user = Auth::user();
            $cart = Carts::where('user_id', auth()->id())->first();

            if ($cart) {
                $cartItems = collect($cart->items);
            }

            $city = $user->ville ? $user->ville : 'Casa';
            $deliveryFee = DeliveryFee::where('city', $city)->value('fee') ?? 0;
        } else {
            $cartItems = collect(session()->get('cart', []));
        }

        $subtotal = $cartItems->sum(fn($item) => $item['product'] ? $item['quantity'] * $item['product']['prix'] : 0);

        // Calcul du total
        $total = $subtotal + $deliveryFee;

        // Retourner la vue avec les données nécessaires
        return view('temp.check.checkout', compact('cartItems', 'deliveryFee', 'categories', 'subtotal', 'total', 'countries'));
    }


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
        // Liste des pays
        $countries = (new CountryList())->getList('fr');

        // Validation des données
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'tel' => 'required|string',
            'addresse' => 'required|string',
            'ville' => 'required|string',
            'codepostal' => 'required|string',
            'pays' => ['required', 'string', Rule::in(array_values($countries))],
            'payment_method' => 'required|string',
            'cart_items' => 'required|json',
        ]);

        $cartItems = json_decode($request->cart_items, true);
        if (empty($cartItems)) {
            return redirect()->back()->with('error', 'Le panier est vide.');
        }

        // Calcul des totaux
        $subtotal = array_sum(array_map(fn($item) => $item['product']['prix'] * $item['quantity'], $cartItems));
        $newSubtotal = session()->get('newSubtotal', $subtotal);
        $deliveryFee = session()->get('deliveryFee', 0);
        $totalPrix = $newSubtotal + $deliveryFee;

        if ($totalPrix <= 0) {
            return redirect()->back()->with('error', 'Le prix total n\'est pas valide.');
        }

        // Vérifier la disponibilité du stock avant de créer la commande
        foreach ($cartItems as $item) {
            $product = Produits::find($item['produit_id']);
            if (!$product) {
                return redirect()->route('cart.show')->with('error', "Le produit avec ID {$item['produit_id']} n'existe pas.");
            }
            if ($product->quantite < $item['quantity']) {
                return redirect()->route('cart.show')->with('error', "Le stock pour le produit '{$product->nom}' est insuffisant.");
            }
        }

        $order = null; // Initialiser $order pour qu'il soit accessible en dehors du bloc

        DB::transaction(function () use ($request, $cartItems, $totalPrix, &$order) {
            $lastOrder = Commandes::latest('created_at')->first();
            $newOrderNumber = 'CMD-' . now()->year . '-' . str_pad(($lastOrder ? substr($lastOrder->numCom, -5) + 1 : 1), 5, '0', STR_PAD_LEFT);

            $order = Commandes::create([
                'numCom' => $newOrderNumber,
                'dateCom' => now(),
                'user_id' => Auth::id(),
                'location' => "{$request->addresse}, {$request->ville}, {$request->pays}",
                'payment_method' => $request->payment_method,
                'totalPrix' => $totalPrix,
                'tel' => $request->tel,
            ]);

            foreach ($cartItems as $item) {
                $order->products()->attach($item['produit_id'], [
                    'quantity' => $item['quantity'],
                    'prix' => $item['product']['prix'],
                ]);

                // Mise à jour du stock
                $product = Produits::find($item['produit_id']);
                $product->decrement('quantite', $item['quantity']);
            }

            // Supprimer le panier
            if (Auth::check()) {
                Carts::where('user_id', Auth::id())->first()->items()->delete();
            } else {
                session()->forget('cart');
            }

            // Gestion du paiement
            if ($request->payment_method == 'Credit Card') {
                throw new \Exception("Redirection vers la page de paiement.");
            }

            if ($request->payment_method == 'Cash on Delivery') {
                Paiements::create([
                    'commande_id' => $order->id,
                    'amount' => $totalPrix,
                    'payment_method' => 'Cash on Delivery',
                    'status' => 'pending',
                ]);
            }
        });

        // Supprimer les données de session liées à la réduction
        session()->forget(['newSubtotal', 'deliveryFee']);

        // Envoi d'e-mail
        Mail::to($request->email)->send(new CommandeMail($order));

        return redirect()->route('commande.details', ['order' => $order->id])
                         ->with('success', 'Commande passée avec succès!');
    }


    public function details($orderId)
{

    $categories = Categorie::all();
    $cart = Carts::where('user_id', auth()->id())->first();
    $cartItems = $cart ? $cart->items->load(['product', 'product.firstImage']) : collect();
    $commande = Commandes::with(['products', 'User'])->findOrFail($orderId);
    $products = $commande->produits;
    $billingInfo = [
        'name' => $commande->User->name,
        'address' => $commande->User->adresse,
        'payment_method' => $commande->payment_method,
        'payment_status' => $commande->status,
        'total' => $commande->totalPrix,
        'tel' => $commande->tel,
    ];

    return view('temp.check.commande',[
        'categories' => $categories,
        'cart' => $cart,
        'cartItems' => $cartItems,
        'commande' => $commande,
        'products' => $products,
        'billingInfo' => $billingInfo,

    ]);
}

public function generatePdf($id)
{
    $commande = Commandes::with(['User', 'products'])->findOrFail($id);
    // Préparer les informations de facturation
    $billingInfo = [
        'name' => $commande->User->name,
        'payment_method' => $commande->payment_method,
        'payment_status' => $commande->status,
        'total' => $commande->total,
        'tel' => $commande->tel,
    ];

    $html = view('pdf.commande', compact('commande', 'billingInfo'))->render();
    $mpdf = new \Mpdf\Mpdf();
    // Écrire le contenu HTML dans le PDF
    $mpdf->WriteHTML($html);

    return response($mpdf->Output('commande_' . $commande->numCom . '.pdf', 'I'))
        ->header('Content-Type', 'application/pdf');
}

    public function cancel($id)
    {
        // Trouver la commande
        $commande = Commandes::findOrFail($id);
        if ($commande->status === 'canceled') {
            return back()->with('error', 'Cette commande est déjà annulée.');
        }
        // Annuler la commande
        $commande->update(['status' => 'cancelled']);
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
