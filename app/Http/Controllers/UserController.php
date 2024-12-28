<?php

namespace App\Http\Controllers;

use App\Models\Carts;
use App\Models\Categorie;
use App\Models\Commandes;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class UserController extends Controller
{
    public function showLogin(){
        $categories = Categorie::all();
        return view('temp.auth.login',[
            'categories' => $categories
        ]);
    }
    public function login(Request $request){
        // $credentials = $request->only('email','password');
        $email = $request->email ;
        $password = $request->password ;
        $credentials = [
            'email' => $email ,
            'password' => $password
        ];
        if(Auth::attempt($credentials)){
            $request->session()->regenerate();
            return redirect()->route('layouts.home')->with('login','Login avec succées , Bienvenue');
        }else{
            return back()->withErrors([
                'email' => 'Email où mot de pass est incorrect'
            ]);
        }
    }
    public function logout(Request $request){
        Session::flush();
        Auth::logout();
        return redirect()->route('layouts.home')->with('logout','Déconnexion avec succées');
    }
    public function RegisterForm(){
        $categories = Categorie::all();
        return view('temp.auth.register',compact('categories'));
    }
    public function Register(Request $request){
        $att = $request->validate([
            'name' => 'required' ,
            'image' => 'nullable',
            'cin' => 'nullable',
            'adresse'=>'nullable',
            'email' => 'required|unique:users' ,
            'password' => 'required|confirmed|min:5|string|max:25',
            'status' => 'nullable',
            'pays' => 'nullable',
            'ville' => 'nullable'

        ]);
        //$att['image'] = $request->file('image')->store('users','public');
        $att['password'] = Hash::make($request->password);
        User::create($att);
        return redirect()->route('login')->with('register','Création du compte avec succes');
    }

    public function profile($id)
    {
        $user = User::find($id);
        $categories = Categorie::all();
        $cart = Carts::where('user_id', auth()->id())->first();
        $orders = auth()->user()->Commandes;
        $commande = Commandes::with(['products', 'User'])->findOrFail($id);
        $products = $commande->produits;

        $cartItems = $cart ? $cart->items->load(['product', 'product.firstImage']) : collect();
        return view('temp.auth.profile', compact('user', 'categories', 'cart', 'cartItems','commande','products', 'orders'));
    }


    public function editp($id) {
        $categories = Categorie::all();
        $user = User::find($id);
        $cart = Carts::where('user_id', auth()->id())->first();
        $cartItems = $cart ? $cart->items->load(['product', 'product.firstImage']) : collect();
        if (!$user) {
            return redirect()->route('auth.profile', $id)->with('error', 'Utilisateur non trouvé');
        }
        return view('temp.auth.editp', compact('user','categories','cart','cartItems'));
    }
    public function updatep(Request $request, $id) {
        $att = $request->validate([
            'name' => 'required',
            'image' => 'nullable|image',
            'cin' => 'nullable',
            'adresse' => 'nullable',
            'email' => 'nullable|unique:users,email,' . $id,
            'password' => 'nullable|confirmed|min:5|string|max:25',
            'status' => 'nullable',
            'pays' => 'nullable',
            'ville' => 'nullable'
        ]);
        if ($request->hasFile('image')) {
            $att['image'] = $request->file('image')->store('users', 'public');
        }
        $user = User::find($id);
        if (!$user) {
            return redirect()->route('auth.profile', $id)->with('error', 'Utilisateur non trouvé');
        }
        $user->update($att);

        return redirect()->route('auth.profile', $id)->with('update', 'Modification du compte avec succéss');
    }
    public function authenticated(Request $request, $user)
    {
        // Appeler la méthode mergeCart pour synchroniser le panier
        app('App\Http\Controllers\CartsController')->mergeCart();

        return redirect()->intended('/');
    }

}
