<?php

use App\Http\Controllers\Admin\ProductController;
use Illuminate\Support\Facades\Route;

//Route::prefix('admin')->middleware(['role:admin'])->group(function () {
Route::prefix('admin')->group(function () {
    Route::get('products', [ProductController::class, 'index'])->name('admin.products.index');

    Route::get('products/create', [ProductController::class, 'create'])->name('admin.products.create');
    Route::post('products/store', [ProductController::class, 'store'])->name('admin.products.store');

    Route::get('products/{product}/show', [ProductController::class, 'show'])->name('admin.products.show');

    Route::get('products/{product}/edit', [ProductController::class, 'edit'])->name('admin.products.edit');
    Route::post('products/{product}/update', [ProductController::class, 'update'])->name('admin.products.update');

    Route::post('products/{product}/delete',[ProductController::class, 'delete'])->name('admin.products.delete');
});
