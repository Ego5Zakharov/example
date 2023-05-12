<?php

use App\Http\Controllers\User\CardController;
use Illuminate\Support\Facades\Route;


Route::prefix('user')->middleware(['active'])->group(function () {
    Route::get('card', [CardController::class, 'index'])->name('user.card.index');

    Route::POST('card/{product}/create', [CardController::class, 'create'])->name('user.card.create');

    Route::POST('card/{product}/delete', [CardController::class, 'delete'])->name('user.card.delete');
});
