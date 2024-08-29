<?php

namespace App\Http\Requests\Admin;

use App\Models\App;
use Illuminate\Foundation\Http\FormRequest;

class CreateCategoryRequest extends FormRequest
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
            'order' => 'integer|min:0',
//            'apps' => ['array', 'nullable', function($attr, $value, $fail){
//                foreach ($value as $id){
//                    $app = App::where('id', $id)->first();
//                    if (empty($app)){
//                        $fail('App id: '.$id.' not found!');
//                    }
//                }
//                return true;
//            }],
            'active' => ['string', function ($attr, $value, $fail) {
                if ($value !== "on") {
                    return $fail("Active must be on");
                }
                return true;
            }],
            'name' => ['required', 'string']
        ];
    }
}
