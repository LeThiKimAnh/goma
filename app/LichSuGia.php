<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LichSuGia extends Model
{
   protected $table ='lich_su_gia';

   protected $fillable =['vatdung_id','gia_cu','nguoi_sua','batch'];
}
