@extends('admin.master')

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
                                <span ><strong>{{$products->product_name}}|数量：{{$products->product_num}}件</strong> </span>
                            </td>
                            @endforeach

                            <td class="col-sm-1 col-md-1 text-center"  >

                            <span ><strong> <?php $address = \Illuminate\Support\Facades\DB::table('addresses')->where('id',$item->address_id)->first();?>
                                    {{$address->name}}|{{$address->phonenumber}}|||{{$address->city}}|{{$address->address}}</strong> </span></td>
                            <td class="col-sm-1 col-md-1 text-center" >
                                <span ><strong>￥{{$item->total}}</strong> </span></td>
                            <td class="col-sm-1 col-md-1 text-center" >
                                <span ><strong>{{$item->adminstatus($item->status)}}</strong> </span></td>
                            <td class='col-sm-1 col-md-1 text-center'>

                                <a href="./detail/{{$item->id}}" >
                                    <button type='button' class='btn btn-danger'>
                                        <span class='fa fa-remove'>查看订单详情</span>
                                    </button></a></td>
                            <td class='col-sm-1 col-md-1 text-center'>
                            <?php  if($item->status < '2111') {
                                echo " <a href='./{$item->adminaddress($item->status)}/{$item->id}' >
                                    <button type='button' class='btn btn-danger'>
                                        <span class='fa fa-remove'>{$item->admincaozuo($item->status)}</span>
                                     </button></a>
                            " ;
                            } ?>


                            </td>

                        </tr>

                    </tbody>

            @endforeach




@endsection