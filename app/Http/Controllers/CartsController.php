<?php

namespace App\Http\Controllers;

use App\Models\Produits;
use Illuminate\Http\Request;

class CartsController extends Controller
{
    public function addToCart($productId, Request $request)
    {
        // Trouver le produit par son ID
        $product = Produits::findOrFail($productId);
        // Vérifier si le panier existe déjà dans la session
        $cart = session()->get('cart', []);
        // Si le produit existe déjà dans le panier, on l'incrémente
        if(isset($cart[$productId])) {
            $cart[$productId]['quantite']++;
        } else {
            // Si le produit n'existe pas, on l'ajoute
            $cart[$productId] = [
                "nom" => $product->nom,
                "quantite" => 1,
                "prix" => $product->prix,
                "image" => $product->image
            ];
        }
        // Sauvegarder le panier dans la session
        session()->put('cart', $cart);
        return response()->json(['success' => true]);
    }
    public function showCart()
    {
        $cart = session()->get('cart', []);
        return view('cart.panier', compact('cart'));
    }
}
