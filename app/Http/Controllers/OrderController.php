<?php

namespace App\Http\Controllers;

use App\Cart;
use App\Order;
use App\OrderItem;
use App\Product;
use App\Address;
use App\Service\OrderService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    public function __construct(OrderService $orderService){
        $this->middleware('auth');
        $this->order = $orderService;
    }

    //Auth::user()->id
    public  function  direct(Request $request,$id){
        //dd($id);
        $product = Product::where('id',$id)->first();
       // $address=Address::where([['user_id','=', Auth::user()->id],['status','=',1]])->first();
        //$adstring=$address->city.' '.$address->name;
        //$astring = $address->name.' '.$address->city.' '.$address->address.' '.$address->phonenumber;
        //dd($astring);
        $oldorders = Order::where([['user_id',Auth::user()->id],['status',NULL]])->get();
//        dd($oldorders);
//        exit;
        $userid=Auth::user()->id;
        if(!$oldorders->isEmpty()){
        foreach($oldorders as$oldorder) {
            DB::table('order_items')
                ->where('order_id', $oldorder->id)
                ->delete();
        }}
        DB::table('orders')
            ->where([['status',NULL],['user_id',Auth::user()->id]])
            ->delete();


        if($id<'0.5'){

            //判断来自购物车页面 或者直接购买页面
            $ordercart=Cart::where('user_id',$userid)->first();
            $items=$ordercart->cartItems;
            $order = new Order();
            $order->user_id= $userid;
            $order->total=$ordercart->total;
            $order->save();

            //$orderitem= new OrderItem();
            foreach ($items as $item) {
                $orderitem=new OrderItem();
                $orderitem->order_id = $order->id;
                $orderitem->product_id = $item->product_id;
                $orderitem->product_name=$item->product->name;
                $orderitem->product_num = $item->product_num;
                $orderitem->product_price = $item->product->price;
                $orderitem->save();
            }

        }else{
            $order = new Order();
            $order->user_id= $userid;
            $order->total=$request->input('num')*$product->price;
            $order->save();

            $orderitem = new OrderItem();
            $orderitem->order_id = $order->id;
            $orderitem->product_id= $product->id;
            $orderitem->product_name = $product->name;
            $orderitem->product_num = $request->input('num','1');
            $orderitem->product_price = $product->price;
            $orderitem->save();
        }
        //dd($orderitem);

        return redirect('./sorder');



    }


    public function sorder( ){
        $items = Address::where('user_id','=', Auth::user()->id)->get();
        //dd($address);
        return view('user.order.order',['items'=>$items,]);
    }

    public function corder(Request $request,$id){

//            $naddress=Address::where('choo',1)->first();
//        if($naddress){
//            $naddress->choo= 0;
//            $naddress->save();
//        }
//        $caddress=Address::where('id',$id)->first();
//        $caddress->choo=1;
//        $caddress->save();
        $order = Order::where([['user_id', Auth::user()->id],['status',NULL]])->first();


        if($order){

            $caddress=Address::where('id',$id)->first();
            $order->address_id=$caddress->id;
            $order->save();
        }
        else{
            return  redirect('./home');
        }
        if($request->isMethod('POST')){
            $items=$order->orderItems;
            $cartid=Cart::where('user_id',Auth::user()->id)->first()->id;
            $order->status='0000';
            $order->note = $request->input('note');
            $order->save();
            foreach($items as $item)
            {
                $p_id=$item->product_id;
                DB::table('cart_items')
                    ->where([['cart_id',$cartid],['product_id',$p_id]])
                    ->delete();
            }
            return  redirect('./home');
        }

        //dd($items);
        $items = OrderItem::where('order_id',$order->id)->get();

        //dd($caddress->name);

        return view('user.order.corder',['address'=>$caddress,'items'=>$items,'total'=>$order->total]);
    }

    public function myorder(){
       //$items=Order::where('user_id',Auth::user()->id)->get();
        $arr=$this->order->order(-5000,2000);
//        $items=Order::where("SUBSTRING('status', 2,3) = 234")->toSql();
//        dd($items);
        //$a=Order::where('status', '=', '0000')->toSql();

        $items = $arr['items'];
        //($items);
        //dd($a);
       //dd($items);
        return view('user.order.myorders',['items'=>$items]);
       // dd($orders);
    }

    public function unpayorder(){
        $arr=$this->order->order(0,0);
        $items = $arr['items'];
        return view('user.order.myorders',['items'=>$items]);


    }
    public function evaluation(){
        $arr = $this->order->order(110,110);
        $items = $arr['items'];
        return view('user.order.myorders',['items'=>$items]);

    }
    public function unexpress(){
        $arr = $this->order->order(100,100);
        $items = $arr['items'];
        return view('user.order.myorders',['items'=>$items]);
    }

}
