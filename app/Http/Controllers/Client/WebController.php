<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductCategory;
use Illuminate\Http\Request;

class WebController extends Controller
{
    function getBySlug($slug)
    {
        $product = Product::where('slug', $slug)->with('categories')->first();
        if (empty($product)){
            $categories = Category::orderBy('id')->where('active', 1)->get();
            abort(404);
        }
        $category_id = ProductCategory::where('product_id', $product->id)->first();
        if (!empty($category_id)) {
            $category_id = $category_id->category_id;
        } else {
            $category_id = 1;
        }

        $product_ids = ProductCategory::where('category_id', $category_id)->limit(4)->get();
        $prod_ids = [];
        foreach ($product_ids as $product_id) {
            $prod_ids[] = $product_id->product_id;
        }
        $products = Product::whereIn('id', $prod_ids)->get();
        $categories = Category::orderBy('id')->where('active', 1)->get();
        return view('pages.product', compact(['product', 'categories', 'products']));
    }

    function search($keyword)
    {
        $products = Product::where('name', 'LIKE', '%' . $keyword . '%')->where('active', 1)->get();
        return response()->json([
            'data' => $products
        ]);
    }
}
