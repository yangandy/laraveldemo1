@extends('layouts.master')

@section('商品列表', 'Page Title')

{{--@section('sidebar')--}}
    {{--@parent--}}
{{--@endsection--}}

<div>
    1
</div>   <div>
    1
</div>
<div>
    1
</div>
<!-- 左侧菜单区域   -->

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                @foreach ($products as $product)

                    <div class="col-sm-6 col-md-4">
                        <div class="thumbnail" >
                            <img src="../storage/app/public/{{$product->id}}/{{$product->imageurl}}" class="img-responsive">
                            <div class="caption">
                                <div class="row">
                                    <div class="col-md-6 col-xs-6">
                                        <h3>{{$product->name}}</h3>
                                    </div>
                                    <div class="col-md-6 col-xs-6 price">
                                        <h3>
                                            <label>￥{{$product->price}}</label></h3>
                                    </div>
                                </div>
                                <p>{{$product->description}}</p>
                                <div class="col-md-6 col-md-offset-3">
                                <form  role="form" method="POST"  action="./direct/{{$product->id}}">
                                    {!! csrf_field() !!}
                                    <input id="num" name="num" type="text" class="count"
                                           value="1"
                                           placeholder="商品数量"  class="btn btn-success btn-product" required="">
                                    {{--<a href="">--}}
                                    <button id="" class="mid"><span class="fa fa-shopping-cart"></span>直接购买 </button></a>
                                </form>
                                </div>
                                <div class="row">
                                    <div class="col-md-6 col-md-offset-3">
                                        <a href="./addProduct/{{$product->id}}" class="btn btn-success btn-product"><span class="fa fa-shopping-cart"></span> 加入购物车</a>
                                <a href="./detail/{{$product->id}}" class="btn btn-success btn-product"><span class="fa fa-shopping-cart"></span> 查看详情</a></div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

@endsection