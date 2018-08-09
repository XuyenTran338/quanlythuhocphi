<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\HinhThucModel;
class PaymentEditRequest extends FormRequest
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
            'txtHinhThuc'   => 'required|string',
            'txtSoThang'    => 'required|integer|max:30|min:1',
            'txtTyLeGiam'   => 'required|numeric|max:20|min:0',
        ];
    }

    public function messages()
    {
        return [
            'txtHinhThuc.required'  => 'Vui lòng nhập tên hình thức!',
            /*'txtHinhThuc.unique'    => 'Vui lòng nhập tên hình thức khác!',*/
            'txtSoThang.required'   => 'Vui lòng nhập số tháng!',
            'txtSoThang.max'        => 'Số tháng phải nộp tối đa là 30!',
            'txtSoThang.min'        => 'Số tháng phải nộp tối thiểu là 1!',
            'txtTyLeGiam.numeric'   => 'Vui lòng nhập tỷ lệ ưu đãi!',
            'txtTyLeGiam.max'       => 'Tỷ lệ ưu đãi tối đa là 20!',
            'txtTyLeGiam.min'       => 'Tỷ lệ ưu đãi tối thiểu là 0!',
        ];
    }
}
