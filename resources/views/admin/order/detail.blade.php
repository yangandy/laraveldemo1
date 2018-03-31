
@extends('admin.master')

@section('发送快递', 'Page Title')

@section('sidebar')
    @parent
@endsection

@section('content')
    <div class="panel panel-info">
        <div class="panel-heading">
            <div class="panel-title">订单详情</div>
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
                    </div></div>
                    <div class="form-group">

                        <div class="form-group">
                            <label class="col-md-3 control-label" for="name">货品总价</label>
                            <span ><strong>{{ $order->total }}</strong> </span></td>
                        </div>
                        </div>
                        <div class="form-group">
                            <div class="form-group">
                                <label class="col-md-3 control-label" for="name">快递信息</label>
                                <td><span ><strong>单号：{{ $order->express }}</strong> </span></td>
                            </div>
                            </div>
                            <div class="form-group">
                                <div class="form-group">
                                    <label class="col-md-3 control-label" for="name">订单备注</label>
                                    <span ><strong>{{ $order->note }}</strong> </span></td>
                                </div>










            </form>
        </div>
    </div>


@endsection