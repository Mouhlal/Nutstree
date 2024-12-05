<?php

namespace App\Http\Controllers;

use App\Models\CartItems;
use App\Models\Carts;
use App\Models\Produits;
use Illuminate\Http\Request;

class CartsController extends Controller
{

    public function addToCart($productId, Request $request)
{
    $product = Produits::findOrFail($productId);

    // Récupérez le panier de l'utilisateur
    $cart = Carts::firstOrCreate(['user_id' => auth()->id()]);

    // Vérifiez si le produit est déjà dans le panier
    $cartItem = CartItems::where('cart_id', $cart->id)
                         ->where('produit_id', $product->id)
                         ->first();

    if ($cartItem) {
        // Si le produit existe déjà, mettez à jour la quantité
        $cartItem->increment('quantity');
    } else {
        // Sinon, ajoutez un nouvel élément
        CartItems::create([
            'cart_id' => $cart->id,
            'produit_id' => $product->id,
            'quantity' => 1,
        ]);
    }

    return response()->json(['message' => 'Produit ajouté au panier avec succès!']);
    ;
}

    public function showCart()
{
    $cart = Carts::where('user_id', auth()->id())->first();

    if (!$cart) {
        $cartItems = collect(); // Aucun élément si le panier n'existe pas
    } else {
        $cartItems = CartItems::where('cart_id', $cart->id)
                              ->with('product') // Charge le produit associé
                              ->get();
    }

    return view('cart.panier', compact('cartItems'));
}

public function removeFromCart($id)
    {
        // Trouver l'élément du panier
        $cartItem = CartItems::findOrFail($id);

        // Vérifiez si le produit appartient au panier de l'utilisateur connecté
        if ($cartItem->cart->user_id !== auth()->id()) {
            return redirect()->back()->withErrors('Action non autorisée.');
        }

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



}
