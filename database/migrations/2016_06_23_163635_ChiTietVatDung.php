<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChiTietVatDung extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('chi_tiet_vat_dung',function(Blueprint $table){
        $table->increments('id');
        $table->integer('vatdung_id')->unsigned();
        $table->foreign('vatdung_id')->references('id')->on('vat_dung')->onDelete('cascade');
        $table->integer('vatlieu_id')->unsigned();
        $table->foreign('vatlieu_id')->references('id')->on('vat_lieu')->onDelete('cascade');
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
         Schema::drop('chi_tiet_vat_dung');
    }
}
