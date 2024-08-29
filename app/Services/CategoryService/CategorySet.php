<?php


namespace App\Services\CategoryService;


use App\Models\Category;
use App\Models\CategoryApp;
use Illuminate\Support\Str;

class CategorySet
{
    static function create(array $data): Category
    {
        $category = new Category();
        $category->name = $data['name'];
        $category->slug = Str::slug($data['name']);
        $category->order = $data['order'] ?? 0;
        $category->active = $data['active'] ?? 0;
        $category->save();

//        $app_ids = isset($data['apps']) ? $data['apps'] : [];
//        self::updateAppCategory($category->id, $app_ids);

        return $category;
    }

//    static function updateAppCategory(int $content_id, array $app_id)
//    {
//        CategoryApp::where('category_id', $content_id)->delete();
//        CategoryApp::insert(array_map(function ($app_id) use ($content_id) {
//            return [
//                'category_id' => $content_id,
//                'app_id' => $app_id
//            ];
//        }, $app_id));
//    }

    static function increase($id, $type)
    {
        $tag = Category::where('id', $id)->first();
        if (empty($tag)) {
            return false;
        }
        if ($type == 'set') {
            $tag->set_count = $tag->set_count + 1;
        }
        $tag->save();
        return true;
    }

    static function update($id, array $data)
    {
        $category = Category::where('id', $id)->first();

        Category::where('id', $id)->update($data);
//        $app_ids = isset($data['apps']) ? $data['apps'] : [];
//        self::updateAppCategory($category->id, $app_ids);
    }

    static function block($id)
    {
        return Category::where('id', $id)->update([
            'active' => 0,
        ]);
    }

    static function unblock($id)
    {
        return Category::where('id', $id)->update([
            'active' => 1,
        ]);
    }
}
