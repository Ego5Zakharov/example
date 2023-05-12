<?php

use App\Http\Controllers\LoginController;
use App\Http\Controllers\MarketPlace;
use App\Http\Controllers\RegisterController;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;


Route::view('/', 'home.index')->name('home')->middleware('guest');

Route::get('market', [MarketPlace::class, 'index'])->name('market');
Route::get('market/{product}', [MarketPlace::class,'show'])->name('market.show');

Route::get('register', [RegisterController::class, 'index'])->name('register');
Route::post('store,', [RegisterController::class, 'store'])->name('register.store');

Route::get('login', [LoginController::class, 'index'])->name('login');
Route::post('store', [LoginController::class, 'store'])->name('login.store');
Route::post('login/logout', [LoginController::class, 'logout'])->name('login.logout');



//Route::get('/', function () {
//    $user = new User;

//    dd($user->getProductSum(), $user->getProductCount(),);
//});


//Qd6-YFm-8yS-ih9 egorka@mail.ru
