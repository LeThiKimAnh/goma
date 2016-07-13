<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class VatDung extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vat_dung',function(Blueprint $table){
        $table->increments('id');
        $table->string('ma_vat_dung');
        $table->string('ten');
        $table->string('mo_ta');
        $table->double('gia_san_xuat');
        $table->double('he_so');
        $table->double('gia_san_pham');
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
        Schema::drop('vat_dung');
    }
}
