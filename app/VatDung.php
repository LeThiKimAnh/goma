<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class VatDung extends Model
{
   protected $table ='vat_dung';

   protected $fillable =['ten','ma_vat_dung','mo_ta'];

   public function chi_tiet_vat_dung(){
   		return $this->hasMany('App\ChiTietVatDung');
   }
   public function chi_tiet_don_hang(){
   		return $this->hasMany('App\ChiTietDonHang');
   }
}
