<?php

namespace App\Models;

use App\Casts\Product\Images;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Ngocnm\LaravelHelpers\eloquent\BaseModel;

class Product extends Model
{
    use HasFactory, BaseModel;

    protected $table = 'products';

    protected $primaryKey = 'id';

    protected $casts = [
        'images' => Images::class,
    ];

    protected $fillable = [
        'name',
        'images',
        'description',
        'uses',
        'active',
        'parent_id',
        'order',
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
        "images" => [
            "type" => "string",
            "insert" => true,
            "query_condition" => true,
            "sort" => true
        ],
        "length" => [
            "type" => "double",
            "insert" => true,
            "query_condition" => true,
            "sort" => true
        ],
        "box_length" => [
            "type" => "double",
            "insert" => true,
            "query_condition" => true,
            "sort" => true
        ],
        "product_id" => [
            "type" => "int",
            "insert" => true,
            "query_condition" => true,
            "sort" => true
        ],
        "package_id" => [
            "type" => "int",
            "insert" => true,
            "query_condition" => true,
            "sort" => true
        ],
        "tax_pst" => [
            "type" => "double",
            "insert" => true,
            "query_condition" => true,
            "sort" => true
        ],
        "tax_gst" => [
            "type" => "double",
            "insert" => true,
            "query_condition" => true,
            "sort" => true
        ],
        "height" => [
            "type" => "double",
            "insert" => true,
            "query_condition" => true,
            "sort" => true
        ],
        "width" => [
            "type" => "double",
            "insert" => true,
            "query_condition" => true,
            "sort" => true
        ],
        "box_height" => [
            "type" => "double",
            "insert" => true,
            "query_condition" => true,
            "sort" => true
        ],
        "box_width" => [
            "type" => "double",
            "insert" => true,
            "query_condition" => true,
            "sort" => true
        ],
        "box_count" => [
            "type" => "int",
            "insert" => true,
            "query_condition" => true,
            "sort" => true
        ],
        "title" => [
            "type" => "string",
            "insert" => true,
            "query_condition" => true,
            "sort" => true
        ],
        "brand" => [
            "type" => "string",
            "insert" => true,
            "query_condition" => true,
            "sort" => true
        ],
        "flavour" => [
            "type" => "string",
            "insert" => true,
            "query_condition" => true,
            "sort" => true
        ],
        "product_shopify_id" => [
            "type" => "string",
            "insert" => true,
            "query_condition" => true,
            "sort" => true
        ],
        "variant_shopify_id" => [
            "type" => "string",
            "insert" => true,
            "query_condition" => true,
            "sort" => true
        ],
        "weight" => [
            "type" => "double",
            "insert" => true,
            "query_condition" => true,
            "sort" => true
        ],
        "price" => [
            "type" => "double",
            "insert" => true,
            "query_condition" => true,
            "sort" => true
        ],
        "price_sale" => [
            "type" => "double",
            "insert" => true,
            "query_condition" => true,
            "sort" => true
        ],
        "weight_unit" => [
            "type" => "string",
            "insert" => true,
            "query_condition" => true,
            "sort" => true
        ],
        "product_shopify_image_url" => [
            "type" => "string",
            "insert" => true,
            "query_condition" => true,
            "sort" => true
        ],
        "product_shopify_image_alt" => [
            "type" => "string",
            "insert" => true,
            "query_condition" => true,
            "sort" => true
        ],
        "sku" => [
            "type" => "string",
            "insert" => true,
            "query_condition" => true,
            "sort" => true
        ],
        "description" => [
            "type" => "string",
            "insert" => true,
            "query_condition" => true,
            "sort" => true
        ],
        "body_html" => [
            "type" => "string",
            "insert" => true,
            "query_condition" => true,
            "sort" => true
        ],
        "slug" => [
            "type" => "string",
            "insert" => true,
            "query_condition" => true,
            "required_when_create" => true,
            "sort" => true
        ],
        "is_hot" => [
            "type" => "int",
            "insert" => true,
            "query_condition" => true,
            "required_when_create" => true,
            "sort" => true
        ],
        "is_sale" => [
            "type" => "int",
            "insert" => true,
            "query_condition" => true,
            "required_when_create" => true,
            "sort" => true
        ],
        "stock" => [
            "type" => "int",
            "insert" => true,
            "query_condition" => true,
            "required_when_create" => true,
            "sort" => true
        ],
        "stock_sold" => [
            "type" => "int",
            "insert" => true,
            "query_condition" => true,
            "required_when_create" => true,
            "sort" => true
        ],
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

    const relationship_categories_fields = ['id', 'name', 'active', 'order', 'parent_id', 'slug'];

    public function categories()
    {
        return $this->hasManyThrough(
            Category::class,
            ProductCategory::class,
            'product_id',
            'id',
            'id',
            'category_id'
        );
    }
}
