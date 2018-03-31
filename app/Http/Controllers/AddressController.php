<?php

namespace App\Http\Controllers;

use App\Address;
use Illuminate\Http\Response;
use Request;
use App\Http\Requests;
use Illuminate\Support\Facades\Auth;

class AddressController extends Controller
{
    // //

    public function __construct(){
        $this->middleware('auth');
    }


    public function show(){
//        Address::where('user_id',Auth)
        $addresses = Address::where([['user_id',Auth::user()->id],['deleted',NULL]])->get();


        return view('user.address.address',['addresses'=>$addresses]);
    }
    public function add(){
        $raddress=Address::where('status',1)->first();
        $user_id = Auth::user()->id;
        //dd($a);
        if( Request::input('status')>0){
            if($raddress){
            $raddress->status = 0;
            $raddress->save();}
        }

        $address = new Address();
        $address->user_id = $user_id;
        $address->name = Request::input('name');
        $address->city = Request::input('city');
        $address->address = Request::input('address');
        $address->phonenumber = Request::input('phonenumber');
        $address->status = Request::input('status');
        $address->save();
        return  redirect('./address');



    }
    public function update($id)
    {

        $address = Address::where('id', $id)->first();
//        dd($product);
//        exit;
        //dd($address);
        if (Request::isMethod('POST')) {
            /* $this->validate($request,[
                 'Product.name'=>'required| min:1|max:20',
                 'Product.description'=>'required|min:1|max:500',
                 'Product.price'=>'required|integer',
                 'Product.num'=>'required|integer|max:999',
                 ], [
                     'required' => ':attribute 为必填项',
                     'min' => ':attribute 长度不符合要求',
                     'integer' => ':attribute 必须为整数',
                 ], [
                     'Product.name' => '商品名',
                     'Product.description' => '描述',
                     'Product.price' => '价格',
                      'Product.num'=>'数量'
                 ]);*/
//            $data = Request::input('name');
//            dd($data);
            $address->name = Request::input('name');
            $address->city = Request::input('city');
            $address->address = Request::input('address');
            $address->phonenumber = Request::input('phonenumber');


//            dd($product);
//            exit;
            if ($address->save()) {
                return redirect('./address');


            } }

            return view('user.address.aupdate', ['address' => $address]);

    }
    public function status($id){

        $raddress=Address::where('status',1)->first();

        $address=Address::where('id',$id)->first();
        if( empty($raddress) ){
            //dd($address);
            $address->status=1;
            $address->save();
        }else {
            if ($raddress->status = $address->status) {
                return redirect('./address');
            } else {
                $raddress->status = 0;
                $address->status = 1;
                $raddress->save();
                $address->save();
            }

        }
        return redirect('./address');



    }
    public function delete($id){
        $old=Address::where('id',$id)->first();
        $old->deleted = 1;
        $old->save();
        $address=Address::where('user_id',Auth::user()->id)->first();
       if($address){
        $address->status=1;
        $address->save();}


         return  redirect('./address');


    }




}
