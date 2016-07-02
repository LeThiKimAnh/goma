<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class VatDung extends Model
{
   protected $table ='vat_dung';

   protected $fillable =['ten','ma_vat_dung','mo_ta','don_gia'];

   public function chi_tiet_vat_dung(){
   		return $this->hasMany('App\ChiTietVatDung');
   }
}
