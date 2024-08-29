<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\CreateCategoryRequest;
use App\Http\Requests\Admin\UpdateCategoryRequest;
use App\Models\App;
use App\Models\Category;
use App\Services\CategoryService\CategoryGet;
use App\Services\CategoryService\CategorySet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CategoryController extends Controller
{
    function index(Request $request)
    {
        $categories = CategoryGet::getCategoryByAdmin();
        $categories->appends($request->all());

        return view('pages.admin.categories.list', compact(['categories']));
    }

    function create()
    {
        $categories = Category::orderBy('id', 'asc')->get();
        return view('pages.admin.categories.create_update', compact(['categories']));
    }

    function store(CreateCategoryRequest $request)
    {
        $data = $request->validated();
        if (isset($data['active']) && $data['active'] == "on") {
            $data['active'] = 1;
        }

        CategorySet::create($data);

        return redirect()->route('admin.categories.get');
    }

    function edit($id)
    {
        $category = CategoryGet::getCategoryWithIdByAdmin($id);
        if (empty($category)) {
            abort(404);
        }
        $page = (int)\Illuminate\Support\Facades\Request::get('page', null);

        return view('pages.admin.categories.create_update', compact(['category', 'page']));
    }

    function update($id, UpdateCategoryRequest $request)
    {
        $data = $request->validated();
        $category = Category::where('id', $id)->first();
        if (empty($category)) {
            abort(404);
        }

//        $app_ids = isset($data['apps']) ? $data['apps'] : [];
//        CategorySet::updateAppCategory($category->id, $app_ids);

        if (isset($data['active']) && $data['active'] == "on") {
            $data['active'] = 1;
        } else {
            $data['active'] = 0;
        }

        $category->update($data);
        $page = (int)\Illuminate\Support\Facades\Request::get('page', null);

        return redirect()->route('admin.categories.get', ['page' => $page]);
    }

    function delete($id)
    {
        $category = Category::where('id', $id)->first();
        if (empty($category)) {
            abort(404);
        }

        DB::beginTransaction();
        Category::where('id', $id)->delete();
        DB::commit();
        return response()->json("Deleted success");
    }

    function block($id)
    {
        $category = Category::where('id', $id)->first();
        if (empty($category)) {
            return $this->response("Not found data!", 404);
        }
        CategorySet::block($id);
        return response()->json("Blocked success");
    }

    function unblock($id)
    {
        $category = Category::where('id', $id)->first();
        if (empty($category)) {
            return $this->response("Not found data!", 404);
        }
        CategorySet::unblock($id);
        return response()->json("Unblocked success");
    }
}
