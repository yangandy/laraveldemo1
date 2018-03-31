
@extends('layouts.master')

@section('发送快递', 'Page Title')

@section('sidebar')
    @parent
@endsection

@section('content')
    <div class="panel panel-info">
        <div class="panel-heading">
            <div class="panel-title">fakuaidi</div>
        </div>
        <div class="panel-body" >

                <fieldset>
                    <!-- Text input-->
                    <div class="form-group">
                        <label class="col-md-3 control-label" for="name">收件人</label>
                        <span ><strong>{{ $order->user->name }}</strong> </span></td>
                    </div><div class="form-group">
                        <div class="form-group">
                            <label class="col-md-3 control-label" for="name">收货地址</label>
                            <span ><strong> <?php $address = \Illuminate\Support\Facades\DB::table('addresses')->where('id',$order->address_id)->first();?>
                                    {{$address->name}}|{{$address->phonenumber}}|||{{$address->city}}|{{$address->address}}</strong> </span></td>
                        </div><div class="form-group">
                            <div class="form-group">
                                    <label class="col-md-3 control-label" for="name">货品总价</label>
                                    <span ><strong>{{ $order->total }}</strong> </span></td>
                                </div>
                            <div class="form-group">
                                <div class="form-group">
                                    <label class="col-md-3 control-label" for="name">订单备注</label>
                                    <span ><strong>{{ $order->note }}</strong> </span></td>
                                </div>






                        <form method="POST" action="" class="form-horizontal" enctype="multipart/form-data" role="form">
                            {!! csrf_field() !!}
                            <div class="form-group">
                                <label class="col-md-3 control-label" for="price">快递单号</label>
                                <div class="col-md-9">
                                        <input id="price" name="express" type="text" placeholder="请输入快递单号" class="form-control input-md" required="">

                                </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label" for="submit"></label>
                        <div class="col-md-9">
                            <button id="submit" name="submit" class="btn btn-primary">提交</button>
                        </div>
                    </div>

                </fieldset>

            </form>
        </div>
    </div>


@endsection