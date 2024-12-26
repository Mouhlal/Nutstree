<?php

use App\Http\Controllers\Auth\GoogleController;
use App\Http\Controllers\CartsController;
use App\Http\Controllers\CategorieController;
use App\Http\Controllers\CommandesController;
use App\Http\Controllers\DeliveryFeeController;
use App\Http\Controllers\FrontEndController;
use App\Http\Controllers\PaiementsController;
use App\Http\Controllers\ProduitsController;
use App\Http\Controllers\ReviewsController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::controller(FrontEndController::class)->group(function () {
    Route::get('/', 'home')->name('layouts.home');
    Route::get('/about', 'About')->name('layouts.about');
    Route::get('/contact', 'Contact')->name('layouts.contact');
    Route::get('/dashboard/home','Dash')->name('dash.home')->middleware(['role:admin,superadmin']);
    Route::get('/dashboard/produit','tables')->name('dash.tables')->middleware(['role:admin,superadmin']);
    Route::get('/dashboard/categories','cat')->name('dash.cat')->middleware(['role:admin,superadmin']);
    Route::get('/dashboard/forms','forms')->name('dash.forms')->middleware(['role:admin,superadmin']);
    Route::get('/dashboard/calendar','calendar')->name('dash.calendar')->middleware(['role:admin,superadmin']);
    Route::get('/dashboard/commandes','index')->name('dash.commandes')->middleware(['role:superadmin']);
    Route::delete('/dashboard/commandes/{id}','destroy')->name('dash.commandes.destroy')->middleware(['role:superadmin']);
    Route::patch('/dashboard/commandes/update/{id}','updateStatus')->name('dash.commandes.update')->middleware(['role:superadmin']);


});

Route::controller(PaiementsController::class)->group(function(){
});


Route::controller(CommandesController::class)->group(function(){
    Route::get('/checkout', 'checkout')->name('pay.check');
    Route::post('/commande', 'store')->name('commande.store');
    Route::get('/commandes', 'index')->name('commandes.index');
    Route::post('/commandes/{commande}/cancel', 'cancel')->name('commandes.cancel');
    Route::delete('/orders/{id}',  'deleteOrder')->name('orders.delete');

});
Route::get('/commande/{order}/details', [CommandesController::class, 'details'])->name('commande.details');
Route::get('/cmi/payment/{order}', [CommandesController::class, 'index'])->name('cmi.payment');
Route::get('/commande/{id}/pdf', [CommandesController::class, 'generatePdf'])->name('commande.pdf');






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
    Route::patch('/cart/update-multiple',  'updateMultiple')->name('cart.updateMultiple');
    Route::get('/cart/remove/{id}','removeFromCart')->name('cart.remove');
    Route::post('/update-city',  'updateCity')->name('update.city');
    Route::post('/cart/session/update',  'updateQuantitySession')->name('cart.updateSession');
    Route::get('/cart/session/remove/{id}',  'supprimerItems')->name('cart.dropsession');

});

Route::get('/cart', function () {
    if (Auth::check()) {
        return app(CartsController::class)->showCart();
    } else {
        return app(CartsController::class)->showCartSession();
    }
})->name('cart.show');

Route::get('/debug-cart', function () {
    dd(session('cart', []));
});

Route::post('/produits/{id}/reviews', [ReviewsController::class, 'storeReview'])->name('reviews.store');


Route::get('pay/create/{commandeId}', [PaiementsController::class, 'createPayment'])->name('pay.pay');
Route::get('pay/success/{commandeId}', [PaiementsController::class, 'paymentSuccess'])->name('pay.success');
Route::post('/pay/cash/{commande}', [PaiementsController::class, 'cashOnDelivery'])->name('pay.cash');
Route::post('/pay/cmi/{commande}', [PaiementsController::class, 'payByCmi'])->name('pay.cmi');



Route::get('/delivery-fees', [DeliveryFeeController::class, 'index'])->name('delivery_fees.index');
Route::get('/delivery-fees/create', [DeliveryFeeController::class, 'create'])->name('delivery_fees.create');
Route::post('/delivery-fees', [DeliveryFeeController::class, 'store'])->name('delivery_fees.store');
Route::get('/delivery-fees/{id}/edit', [DeliveryFeeController::class, 'edit'])->name('delivery_fees.edit');
Route::put('/delivery-fees/{id}', [DeliveryFeeController::class, 'update'])->name('delivery_fees.update');
Route::delete('/delivery-fees/{id}', [DeliveryFeeController::class, 'destroy'])->name('delivery_fees.destroy');





