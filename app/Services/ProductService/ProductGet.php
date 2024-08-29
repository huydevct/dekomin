<?php


namespace App\Services\ProductService;


use App\Models\Product;
use Illuminate\Support\Facades\Request;
use Ngocnm\LaravelHelpers\Helper;

class ProductGet
{
    static function getByApi()
    {
        $products = Product::baseQueryBuilder(Product::class)->with('languages');
        if (Request::has('limit')) {
            return $products->limit(Helper::BaseApiRequest()->getLimit())->get();
        }
        return $products->paginate(30);
    }

    static function getByMd5(string $productMd5, \Closure $callback = null)
    {
        $product = Product::where('name_md5', $productMd5);
        if (is_callable($callback)) {
            $product = $callback($product);
        }
        return $product->first();
    }

    static function getAll()
    {
        return Product::where('active', 1)->get();
    }

    static function getByAdmin($limit = 30)
    {
        $products = Product::select("*")->with('languages')->with('categories');
        $request = Request::all();
//        $product = new Product();
//        $products = Product::baseQueryBuilder($product);
        //Filter
        if (isset($request['order']) && ($request['order'] == 'asc' || $request['order'] == 'desc')) {
            $products->orderBy('order', $request['order']);
        }

        if (isset($request['stock_sort']) && ($request['stock_sort'] == 'asc' || $request['stock_sort'] == 'desc')) {
            $products->orderBy('stock', $request['stock_sort']);
        }

        if (isset($request['price_sort']) && ($request['price_sort'] == 'asc' || $request['price_sort'] == 'desc')) {
            $products->orderBy('price', $request['price_sort']);
        }

        if (Request::has('category_id')) {
            $category_id = Request::input('category_id');
            if ($category_id != null) {
                $products->join('product_category', 'products.id', '=', 'product_category.product_id')
                    ->where('product_category.category_id', $category_id);
            }
        }
        if (Request::has('product_id')) {
            $product_id = Request::input('product_id');
            if ($product_id != null) {
                $products->where('id', $product_id);
            }
        }
        if (Request::has('name')) {
            $name = Request::input('name');
            if ($name != null) {
                $products->where('title', 'LIKE', '%'.$name.'%');
            }
        }
        if (Request::has('active')) {
            $active = Request::input('active');
            if ($active != null) {
                $products->where('active', $active);
            }
        }
        if (Request::has('popular')) {
            $popular = Request::input('popular');
            if ($popular != null) {
                $products->where('is_hot', $popular);
            }
        }
        if (Request::has('is_sale')) {
            $is_sale = Request::input('is_sale');
            if ($is_sale != null) {
                $products->where('is_sale', $is_sale);
            }
        }
        if (Request::has('sku')) {
            $sku = Request::input('sku');
            if ($sku != null) {
                $products->where('sku', $sku);
            }
        }

        if (Request::has('brand')) {
            $brand = Request::input('brand');
            if ($brand != null) {
                $products->where('brand', $brand);
            }
        }

        if (Request::has('flavour')) {
            $flavour = Request::input('flavour');
            if ($flavour != null) {
                $products->where('flavour', $flavour);
            }
        }

        if (Request::has('parent_id')) {
            $parent_id = Request::input('parent_id');
            if ($parent_id != null) {
                $products->where('parent_id', $parent_id);
            }
        }
        if (!Request::has('parent_id') &&
            !Request::has('sku') &&
            !Request::has('product_id') &&
            !Request::has('flavour') &&
            !Request::has('stock_sort') &&
            !Request::has('popular') &&
            !Request::has('is_sale') &&
            !Request::has('price_sort') &&
            !Request::has('brand') &&
            !Request::has('category_id')) {
            $products->where('parent_id', 0)->orderBy('id', 'desc');
        }
        if ($limit == -1) {
            return $products->get();
        }
        return $products->simplePaginate($limit);
    }

    static function getById(int $id)
    {
        return Product::with('categories')->with('languages')->find($id);
    }
}
