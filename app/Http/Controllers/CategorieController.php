<?php

namespace App\Http\Controllers;

use App\Models\Categorie;
use Illuminate\Http\Request;

class CategorieController extends Controller
{

    public function index(){
        $categories = Categorie::all();
        return view('cat.index', compact('categories'));
    }

    public function add(){
        return view('cat.add');
    }
    public function store(Request $request){
        $cat = $request->validate([
            'type' => 'required',
        ]);
        Categorie::create($cat);
        return redirect()->route('cat.index')->with('catAdd','Categories ajoutée');
    }
    public function edit($id){
        $cat = Categorie::find($id);
        return view('cat.edit', compact('cat'));
    }
    public function update(Request $request, $id){
        $cat = $request->validate([
            'type' => 'nullable',
        ]);
            Categorie::find($id)->update($cat);
            return redirect()->route('cat.index')->with('catUpdate','Categories modifiée');
    }
    public function delete($id){
        Categorie::find($id)->delete();
        return redirect()->route('cat.index')->with('catDelete','Categories supprimée');
    }

}

