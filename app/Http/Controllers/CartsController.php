<?php

namespace App\Http\Controllers;

use App\Models\CartItems;
use App\Models\Carts;
use App\Models\Categorie;
use App\Models\Code_Promo;
use App\Models\DeliveryFee;
use App\Models\Produits;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartsController extends Controller
{

    public function addToCart($productId, Request $request)
    {
        // Valider la quantité envoyée par la requête
        $quantity = $request->input('quantity', 1);
        if ($quantity < 1) {
            return response()->json(['message' => 'La quantité doit être supérieure à zéro.'], 400);
        }

        $product = Produits::findOrFail($productId);

        if ($product->quantite <= 0) {
            return response()->json(['message' => 'Ce produit est en rupture de stock.'], 400);
        }

        // Vérifier si la quantité demandée est disponible en stock
        if ($quantity > $product->quantite) {
            return response()->json(['message' => 'Quantité demandée supérieure au stock disponible.'], 400);
        }

        if (Auth::check()) {
            // Utilisateur authentifié - Enregistrer dans la base de données
            $cart = Carts::firstOrCreate(['user_id' => auth()->id()]);

            $cartItem = CartItems::where('cart_id', $cart->id)
                                 ->where('produit_id', $product->id)
                                 ->first();

            if ($cartItem) {
                // Vérifier si l'incrément dépasse le stock disponible
                if ($cartItem->quantity + $quantity > $product->quantite) {
                    return response()->json(['message' => 'Stock insuffisant pour ce produit.'], 400);
                }

                $cartItem->increment('quantity', $quantity);
            } else {
                CartItems::create([
                    'cart_id' => $cart->id,
                    'produit_id' => $product->id,
                    'quantity' => $quantity,
                ]);
            }
        } else {
            // Utilisateur non authentifié - Stocker dans la session
            $cart = session()->get('cart', []);

            if (isset($cart[$productId])) {
                if ($cart[$productId]['quantity'] + $quantity > $product->quantite) {
                    return response()->json(['message' => 'Stock insuffisant pour ce produit.'], 400);
                }

                $cart[$productId]['quantity'] += $quantity;
            } else {
                $cart[$productId] = [
                    'id' => $product->id,
                    'name' => $product->nom,
                    'price' => $product->prix,
                    'image' => $product->images->first() ?? 'default-image.jpg',
                    'quantity' => $quantity,
                ];
            }

            session()->put('cart', $cart);

        }


        // Décrémenter le stock après ajout au panier
        $product->decrement('quantite', $quantity);

        return response()->json(['message' => 'Produit ajouté au panier avec succès!', 'success' => true]);
    }

    public function showCart()
    {
        $categories = Categorie::all();
        $deliveryFee = 0;
        $cartItems = collect();
        $subtotal = 0;
        if (Auth::check()) {
            $city = auth()->user()->ville ?? 'casa';
            $deliveryFee = DeliveryFee::where('city', $city)->value('fee') ?? 0;
            $cart = Carts::where('user_id', auth()->id())->with('items.product.firstImage')->first();
            $cartItems = $cart ? $cart->items : collect();
            $subtotal = $cartItems->sum(fn($item) => $item->product ? $item->quantity * $item->product->prix : 0);
        }
        $total = $subtotal + $deliveryFee;
        $allCities = DeliveryFee::pluck('city')->toArray();
        $currentCity = Auth::check() ? auth()->user()->adresse : session('city', 'casa');

        return view('temp.panier-auth', compact('cartItems', 'categories', 'subtotal', 'deliveryFee', 'total', 'allCities', 'currentCity'));
    }

    public function removeFromCart($id)
    {
        $cartItem = CartItems::findOrFail($id);
        $cartItem->delete();
        return redirect()->back()->with('delP', 'Produit supprimé du panier avec succès.');
    }

    public function updateMultiple(Request $request)
    {
        // Valider les quantités reçues dans le formulaire
        $validated = $request->validate([
            'quantity' => 'required|array',
            'quantity.*' => 'required|integer|min:1',
        ]);

        foreach ($validated['quantity'] as $itemId => $quantity) {
            $cartItem = CartItems::findOrFail($itemId);
            if ($cartItem->cart->user_id !== auth()->id()) {
                return redirect()->back()->withErrors('Action non autorisée.');
            }

            $cartItem->quantity = $quantity;
            $cartItem->save();
        }

        // Rediriger avec un message de succès
        return redirect()->back()->with('success', 'Quantités mises à jour avec succès.');
    }

public function updateCity(Request $request)
{
    $request->validate([
        'city' => 'required|string|exists:delivery_fees,city',
    ]);

    if (Auth::check()) {
        $user = auth()->user();
        $user->ville = $request->city;
        $user->save();
        session(['selected_city' => $user->ville]);
    } else {
        session(['selected_city' => $request->city]);
    }

    return redirect()->back()->with('success', 'City updated successfully!');
}


public function syncSessionCart()
{
    $sessionCart = session()->get('cart', []);
    if (Auth::check() && !empty($sessionCart)) {
        $cart = Carts::firstOrCreate(['user_id' => auth()->id()]);

        foreach ($sessionCart as $productId => $item) {
            $cartItem = CartItems::where('cart_id', $cart->id)
                                 ->where('produit_id', $productId)
                                 ->first();

            if ($cartItem) {
                $cartItem->quantity += $item['quantity'];
                $cartItem->save();
            } else {
                CartItems::create([
                    'cart_id' => $cart->id,
                    'produit_id' => $productId,
                    'quantity' => $item['quantity'],
                ]);
            }
        }

        // Une fois les données transférées, videz le panier de session
        session()->forget('cart');
    }
}

public function showCartSession()
{
    $categories = Categorie::all();
    $cartItems = collect(session()->get('cart', []));
    $subtotal = collect($cartItems)->sum(fn($item) => $item['price'] * $item['quantity']);
    $deliveryFee = session('city') ? DeliveryFee::where('city', session('city'))->value('fee') ?? 0 : 0;
    $total = $subtotal + $deliveryFee;

    $allCities = DeliveryFee::pluck('city')->toArray();
    $currentCity = session('city', 'casa');

    return view('temp.panier-session', compact('cartItems', 'categories', 'subtotal', 'deliveryFee', 'total', 'allCities', 'currentCity'));
}


public function updateQuantitySession(Request $request)
{
    $cart = session('cart', []);

    foreach ($request->quantity as $id => $quantity) {
        if (isset($cart[$id])) {
            $cart[$id]['quantity'] = max(1, (int) $quantity); // Assurez-vous que la quantité est au moins 1
        }
    }

    session(['cart' => $cart]);

    return redirect()->route('cart.show')->with('success', 'Quantité mise à jour avec succès.');
}


public function supprimerItems($id)
{
    $cart = session('cart', []);

    if (isset($cart[$id])) {
        unset($cart[$id]);
        session(['cart' => $cart]); // Mettre à jour la session
    }

    // Rediriger vers la page du panier
    return redirect()->route('cart.show')->with('delP', 'Produit supprimé du panier avec succès.');
}



public function applyPromo(Request $request)
{
    // Vérifier si le code promo existe et est valide
    $promoCode = Code_Promo::where('code', $request->promo_code)->first();

    if (!$promoCode || !$promoCode->isValid()) {
        return redirect()->back()->withErrors(['promo_code' => 'Code promo invalide ou expiré.']);
    }

    // Calculer le montant de la réduction
    $discountAmount = $promoCode->discount;

    // Trouver le panier de l'utilisateur
    $cart = Carts::where('user_id', auth()->id())->first();

    if (!$cart) {
        return redirect()->back()->withErrors(['cart' => 'Panier introuvable.']);
    }

    // Appliquer la réduction sur le total du panier
    $cart->discount = $discountAmount;
    $cart->save();

    // Calculer le nouveau total après réduction
    $totalPrice = $cart->total_price - $discountAmount; // total_price est le prix avant réduction

    // Mettre à jour le total du panier
    $cart->total_price = $totalPrice;
    $cart->save();

    return redirect()->route('cart.show')->with('success', 'Le code promo a été appliqué avec succès!');
}




}

