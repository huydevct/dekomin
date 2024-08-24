<?php

namespace App\Models;

use App\Casts\Product\Images;
//use App\Casts\Product\Json;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Ngocnm\LaravelHelpers\eloquent\BaseModel;

class Category extends Model
{


    use HasFactory, BaseModel;

    protected $table = 'categories';

    protected $primaryKey = 'id';

    protected $casts = [
//        'product_shopify_image_url' => Json::class,
//        'product_shopify_image_alt' => Json::class,
//        'images' => Images::class,
    ];

    protected $fillable = [
        'name',
        'name_md5',
        'category_shopify_id',
        'description',
        'body_html',
        'product_count',
        'active',
//        'stock_sold',
//        'price',
        'parent_id',
//        'product_shopify_id',
//        'variant_shopify_id',
        'category_shopify_image_url',
        'category_shopify_image_alt',
//        'stock',
        'slug',
        'order',
//        'is_hot',
//        'is_sale',
        'created_at',
        'updated_at'
    ];

    static $schema = [
        "id" => [
            "type" => "int",
            "insert" => false,
            "query_condition" => true,
            "sort" => true
        ],
        "name" => [
            "type" => "string",
            "insert" => true,
            "query_condition" => true,
            "sort" => true
        ],
        "name_md5" => [
            "type" => "string",
            "insert" => true,
            "query_condition" => true,
            "sort" => true
        ],
        "slug_md5" => [
            "type" => "string",
            "insert" => true,
            "query_condition" => true,
            "sort" => true
        ],
        "images" => [
            "type" => "string",
            "insert" => true,
            "query_condition" => true,
            "sort" => true
        ],
//        "weight" => [
//            "type" => "double",
//            "insert" => true,
//            "query_condition" => true,
//            "sort" => true
//        ],
        "product_count" => [
            "type" => "int",
            "insert" => true,
            "query_condition" => true,
            "sort" => true
        ],
//        "price" => [
//            "type" => "double",
//            "insert" => true,
//            "query_condition" => true,
//            "sort" => true
//        ],
//        "weight_unit" => [
//            "type" => "string",
//            "insert" => true,
//            "query_condition" => true,
//            "sort" => true
//        ],
        "category_shopify_image_url" => [
            "type" => "string",
            "insert" => true,
            "query_condition" => true,
            "sort" => true
        ],
        "category_shopify_image_alt" => [
            "type" => "string",
            "insert" => true,
            "query_condition" => true,
            "sort" => true
        ],
//        "sku" => [
//            "type" => "string",
//            "insert" => true,
//            "query_condition" => true,
//            "sort" => true
//        ],
//        "description" => [
//            "type" => "string",
//            "insert" => true,
//            "query_condition" => true,
//            "sort" => true
//        ],
        "body_html" => [
            "type" => "string",
            "insert" => true,
            "query_condition" => true,
            "sort" => true
        ],
        "slug" => [
            "type" => "string",
            "insert" => true,
            "query_condition" => false,
            "required_when_create" => false,
            "sort" => true
        ],
//        "is_hot" => [
//            "type" => "int",
//            "insert" => true,
//            "query_condition" => true,
//            "required_when_create" => true,
//            "sort" => true
//        ],
//        "stock" => [
//            "type" => "int",
//            "insert" => true,
//            "query_condition" => true,
//            "required_when_create" => true,
//            "sort" => true
//        ],
//        "stock_sold" => [
//            "type" => "int",
//            "insert" => true,
//            "query_condition" => true,
//            "required_when_create" => true,
//            "sort" => true
//        ],
        "parent_id" => [
            "type" => "int",
            "insert" => true,
            "query_condition" => true,
            "required_when_create" => true,
            "sort" => true
        ],
        "active" => [
            "type" => "int",
            "insert" => true,
            "query_condition" => true
        ],
        "order" => [
            "type" => "int",
            "insert" => true,
            "query_condition" => true,
            "sort" => true
        ],
        "updated_at" => [
            "type" => "string",
            "insert" => false,
            "query_condition" => false,
            "required_when_create" => false,
            "sort" => true
        ],
        "created_at" => [
            "type" => "string",
            "insert" => false,
            "query_condition" => true,
            "required_when_create" => false,
            "sort" => true
        ]
    ];


    const relationship_products_fields = ['id', 'title', 'active', 'order', 'parent_id', 'slug', 'images',
        'sku', 'weight', 'weight_unit', 'stock', 'stock_sold', 'is_hot', 'is_sale'];

    public function products()
    {
        return $this->hasManyThrough(
            Product::class,
            ProductCategory::class,
            'category_id',
            'id',
            'id',
            'product_id'
        );
    }

    const relationship_category_fields = ['id', 'name', 'parent_id', 'active', 'order'];

    public function category()
    {
        return $this->hasMany(Category::class, 'parent_id', 'id');
    }
}
