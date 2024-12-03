<?php

namespace App\Http\Controllers;

use App\Models\Categorie;
use App\Models\Produits;
use Illuminate\Http\Request;

class ProduitsController extends Controller
{
    public function index(){
        $produits = Produits::with('categories');
        return view('layouts.produits',[
            'produits' => $produits
        ]);
    }

    public function add(){
        $categ = Categorie::all();
        return view('produits.index',[
            'categ' => $categ
        ]);
    }
    public function store(Request $request){
        $att = $request->validate([
            'nom' => 'required',
            'description' => 'nullable' ,
            'image' => 'nullable|image' ,
            'prix' => 'required',
            'quantite' => 'required',
            'categories_id' => 'required|exists:categories,id'
        ]);
        $att['image'] = $request->file('image')->store('produits','public');
        Produits::create($att);
        return redirect()->route('/')->with('addP','Produit a été ajoutée');
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
            'quantite' => 'nullable',
            'categories_id' => 'required|exists:categories,id'
        ]);
        if($request->hasFile('image')){
            $att['image'] = $request->file('image')->store('produits','public');
        }
        $prod = Produits::findOrFail($id) ;
        $prod->update($att);
        return redirect()->route('/')->with('updateP','Produit a été modifié');
    }
    public function delete($id){
        $prod = Produits::findOrFail($id);
        $prod->delete();
        return redirect()->route('/')->with('deleteP','Produit a été supprimé');
    }
    public function details($id){
        $id = Produits::with('categories')->findOrFail($id);
        return view('produits.details',[
            'produit' => $id
        ]);
    }

}
