<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateProductRequest extends FormRequest
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
            'category_id' => 'required',
            'brand_id' => 'required',
            'description' => 'required',
            'content' => 'required',
            'quantity' => 'required|numeric',
            'image' => 'required',
            'price' => 'required|numeric',
            'discount' => 'numeric',
            'status' => 'required'
        ];
    }
    public function messages()
    {
        return [
            'name.required'=> 'Không được bỏ trống tên',
            'name.min'=> 'Tên không được nhỏ hơn 3 ký tự',
            'category_id.required'=> 'Không được bỏ trống loại sản phẩm',
            'brand_id.required'=> 'Không được bỏ trống thương hiệu sản phẩm',
            'description.required'=> 'Không được bỏ trống mô tả sản phẩm',
            'content.required'=> 'Không được bỏ trống nội dung sản phẩm',
            'quantity.required'=> 'Không được bỏ trống số lượng sản phẩm',
            'quantity.numeric'=> 'Số lượng phải là dạng số',
            'image.required'=> 'Không được bỏ trống hình ảnh sản phẩm',
            'price.required'=> 'Không được bỏ trống giá sản phẩm',
            'price.numeric'=> 'Giá phải là dạng số',
            'discount.numeric'=> 'Tỷ lệ giảm giá phải là dạng số',
            'status.required'=> 'Không được bỏ trống trạng thái sản phẩm',
        ];
    }
}
