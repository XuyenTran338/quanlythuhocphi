<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MajorsRequest extends FormRequest
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
            'txtTenNganh'   => 'required|string|unique:tbl_nganh,ten_nganh',
            'txtHe'         => 'required|string',
        ];
    }

    public function messages()
    {
        return [
            'txtTenNganh.required'  => 'Vui lòng nhập tên ngành học!',
            'txtTenNganh.unique'    => 'Tên ngành học đã tồn tại! Thử lại!',
            'txtHe.required'        => 'Vui lòng nhập Hệ đào tạo!'
        ];
    }
}
