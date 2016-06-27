<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class DonHang extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('don_hang',function(Blueprint $table){
        $table->increments('id');
        $table->string('ma_don_hang');
        $table->string('khach_hang');
        $table->string('nguoi_tao_don');
        $table->string('mo_ta');
        $table->integer('trang_thai');
        $table->timestamps();
       });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('don_hang');
    }
}
