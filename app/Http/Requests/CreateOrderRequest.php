<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateOrderRequest extends FormRequest
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
            'fullname' => 'required|min:3',
            'email' => 'required',
            'street' => 'required',
            'province_id' => 'required',
            'district_id' => 'required',
            'ward_id' => 'required',
            'phone' => 'required'
        ];
    }
    public function messages()
    {
        return [
            'fullname.required' => 'Không được bỏ trống họ tên',
            'fullname.min' => 'Họ tên không được nhỏ hơn 3 ký tự',
            'email.required' => 'Không được bỏ trống email',
            'street.required' => 'Không được bỏ trống số nhà',
            'province_id.required' => 'Không được bỏ trống tỉnh/thành phố',
            'district_id.required' => 'Không được bỏ trống huyện/quận',
            'ward_id.required' => 'Không được bỏ trống xã/phường',
            'phone.required' => 'Không được bỏ số điện thoại'
        ];
    }
}
