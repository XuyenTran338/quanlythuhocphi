<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StudentEditRequest extends FormRequest
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
            'txtTen'   =>  'required|string',
            'txtBirth' =>  'required',
            'txtEmail' =>  'required|email',
            'rdSex'    =>  'required',
            'txtSDT'   =>  'required|max:12|min:10',
            'txtAdd'   =>  'required',
            'sltHB'    =>  'required|not_in:0',
        ];
    }

    public function messages()
    {
        return [
            'txtTen.required'       => 'Vui lòng nhập tên sinh viên!',
            'txtBirth.required'     => 'Vui lòng nhập ngày sinh!',
            'txtEmail.required'     => 'Vui lòng nhập địa chỉ email!',
            'txtEmail.email'        => 'Vui lòng nhập đúng định dạng địa chỉ email!',
            'rdSex.required'        => 'Vui lòng chọn giới tính!',
            'txtSDT.required'       => 'Vui lòng nhập số điện thoại!',
            'txtSDT.max'            => 'Số điện thoại không khả dụng!',
            'txtSDT.min'            => 'Số điện thoại ư? Really!',
            'txtAdd.required'       => 'Vui lòng nhập địa chỉ!',
            'sltHB.required'        => 'Vui lòng chọn học bổng!',
        ];
    }
}
