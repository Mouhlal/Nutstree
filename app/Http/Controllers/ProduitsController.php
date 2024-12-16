<?php

namespace App\Http\Controllers;

use App\Models\Categorie;
use App\Models\Produits;
use App\Models\Produits_Images;
use Illuminate\Http\Request;

class ProduitsController extends Controller
{

    public function index(Request $request)
    {
        $category_id = $request->input('category_id');
        $categorie = Categorie::all();


        if ($category_id) {
            $produits = Produits::where('categorie_id', $category_id)->with('categories')->get();
        } else {
            $produits = Produits::with('categories')->get();
        }
        return view('produits.index',[
            'category_id' => $category_id ,
            'categorie' => $categorie ,
            'produits' => $produits
        ]);
    }

    public function add(){
        $categ = Categorie::all();
        return view('produits.add',[
            'categ' => $categ
        ]);
    }
    public function store(Request $request) {
        $att = $request->validate([
            'nom' => 'required',
            'description' => 'nullable',
            'image.*' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'prix' => 'required|numeric',
            'mesure' => 'required',
            'quantite' => 'required|numeric',
            'categorie_id' => 'required|exists:categories,id',
        ]);

        // Créez le produit
        $produit = Produits::create([
            'nom' => $att['nom'],
            'description' => $att['description'],
            'prix' => $att['prix'],
            'mesure' => $att['mesure'],
            'quantite' => $att['quantite'],
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
    public function update(Request $request, $id){
        $att = $request->validate([
            'nom' => 'required',
            'description' => 'nullable' ,
            'image' => 'nullable|image' ,
            'prix' => 'nullable',
            'mesure' => 'nullable',
            'quantite' => 'nullable',
            'categorie_id' => 'required|exists:categories,id'
        ]);
        if($request->hasFile('image')){
            $att['image'] = $request->file('image')->store('produits','public');
        }
        $prod = Produits::findOrFail($id) ;
        $prod->update($att);
        return redirect()->route('dash.tables')->with('updateP','Produit a été modifié');
    }

    public function delete($id){
        $prod = Produits::findOrFail($id);
        $prod->delete();
        return redirect()->route('dash.tables')->with('deleteP','Produit a été supprimé');
    }
    public function details($id)
{
    $produit = Produits::with('reviews.user')->findOrFail($id);

    return view('produits.details', compact('produit'));
}



}
