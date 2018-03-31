<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableOrderItems extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //dingdan shangpinxiangqing
        Schema::create('order_items',function(Blueprint $table){
           $table->increments('id');
            $table->integer('order_id');
            $table->integer('product_id');
            $table->char('product_num');
            $table->integer('product_num');
            $table->float('product_price');
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
    }
}
