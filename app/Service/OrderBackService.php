<?php

namespace App\Service;



use App\Order;

class  OrderBackService{
    public function orderback($a,$b){


        $items=Order::whereBetween('status', [$a, $b])
            ->orderBy('id','desc') ->get();

        return  (['items'=>$items]);
    }
}