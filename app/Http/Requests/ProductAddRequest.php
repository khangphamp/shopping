<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductAddRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required',
            'price'=>'required',
            'category_id'=>'required',
            'content'=>'required',
            'fimage_path'=>'required',
            'feature_image_path'=>'required',
            'tags'=>'required',
        ];
    }
    public function messages()
{
    return [
        'name.required' => 'Tên không được phép để trống',
        'price.required' => 'Giá không được phép để trống ',
        'content.required' => 'Nội dung không được phép để trống ',
        'category_id.required' => 'Danh mục không được phép để trống ',
        'fimage_path.required' => 'Ảnh chỉnh không được phép để trống ',
        'feature_image_path.required' => 'Ảnh phụ không được phép để trống ',
        'tags.required' => 'Tag phụ không được phép để trống ',
    ];
}
}
