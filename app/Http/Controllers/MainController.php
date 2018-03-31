<?php

namespace App\Http\Controllers;

use App\CartItem;
use App\Product;
use Illuminate\Http\Request;
use App\Cart;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class MainController extends Controller
{
    //
    public function index(){


           $products =Product::where([['num','>','0'],['status','=','1'],]

           )->get();
//echo $products;
        //sdd($products);
        //$products = Product::all();

        return view('main.index',['products'=>$products]);
    }
    public function  detail($productId){
        $product = Product::where('id',$productId)->get();
        //dd($product);

        return view('product.detail',['products'=>$product]);

    }
    public  function  buy($productId){
        $product = Product::where('id',$productId)->get();

        return view('');
    }
    public function myindex(){

        return view('user.myindex');

    }
}
