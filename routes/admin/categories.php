<?php

use App\Http\Controllers\Admin\CategoryController;
use Illuminate\Support\Facades\Route;

Route::prefix('categories')->group(function () {
    Route::get('/', [CategoryController::class, 'index'])->name('admin.categories.get');
    Route::get('/create', [CategoryController::class, 'create'])->name('admin.categories.create');
    Route::post('/', [CategoryController::class, 'store'])->name('admin.categories.store');
    Route::get('/edit/{id}', [CategoryController::class, 'edit'])->name('admin.categories.edit');
    Route::delete('/delete/{id}', [CategoryController::class, 'delete'])->name('admin.categories.delete');
    Route::put('/{id}', [CategoryController::class, 'update'])->name('admin.categories.update');
    Route::put('/block/{id}', [CategoryController::class, 'block'])->name('admin.categories.block');
    Route::put('/unblock/{id}', [CategoryController::class, 'unblock'])->name('admin.categories.unblock');
});
