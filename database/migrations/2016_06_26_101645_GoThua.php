<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class GoThua extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('go_thua',function(Blueprint $table){
        $table->increments('id');
        $table->string('ten');
        $table->integer('dai');
        $table->integer('rong');
        $table->integer('cao');
        $table->integer('chat_lieu');
        $table->integer('yeu_cau');
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
        Schema::drop('go_thua');
    }
}
