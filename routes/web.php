<?php

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

