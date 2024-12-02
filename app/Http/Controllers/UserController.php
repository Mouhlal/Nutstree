<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class UserController extends Controller
{
    public function showLogin(){
        return view('auth.login');
    }
    public function login(Request $request){
        // $credentials = $request->only('email','password');
        $email = $request->email ;
        $password = $request->password ;
        $credentials = $request->validate([
            'email' => $email ,
            'password' => $password
        ]);
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
        return view('auth.register');
    }
    public function Register(Request $request){
        $att = $request->validate([
            'name' => 'required' ,
            'image' => 'nullable',
            'cin' => 'nullable',
            'adresse'=>'nullable',
            'tel' => 'required|unique:users' ,
            'email' => 'required|confirmed|unique:users' ,
            'password' => 'required|min:5|string|max:25'
        ]);
        $att['image'] = $request->file('image')->store('users','public');
        $att['password'] = Hash::make($request->password);
        User::create($att);
        return redirect()->route('layouts.home')->with('register','Création du compte avec succes');
    }
}
