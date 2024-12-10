<?php
namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class GoogleController extends Controller
{
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    public function handleGoogleCallback()
    {
        $googleUser = Socialite::driver('google')->user();

        $user = User::firstOrCreate(
            ['email' => $googleUser->getEmail()],
            [
                'name' => $googleUser->getName(),
                'password' => bcrypt(str()->random(16)),
                'google_id' => $googleUser->getId(), // Ajouter le google_id
            ]
        );
        Auth::login($user);

        return redirect()->route('layouts.home');
        // Redirigez vers votre page d'accueil ou tableau de bord
    }
    public function authenticated(Request $request, $user)
{
    // Appeler la méthode mergeCart pour synchroniser le panier
    app('App\Http\Controllers\CartsController')->mergeCart();

    return redirect()->intended('/');
}
}
