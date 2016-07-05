<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Session extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('session',function(Blueprint $table){
        $table->increments('id');
        $table->integer('donhang_id')->unsigned();
        $table->foreign('donhang_id')->references('id')->on('don_hang')->onDelete('cascade');
        $table->string('nguoi_xu_ly');
        $table->integer('trang_thai');
        $table->mediumText('sketch');
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
        Schema::drop('session');    
    }
}
