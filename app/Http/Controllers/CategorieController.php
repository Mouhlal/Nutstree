<?php

namespace App\Http\Controllers;

use App\Models\Categorie;
use Illuminate\Http\Request;

class CategorieController extends Controller
{
    public function add(){
        return view('cat.add');
    }
    public function store(Request $request){
        $cat = $request->validate([
            'type' => 'required',
            'image' => 'nullable'
        ]);
        $cat['image'] = $request->file('image')->store('categories','public');

        Categorie::create($cat);
        return redirect()->route('dash.cat')->with('catAdd','Categories ajoutée');
    }
    public function edit($id){
        $cat = Categorie::find($id);
        return view('cat.edit', compact('cat'));
    }
    public function update(Request $request, $id){
        $cat = $request->validate([
            'type' => 'nullable',
            'image' => 'nullable'
        ]);
        if($request->hasFile('image')){
            $cat['image'] = $request->file('image')->store('categories','public');
        }
            Categorie::find($id)->update($cat);
            return redirect()->route('dash.cat')->with('catUpdate','Categories modifiée');
    }
    public function delete($id){
        Categorie::find($id)->delete();
        return redirect()->route('dash.cat')->with('catDelete','Categories supprimée');
    }

}

