@extends('admin.master')

@section('商店后台', 'Page Title')

@section('sidebar')
    @parent
@endsection
<div>
1
</div>
<div>
1
</div>
<div>
1
</div>


@section('content')

    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <a href="./product/new"><button class="btn btn-success">新增商品</button></a>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <table class="table table-striped">
                    <thead>
                    <td>名称</td>
                    <td>价格</td>
                    <td>文件</td>
                    <td>剩余数量</td>
                    <td>状态</td>
                    <td>操作</td>
                    </thead>
                    <tbody>
                    @foreach ($products as $product)
                        <tr>
                            <td>{{$product->name}}</td>
                            <td>￥{{$product->price}}</td>
                            <td>{{$product->file->original_filename}}</td>
                            <td>{{$product->num}}件</td>
                            {{--<td>{{$product->status($product->statu)}}</td>--}}
                            <td>{{$product->status}}</td>
                            <td><a href="./product/update/{{$product->id}}"><button class="btn btn-danger">修改</button></a>
                                <a href="./product/destroy/{{$product->id}}"><button class="btn btn-danger">删除</button></a>
                                <a href="./product/detail/{{$product->id}}"><button class="btn btn-danger">详情介绍</button></a>
                            </td>

                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>


@endsection