<?php

namespace App\Http\Controllers;

use App\Models\CartItems;
use App\Models\Carts;
use App\Models\Produits;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartsController extends Controller
{

    public function addToCart($productId, Request $request)
{
    $product = Produits::findOrFail($productId);

    if (Auth::check()) {
        // Utilisateur authentifié - Enregistrez dans la base de données
        $cart = Carts::firstOrCreate(['user_id' => auth()->id()]);

        $cartItem = CartItems::where('cart_id', $cart->id)
                             ->where('produit_id', $product->id)
                             ->first();

        if ($cartItem) {
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
            $cart[$productId]['quantity']++;
        } else {
            $cart[$productId] = [
                'id' => $product->id,
                'name' => $product->nom,
                'price' => $product->prix,
                'image' => $product->image,
                'quantity' => 1,
            ];
        }

        session()->put('cart', $cart);
    }

    return response()->json(['message' => 'Produit ajouté au panier avec succès!']);
}

public function showCart()
{
    if (Auth::check()) {
        // Panier pour utilisateur authentifié
        $cart = Carts::where('user_id', auth()->id())->first();
        $cartItems = $cart ? $cart->items : collect();
    } else {
        // Panier pour utilisateur non authentifié
        $cartItems = session()->get('cart', []);
    }

    return view('cart.panier', compact('cartItems'));
}

public function removeFromCart($id)
{
    if (Auth::check()) {
        // Trouver l'élément du panier
        $cartItem = CartItems::findOrFail($id);

        // Vérifiez si le produit appartient au panier de l'utilisateur connecté
        if ($cartItem->cart->user_id !== auth()->id()) {
            return redirect()->back()->withErrors('Action non autorisée.');
        }

        // Supprimer l'élément du panier
        $cartItem->delete();
    } else {
        // Supprimer l'élément du panier de la session
        $cart = session()->get('cart', []);
        if (isset($cart[$id])) {
            unset($cart[$id]);
            session()->put('cart', $cart);
        }
    }

    return redirect()->back()->with('delP', 'Produit supprimé du panier avec succès.');
}

public function mergeCart()
{
    if (Auth::check() && session()->has('cart')) {
        $cartSession = session()->get('cart');
        $cart = Carts::firstOrCreate(['user_id' => auth()->id()]);

        foreach ($cartSession as $productId => $productData) {
            $cartItem = CartItems::where('cart_id', $cart->id)
                                 ->where('produit_id', $productId)
                                 ->first();

            if ($cartItem) {
                $cartItem->increment('quantity', $productData['quantity']);
            } else {
                CartItems::create([
                    'cart_id' => $cart->id,
                    'produit_id' => $productId,
                    'quantity' => $productData['quantity'],
                ]);
            }
        }

        // Supprimer le panier de la session
        session()->forget('cart');
    }
}

}
