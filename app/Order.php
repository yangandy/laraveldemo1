<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{

    const UNPAY = '0000';//未支付
    const UNEXPRESS = '0100';//未发货
    const EVALUATION = '0110';//未评价

    const TUIKUAN = '1100';//需要退款
    const TUIKUAN2 = '1110';//需要退款
    const SUCCESS = '2111';//交易成功
    const FAIL = '3000';//交易失败
    const FAIL2 = '3100';
    const FAIL3 = '3110';

    //
    public function user(){
        return $this->belongsTo('App\User');
    }

    public function orderItems(){
        return $this->hasMany('App\OrderItem');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */


    public function userstatus($ind = null){
        //dd($ind);
        $arr = [
            Self::UNPAY=>'尚未付款',
            Self::UNEXPRESS=>'待发货',
            Self::EVALUATION=>'请评价',
            Self::SUCCESS=>'交易完成',
            Self::FAIL=>'订单已取消',
            Self::FAIL3=>'订单已取消',
            Self::FAIL2=>'订单已取消',

            Self::TUIKUAN=>'等待退款',
            Self::TUIKUAN2=>'等待退款',
        ];
        if($ind!=null){
            return array_key_exists($ind,$arr) ? $arr[$ind] : $arr[Self::UNPAY];
        }
        return $arr;
    }
    public function useraddress($ind = null)
    {
        $arr = [
            Self::UNPAY=>'pay',
            Self::UNEXPRESS=>'kuaidi',
            Self::EVALUATION=>'pingjia',
            Self::SUCCESS=>'success',
            Self::FAIL=>'fail',
            Self::FAIL2=>'fail',
            Self::FAIL3=>'fail',
            Self::TUIKUAN=>'tuikuanxiangqing',
            Self::TUIKUAN2=>'tuikuanxiangqing',
        ];
        if($ind!=null){
            return array_key_exists($ind,$arr) ? $arr[$ind] : $arr[Self::SUCCESS];
        }
        return $arr;
    }
    public function usercaozuo($ind = null){

        $arr = [
            Self::UNPAY=>'去支付',
            Self::UNEXPRESS=>'查看快递',
            Self::EVALUATION=>'去评价',
            Self::SUCCESS=>'订单已完成',
            Self::FAIL=>'订单已取消',
            Self::FAIL2=>'订单已取消',
            Self::FAIL3=>'订单已取消',
            Self::TUIKUAN=>'查看退款详情',
            Self::TUIKUAN2=>'查看退款详情',
        ];
        if($ind!=null){
            return array_key_exists($ind,$arr) ? $arr[$ind] : $arr[Self::SUCCESS];
        }
        return $arr;
    }

    public function adminstatus($ind = null){
        //dd($ind);
        $arr = [
            Self::UNPAY=>'尚未付款',
            Self::UNEXPRESS=>'待发货',
            Self::EVALUATION=>'请评价',
            Self::SUCCESS=>'交易完成',
            Self::FAIL=>'订单已取消',
            Self::FAIL2=>'订单已取消',
            Self::FAIL3=>'订单已取消',
            Self::TUIKUAN=>'需要退款',
            Self::TUIKUAN2=>'需要退款',
        ];
        if($ind!=null){
            return array_key_exists($ind,$arr) ? $arr[$ind] : $arr[Self::FAIL];
        }
        return $arr;
    }
    public function adminaddress($ind = null)
    {
        $arr = [
            Self::UNPAY=>'pay',
            Self::UNEXPRESS=>'kuaidi',
            Self::EVALUATION=>'pingjia',
            Self::SUCCESS=>'detail',
            Self::FAIL=>'fail',
            Self::FAIL2=>'fail',
            Self::FAIL3=>'fail',
            Self::TUIKUAN=>'refund',
            Self::TUIKUAN2=>'refund',
        ];
        if($ind!=null){
            return array_key_exists($ind,$arr) ? $arr[$ind] : $arr[Self::SUCCESS];
        }
        return $arr;
    }
    public function admincaozuo($ind = null){

        $arr = [
            Self::UNPAY=>'取消订单',
            Self::UNEXPRESS=>'发快递',
            Self::EVALUATION=>'提醒评价',
            Self::SUCCESS=>'查看订单详情',
            Self::FAIL=>'订单已取消',
            Self::FAIL2=>'订单已取消',
            Self::FAIL3=>'订单已取消',
            Self::TUIKUAN=>'退款',
            Self::TUIKUAN2=>'退款',
        ];
        if($ind!=null){
            return array_key_exists($ind,$arr) ? $arr[$ind] : $arr[Self::FAIL];
        }
        return $arr;
    }



}
