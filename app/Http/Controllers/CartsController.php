<?php

namespace App\Http\Controllers;

use App\Models\CartItems;
use App\Models\Carts;
use App\Models\Code_Promo;
use App\Models\Produits;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartsController extends Controller
{

    public function addToCart($productId, Request $request)
{
    $product = Produits::findOrFail($productId);

    // Vérifier si le produit est en stock
    if ($product->quantite <= 0) {
        return response()->json(['message' => 'Ce produit est en rupture de stock.'], 400);
    }

    if (Auth::check()) {
        // Utilisateur authentifié - Enregistrer dans la base de données
        $cart = Carts::firstOrCreate(['user_id' => auth()->id()]);

        $cartItem = CartItems::where('cart_id', $cart->id)
                             ->where('produit_id', $product->id)
                             ->first();

        if ($cartItem) {
            // Vérifier si l'incrément dépasse le stock disponible
            if ($cartItem->quantity + 1 > $product->quantite) {
                return response()->json(['message' => 'Stock insuffisant pour ce produit.'], 400);
            }

            $cartItem->increment('quantity');
        } else {
            CartItems::create([
                'cart_id' => $cart->id,
                'produit_id' => $product->id,
                'quantity' => 1,
            ]);
        }
    } else {
        // Utilisateur non authentifié - Stocker dans la session
        $cart = session()->get('cart', []);

        if (isset($cart[$productId])) {
            // Vérifier si l'incrément dépasse le stock disponible
            if ($cart[$productId]['quantity'] + 1 > $product->quantite) {
                return response()->json(['message' => 'Stock insuffisant pour ce produit.'], 400);
            }

            $cart[$productId]['quantity']++;
        } else {
            $cart[$productId] = [
                'id' => $product->id,
                'name' => $product->nom,
                'price' => $product->prix,
                'image' => $product->images->first() ?? 'default-image.jpg',
                'quantity' => 1,
            ];
        }

        session()->put('cart', $cart);
    }

    // Décrémenter le stock après ajout au panier
    $product->decrement('quantite', 1);

    return response()->json(['message' => 'Produit ajouté au panier avec succès!','success' => true,]);
}

public function showCart()
{
    if (Auth::check()) {
        // Récupérer le panier de l'utilisateur connecté avec les produits et leurs images
        $cart = Carts::where('user_id', auth()->id())->first();
        $cartItems = $cart ? $cart->items->load(['product', 'product.firstImage']) : collect();
    } else {
        // Panier pour utilisateurs non connectés
        $cartItems = collect(session()->get('cart', []));
    }

    return view('cart.panier', compact('cartItems'));
}




public function removeFromCart($id)
    {
        // Trouver l'élément du panier
        $cartItem = CartItems::findOrFail($id);

        // Supprimer l'élément du panier
        $cartItem->delete();
        // Rediriger avec un message de succès
        return redirect()->back()->with('delP', 'Produit supprimé du panier avec succès.');
    }
    public function updateQuantity(Request $request, $id)
{
    // Valider la nouvelle quantité
    $validated = $request->validate([
        'quantity' => 'required|integer|min:1',
    ]);
    // Trouver l'élément du panier
    $cartItem = CartItems::findOrFail($id);
    // Vérifiez si l'élément appartient à l'utilisateur connecté
    if ($cartItem->cart->user_id !== auth()->id()) {
        return redirect()->back()->withErrors('Action non autorisée.');
    }

    // Mettre à jour la quantité
    $cartItem->quantity = $validated['quantity'];
    $cartItem->save();
    // Rediriger avec un message de succès
    return redirect()->back()->with('success', 'Quantité mise à jour avec succès.');
}

// Pour les Sessions
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

public function updateSessionQuantity(Request $request, $id)
{
    $cart = session()->get('cart', []);
    if (isset($cart[$id])) {
        $cart[$id]['quantity'] = $request->input('quantity');
        session()->put('cart', $cart);
    }
    return redirect()->back()->with('success', 'Quantité mise à jour avec succès.');
}
public function removeSessionItem($id)
{
    $cart = session()->get('cart', []);
    if (isset($cart[$id])) {
        unset($cart[$id]);
        session()->put('cart', $cart);
    }
    return redirect()->back()->with('delP', 'Produit supprimé du panier avec succès.');
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

