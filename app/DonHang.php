<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DonHang extends Model
{
   protected $table ='don_hang';

   protected $fillable =['khach_hang','nguoi_tao_don','mo_ta','trang_thai','ma_don_hang','tong_gia'];
   
   public function chi_tiet_don_hang(){
   		return $this->hasMany('App\ChiTietDonHang');
   }
}
