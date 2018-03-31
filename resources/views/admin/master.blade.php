<html>

<head>
    <title>商店测试</title>
    <link href="http://cdn.bootcss.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" rel="stylesheet">
    <link href="http://cdn.bootcss.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
    <script src="http://cdn.bootcss.com/bootstrap/3.3.7/js/bootstrap.js"></script>
    <script src="http://cdn.bootcss.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

    <script type="text/javascript">



    </script>
</head>
<body >

@section('sidebar')
    <nav class="navbar navbar-default  navbar-fixed-top" role="navigation">
        <div class="container-fluid">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="./all">土豆的商店</a>

            </div>
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">

                <ul class="nav navbar-nav navbar-right">
                    @if(!Auth::user())
                        <li><a href="./login">登录</a></li>
                        <li><a href="./register">注册</a></li>

                    @else
                        <li><a href="./">主页 <span class="fa fa-briefcase"></span></a></li>
                        <li><a href="./myindex">个人中心 <span class="fa fa-briefcase"></span></a></li>
                        <li><a href="./myorder">我的订单 <span class="fa fa-briefcase"></span></a></li>

                        <li><a href="./cart">购物车 <span class="fa fa-shopping-cart"></span></a></li>
                        <li><a href="./auth/logout">退出 {{ Auth::user()->name}}</a></li>
                    @endif
                </ul>
            </div><!-- /.navbar-collapse -->
        </div><!-- /.container-fluid -->
    </nav>

@show


        @section('leftmenu')
            <div class="col-md-3">
                <div class="list-group">
        <div class="list-group">
            <ul>
                <li><a class="list-group-item" href="../order/all">订单管理 </a></li>
                    <ul>
                        <li><a class="list-group-item" href="http://localhost/tudo/public/admin/order/all">所有订单 </a></li>
                        <li><a class="list-group-item" href="http://localhost/tudo/public/admin/order/unpay">未付款订单</a></li>
                        <li><a class="list-group-item" href="http://localhost/tudo/public/admin/order/express">待发货订单 </a></li>
                        <li><a class="list-group-item" href="http://localhost/tudo/public/admin/order/refund">待退款订单 </a></li>
                        <li><a class="list-group-item" href="http://localhost/tudo/public/admin/order/yiquxiao">已取消订单 </a></li>
                    </ul>
                </li>
                <li><a class="list-group-item" href="../product/products">商品管理</a></li>
                <ul>
                    <li><a class="list-group-item" href="../product/products">所有商品</a></li>
                <li><a class="list-group-item" href="../product/new">新增商品 </a></li>
                </ul>
                </li>
                <li><a class="list-group-item" href="./">用户管理</a></li>
            </ul>





        </div>
    </div>
</div>
    @show







<div class="container">
    @yield('content')
</div>
</body >

</html>