<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableOrders extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //dingdanbiao
        Schema::create('orders',function(Blueprint $table){
            $table->increments('id');
            $table->integer('user_id');
            $table->float('total');
            $table->char('address_id');
            $table->char('express');
            $table->char('status');
            $table->char('note');
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
        //
        Schema::drop('orders');
    }
}
