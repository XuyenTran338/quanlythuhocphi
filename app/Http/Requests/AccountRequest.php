<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AccountRequest extends FormRequest
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
            'txtUser'   => 'required|unique:tbl_taikhoan,ten_tai_khoan',
            'txtEmail'  => 'required|string|email|max:255|unique:tbl_taikhoan,email',
            'txtPass'   => 'required|string|min:8',
            'txtRe_Pass'=> 'required|string|same:txtPass',
            'txtLevel'  => 'required|not_in:0',
            'txtTen'    => 'required',
            'txtSDT'    => 'required|max:13|min:11|unique:tbl_taikhoan,SDT',
            'txtFile'   => 'required',
        ];
    }

    public function messages()
    {
        return [
            'txtUser.required'  => 'Vui lòng nhập tên tài khoản',
            'txtUser.unique'    => 'Tên tài khoản đã tồn tại! Thử lại!',
            'txtEmail.required' => 'Vui lòng nhập email',
            'txtEmail.unique'   => 'Email không khả dụng hoặc đã tồn tại!',
            'txtEmail.email'    => 'Email không đúng định dạng',
            'txtPass.required'  => 'Vui lòng nhập mật khẩu',
            'txtPass.min'       => 'Vui lòng nhập mật khẩu trên 8 ký tự',
            'txtRe_Pass.same'   => 'Mật khẩu không khớp',
            'txtRe_Pass.required' => 'Vui lòng xác nhận mật khẩu',
            'txtLevel.required' => 'Vui lòng chọn phân quyền',
            'txtTen.required'   => 'Vui lòng nhập họ tên',
            'txtSDT.required'   => 'Vui lòng nhập số điệnt thoại',
            'txtSDT.max'        => 'Số điện thoại tối đa 13 số',
            'txtSDT.min'        => 'Số điện thoại tối thiểu 11 số',
            'txtSDT.unique'     => 'Số điện thoại đã tồn tại',
            'txtFile.required'  => 'Vui lòng chọn ảnh',
        ];
    }
}
