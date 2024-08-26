<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Web\CategoryController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    $categories = \App\Models\Category::orderBy('id')->get();
    return view('client', compact(['categories']));
});

Route::prefix('category')->group(function (){
    Route::get('/{slug}', [CategoryController::class, 'getBySlug'])->name('category.slug');
});
