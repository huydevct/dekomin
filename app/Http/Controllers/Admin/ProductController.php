<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ProductRequest;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\ProductLanguage;
use App\Services\ProductService\ProductGet;
use App\Services\ProductService\ProductSet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    function index(Request $request)
    {
        $products = ProductGet::getByAdmin();
        $products->appends($request->all());

        return view('pages.admin.products.list', compact(['products']));
    }

    function store(ProductRequest $request)
    {
        $product = ProductSet::createOrUpdate($request->validated());
        if ($product === false) $this->response(500, 'Created failed! ');

        return $this->response("Create success");
    }

    function edit($id)
    {
        $product = ProductGet::getById($id);
        if (empty($product)) abort(404);
//        $product->description_vi = '';
//        $product->description_zh = '';

//        if (!empty($product->languages)) {
//            foreach ($product->languages as $language) {
//                if ($language->lang == 'vi') {
//                    if (!empty($language->description)) {
////                    $product->push(['description_vi' => $language->description]);
//                        $product->description_vi = $language->description;
//                    }
//                }
//
//                if ($language->lang == 'zh') {
//                    if (!empty($language->description)) {
//                        $product->description_zh = $language->description;
//                    }
//                }
//            }
//        }
        $categories = Category::orderBy('id')->get();
//        $products = Product::get();
//        $product_types = config('product.Products');
//        $packages = config('product.Packages');

        $params = \Illuminate\Support\Facades\Request::get('params', null);
        return view('pages.admin.products.create_update', compact(['product', 'categories', 'params']));
    }

    function destroy($id)
    {
        $product = ProductGet::getById($id);
        if (empty($product)) abort(404);
        DB::beginTransaction();
        ProductSet::delete($id);
        ProductCategory::where('product_id', $id)->delete();
//        ProductLanguage::where('product_id', $id)->delete();
        DB::commit();
        return $this->response('Deleted success');
    }

    function update($id, ProductRequest $request)
    {
        $product = ProductGet::getById($id);
        if (empty($product)) {
            abort(404);
        }
        $product = ProductSet::createOrUpdate($request->validated(), $id);
        if (empty($product)) abort(404);
        return redirect()->route('admin.products.list');
    }

    function create()
    {
        $categories = Category::orderBy('id')->get();
//        $products = Product::where('parent_id', 0)->get();
//        $product_types = config('product.Products');
//        $packages = config('product.Packages');

        return view('pages.admin.products.create_update', compact(['categories']));
    }
}
