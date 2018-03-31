<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableProductEvaluations extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('product_evaluations',function(Blueprint $table){

            $table->increments('id');
            $table->integer('product_id');
            $table->integer('user_id');
            $table->longText('text');
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


//Array (
//[code] => 041sc6hg2JH8yE0dHXdg2GqMgg2sc6hl
//[token] => Array (
//    [access_token] => Hf5nopaCtZGBbgzdL9hWaKJ2ZKbiNm6Jl7_tHwhDueoen59op__igQWvuowX8uZMKPjrwPLpVzdZY6uxyzFZUbOH6ek-x46O17LKc1YWyMU
//[expires_in] => 7200
//[refresh_token] => 2VcUf-af5sOIlAFimFaYitVCma5_u04ZqDtsU0prFB9PQ-a8RmUkHCdY0mmxwd9VnmmPr-8eysxi-fRehjVQhdcThZE5w1CAVfeTRCdNL1Q
//[openid] => oFR0dw_mKtrG7nyCc9ipFwg3jgAg
//[scope] => snsapi_userinfo ) )
//https://api.weixin.qq.com/sns/userinfo?
//access_token=Hf5nopaCtZGBbgzdL9hWaKJ2ZKbiNm6Jl7_tHwhDueoen59op__igQWvuowX8uZMKPjrwPLpVzdZY6uxyzFZUbOH6ek-x46O17LKc1YWyMU
//&openid=oFR0dw_mKtrG7nyCc9ipFwg3jgAg&lang=zh_CN
// Array (
// [code] => 041sc6hg2JH8yE0dHXdg2GqMgg2sc6hl
// [token] => Array (
// [access_token] => Hf5nopaCtZGBbgzdL9hWaKJ2ZKbiNm6Jl7_tHwhDueoen59op__igQWvuowX8uZMKPjrwPLpVzdZY6uxyzFZUbOH6ek-x46O17LKc1YWyMU
// [expires_in] => 7200
// [refresh_token] => 2VcUf-af5sOIlAFimFaYitVCma5_u04ZqDtsU0prFB9PQ-a8RmUkHCdY0mmxwd9VnmmPr-8eysxi-fRehjVQhdcThZE5w1CAVfeTRCdNL1Q
// [openid] => oFR0dw_mKtrG7nyCc9ipFwg3jgAg
// [scope] => snsapi_userinfo )
// [userinfo] => Array (
// [openid] => oFR0dw_mKtrG7nyCc9ipFwg3jgAg
// [nickname] => uy
// [sex] => 1
// [language] => zh_CN
// [city] =>
// [province] =>
// [country] => ä¸­å›½
// [headimgurl] => http://wx.qlogo.cn/mmopen/xCuib6CaDUQqnSWIicK7AVvxveC4KjlTABCoaWabSxjImQPTpHeiaujZD6POSxT7gWWIAh9GibeCbEvwSHicEicnEmFUaIgoxh7Acj/0
// [privilege] => Array ( ) ) )