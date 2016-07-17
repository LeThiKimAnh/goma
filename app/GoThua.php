<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GoThua extends Model
{
   protected $table ='go_thua';

   protected $fillable =['ten','dai','rong','cao','chat_lieu','yeu_cau'];
}
