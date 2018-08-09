<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
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
            'txtEmail' => 'required|email|max:255',
            'txtPass' => 'required|min:8',
        ];
    }

    public function messages()
    {
        return [
            'txtEmail.required' => 'Vui lòng nhập email',
            'txtEmail.email' => 'Email không đúng định dạng',
            'txtPass.required' => 'Vui lòng nhập mật khẩu',
            'txtPass.min' => 'Vui lòng nhập mật khẩu trên 8 ký tự',
        ];
    }
}
