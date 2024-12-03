<?php

namespace App\Http\Controllers;

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
    
}
