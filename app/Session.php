<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Session extends Model
{
   protected $table ='session';

   protected $fillable =['donhang_id','nguoi_xu_ly','trang_thai','rong','dai','day','size_cut','sketch','go_thua'];
}
