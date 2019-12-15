<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EditUserRequest extends FormRequest
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
            'username'  => 'required|string|alpha_dash|max:25',
            'email'     => 'required|string|email|max:100',
            'avatar'    => 'image|max:2048',
            'full_name' => 'nullable|string|max:100',
            'age'       => 'numeric|nullable'
        ];
    }
    public function messages()
    {
        return [
            'username.required'   => 'username không được bỏ trống',
            'username.string'     => 'username phải là chuỗi ký tự',
            'username.alpha_dash' => 'username chỉ dùng ký tự chữ, số và dấu gạch dưới',
            'username.max'        => 'username không được dài quá 25 ký tự',
            'email.required'      => 'email không được bỏ trống',
            'email.email'         => 'email không đúng định dạng',
            'email.max'           => 'email quá dài',
            'avatar.image'        => 'avatar phải là kiểu ảnh',
            'avatar.max'          => 'ảnh tải lên quá lớn',
            'full_name.max'       => 'Tên quá dài ',
            'age.numeric'         => 'Tuổi phải là số'
        ];
    }
}
