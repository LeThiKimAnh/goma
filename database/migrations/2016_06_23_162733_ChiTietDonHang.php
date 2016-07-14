<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChiTietDonHang extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('chi_tiet_don_hang',function(Blueprint $table){
        $table->increments('id');
        $table->integer('donhang_id')->unsigned();
        $table->foreign('donhang_id')->references('id')->on('don_hang')->onDelete('cascade');
        $table->integer('vatdung_id')->unsigned();
        $table->foreign('vatdung_id')->references('id')->on('vat_dung')->onDelete('cascade');
        $table->double('don_gia');
        $table->integer('so_luong');
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
        Schema::drop('chi_tiet_don_hang');
    }
}
