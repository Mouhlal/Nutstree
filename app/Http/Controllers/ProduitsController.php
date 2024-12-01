<?php

namespace App\Http\Controllers;

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
    
}
