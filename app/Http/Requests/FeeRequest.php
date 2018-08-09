<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FeeRequest extends FormRequest
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
            'txtMucThu'     => 'required|integer|max:90000000|min:2500000',
            'txtNganh'      => 'required|not_in:0',
            'txtHinhThuc'   => 'required|not_in:0',
        ];
    }

    public function messages()
    {
        return [
            'txtMucThu.required'    => 'Vui lòng nhập mức thu qui định!',
            'txtMucThu.integer'     => 'Vui lòng chỉ nhập số!',
            'txtMucThu.max'         => 'Số tháng phải nộp tối đa là 90000000!',
            'txtMucThu.min'         => 'Số tháng phải nộp tối thiểu là 2500000!',
            'txtNganh.required'     => 'Vui lòng chọn tên ngành!',
            'txtHinhThuc.required'  => 'Vui lòng chọn hình thức nộp!',
        ];
    }
}
