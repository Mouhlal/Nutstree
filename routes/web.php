<?php

use App\Http\Controllers\Auth\GoogleController;
use App\Http\Controllers\CategorieController;
use App\Http\Controllers\FrontEndController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::controller(FrontEndController::class)->group(function () {
    Route::get('/', 'Home')->name('layouts.home');
});

Route::controller(UserController::class)->group(function(){
    Route::get('/login', 'showLogin')->name('auth.showLogin');
    Route::post('/login','login')->name('auth.login');
    Route::get('/register','RegisterForm')->name('auth.showRegister');
    Route::post('/register','Register')->name('auth.register');
    Route::get('/logout','logout')->name('auth.logout');
});

Route::get('auth/google', [GoogleController::class, 'redirectToGoogle'])->name('auth.google');
Route::get('auth/google/callback', [GoogleController::class, 'handleGoogleCallback']);


Route::controller(CategorieController::class)->group(function(){
    Route::get('/categories','index')->name('cat.index');
    Route::get('/categories/ajout','add')->name('cat.add');
    Route::post('/categories/ajout','store')->name('cat.store');
    Route::get('/categories/{id}/edit','edit')->name('cat.edit');
    Route::post('/categories/{id}/edit','update')->name('cat.update');
    Route::get('/categories/{id}/delete','delete')->name('cat.delete');
});
