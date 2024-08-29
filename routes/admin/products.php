<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\ProductController;

Route::prefix('products')->group(function () {

    Route::get('/', [ProductController::class, 'index'])->name('admin.products.list');
    Route::get('/create', [ProductController::class, 'create'])->name('admin.products.create');
    Route::post('/store', [ProductController::class, 'store'])->name('admin.products.store');
    Route::get('/edit/{id}', [ProductController::class, 'edit'])
        ->name('admin.products.edit')
        ->whereNumber('id');
    Route::post('/update/{id}', [ProductController::class, 'update'])
        ->name('admin.products.update')->whereNumber('id');
    Route::delete('/delete/{id}', [ProductController::class, 'destroy'])
        ->name('admin.products.delete')->whereNumber('id');

});
