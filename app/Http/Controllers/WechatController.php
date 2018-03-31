<?php

namespace App\Http\Controllers;
use EasyWeChat\Foundation\Application;
use Log;
use Illuminate\Http\Request;

class WechatController extends Controller
{
    //
    public function serve(){
        Log::info('request arrived');
        $wechat = app('wechat');
        $wechat->server->setMessageHandler(function($message){
            return "wellcome myfriends";
        });
        Log::info('return response.');

        return $wechat->server->serve();

    }
    public function demo(Application $wechat){

    }


}
