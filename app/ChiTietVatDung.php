<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ChiTietVatDung extends Model
{
   protected $table ='chi_tiet_vat_dung';

   protected $fillable =['vatdung_id','vatlieu_id','so_luong'];
}
