<?php

namespace App\Service;


use App\Address;
use App\Order;
use Illuminate\Support\Facades\Auth;

class OrderService{


    public function order($a,$b){

        $items=Order::where('user_id',Auth::user()->id)
            ->whereBetween('status', [$a, $b])
            ->orderBy('id','desc') ->get();


        return  (['items'=>$items]);
    }



}