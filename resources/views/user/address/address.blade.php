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

    <div class="panel panel-info">
        <div class="panel-heading">
            <div class="panel-title"> new address</div>
        </div>
        <div class="panel-body" >
            <form method="POST" action="./addaddress" class="form-horizontal" enctype="multipart/form-data" role="form">
                {!! csrf_field() !!}
                <fieldset>
                    <!-- Text input-->
                    <div class="form-group">
                        <label class="col-md-3 control-label" for="name">name</label>
                        <div class="col-md-9">
                            <input id="name" name="name" type="text" placeholder="yourname" class="form-control input-md" required="">

                        </div>
                        </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label" for="name">city</label>
                        <div class="col-md-9">
                            <input id="name" name="city" type="text" placeholder="yourcity" class="form-control input-md" required="">

                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label" for="textarea">address</label>
                        <div class="col-md-9">
                            <textarea class="form-control" id="textarea" name="address" placeholder="input your real address"></textarea>
                        </div>
                    </div>


                    <div class="form-group">
                        <label class="col-md-3 control-label" for="num">phone number</label>
                        <div class="col-md-9">
                            <input id="num" name="phonenumber" type="text" placeholder="your phone number" class="form-control input-md" required="" >

                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-3 control-label" for="status">status</label>
                        <label for="openStatus" >set first address</label>
                        <input id="openStatus" type="radio" name="status" value="1" checked />
                        <label for="closeStatus" >set other address</label>
                        <input id="closeStatus" type="radio" name="status" value="0" />
                        </p>
                    </div>



                    <div class="form-group">
                        <label class="col-md-3 control-label" for="submit"></label>
                        <div class="col-md-9">
                            <button id="submit" name="submit" class="btn btn-primary">提交</button>
                        </div>
                    </div>

                    </fieldset>
                    ------------------------------------------------------------------------------------------------------------------------------------------------------------------------


        <div class="row">
                <div class="col-sm-12 col-md-10 col-md-offset-1">
                    <table class="cartTable">
                        <thead>
                        <tr>
                            <th>收货人</th>
                            <th>所在地区</th>

                            <th class="text-center">详细地址</th>
                            <th class="text-center">电话</th>

                            <th class="text-center">操作</th>

                            <th>操作</th>


                        </tr>
                        </thead>
                        <tbody>
                       @foreach($addresses as $address)

                            <tr>
                                <td class="col-sm-1 col-md-1 text-center">

                                            <h4 class="media-heading">{{$address->name}}</h4>
                                    </div></td>

                                <td class="col-sm-1 col-md-1" >
                                    <span ><strong>{{$address->city}}</strong> </span></td>
                                <td class="col-sm-1 col-md-1 text-center" >
                                    <span ><strong>{{$address->address}}</strong> </span></td>

                                <td class="col-sm-1 col-md-1 ">
                                    <div class="media">

                                    <strong>{{$address->phonenumber}}</strong>
                                    </div>
                                </td>


                                <td class="col-sm-1 col-md-1 text-center" >
                                    <strong>{{$address->status}}</strong>

                                </td>
                                <td class="col-sm-1 col-md-1">
                                    <a href="./update/{{$address->id}}"> <button type="button" class="btn btn-danger">
                                            <span class="fa fa-remove">update</span></button></a>
                                    <a href="./delete/{{$address->id}}"> <button type="button" class="btn btn-danger">
                                            <span class="fa fa-remove">移除</span></button></a>

                                            <a href="./status/{{$address->id}}"> <button type="button" class="btn btn-danger">
                                                    <span class="fa fa-remove">设为默认地址</span>
                                        </button>
                                            </a>

                                </td>
                            </tr>
            </div>


                         </tbody>

                       @endforeach

    </div>




@endsection