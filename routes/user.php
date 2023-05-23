<?php

use App\Http\Controllers\User\CardController;
use App\Http\Controllers\User\CommentController;
use Illuminate\Support\Facades\Route;


Route::prefix('user')->middleware(['active'])->group(function () {
    Route::get('card', [CardController::class, 'index'])->name('user.card.index');

    Route::post('card/{product}/create', [CardController::class, 'create'])->name('user.card.create');

    Route::post('card/{product}/delete', [CardController::class, 'delete'])->name('user.card.delete');


    Route::post('market/{product}/create', [CommentController::class, 'create'])->name('user.market.create');
    Route::post('market/delete', [CommentController::class, 'delete'])->name('user.market.delete');
});
