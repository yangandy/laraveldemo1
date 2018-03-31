


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


<form method="POST" action=" " class="form-horizontal" enctype="multipart/form-data" role="form">
    {!! csrf_field() !!}
    <fieldset>
        <!-- Text input-->
        <div class="form-group">
            <label class="col-md-3 control-label" for="name">name</label>
            <div class="col-md-9">
                <input id="name" name="name" type="text" placeholder="yourname"
                       value="{{old('Address')['name'] ? old('Address')['name'] : $address->name }}"
                       class="form-control input-md" required="">

            </div>
        </div>
        <div class="form-group">
            <label class="col-md-3 control-label" for="name">city</label>
            <div class="col-md-9">
                <input id="name" name="city" type="text" placeholder="yourcity"
                       value="{{old('Address')['city'] ? old('Address')['city'] : $address->city }}"
                       class="form-control input-md" required="">

            </div>
        </div>
        <div class="form-group">
            <label class="col-md-3 control-label" for="textarea">address</label>
            <div class="col-md-9">
                            <textarea class="form-control" id="textarea" name="address"

                                      placeholder="input your real address">{{old('Address')['address'] ? old('Address')['address'] : $address->address }}</textarea>
            </div>
        </div>


        <div class="form-group">
            <label class="col-md-3 control-label" for="num">phone number</label>
            <div class="col-md-9">
                <input id="num" name="phonenumber" type="text" placeholder="your phone number"
                       value="{{old('Address')['phonenumber'] ? old('Address')['phonenumber'] : $address->phonenumber }}"
                       class="form-control input-md" required="" >

            </div>
        </div>




        <div class="form-group">
            <label class="col-md-3 control-label" for="submit"></label>
            <div class="col-md-9">
                <button id="submit" name="submit" class="btn btn-primary">提交</button>
            </div>
        </div>

    </fieldset>
@section('content')


@endsection