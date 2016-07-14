<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ChiTietDonHang extends Model
{
   protected $table ='chi_tiet_don_hang';

   protected $fillable =['donhang_id','vatdung_id','so_luong','don_gia'];
}
