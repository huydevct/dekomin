<?php


namespace App\Services\CategoryService;


use App\Models\Category;
use Illuminate\Support\Facades\Request;

class CategoryGet
{
    static function getCategoryByApi()
    {
        $category = Category::baseQueryBuilder(Category::class);
        $categories = $category->orderBy('id', 'asc')->where('active', 1);
        if (Request::has('app') && !empty(Request::input('app'))) {
            $app = array_map(function ($app_id) {
                $app_id = (int)$app_id;
                if (empty($app_id)) return null;
                return $app_id;
            }, explode(",", trim(Request::input('app'))));
            $app = array_filter($app);
            if (!empty($app)) {
                $categories->join('category_app', 'category_app.category_id', '=', 'categories.id')
                    ->whereIn('category_app.app_id', $app);
            }
        }
        return $categories->simplePaginate(30);
    }

    static function getAll()
    {
        return Category::orderBy('id', 'asc')->with('apps')->get();
    }

    static function getCategoryByAdmin()
    {
        $category = new Category();
        $categories = Category::baseQueryBuilder($category);
        $active = Request::get('active', null);
        if ($active != null) {
            $categories->where('active', $active);
        }
        if (Request::has('app_id')){
            $app_id = Request::input('app_id');
            if ($app_id != null){
                $categories->join('category_app','categories.id', '=', 'category_app.category_id')
                    ->where('category_app.app_id', $app_id);
            }
        }
        $order_sort = Request::get('order_sort', null);
        if (!empty($order_sort)) {
            if ($order_sort !== 'asc' && $order_sort !== 'desc') {
                $categories->orderBy('id', 'asc');
            } else {
                $categories->orderBy('order', $order_sort);
            }
        }
        return $categories->simplePaginate(30);
    }

    static function getCategoryWithIdByAdmin($id)
    {
        return Category::where('id', $id)->first();
    }
}
