<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    //

    const  status_up = 1;
    const  status_down = 0;
    protected  $table = 'products';

    public  function  status($statu = null){
        $arr = [
            Self::status_up=>'开启',
            Self::status_down=>'关闭',
        ];
        if($statu!=null){
            return array_key_exists($statu,$arr) ? $arr[$statu] : $arr[self::status_down];

        }
        return $arr;
    }
    public function file(){
        return $this->belongsTo('App\File');
    }
}
