<?php

namespace App\Http\Controllers;

use App\Mail\PromoCodeMail;
use App\Models\CartItems;
use App\Models\Carts;
use App\Models\Categorie;
use App\Models\Code_Promo;
use App\Models\CodePromo;
use App\Models\DeliveryFee;
use App\Models\Produits;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

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
        $cartItems = collect(); // For authenticated users
        $sessionCartItems = collect(); // For unauthenticated users
        $subtotal = 0; // Subtotal for authenticated users
        $sessionSubtotal = 0; // Subtotal for unauthenticated users

        // Check if the user is authenticated
        if (Auth::check()) {
            $city = auth()->user()->ville ?? 'casa'; // User's city, default to 'casa'
            $deliveryFee = DeliveryFee::where('city', $city)->value('fee') ?? 0; // Get delivery fee based on the city

            // Get the user's cart (if any)
            $cart = Carts::where('user_id', auth()->id())->with('items.product.firstImage')->first();
            $cartItems = $cart ? $cart->items : collect(); // Get items in the authenticated user's cart
            $subtotal = $cartItems->sum(fn($item) => $item->product ? $item->quantity * $item->product->prix : 0); // Calculate the subtotal

            // Save the subtotal and delivery fee to session for future use
            session()->put('subtotal', $subtotal);
            session()->put('deliveryFee', $deliveryFee);
        }

        // For unauthenticated users, handle cart stored in session
        $sessionCart = session('cart', []);
        if (!empty($sessionCart)) {
            $sessionCartItems = collect($sessionCart); // Cart items stored in session
            $sessionSubtotal = $sessionCartItems->sum(fn($item) => $item['price'] * $item['quantity']); // Calculate subtotal for session cart
        }

        // Get the list of all available cities and the current selected city
        $allCities = DeliveryFee::pluck('city')->toArray();
        $currentCity = session('selected_city', 'casa'); // Get the current selected city from session or default to 'casa'

        // Calculate the new subtotal for authenticated users only (do not include session subtotal here)
        $newSubtotal = $subtotal; // Use only the authenticated user's subtotal
        $discountAmount = session('discountAmount', 0); // Get any discount amount if applicable
        $total = $newSubtotal + $deliveryFee; // Calculate the total for authenticated users only

        // Save the total to the session
        session()->put('total', $total);

        // Debugging output (you can remove this later)
       

        // Return the view with all necessary data
        return view('temp.panier-auth', compact(
            'cartItems',
            'sessionCartItems',
            'categories',
            'allCities',
            'currentCity',
            'subtotal',
            'sessionSubtotal',
            'deliveryFee',
            'total',
            'discountAmount',
            'newSubtotal'
        ));
    }

    public function removeFromCart($id)
{
    if (auth()->check()) {
        // Authenticated user: Remove from database cart
        $cartItem = CartItems::findOrFail($id);

        if ($cartItem->cart->user_id !== auth()->id()) {
            return redirect()->back()->withErrors('Action non autorisée.');
        }

        $cartItem->delete();
    } else {
        // Guest user: Remove from session cart
        $cart = session('cart', []);

        // Find and remove the item by ID
        if (isset($cart[$id])) {
            unset($cart[$id]);
        }

        // Update the session
        session(['cart' => $cart]);
    }

    return redirect()->back()->with('delP', 'Produit supprimé du panier avec succès.');
}


    public function updateMultiple(Request $request)
{
    // Valider les quantités reçues dans le formulaire
    $validated = $request->validate([
        'quantity' => 'required|array',
        'quantity.*' => 'required|integer|min:1',
    ]);

    if (auth()->check()) {
        // Si l'utilisateur est connecté
        foreach ($validated['quantity'] as $itemId => $quantity) {
            $cartItem = CartItems::findOrFail($itemId);
            if ($cartItem->cart->user_id !== auth()->id()) {
                return redirect()->back()->withErrors('Action non autorisée.');
            }

            $cartItem->quantity = $quantity;
            $cartItem->save();
        }
    } else {
        // Si l'utilisateur n'est pas connecté (utilise une session)
        $sessionCart = session('cart', []);
        foreach ($validated['quantity'] as $itemId => $quantity) {
            if (isset($sessionCart[$itemId])) {
                $sessionCart[$itemId]['quantity'] = $quantity;
            }
        }
        session(['cart' => $sessionCart]); // Mettre à jour la session
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
        // Mettre à jour la ville dans la session
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

/*  public function showCartSession()
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
 */

/* public function updateQuantitySession(Request $request)
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
 */

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


}

