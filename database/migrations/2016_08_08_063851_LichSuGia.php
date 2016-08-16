<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class LichSuGia extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lich_su_gia', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('vatdung_id')->unsigned();
            $table->foreign('vatdung_id')->references('id')->on('vat_dung')->onDelete('cascade');
            $table->string('gia_cu');
            $table->string('nguoi_sua');
            $table->integer('batch');
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
        Schema::drop('lich_su_gia');
    }
}
