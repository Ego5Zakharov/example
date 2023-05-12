<?php

use Illuminate\Support\Facades\Route;


Route::prefix('user')->middleware(['active'])->group(function () {

});
