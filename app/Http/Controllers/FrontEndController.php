<?php

namespace App\Http\Controllers;

use App\Models\Carts;
use App\Models\Categorie;
use App\Models\Commandes;
use App\Models\Produits;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FrontEndController extends Controller
{
    public function Home(){
        return view('layouts.home');
    }
    public function Contact(){
        return view('layouts.contact');
    }
    public function About(){
        return view('layouts.about');
    }
    // Dashboard
    public function Dash(){
        $produits = Produits::with('categories')
                    ->orderByDesc('id')
                    ->limit(5)
                    ->get();
        $categories = Categorie::all();
        $user = User::all();
        return view('dashboard.home', [
            'produits' => $produits,
            'categories' => $categories,
            'user' => $user
        ]);
    }
    public function tables(){
        $produits = Produits::with('categories')
                    ->get();
        $categories = Categorie::all();
        $user = User::all();
        return view('dashboard.tables', [
        'produits' => $produits,
        'categories' => $categories,
        'user' => $user
    ]);
    }
    public function cat(){
        $categories = Categorie::all();
        return view('dashboard.cat', [
        'categories' => $categories
    ]);
    }
    public function calendar(){
        return view('dashboard.calendar');
    }
    public function forms(){
        return view('dashboard.forms');
    }
    public function blanks(){
        return view('dashboard.blank');
    }
    public function index(Request $request)
    {
        $search = $request->input('search');
        $status = $request->query('status');
        $commandesQuery = Commandes::query();

        if ($status) {
            $commandesQuery->where('status', $status);
        }
        if ($search) {
            $commandesQuery->where(function ($query) use ($search) {
                $query->where('numCom', 'like', "%$search%")
                      ->orWhereHas('user', function ($query) use ($search) {
                          $query->where('name', 'like', "%$search%");
                      });
            });
        }

        // Récupérer les commandes avec pagination
        $commandes = $commandesQuery->paginate(10);

        return view('dashboard.commandes', [
            'commandes' => $commandes,
            'status' => $status,
            'search' => $search,
        ]);
    }

    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|string',
        ]);
        $commande = Commandes::findOrFail($id);
        $commande->status = $request->input('status');
        $commande->save();
        return redirect()->route('dash.commandes')->with('success', 'Statut de la commande mis à jour avec succès.');
    }
    public function destroy($id)
    {
        $commande = Commandes::findOrFail($id);
        $commande->delete();
        return redirect()->route('dash.commandes')->with('deletedC', 'Commande supprimée avec succès.');
    }


    public function main(){
        $produits = Produits::with('categories')
                     ->orderByDesc('id')
                    ->limit(8)
                    ->get();
        $categories = Categorie::all();
        if (Auth::check()) {
            // Récupérer le panier de l'utilisateur connecté avec les produits et leurs images
            $cart = Carts::where('user_id', auth()->id())->first();
            $cartItems = $cart ? $cart->items->load(['product', 'product.firstImage']) : collect();
        } else {
            // Panier pour utilisateurs non connectés
            $cartItems = collect(session()->get('cart', []));
        }

        return view('main.index',[
            'produits' => $produits,
            'categories' => $categories,
            'cartItems' => $cartItems,
        ]);
    }
    public function search(Request $request){
        $query = $request->input('query');
        $products = Produits::where('nom', 'like', '%' . $query . '%')
                           ->orWhere('description', 'like', '%' . $query . '%')
                           ->get();

        return view('main.index', compact('products'));
    }


}
