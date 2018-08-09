<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ObjectRequest extends FormRequest
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
            'txtTenHB'   => 'required|string|unique:tbl_hocbong,ten_hoc_bong',
            'txtTyLeHB'  => 'required|integer|max:100|min:0',
        ];
    }

    public function messages()
    {
        return [
            'txtTenHB.required'  => 'Vui lòng nhập tên học bổng!',
            'txtTenHB.unique'    => 'Tên học bổng đã tồn tại! Thử lại!',
            'txtTyLeHB.required' => 'Vui lòng nhập tỷ lệ học bổng!',
            'txtTyLeHB.max'      => 'Tỷ lệ tối đa là 100%',
            'txtTyLeHB.min'      => 'Tỷ lệ tối thiểu là 0%',
        ];
    }
}
