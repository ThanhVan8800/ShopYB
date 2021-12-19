<?php

namespace App\Http\Requests\Product;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true; #quên sửa thành true
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            //
            'name' => 'required',
            'thumb' => 'required'
        ];
    }
    public function message():array
    {
        return[
            'name.required' => 'Vui lòng nhập tên sản phẩm',
            'thumb.required' => 'Không để trống',
        ];
    }
}
