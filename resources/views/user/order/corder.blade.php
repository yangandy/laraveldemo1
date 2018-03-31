@extends('user.master')

@section('商品列表', 'Page Title')

@section('sidebar')
    @parent
@endsection

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

    <div class="row">
        <div class="col-sm-12 col-md-10 col-md-offset-1">
            <table class="cartTable">
                <thead>
                <tr>
                    <th class="text-center">收货人</th>
                    <th class="text-center">电话</th>
                    <th class="text-center">详细地址</th>
                </tr>
                </thead>

                <tbody>
                <tr>
                    <td class="col-sm-1 col-md-1 ">
                        <h4 >{{$address->name}}-{{$address->city}}</h4>
                    </td>
                    <td class="col-sm-1 col-md-1" >
                        <span ><strong>{{$address->phonenumber}}</strong> </span>
                    </td>
                    <td class="col-sm-1 col-md-1" >
                        <span ><strong>{{$address->name}}{{$address->city}}{{$address->address}}</strong> </span>
                    </td>

                </tr>
                </tbody>

            </table>
        </div>
    </div>
    <div></div>
    <div></div>

    <div></div>


    ---------------------------------------------------------------------------    ---------------------------------------------------------------------------    ---------------------------------------------------------------------------

    <table class="cartTable">
        <thead>
        <tr>
            <th>商品</th>
            <th class="text-center">数量</th>
            <th class="text-center">单价</th>
            <th> </th>
        </tr>
        </thead>
        <tbody>

        @foreach($items as $item)

            <tr>
                <td class="media">
                    <div class="media">
                        {{--<a class="thumbnail pull-left" href="#"> <img class="media-object" src="../storage/app/uploads/{{$item->product->imageurl}}" style="width: 100px; height: 72px;"> </a>--}}
                        <div class="media-body">
                            <h4 class="media-heading"><a href="#">{{$item->product_name}}</a></h4>
                        </div>
                    </div>
                </td>
                <td class="col-sm-1 col-md-1" >
                    <span ><strong>{{$item->product_num}}件</strong> </span></td>
                <td class="col-sm-1 col-md-1" >
                    <span ><strong>${{$item->product_price}}</strong> </span></td>
            </tr>
        @endforeach
        </tbody>
        </table>
        <td class="col-sm-1 col-md-1 text-center" >
            <span ><strong>${{$total}}</strong></span></td>
    <form method="POST" action="" class="form-horizontal" enctype="multipart/form-data" role="form">
        {!! csrf_field() !!}
    <input id="num" name="note" type="text" class="count"
           placeholder="请输入商品的备注信息/给商家的留言"  class="form-control input-md" required="">
        <div class="col-md-9">
            <button id="submit" name="submit" class="btn btn-primary">提交</button>
        </div>
    </form>


@endsection
