<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class VatLieu extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vat_lieu',function(Blueprint $table){
        $table->increments('id');
        $table->string('ten_ma');
        $table->string('ten');
        $table->double('rong');
        $table->double('dai');
        $table->double('cao');
        $table->double('don_gia');
        $table->integer('chat_lieu');
        $table->integer('yeu_cau');
        $table->string('mo_ta');
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
        Schema::drop('vat_lieu');
    }
}
