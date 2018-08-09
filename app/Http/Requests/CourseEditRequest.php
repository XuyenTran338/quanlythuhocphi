<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CourseEditRequest extends FormRequest
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
            'txtKhoaHoc'   => 'required',
            'txtStart'     => 'required',
            'txtEnd'       => 'required|date|after:txtStart'
        ];
    }

    public function messages()
    {
        return [
            'txtKhoaHoc.required'  => 'Vui lòng nhập tên khóa học!',
            'txtStart.required'    => 'Vui lòng chọn ngày nhập học!',
            'txtEnd.required'      => 'Vui lòng chọn ngày kết thúc!',
            'txtEnd.after'         => 'Vui lòng chọn ngày kết thúc phải sau ngày bắt đầu!',
        ];
    }
}
