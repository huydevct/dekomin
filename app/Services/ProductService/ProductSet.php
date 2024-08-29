<?php


namespace App\Services\ProductService;


use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\ProductLanguage;
use App\Services\ProductLanguageService\ProductLanguageSet;
use Illuminate\Support\Str;

class ProductSet
{
    static function createOrUpdate(array $data, int $id = 0)
    {
        $product = new Product();
        if ($id != 0) {
            $product = Product::find($id);
            if (empty($product)) return false;
        }
        $product->name = $data['name'] ?? '';
//        $product->flavour = $data['flavour'] ?? '';
        $product->brand = $data['brand'] ?? '';
        $product->description = $data['description'] ?? '';
        $product->note = $data['note'] ?? '';
        $product->uses = $data['uses'] ?? '';
//        $product->weight_unit = $data['weight_unit'] ?? '';
//        $product->price = $data['price'] ?? 0;
        $product->subject_of_use = $data['subject_of_use'] ?? 0;
//        $product->stock = $data['stock'] ?? 0;
//        $product->stock_sold = $data['stock_sold'] ?? 0;
//        $product->parent_id = $data['parent_id'] ?? 0;
//        $product->weight = $data['weight'] ?? 0;
//        $product->length = $data['length'] ?? 0;
//        $product->height = $data['height'] ?? 0;
//        $product->width = $data['width'] ?? 0;
//        $product->box_length = $data['box_length'] ?? 0;
//        $product->box_height = $data['box_height'] ?? 0;
//        $product->box_width = $data['box_width'] ?? 0;
//        $product->box_count = $data['box_count'] ?? 0;
//        $product->tax_pst = $data['tax_pst'] ?? 0;
//        $product->tax_gst = $data['tax_gst'] ?? 0;
        $product->rate = $data['rate'] ?? 0;
//        $product->product_id = $data['product_id'] ?? 0;
        $product->active = $data['active'] ?? 0;
        $product->is_recommend = $data['is_recommend'] ?? 0;
//        $product->is_hot = $data['is_hot'] ?? 0;
        $product->order = $data['order'] ?? 0;
        $product->sku = $data['sku'] ?? '';
        $product->images = $data['images'] ?? '';
        $product->slug = Str::slug($data['name']) ?? '';
//        $product->product_shopify_id = $data['product_shopify_id'] ?? '';
//        $product->product_shopify_image_url = $data['product_shopify_image_url'] ?? '';
//        $product->product_shopify_image_alt = $data['product_shopify_image_alt'] ?? '';
        $product->save();

//        if (!empty($data['active']) && $id != 0) {
//            Product::where('parent_id', $id)->update([
//                'active' => $data['active']
//            ]);
//        }

//        if (!empty($data['title_vi']) || !empty($data['description_vi'])) {
//            $lang_db = ProductLanguage::where('product_id', $product->id)
//                ->where('lang', 'vi')
//                ->first();
//            if (empty($lang_db)) {
//                $lang_db = new ProductLanguage();
//            }
//            $lang_db->product_id = $product->id;
//            if (!empty($data['title_vi'])){
//                $lang_db->title = $data['title_vi'];
//            }else{
//                $lang_db->title = '';
//            }
//            if (!empty($data['description_vi'])){
//                $lang_db->description = $data['description_vi'];
//            }else{
//                $lang_db->description = '';
//            }
//            $lang_db->lang = 'vi';
//            $lang_db->save();
//        }
//
//        if (!empty($data['title_zh']) || !empty($data['description_zh'])) {
//            $lang_db = ProductLanguage::where('product_id', $product->id)
//                ->where('lang', 'zh')
//                ->first();
//            if (empty($lang_db)) {
//                $lang_db = new ProductLanguage();
//            }
//            $lang_db->product_id = $product->id;
//            if (!empty($data['title_zh'])){
//                $lang_db->title = $data['title_zh'];
//            }else{
//                $lang_db->title = '';
//            }
//            if (!empty($data['description_zh'])){
//                $lang_db->description = $data['description_zh'];
//            }else{
//                $lang_db->description = '';
//            }
//            $lang_db->lang = 'zh';
//            $lang_db->save();
//        }

        $category_ids = isset($data['categories']) ? $data['categories'] : [];
        self::updateCategoryProduct($product->id, $category_ids);

        return $product;
    }

    static function updateCategoryProduct(int $product_id, array $category_id)
    {
        ProductCategory::where('product_id', $product_id)->delete();
        ProductCategory::insert(array_map(function ($category_id) use ($product_id) {
            return [
                'product_id' => $product_id,
                'category_id' => $category_id
            ];
        }, $category_id));
    }

    static function delete(int $id)
    {
        return Product::where('id', $id)->delete();
    }

//    static function createOrUpdate(array $data, int $id = 0): Product
//    {
//        $product = new Product();
//        if ($id != 0) {
//            $product = Product::find($id);
//        }
//        $product->active = 0;
//        foreach ($data as $key => $value) {
//            if ($key == 'active') {
//                $product->active = $data['active'] == 'on' ? 1 : 0;
//                continue;
//            }
//            $product->{$key} = $value;
//        }
//        if (isset($data['name'])) $product->name_md5 = md5(Str::slug($data['name']));
//        if (isset($data['name'])) $product->slug = Str::slug($data['name']);
//        $product->save();
//        return $product;
//    }
}
