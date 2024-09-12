<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Web\CategoryController;
use App\Http\Controllers\Client\WebController;

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
    $categories = \App\Models\Category::orderBy('id')->where('active', 1)->get();
    $products = \App\Models\Product::where('active', 1)->orderBy('created_at', 'desc')->limit(8)->get();
    $product_suggest = \App\Models\Product::where('active', 1)->where('is_recommend', 1)->orderBy('order')->limit(8)->get();
    return view('client', compact(['categories', 'products', 'product_suggest']));
});

Route::get('/shop', function () {
    $categories = \App\Models\Category::orderBy('id')->where('active', 1)->get();
    $products = \App\Models\Product::where('active', 1)->paginate(6);
    return view('pages.shop', compact(['categories', 'products']));
})->name('shop');

Route::prefix('category')->group(function () {
    Route::get('/{slug}', [CategoryController::class, 'getBySlug'])->name('category.slug');
});

Route::prefix('product')->group(function () {
    Route::get('/search/{keyword}', [WebController::class, 'search'])->name('product.search');
    Route::get('/{slug}', [WebController::class, 'getBySlug'])->name('product.slug');
});

Route::get('/admin', function () {
    return redirect()->route('login');
});

require "admin/index.php";
