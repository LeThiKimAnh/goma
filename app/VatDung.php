<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class VatDung extends Model
{
   protected $table ='vat_dung';

   protected $fillable =['ten','ma_vat_dung','mo_ta','gia_san_xuat','he_so','gia_san_pham'];

   public function chi_tiet_vat_dung(){
   		return $this->hasMany('App\ChiTietVatDung');
   }
}
