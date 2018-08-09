<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ObjectEditRequest extends FormRequest
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
            'txtTenHB'   => 'required|string',
            'txtTyLeHB'  => 'required|integer|max:100|min:0',
        ];
    }

    public function messages()
    {
        return [
            'txtTenHB.required'  => 'Vui lòng nhập tên học bổng!',
            'txtTyLeHB.required' => 'Vui lòng nhập tỷ lệ học bổng!',
            'txtTyLeHB.max'      => 'Tỷ lệ tối đa là 100%',
            'txtTyLeHB.min'      => 'Tỷ lệ tối thiểu là 10%',
        ];
    }
}
