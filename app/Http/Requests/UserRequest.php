<?php

namespace App\Http\Requests;

use App\Rules\AgeRule;
use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
        // return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'username'  => 'required|string|alpha_dash|max:25|unique:users',
            'email'     => 'required|string|email|max:100|unique:users',
            'avatar'    => 'image|max:2048',
            'full_name' => 'nullable|string|max:100',
            'age'       => [new AgeRule, 'nullable'], //['required', 'string', new Uppercase],
        ];
    }
    public function messages()
    {
        return [
            'username.required'   => 'username không được bỏ trống',
            'username.string'     => 'username phải là chuỗi ký tự',
            'username.alpha_dash' => 'username chỉ dùng ký tự chữ, số và dấu gạch dưới',
            'username.max'        => 'username không được dài quá 25 ký tự',
            'username.unique'     => 'Username đã tồn tại',
            'email.required'      => 'email không được bỏ trống',
            'email.email'         => 'email không đúng định dạng',
            'email.max'           => 'email quá dài',
            'email.unique'        => 'email đã được sử dụng',
            'avatar.image'        => 'avatar phải là kiểu ảnh',
            'avatar.max'          => 'ảnh tải lên quá lớn',
            'full_name.max'       => 'Tên quá dài ',
        ];
    }
}
