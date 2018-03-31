@extends('user.master')

@section('购物车', 'Page Title')

@section('sidebar')
    @parent
@endsection

@section('content')
    <div >
        1
    </div>
    <div>
        1
    </div>
    <div>
        1
    </div>

    <div class="row">
        <div class="orderitem clearfix" priceOne>
            <div class="col-sm-12 col-md-10 col-md-offset-1">
                <table class="cartTable">
                    <thead>
                    <tr>
                        <th>商品</th>
                        <th>剩余数量</th>

                        <th class="text-center">单价</th>
                        <th class="text-center">数量</th>

                        <th class="text-center">小计</th>

                        <th>操作</th>

                        <th> </th>
                    </tr>
                    </thead>
                    <tbody>

                    @foreach($items as $item)

                        <tr>
                            <td class="media">
                                <div class="media">
                                    <a class="thumbnail pull-left" href="#"> <img class="media-object" src="../storage/app/uploads/{{$item->product->imageurl}}" style="width: 100px; height: 72px;"> </a>
                                    <div class="media-body">
                                        <h4 class="media-heading"><a href="#">{{$item->product->name}}</a></h4>
                                    </div>
                                </div></td>

                            <td class="col-sm-1 col-md-1" >
                                <span ><strong>{{$item->product->num}}件</strong> </span></td>
                            <td class="col-sm-1 col-md-1" >
                                <span ><strong>${{$item->product->price}}</strong> </span></td>

                            <td class="col-sm-1 col-md-1 text-center">
                                <a href="./min/{{$item->id}}">
                                <button id="min" name="num" class="reduce">-</button></a>

                                <form  role="form" method="POST" action="./mid/{{$item->id}}">
                                    {!! csrf_field() !!}
                                <input id="num" name="num" type="text" class="count"
                                       value="{{old('$item')['product_num'] ? old('$item')['product_num'] : $item->product_num }}"
                                       placeholder="商品数量"  class="form-control input-md" required="">
                                {{--<a href="">--}}
                                        <button id=""  class="mid">修改 </button></a>
                                    </form>

                                <a href="./max/{{$item->id}}">
                                <button id="add"  class="add">+ </button></a>

                            </td>


                            <td class="col-sm-1 col-md-1 text-center" >
                                <strong>${{$item->subtotal}}</strong>
                                <div class="subtotal">
                            </td>
                            <td class="col-sm-1 col-md-1">
                                <a href="./removeItem/{{$item->id}}"> <button type="button" class="btn btn-danger">
                                        <span class="fa fa-remove"></span> 移除
                                    </button>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                    <div class="foot" id="foot">



                        <tr>
                            <td>   </td>
                            <td>   </td>
                            <td>   </td>
                            <td><h3>总价</h3></td>
                            <td class="text-right" >

                                <input type="hidden" name="total" id="demo" value="111" > <h3><strong>${{$total}}</strong></h3> </td>
                        </tr>
                        <tr>
                            <td>   </td>
                            <td>   </td>
                            <td>   </td>


                            <td>


                                <a href=""> <button type="button" class="btn btn-default">
                                        <span class="fa fa-shopping-cart"></span> 继续购物
                                    </button>
                                </a></td>
                            <td>





                    <td>
                    <a href="./cartorder/0">
                    <button type="button" class="btn btn-success">
                        结算 <span class="fa fa-play"></span></button></a>
                    </td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>

@endsection