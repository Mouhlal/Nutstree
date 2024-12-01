<?php

use App\Http\Controllers\FrontEndController;
use Illuminate\Support\Facades\Route;

Route::controller(FrontEndController::class)->group(function () {
    Route::get('/', 'Home')->name('layouts.home');
});
