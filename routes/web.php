<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SauceController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\SauceApiController;
use Illuminate\Support\Facades\View;

// Page d'accueil accessible à tous
Route::get('/', function () {
    return view('sauces.home');
})->name('home');

// Authentification (Login & Register)
Auth::routes();

Route::resource('sauces', SauceApiController::class);

// Routes pour les likes et dislikes
Route::post('/sauces/{sauce}/like', [SauceApiController::class, 'like'])->name('sauces.like');
Route::post('/sauces/{sauce}/dislike', [SauceApiController::class, 'dislike'])->name('sauces.dislike');

// Route pour my-sauces
Route::get('/my-sauces', [SauceApiController::class, 'mySauces'])->name('sauces.my-sauces');    
Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
