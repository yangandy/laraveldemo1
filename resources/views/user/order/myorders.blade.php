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
                    <th class="text-center">订单详情</th>
                    <th class="text-center">收货人</th>
                    <th class="text-center">金额</th>
                    <th class="text-center">状态</th>
                    <th class="text-center">操作</th>

                </tr>
                </thead>

                @foreach($items as $item)
                    <tbody>

                    @foreach($item->orderItems as $products)
                    <tr>
                        <td class="col-sm-1 col-md-1 text-center">
                                <span ><strong>{{$products->product_name}}|{{$products->product_num}}</strong> </span>
                        </td>
                        @endforeach

                        <td class="col-sm-1 col-md-1 text-center"  >

                            <span ><strong> <?php $address = \Illuminate\Support\Facades\DB::table('addresses')->where('id',$item->address_id)->first();

                                    ?>{{$address->name}}</strong> </span></td>
                        <td class="col-sm-1 col-md-1 text-center" >
                        <span ><strong>￥{{$item->total}}</strong> </span></td>
                        <td class="col-sm-1 col-md-1 text-center" >
                            <span ><strong>{{$item->userstatus($item->status)}}</strong> </span></td>

                        <td class="col-sm-1 col-md-1 text-center">
                            <a href="./{{$item->useraddress($item->status)}}/{{$item->id}}"> <button type="button" class="btn btn-danger">
                                    <span class="fa fa-remove">{{$item->usercaozuo($item->status)}}</span>

                                </button>
                            </a>
                        </td>
                    </tr>

                    </tbody>

@endforeach




        </div>


@endsection