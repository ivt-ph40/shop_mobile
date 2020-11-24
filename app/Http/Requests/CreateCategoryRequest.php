<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateCategoryRequest extends FormRequest
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
            'name' => 'required|min:3',
            'description' => 'required|max:255',
            'status' => 'required'
        ];
    }
    public function messages()
    {
        return [
            'name.required' => 'Tên không được bỏ trống',
            'name.min' => 'Tên không được nhỏ hơn 3 ký tự',
            'description.required' => 'Trường mô tả không được bỏ trống',
            'description.max' => 'Trường mô tả không được vượt quá 255 ký tự',
            'status.required' => 'Trường không được bỏ trống'
        ];
    }
}
