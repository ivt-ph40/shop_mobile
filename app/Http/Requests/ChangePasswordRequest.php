<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ChangePasswordRequest extends FormRequest
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
            'old_password' => 'required',
            'new_password' => 'required|min:8',
            'password_confirmation' => 'required|same:new_password',
        ];
    }
    public function messages()
    {
        return [
            'old_password.required'=> 'Không được bỏ trống!',
            'new_password.required'=> 'Không được bỏ trống!',
            'new_password.min'=> 'Không nhỏ hơn 8 ký tự',
            'password_confirmation.required'=> 'Không được bỏ trống!',
            'password_confirmation.same'=> 'Không trùng khớp với mật khẩu mới tạo!',
        ];
    }
}
