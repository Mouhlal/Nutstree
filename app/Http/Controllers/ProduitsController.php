<?php

namespace App\Http\Controllers;

use App\Models\Carts;
use App\Models\Categorie;
use App\Models\Produits;
use App\Models\Produits_Images;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProduitsController extends Controller
{

    public function index(){
        $categories = Categorie::all();
        $produits = Produits::with('categories')->paginate(12);
        $latestProduits = Produits::where('status', 'new')->get();
        $topRatedProduits = Produits::where('status', 'best')->get();
        $reviewProduits = Produits::where('status', 'normal')->get();
        $cart = Carts::where('user_id', auth()->id())->first();
        $cartItems = $cart ? $cart->items->load(['product', 'product.firstImage']) : collect();
        $produitsDiscount = Produits::with('categories')
        ->where('discount', '>', 0)->distinct()
        ->get();
        return view('temp.shop',[
            'categories' => $categories,
            'produits' => $produits,
            'latestProduits' => $latestProduits,
            'topRatedProduits' => $topRatedProduits,
            'reviewProduits' => $reviewProduits,
            'cart' => $cart,
            'cartItems' => $cartItems,
            'produitsDiscount' => $produitsDiscount,
        ]);
    }

    public function add(){
        $categ = Categorie::all();
        return view('produits.add',[
            'categ' => $categ
        ]);
    }
    public function store(Request $request) {
        // Validation des données
        $att = $request->validate([
            'nom' => 'required',
            'description' => 'nullable',
            'image.*' => 'required|image|max:2048',
            'prix' => 'required|numeric',
            'mesure' => 'required',
            'quantite' => 'required|numeric',
            'status' => 'nullable',
            'discount' => 'nullable|numeric|min:0|max:100',
            'categorie_id' => 'required|exists:categories,id',
        ]);

        // Calcul du prix après application du rabais
        $discountAmount = ($request->prix * $request->discount) / 100;
        $finalPrice = $request->prix - $discountAmount;

        // Créez le produit avec le prix réduit
        $produit = Produits::create([
            'nom' => $att['nom'],
            'description' => $att['description'],
            'prix' => $finalPrice, // Utilisation du prix réduit
            'mesure' => $att['mesure'],
            'quantite' => $att['quantite'],
            'status' => $att['status'],
            'discount' => $att['discount'],
            'categorie_id' => $att['categorie_id'],
        ]);

        // Traitez et enregistrez les images
        if ($request->hasFile('image')) {
            foreach ($request->file('image') as $image) {
                $path = $image->store('produits', 'public'); // Stocke l'image dans le dossier `storage/app/public/produits`
                Produits_Images::create([
                    'produit_id' => $produit->id,
                    'images' => $path,
                ]);
            }
        }
        return redirect()->route('prod.index')->with('addP', 'Produit a été ajoutée avec succès.');
    }



    public function edit($id){
        $produit = Produits::findOrFail($id);
        $categ = Categorie::all();
        return view('produits.edit',[
            'produit' => $produit,
            'categ' => $categ
            ]);
    }
    public function update(Request $request, $id)
{
    // Validation des données
    $att = $request->validate([
        'nom' => 'required',
        'description' => 'nullable',
        'image' => 'nullable|image',
        'prix' => 'nullable|numeric',
        'mesure' => 'nullable',
        'quantite' => 'nullable|numeric',
        'status' => 'nullable',
        'discount' => 'nullable|numeric|min:0|max:100',
        'categorie_id' => 'required|exists:categories,id'
    ]);

    $prod = Produits::findOrFail($id);
    // Si une nouvelle image est téléchargée, la stocker
    if ($request->hasFile('image')) {
        // Supprimer l'ancienne image si elle existe (optionnel, selon votre logique)
        if ($prod->image) {
            Storage::disk('public')->delete($prod->image);
        }
        $att['image'] = $request->file('image')->store('produits', 'public');
    }
    if (isset($att['discount']) && $att['discount'] > 0) {
        $discountAmount = ($prod->prix * $att['discount']) / 100;
        $prod->prix = $prod->prix - $discountAmount;
    }
    $prod->update($att);
    return redirect()->route('dash.tables')->with('updateP', 'Produit a été modifié');
}


    public function delete($id){
        $prod = Produits::findOrFail($id);
        $prod->delete();
        return redirect()->route('dash.tables')->with('deleteP','Produit a été supprimé');
    }
    public function details($id)
    {
        $categories = Categorie::all();
        $produit = Produits::with('reviews.user')->findOrFail($id);
        $cart = Carts::where('user_id', auth()->id())->first();
        $cartItems = $cart ? $cart->items->load(['product', 'product.firstImage']) : collect();
        $relatedProducts = Produits::whereHas('categories', function($query) use ($produit) {
            $query->where('id', $produit->categorie_id);
        })->where('id', '!=', $produit->id)->get();
        return view('temp.details-shop',[
            'categories' => $categories,
            'produit' => $produit,
            'cart' => $cart,
            'cartItems' => $cartItems,
            'relatedProducts' => $relatedProducts,
        ]);
    }




}
