<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class DonHangRequest extends Request
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
           'txt_KH'=>'required:don_hang,khach_hang'
        ];
    }
     public function messages(){
        return [
            'txt_KH.required' =>'Bắt buộc phải nhập tên khách hàng',
        ];
    }
}
