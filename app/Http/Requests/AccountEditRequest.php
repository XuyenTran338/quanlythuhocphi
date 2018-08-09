<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AccountEditRequest extends FormRequest
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
            'txtUser'   => 'required',
            'txtEmail'  => 'required|string|email|max:255',
            'txtLevel'  => 'required|not_in:0',
            'txtTen'    => 'required',
            'txtSDT'    => 'required|max:13|min:11',
        ];
    }

    public function messages()
    {
        return [
            'txtUser.required'  => 'Vui lòng nhập tên tài khoản',
            // 'txtUser.unique'    => 'Tên tài khoản đã trùng! Vui lòng nhập lại',
            'txtEmail.required' => 'Vui lòng nhập email',
            'txtEmail.email'    => 'Email không đúng định dạng',
            /*'txtEmail.unique'   => 'Tài khoản email đã có! Vui lòng nhập lại',*/
            'txtLevel.required' => 'Vui lòng chọn phân quyền',
            'txtTen.required'   => 'Vui lòng nhập họ tên',
            'txtSDT.required'   => 'Vui lòng nhập số điệnt thoại',
            'txtSDT.max'        => 'Số điện thoại tối đa 13 số',
            'txtSDT.min'        => 'Số điện thoại tối thiểu 11 số',
            /*'txtSDT.unique'     => 'Số điện thoại đã tồn tại'*/
        ];
    }
}
