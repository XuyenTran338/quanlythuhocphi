<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ClassRequest extends FormRequest
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
            'txtLop'        => 'required|unique:tbl_lop,ten_lop',
            'txtSiSo'       => 'required|integer|min:20',
            'txtGVCN'       => 'required|not_in:0',
            'txtNganhHoc'   => 'required|not_in:0',
            'txtKhoa'       => 'required|not_in:0'
       ];
    }

    public function messages()
    {
        return [
            'txtLop.required'   => 'Vui lòng nhập tên lớp!',
            'txtLop.unique'     => 'Tên lớp đã tồn tại! Thử lại!',
            'txtSiSo.integer'   => 'Vui lòng chỉ nhập số!',
            'txtSiSo.required'  => 'Vui lòng nhập sĩ số!',
            'txtSiSo.min'       => 'Vui lòng nhập sĩ số tối thiểu 20 sinh viên',
            'txtGVCN.required'  => 'Vui lòng chọn giáo viên chủ nhiệm',
            'txtNganhHoc.required'  => 'Vui lòng chọn ngành học',
            'txtKhoa.required'  => 'Vui lòng chọn khóa học',
        ];
    }
}
