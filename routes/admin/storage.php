<?php


use App\Http\Controllers\Admin\StorageController;
use Illuminate\Support\Facades\Route;

Route::prefix('storage')->group(function (){
    Route::post('images',[StorageController::class,'uploadImage'])->name('admin.storage.images');
});
