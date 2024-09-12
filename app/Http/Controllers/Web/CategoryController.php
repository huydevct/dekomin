<?php

namespace App\Http\Controllers\Web;

use App\Helpers\AppHelper;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductCategory;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    function getBySlug($slug)
    {
        $category = Category::where('slug', $slug)->first();
        if (empty($category)){
            abort(404);
        }

        $product_categories = ProductCategory::where('category_id', $category->id)->get();
        $product_ids = [];
        foreach ($product_categories as $product_category){
            $product_ids[] = $product_category->product_id;
        }

        $products = Product::whereIn('id', $product_ids)->paginate(6);
        $categories = Category::orderBy('id')->get();

        return view('pages.shop', compact(['products', 'categories']));
    }
}
