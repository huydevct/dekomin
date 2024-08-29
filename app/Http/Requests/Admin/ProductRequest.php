<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'categories' => ['array', 'nullable'],
            'order' => ['integer', 'nullable'],
            'active' => ['integer', 'nullable', Rule::in([1, 0])],
            'title' => ['string', 'nullable'],
            'title_vi' => ['string', 'nullable'],
            'title_zh' => ['string', 'nullable'],
            'flavour' => ['string', 'nullable'],
            'brand' => ['string', 'nullable'],
            'description' => ['string', 'nullable'],
            'description_zh' => ['string', 'nullable'],
            'description_vi' => ['string', 'nullable'],
            'images' => ['array', 'nullable'],
//            'videos' => ['array', 'nullable'],
            'is_hot' => ['integer', 'nullable', Rule::in([1, 0])],
            'stock' => ['integer', 'nullable'],
            'stock_sold' => ['integer', 'nullable'],
//            'rating' => ['numeric', 'nullable'],
            'price' => ['numeric', 'nullable'],
            'width' => ['numeric', 'nullable'],
            'height' => ['numeric', 'nullable'],
            'length' => ['numeric', 'nullable'],
            'box_width' => ['numeric', 'nullable'],
            'box_height' => ['numeric', 'nullable'],
            'box_length' => ['numeric', 'nullable'],
            'box_count' => ['int', 'nullable'],
            'tax_gst' => ['numeric', 'nullable'],
            'tax_pst' => ['numeric', 'nullable'],
            'product_id' => ['integer', 'nullable', function($attr, $value, $fail){
                return true;
            }],
            'package_id' => ['integer', 'nullable'],
            'price_sale' => ['numeric', 'nullable'],
//            'sale_price' => ['numeric', 'nullable'],
//            'info' => ['array', 'nullable'],
            'sku' => ['string', 'nullable'],
            'weight_unit' => ['string', 'nullable'],
            'weight' => ['numeric', 'nullable'],
            'parent_id' => ['integer', 'nullable'],
            'is_sale' => ['integer', 'nullable', Rule::in([1, 0])],
        ];
    }
}
