<?php

namespace App\Http\Controllers;

use App\Address;
use App\CartItem;
use App\Order;
use App\Product;
use App\Service\OrderBackService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class OrderBcakController extends Controller
{
    //
    public function __construct(OrderBackService $orderBackService)
    {
        $this->orderback = $orderBackService;
    }

    public function all(){
       // $a=DB::table('cart_items')
         //   ->where('id','<','300')->get();
//        $a=CartItem::all();
//        dd($a);
//        s
        $arr = $this->orderback->orderback(0,3333);
        $items = $arr['items'];
        return view('admin.order.adminorder',['items'=>$items]);
    }
    public function unpay(){

$a=date('Y-m-d H-i-s',1481639360);
        dd($a);

        $arr = $this->orderback->orderback(0,0);
        //dd($arr);
        $items = $arr['items'];
        return view('admin.order.adminorder',['items'=>$items]);
    }





    public function express(){

//       $a= Address::where('id',10)->first();
//        dd($a);

        $arr = $this->orderback->orderback(100,100);

        $items = $arr['items'];

        return view('admin.order.adminorder',['items'=>$items]);
    }


    public function tuikuan(){
        $arr = $this->orderback->orderback(2100,2120);

        $items = $arr['items'];

        return view('admin.order.adminorder',['items'=>$items]);

    }
    public function yiquxiao(){
        $arr = $this->orderback->orderback(2800,5000);

        $items = $arr['items'];

        return view('admin.order.adminorder',['items'=>$items]);

    }


    public function sendexpress (Request $request, $id){
        $order = Order::where('id',$id)->first();
        if($request->isMethod('POST')){
            $order->express = $request->input('express');
            $order->status+=10;
            if($order->save()){
                return redirect('/admin/order/express');
            }
        }
        return view('admin.order.sendexpress',['order'=>$order]);


    }
    public function delorder($id){
        $order = Order::where('id',$id)->first();
        if($order->status > 1){
            $order->status+=2000;
        }
        else{
            $order->status+=3000;
        }
        $order->save();
        return redirect('/admin/order/all');
    }
    public function refund(Request $request, $id){
        $order = Order::where('id',$id)->first();

        if($request->isMethod('POST')) {
            //dd($order);
            $order->refund_total = $request->input('refund_total');
            $order->status += 1000;
            if ($order->save()) {
                return redirect('/admin/order/all');
            }
        }

            return view('admin.order.refund',['order'=>$order]);
    }
    public function detail($id){
        $order = Order::where('id',$id)->first();

        return view('admin.order.detail',['order'=>$order]);
    }


//    public function  quzhifu ( Request $request,$orderid){
//
//
//
//        if($request->isMethod('POST'))
//        return niyaofuduoshaoqian dingdan neirong  dingdanjinge
//    }
}
