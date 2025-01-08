<?php

use App\Http\Controllers\Auth\GoogleController;
use App\Http\Controllers\CartsController;
use App\Http\Controllers\CategorieController;
use App\Http\Controllers\CodePromoController;
use App\Http\Controllers\CommandesController;
use App\Http\Controllers\DeliveryFeeController;
use App\Http\Controllers\FrontEndController;
use App\Http\Controllers\PaiementsController;
use App\Http\Controllers\ProduitsController;
use App\Http\Controllers\ReviewsController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Auth\PasswordResetController;
use App\Http\Controllers\Auth\ForgotPasswordController;

// Affiche le formulaire de demande de réinitialisation
Route::get('password/reset', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');

// Envoie l'e-mail de réinitialisation
Route::post('password/email', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');

// Affiche le formulaire pour entrer un nouveau mot de passe
Route::get('password/reset/{token}', [PasswordResetController::class, 'showResetForm'])->name('password.reset');

// Gère la réinitialisation du mot de passe
Route::post('password/reset', [PasswordResetController::class, 'reset'])->name('password.update');



Route::controller(FrontEndController::class)->group(function () {
    Route::get('/', 'home')->name('layouts.home');
    Route::get('/about', 'About')->name('layouts.about');
    Route::get('/contact', 'contact')->name('layouts.contact');
    Route::get('/dashboard/home','Dash')->name('dash.home')->middleware(['role:admin,superadmin']);
    Route::get('/dashboard/produit','tables')->name('dash.tables')->middleware(['role:admin,superadmin']);
    Route::get('/dashboard/categories','cat')->name('dash.cat')->middleware(['role:admin,superadmin']);
    Route::get('/dashboard/forms','forms')->name('dash.forms')->middleware(['role:admin,superadmin']);
    Route::get('/dashboard/calendar','calendar')->name('dash.calendar')->middleware(['role:admin,superadmin']);
    Route::get('/dashboard/commandes','index')->name('dash.commandes')->middleware(['role:superadmin']);
    Route::get('/dashboard/clients','clients')->name('dash.clients')->middleware(['role:superadmin']);
    Route::delete('/dashboard/commandes/{id}','destroy')->name('dash.commandes.destroy')->middleware(['role:superadmin']);
    Route::patch('/dashboard/commandes/update/{id}','updateStatus')->name('dash.commandes.update')->middleware(['role:superadmin']);
    Route::delete('/dashboard/client/{id}','destroyUser')->name('dash.client.destroy')->middleware(['role:superadmin']);
    Route::patch('/dashboard/client/update/{id}','updateStatusClient')->name('dash.client.update')->middleware(['role:superadmin']);

    Route::patch('/dashboard/client/role/{id}','update')->name('dash.client.role')->middleware(['role:superadmin']);

});

Route::post('/payment/callback', [PaiementsController::class, 'handleCallback'])->name('payment.callback');
Route::get('/payment/cancel', [PaiementsController::class, 'handleCancel'])->name('payment.cancel');


Route::controller(CommandesController::class)->group(function(){
    Route::get('/checkout', 'checkout')->name('pay.check')->middleware('auth');
    Route::post('/commande', 'store')->name('commande.store')->middleware('auth');
    Route::post('/commandes/{commande}/cancel', 'cancel')->name('commandes.cancel');
    Route::delete('/orders/{id}',  'deleteOrder')->name('orders.delete');

});
Route::get('/commande/{order}/details', [CommandesController::class, 'details'])->name('commande.details');
Route::get('/cmi/payment/{order}', [CommandesController::class, 'index'])->name('cmi.payment');
Route::get('/commande/{id}/pdf', [CommandesController::class, 'generatePdf'])->name('commande.pdf')->middleware(['role:admin,superadmin']);



Route::get('/CodePromo', [CodePromoController::class, 'index'])->name('codepromo.index');
Route::get('/CodePromo/create', [CodePromoController::class, 'create'])->name('codepromo.create');
Route::post('/CodePromo/store', [CodePromoController::class, 'store'])->name('codepromo.store');
Route::get('/CodePromo/{id}/edit', [CodePromoController::class, 'edit'])->name('codepromo.edit');
Route::post('/CodePromo/{id}', [CodePromoController::class, 'update'])->name('codepromo.update');
Route::delete('/CodePromo/{id}', [CodePromoController::class, 'destroy'])->name('codepromo.destroy');
Route::get('/cart/send-promo', [CodePromoController::class, 'sendPromo'])->name('cart.sendPromo');
Route::post('/cart/apply-promo', [CodePromoController::class, 'applyPromo'])->name('apply.promo');




Route::controller(UserController::class)->group(function(){
    Route::get('/login', 'showLogin')->name('login');
    Route::post('/login','login')->name('auth.login');
    Route::get('/register','RegisterForm')->name('auth.showRegister');
    Route::post('/register','Register')->name('auth.register');
    Route::get('/logout','logout')->name('auth.logout');
    Route::get('/profile/{id}','profile')->name('auth.profile')->middleware('auth');
    Route::get('/profile/edit/{id}','editp')->name('auth.editp')->middleware('auth');
    Route::post('/profile/edit/{id}','updatep')->name('auth.updatep')->middleware('auth');
});

Route::get('auth/google', [GoogleController::class, 'redirectToGoogle'])->name('auth.google');
Route::get('auth/google/callback', [GoogleController::class, 'handleGoogleCallback']);


Route::controller(CategorieController::class)->group(function(){
    Route::get('/categories/ajout','add')->name('cat.add')->middleware(['role:admin,superadmin']);
    Route::post('/categories/ajout','store')->name('cat.store')->middleware(['role:admin,superadmin']);
    Route::get('/categories/{id}/edit','edit')->name('cat.edit')->middleware(['role:admin,superadmin']);
    Route::post('/categories/{id}/edit','update')->name('cat.update')->middleware(['role:admin,superadmin']);
    Route::get('/categories/{id}/delete','delete')->name('cat.delete')->middleware(['role:admin,superadmin']);
});

Route::controller(ProduitsController::class)->group(function(){
    Route::get('/produits','index')->name('prod.index');
    Route::get('/produits/ajout','add')->name('prod.add')->middleware(['role:admin,superadmin']);
    Route::post('/produits/ajout','store')->name('prod.store')->middleware(['role:admin,superadmin']);
    Route::get('/produits/{id}/edit','edit')->name('prod.edit')->middleware(['role:admin,superadmin']);
    Route::put('/produits/{id}/update','update')->name('prod.update')->middleware(['role:admin,superadmin']);
    Route::get('/produits/{id}/delete','delete')->name('prod.delete')->middleware(['role:admin,superadmin']);
    Route::get('/produits/détails/{id}','details')->name('prod.details');

});


Route::controller(CartsController::class)->group(function(){
    Route::post('/cart/add/{productId}','addToCart')->name('cart.add');
    Route::post('/cart/update-multiple',  'updateMultiple')->name('cart.updateMultiple');
    Route::get('/cart/remove/{id}','removeFromCart')->name('cart.remove');
    Route::post('/update-city',  'updateCity')->name('update.city');
    Route::post('/cart/session/update',  'updateQuantitySession')->name('cart.updateSession');
    Route::get('/cart/session/remove/{id}',  'supprimerItems')->name('cart.dropsession');
    Route::get('/cart','showCart' )->name('cart.show');

});


Route::post('/produits/{id}/reviews', [ReviewsController::class, 'storeReview'])->name('reviews.store');


/* Route::get('pay/create/{commandeId}', [PaiementsController::class, 'createPayment'])->name('pay.pay');
Route::get('pay/success/{commandeId}', [PaiementsController::class, 'paymentSuccess'])->name('pay.success');
Route::post('/pay/cash/{commande}', [PaiementsController::class, 'cashOnDelivery'])->name('pay.cash');
Route::post('/pay/cmi/{commande}', [PaiementsController::class, 'payByCmi'])->name('pay.cmi'); */

Route::get('/payment/return', [PaiementsController::class, 'handleReturn'])->name('payment.return');
Route::post('/payment/callback', [PaiementsController::class, 'handleCallback'])->name('payment.callback');


Route::get('/delivery-fees', [DeliveryFeeController::class, 'index'])->name('delivery_fees.index');
Route::get('/delivery-fees/create', [DeliveryFeeController::class, 'create'])->name('delivery_fees.create');
Route::post('/delivery-fees', [DeliveryFeeController::class, 'store'])->name('delivery_fees.store');
Route::get('/delivery-fees/{id}/edit', [DeliveryFeeController::class, 'edit'])->name('delivery_fees.edit');
Route::put('/delivery-fees/{id}', [DeliveryFeeController::class, 'update'])->name('delivery_fees.update');
Route::delete('/delivery-fees/{id}', [DeliveryFeeController::class, 'destroy'])->name('delivery_fees.destroy');



