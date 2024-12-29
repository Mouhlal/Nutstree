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
    public function home(Request $request)
{
    $categories = Categorie::all();
    $produits = Produits::with('categories');

    // Si un terme de recherche est fourni
    $seq = $request->query('search');
    if ($seq) {
        $produits = $produits->where('nom', 'like', "%{$seq}%")
                             ->orWhere('description', 'like', "%{$seq}%")
                             ->orWhereHas('categories', function ($query) use ($seq) {
                                 $query->where('type', 'like', "%{$seq}%");
                             });
    }
    // Récupérer tous les produits filtrés ou tous les produits si aucune recherche
    $produits = $produits->get();

    // Produits selon les statuts
    $latestProduits = Produits::where('status', 'new')->get();
    $topRatedProduits = Produits::where('status', 'best')->get();
    $reviewProduits = Produits::where('status', 'normal')->get();

    // Panier et éléments
    $cart = Carts::where('user_id', auth()->id())->first();
    $cartItems = $cart ? $cart->items->load(['product', 'product.firstImage']) : collect();

    // Retourner la vue avec les produits filtrés
    return view('temp.index', [
        'categories' => $categories,
        'produits' => $produits,
        'latestProduits' => $latestProduits,
        'topRatedProduits' => $topRatedProduits,
        'reviewProduits' => $reviewProduits,
        'cart' => $cart,
        'cartItems' => $cartItems,
        'seq' => $seq
    ]);
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

    public function clients(Request $request)
{
    $search = $request->input('search');
    $status = $request->query('status');

    $userQuery = User::query();

    if ($status !== null) {
        $userQuery->where('status', $status);
    }

    // Recherche par nom ou par téléphone dans la relation (si elle existe)
    if ($search) {
        $userQuery->where(function ($query) use ($search) {
            $query->where('name', 'like', "%$search%")
            ->orWhere('tel', 'like', "%$search%");
        });
    }

    // Récupérer les utilisateurs avec pagination
    $users = $userQuery->paginate(10);

    return view('dashboard.client', [
        'users' => $users,
        'status' => $status,
        'search' => $search,
    ]);
}
public function update(Request $request,$id)
{

    $request->validate([
        'role' => 'required|in:user,admin',
    ]);

    $user = User::findOrFail($id);
        $user->role = $request->input('role');
        $user->save();

    return redirect()->back()->with('success', 'Role updated successfully.');
}

    public function updateStatusClient(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|string',
        ]);
        $user = User::findOrFail($id);
        $user->status = $request->input('status');
        $user->save();
        return redirect()->route('dash.clients')->with('success', 'Statut de client mis à jour avec succès.');
    }
    public function destroyUser($id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        return redirect()->route('dash.clients')->with('deletedC', 'Client supprimée avec succès.');
    }



    public function destroy($id)
    {
        $commande = Commandes::findOrFail($id);
        $commande->delete();
        return redirect()->route('dash.commandes')->with('deletedC', 'Commande supprimée avec succès.');
    }


    public function contact(){
        $categories = Categorie::all();
        $produits = Produits::with('categories')->get();
        $latestProduits = Produits::where('status', 'new')->get();
        $topRatedProduits = Produits::where('status', 'best')->get();
        $reviewProduits = Produits::where('status', 'normal')->get();
        $cart = Carts::where('user_id', auth()->id())->first();
        $cartItems = $cart ? $cart->items->load(['product', 'product.firstImage']) : collect();
        return view('temp.layouts.contact',[
            'categories' => $categories,
            'produits' => $produits,
            'latestProduits' => $latestProduits,
            'topRatedProduits' => $topRatedProduits,
            'reviewProduits' => $reviewProduits,
            'cart' => $cart,
            'cartItems' => $cartItems,
        ]);
    }

}
