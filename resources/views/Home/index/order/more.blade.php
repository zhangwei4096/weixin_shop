{{--我的订单详细页面--}}
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="keywords" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <meta name="renderer" content="webkit">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title></title>
    <link rel="stylesheet" href="">
    <link href="{{ URL::asset('home/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('home/css/style.css') }}" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="http://at.alicdn.com/t/font_1459473269_4751618.css">
    <link rel="stylesheet" href="{{ URL::asset('layui/css/layui.css') }}" />
    <script src="{{ URL::asset('home/js/jquery.js') }}"></script>
    <script src="{{ URL::asset('layer/layer.js') }}"></script>
    <script src="{{ URL::asset('home/js/bootstrap.min.js') }}"></script>

    <!--必要样式-->
    <link rel="stylesheet" type="text/css" href="{{ URL::asset('home/css/menu_elastic.css') }}" />
</head>
<style>
    .bottoms {
        /*浏览器定位*/
        position: fixed;
        bottom: 5px;
        border-radius: 10px;
        background-color: #b23e35;
    }
    .bottomsl {
        position: fixed;
        bottom: 5px;
        border-radius: 10px;
    }
</style>
<body class="huibg">
<nav class="navbar text-center">
    <button class="topleft" onclick ="javascript:history.go(-1);"><span class="iconfont icon-fanhui"></span></button>
    <a class="navbar-tit center-block">订单详情</a>
    {{--<button class="topnav" id="open-button"><span class="iconfont icon-1"></span></button>--}}
</nav>

<div class="dingdan">

    @foreach(json_decode($order['order_info']) as $v)
    <div class="ddlist">
        <div class="dtit">订单信息</div>
        <div class="dz"><p class="ziku">名  称：</p>{{ $v->title }}</div>
        <div class="dz"><p class="ziku">数  量：</p>{{ $v->num }}</div>
        <div class="dz"><p class="ziku">单  价：</p><span>{{ $v->xs_price }}</span></div>
        <div class="dz noblord"><p class="ziku">总 价：</p><span>{{ $v->xs_price * $v->num }}</span></div>
    </div>
    @endforeach


    <div class="ddlist">
        <div class="dtit">收货信息</div>
        <div class="dzdv">
            <span class="name">{{ $order->addrs_name }}</span> <span class="phone">{{ $order->addrs_phone }}</span>
            <span class="dd">{{ $order->addrs_info }}</span>

        </div>
    </div>

    <div class="ddlist">
        <div class="dtit">订单备注</div>
        <div class="dz noblord">{{ $order->order_data }}</div>
    </div>

    @if($order->is_goods == 1 && $order->order_type == 1)
    <div class="ddlist">
        <div class="dtit">物流单号</div>
        <div class="dz noblord">{{ $order->express }}：{{ $order->number }}</div>
    </div>
    @elseif($order->order_type == 1 && $order->is_goods == 0)
            <button class="layui-btn layui-btn-fluid bottomsl" onclick="info();">提醒商家发货</button>
    @else
            <button class="layui-btn layui-btn-fluid bottoms" onclick="go_pay();">去支付</button>{{--跳转到支付页面--}}
    @endif

</div>
<script>

    function info(){
        //提醒
        layer.msg('提醒成功',{icon: 1});
    }

    function go_pay() {
        //跳转到支付页面
        var order = '{{ $order->order_id }}';
        location.href='{{ url('/pay/') }}/'+order;
    }

</script>
</body>
</html>