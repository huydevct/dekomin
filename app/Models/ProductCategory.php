<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Ngocnm\LaravelHelpers\eloquent\BaseModel;

class ProductCategory extends Model
{
    use HasFactory, BaseModel;

    protected $table = 'product_category';

    public $timestamps = false;
    protected $fillable = [
        'product_id',
        'category_id'
    ];
}
