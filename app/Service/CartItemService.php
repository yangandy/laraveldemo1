<?php

namespace App\Service;


use App\Cart;
use App\CartItem;
use App\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CartItemService
{



    public function showCart(){

        $cart = DB::table('carts')->where('user_id',Auth::user()->id )->first();
        if (!$cart) {
            $cart = new Cart();
            $cart->user_id = Auth::user()->id;
            $cart->save();
        }
    }
    public  function  add($productId){
        $cart = DB::table('carts')->where('user_id',Auth::user()->id )->first();
        $good = CartItem::where
        ([['product_id', '=', $productId],
            ['cart_id', '=', $cart->id],])
            ->first();
        if ($good)
        {
            $good->product_num++;
            $good->subtotal += Product::find($productId)->price;
            $good->save();
        } else
        {
            $caerItem = new CartItem();
            $caerItem->product_id = $productId;
            $caerItem->product_num = 1;
            $caerItem->subtotal = Product::find($productId)->price;
            $caerItem->cart_id = $cart->id;
            $caerItem->save();
        }

    }
    public function total(){
        $cart = Cart::where('user_id',Auth::user()->id )->first();

        $items =$cart->cartItems;
        //foreach($items as $item){
        //$aaa=$items->product->name;
//       dd($items);
        //exit;
        // dd($items);
        $total =0;
        foreach($items as $item){
            $item->subtotal=$item->product->price * $item->product_num;
            $total+= $item->subtotal;

        }
        $cart->total=$total;
        $cart->save();

        return (['items'=>$items,'total'=>$total]);

    }
    public function max($id){
        $cart=CartItem::where('id',$id)->first();


        $pnum = $cart->product->num;

        $productId=$cart->product_id;
        $cart->product_num ++;
        if($cart->product_num>$pnum){
            $cart->product_num=$pnum;
            $cart->save();
        }else{
            $cart->subtotal+= Product::find($productId)->price ;}

        $cart->save();

    }
    public  function min($id){
        $cart=CartItem::where('id',$id)->first();

        $productId = $cart->product_id;
        $cart->product_num--;
        if($cart->product_num<1){
            $cart->product_num = 1;
            $cart->save();
        }else{
            $cart->subtotal -= Product::find($productId)->price;
        $cart->save();
        }
    }
    public function mid($request,$id){
        $num=$request->input('num');

        $cart=CartItem::where('id',$id)->first();

        //dd($cart);
        $productId = $cart->product_id;
        //dd($productId);
        $pnum = $cart->product->num;
        $price = Product::find($productId)->price;
        //dd($price);

        // $cart->product_num = $num;
        if($num>$pnum){
            $subtotal=$price*$pnum;
            $cart->product_num = $pnum;
        }elseif($num<=0){
            $subtotal=$price;
            $cart->product_num = 1;
        } else{
            $subtotal=$price*$num;
            $cart->product_num = $num;
        }
        $cart->subtotal = $subtotal ;

        // dd($cart);
        $cart->save();

    }
}