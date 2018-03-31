<?php

namespace App\Http\Controllers;

use App\CartItem;
use App\Service\CartItemService;
use App\Service\CartService;
use Illuminate\Http\Request;

class CartController extends Controller
{
    //
public function __construct(CartItemService $id)
{
    $this->middleware('auth');
    $this->cart = $id;
}

    public function addItem($productId)
    {
        $this->cart->showCart();
        $this->cart->add($productId);

            return redirect('./cart');
    }

    public function showCart(){
        $this->cart->showCart();
        $arr = $this->cart->total();

         $items = $arr['items'];
         $total = $arr['total'];

    return view('user.cart.view',['items'=>$items,'total'=>$total]);
    }

    public function  removeItem($id){

        CartItem::destroy($id);
        return redirect('./cart');

    }

    public function  max($id)
    {
        $this->cart->max($id);

        return redirect('./cart');
    }
    public function  min($id)
    {
        $this->cart->min($id);

        return redirect('./cart');
    }

    public function  mid(Request $request, $id)
    {
        $this->cart->mid($request,$id);

        return redirect('/cart');
    }

}
