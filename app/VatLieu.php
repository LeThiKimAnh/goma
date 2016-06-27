<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class VatLieu extends Model
{
   protected $table ='vat_lieu';

   protected $fillable =['ten','ten_ma','rong','dai','cao','mo_ta','chat_lieu','don_gia','yeu_cau'];

   public function chi_tiet_vat_dung(){
   		return $this->hasMany('App\ChiTietVatDung');
   }
}
