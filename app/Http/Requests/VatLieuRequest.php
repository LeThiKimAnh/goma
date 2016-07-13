<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class VatLieuRequest extends Request
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
            'txt_ten'=>'required|unique:vat_lieu,ten',
            'txt_chieu_rong'=>'required|numeric',
            'txt_chieu_dai'=>'required|numeric',
            'sl_chat_lieu'=>'required',
            'sl_yeu_cau'=>'required'
        ];

    }
     public function messages(){
        return [
            'txt_ten.required' =>'Bắt buộc phải nhập tên nguyên liệu',
            'txt_ten.unique'=>'tên này đã tồn tại',
            'txt_chieu_rong.required' =>'Chưa điền chiều rộng',
            'txt_chieu_rong.numeric' =>'chiều rộng không phải là số',
            'txt_chieu_dai.required'=>'Chưa điền chiều dài',
            'txt_chieu_dai.numeric' =>'chiều dài không phải là số',
            'txt_chieu_cao.required'=>'Chưa điền chiều cao',
            'sl_chat_lieu.required'=>'Chưa chọn chất liệu',
            'sl_yeu_cau.required'=>'Chưa chọn yêu cầu'
        ];
    }
}
