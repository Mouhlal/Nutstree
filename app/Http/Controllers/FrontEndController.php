<?php

namespace App\Http\Controllers;

use App\Models\Categorie;
use App\Models\Commandes;
use App\Models\Produits;
use Illuminate\Http\Request;

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
        return view('dashboard.home', [
            'produits' => $produits,
            'categories' => $categories
        ]);
    }
    public function tables(){
        $produits = Produits::with('categories')
                    ->get();
        $categories = Categorie::all();
        return view('dashboard.tables', [
        'produits' => $produits,
        'categories' => $categories
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

}
