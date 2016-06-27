<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class VatDungRequest extends Request
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
           'txt_vd'=>'required|unique:vat_lieu,ten'
        ];
    }
     public function messages(){
        return [
            'txt_vd.required' =>'Bắt buộc phải nhập tên vật dụng',
            'txt_vd.unique'=>'tên này đã tồn tại'
        ];
    }
}
