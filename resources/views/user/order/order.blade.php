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

    <div class="panel panel-info">
        <div class="panel-heading">
            <div class="panel-title">选择收货地址</div>
        </div>
        <div class="panel-body" >


------------------------------------------------------------------------------------------------------------------------------------------------------------------------


                <div class="row">
                    <div class="col-sm-12 col-md-10 col-md-offset-1">
                        <table class="cartTable">
                            <thead>
                            <tr>
                                <th>收货人</th>
                                <th class="text-center">电话</th>
                                <th class="text-center">详细地址</th>

                                <th class="text-center">操作</th>


                            </tr>
                            </thead>
                            <tbody>
                            @foreach($items as $item)

                                <tr>
                                    <td class="col-sm-1 col-md-1 text-center">

                                        <h4 class="media-heading"><strong>{{$item->name}}-{{$item->city}}</strong></h4>
                    </td>

                    <td class="col-sm-1 col-md-1" >
                        <span ><strong>{{$item->phonenumber}}</strong> </span></td>
                    <td class="col-sm-1 col-md-1" >
                        <span ><strong>{{$item->name}}|{{$item->city}}
                                |{{$item->address}}</strong> </span></td>



                    <td class="col-sm-1 col-md-1">
                        <a href="./corder/{{$item->id}}"> <button type="button" class="btn btn-danger">
                                <span class="fa fa-remove">设为收货地址</span>

                        </button>
                        </a>
                    </td>
                    </tr>

                            @endforeach
                    </tbody>


                </div>




@endsection