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
        $produit = Produits::with('Categories')->get();
        return view('dashboard.home', [
            'produit' => $produit
        ]);
    }
    public function tables(){
        $produit = Produits::with('Categories')->get();
    return view('dashboard.home', [
        'produit' => $produit,
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
