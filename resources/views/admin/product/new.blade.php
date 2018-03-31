
    @extends('layouts.master')

@section('新增商品', 'Page Title')

@section('sidebar')
    @parent
@endsection

@section('content')
    <div class="panel panel-info">
        <div class="panel-heading">
            <div class="panel-title">新增商品</div>
        </div>
        <div class="panel-body" >
            <form method="POST" action="./save" class="form-horizontal" enctype="multipart/form-data" role="form">
                {!! csrf_field() !!}
                <fieldset>
                    <!-- Text input-->
                    <div class="form-group">
                        <label class="col-md-3 control-label" for="name">名称</label>
                        <div class="col-md-9">
                            <input id="name" name="name" type="text" placeholder="商品名称" class="form-control input-md" required="">

                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label" for="textarea">描述</label>
                        <div class="col-md-9">
                            <textarea class="form-control" id="textarea" name="description" placeholder="请输入商品详细信息"></textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label" for="price">价格</label>
                        <div class="col-md-9">
                            <input id="price" name="price" type="text" placeholder="商品价格" class="form-control input-md" required="">

                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-3 control-label" for="num">数量</label>
                        <div class="col-md-9">
                            <input id="num" name="num" type="text" placeholder="商品数量" class="form-control input-md" required="" >

                        </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-3 control-label" for="status">status</label>
                            <label for="openStatus" >开启</label>
                            <input id="openStatus" type="radio" name="status" value="1" checked />
                            <label for="closeStatus" >禁止</label>
                            <input id="closeStatus" type="radio" name="status" value="0" />
                        </p>
                        </div>

                    <div class="form-group">
                        <label class="col-md-3 control-label" for="file">文件</label>
                        <div class="col-md-9">
                            <input id="file" name="file" class="input-file" type="file">
                        </div>
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