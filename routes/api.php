<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SauceApiController;

// Groupe de routes protégées par l'authentification API
Route::middleware('auth:api')->group(function () {
    // Routes RESTful pour les sauces (index, store, show, update, destroy)
    Route::apiResource('sauces', SauceApiController::class);

    // Routes spécifiques pour les likes et dislikes
    Route::post('sauces/{sauce}/like', [SauceApiController::class, 'like'])->name('sauces.like');
    Route::post('sauces/{sauce}/dislike', [SauceApiController::class, 'dislike'])->name('sauces.dislike');

    // Route pour afficher les sauces de l'utilisateur connecté
    Route::get('my-sauces', [SauceApiController::class, 'mySauces'])->name('sauces.my-sauces');
});
