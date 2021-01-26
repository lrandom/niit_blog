<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRegisterRequest extends FormRequest
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
            'address' => 'required',
            'email' => 'required|email',
            'bio' => 'required',
            'gender' => 'required|numeric|in:1,2',
            'password' => 'required|min:8',
            'repassword' => 'required|same:password',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Tên không được để trống',
            'address.required' => 'Địa chỉ không được để trống',
            'email.*' => 'Email không hợp lệ',
            'bio.required' => 'Giới thiệu bản thân không được để trống',
            'gender.required' => 'Giới tính không được để trống',
            'gender.in' => 'Giới tính không hợp lệ',
            'gender.numeric' => 'Giới tính không hợp lệ',
            'password.required' => 'Mật khẩu không được để trống',
            'password.min' => 'Mật khẩu tối thiểu 8 ký tự',
            'repassword.required' => 'Nhập lại mật khẩu không được để trống',
        ];
    }
}
