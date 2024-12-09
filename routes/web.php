<?php

use App\Http\Controllers\Auth\GoogleController;
use App\Http\Controllers\CartsController;
use App\Http\Controllers\CategorieController;
use App\Http\Controllers\CommandesController;
use App\Http\Controllers\FrontEndController;
use App\Http\Controllers\ProduitsController;
use App\Http\Controllers\ReviewsController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::controller(FrontEndController::class)->group(function () {
    Route::get('/', 'Home')->name('layouts.home');
    Route::get('/about', 'About')->name('layouts.about');
    Route::get('/contact', 'Contact')->name('layouts.contact');
    Route::get('/dashboard/home','Dash')->name('dash.home')->middleware('isAdmin');
    Route::get('/dashboard/produit','tables')->name('dash.tables')->middleware('isAdmin');
    Route::get('/dashboard/categories','cat')->name('dash.cat')->middleware('isAdmin');
    Route::get('/dashboard/forms','forms')->name('dash.forms')->middleware('isAdmin');
    Route::get('/dashboard/calendar','calendar')->name('dash.calendar')->middleware('isAdmin');


});


Route::controller(CommandesController::class)->group(function(){
    Route::post('/commande', 'store')->name('commande.store');
    Route::get('/commandes', 'index')->name('commandes.index');
    Route::post('/commandes/{commande}/cancel', 'cancel')->name('commandes.cancel');

});

Route::controller(UserController::class)->group(function(){
    Route::get('/login', 'showLogin')->name('auth.showLogin');
    Route::post('/login','login')->name('auth.login');
    Route::get('/register','RegisterForm')->name('auth.showRegister');
    Route::post('/register','Register')->name('auth.register');
    Route::get('/logout','logout')->name('auth.logout');
    Route::get('/profile/{id}','profile')->name('auth.profile');
    Route::get('/profile/edit/{id}','editp')->name('auth.editp');
    Route::post('/profile/edit/{id}','updatep')->name('auth.updatep');
});

Route::get('auth/google', [GoogleController::class, 'redirectToGoogle'])->name('auth.google');
Route::get('auth/google/callback', [GoogleController::class, 'handleGoogleCallback']);


Route::controller(CategorieController::class)->group(function(){
    Route::get('/categories/ajout','add')->name('cat.add')->middleware('isAdmin');
    Route::post('/categories/ajout','store')->name('cat.store')->middleware('isAdmin');
    Route::get('/categories/{id}/edit','edit')->name('cat.edit')->middleware('isAdmin');
    Route::post('/categories/{id}/edit','update')->name('cat.update')->middleware('isAdmin');
    Route::get('/categories/{id}/delete','delete')->name('cat.delete')->middleware('isAdmin');
});

Route::controller(ProduitsController::class)->group(function(){
    Route::get('/produits','index')->name('prod.index');
    Route::get('/produits/ajout','add')->name('prod.add')->middleware('isAdmin');
    Route::post('/produits/ajout','store')->name('prod.store')->middleware('isAdmin');
    Route::get('/produits/{id}/edit','edit')->name('prod.edit')->middleware('isAdmin');
    Route::put('/produits/{id}/update','update')->name('prod.update')->middleware('isAdmin');
    Route::get('/produits/{id}/delete','delete')->name('prod.delete')->middleware('isAdmin');
    Route::get('/produits/détails/{id}','details')->name('prod.details');

});


Route::controller(CartsController::class)->group(function(){
    Route::post('/cart/add/{productId}','addToCart')->name('cart.add');
    Route::get('/cart','showCart')->name('cart.show');
    Route::delete('/cart/remove/{id}','removeFromCart')->name('cart.remove');
    Route::patch('/cart/update/{id}','updateQuantity')->name('cart.update');
    Route::post('/cart/update-session/{id}', 'updateSessionQuantity')->name('cart.updateSession');
    Route::post('/cart/remove-session/{id}',  'removeSessionItem')->name('cart.removeSession');

});

Route::post('/produits/{id}/reviews', [ReviewsController::class, 'storeReview'])->name('reviews.store');

