<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\User;

class UpdateUserAdRequest extends FormRequest
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
        if ($this->password == null) {
            return [
            'name'=> 'required|min:3',
            'gender'=> 'required',
            'birthday'=> 'required',
            'email'=> 'required|unique:users,email,'.$this->id,
            'phone'=> 'required',
            'street'=> 'required',
            'province_id'=> 'required',
            'district_id'=> 'required',
            'ward_id'=> 'required'
        ];
        } else{
            return [
                'name'=> 'required|min:3',
                'gender'=> 'required',
                'birthday'=> 'required',
                'email'=> 'required|unique:users,email,'.$this->id,
                'password'=> 'required|min:8',
                'phone'=> 'required',
                'street'=> 'required',
                'province_id'=> 'required',
                'district_id'=> 'required',
                'ward_id'=> 'required'
            ];
        }
    }
    public function messages()
    {
        return [
            'name.required'=> 'Không được bỏ trống họ tên',
            'name.min'=> 'Họ tên không được ngắn hơn 3 ký tự',
            'gender.required'=> 'Không được bỏ trống giới tính',
            'birthday.required'=> 'Không được bỏ trống ngày sinh',
            'email.required'=> 'Không được bỏ trống email',
            'email.unique'=> 'Email này đã được đăng ký',
            'password.required'=> 'Không được bỏ trống password',
            'password.min'=> 'Không được không được ngắn hơn 8 ký tự',
            'phone.required'=> 'Không được bỏ trống số điện thoại',
            'street.required'=> 'Không được bỏ trống tên đường',
            'province_id.required'=> 'Không được bỏ trống tỉnh',
            'district_id.required'=> 'Không được bỏ trống huyện',
            'ward_id.required'=> 'Không được bỏ trống xã'
        ];
    }
}
