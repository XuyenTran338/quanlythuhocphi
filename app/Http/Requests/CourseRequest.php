<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Carbon\Carbon;
class CourseRequest extends FormRequest
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
            'txtKhoaHoc'   => 'required|string|unique:tbl_khoahoc,ten_khoa_hoc',
            'txtStart'     => 'required|date|unique:tbl_khoahoc,ngay_bat_dau',
            'txtEnd'       => 'required|unique:tbl_khoahoc,ngay_ket_thuc|date|after:txtStart'
        ];
    }

    public function messages()
    {
        return [
            'txtKhoaHoc.required'  => 'Vui lòng nhập tên khóa học!',
            'txtKhoaHoc.unique'    => 'Tên khóa học đã tồn tại! Thử lại!',
            'txtStart.required'    => 'Vui lòng chọn ngày nhập học!',
            'txtStart.date'        => 'Dữ liệu phải là kiểu dạng date',
            'txtStart.unique'      => 'Vui lòng chọn ngày nhập học khác!',
            'txtEnd.required'      => 'Vui lòng chọn ngày kết thúc!',
            'txtEnd.unique'        => 'Vui lòng chọn ngày kết thúc khác!',
            'txtEnd.after'         => 'Vui lòng chọn ngày kết thúc phải sau ngày bắt đầu!',
            'txtEnd.date'          => 'Dữ liệu phải là kiểu dạng date',
        ];
    }
}
