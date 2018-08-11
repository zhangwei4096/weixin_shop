<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="keywords" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <meta name="renderer" content="webkit">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>个人中心</title>
    <link rel="stylesheet" href="">
    <link href="{{ URL::asset('home/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('home/css/style.css') }}" rel="stylesheet">
    <script src="{{ URL::asset('home/js/jquery.js') }}"></script>
    <script src="{{ URL::asset('home/js/bootstrap.min.js') }}"></script>
    <script type="text/javascript" src="{{ URL::asset('admin/lib/layer/2.4/layer.js') }}"></script>
    <!--必要样式-->
    <link rel="stylesheet" type="text/css" href="{{ URL::asset('home/css/menu_elastic.css') }}" />
</head>
<style>
    * {
        padding: 0;
        margin: 0;
        list-style: none;
        font-weight: normal;
    }
    @font-face {
        font-family: 'icomoon';
        src:  url('{{ URL::asset('home/fonts/icomoon.eot?4av2ov')}}');
        src:  url('{{ URL::asset('home/fonts/icomoon.eot?4av2ov#iefix')}}') format('embedded-opentype'),
        url('{{ URL::asset('home/fonts/icomoon.ttf?4av2ov')}}') format('truetype'),
        url('{{ URL::asset('home/fonts/icomoon.woff?4av2ov')}}') format('woff'),
        url('{{ URL::asset('home/fonts/icomoon.svg?4av2ov#icomoon')}}') format('svg');
        font-weight: normal;
        font-style: normal;
    }
    body,html {

        width: 100%;
        box-sizing: border-box;

        background-color: #eee;
        position: relative;
    }
    .nav {
        background: #009c39;
        padding: 10px 0 6px 0;
        width: 100%;
        position: fixed;
        left: 0;
        bottom: 0;
    }
    .nav ul {
        height: 0px;
    }
    .nav ul li {
        float: left;
        width: 25%;
        text-align: center;
        list-style-type: none;
        margin: 0px;
        padding: 0px;
    }
    .nav ul li span {
        display: block;
        color: #fff;
        font-size: 14px;
        font-family: "微软雅黑";
        line-height: 22px;
    }
</style>
<body class="huibg">
<div class="vipcenter">
    <div class="vipheader">
        <a href="javascript:;">
            <div class="touxiang"><img src="{{ $user->thumb }}" alt=""></div>
            <div class="name">{{ $user->nickname }}</div>
            <div class="gztt" style="margin-top: -10px;">认证会员，已关注</div>
        </a>
    </div>
    {{--<div class="vipsan">
        <div class="col-xs-4 text-center"><a ><h4>等级</h4><p>Vip1</p></a></div>
        <div class="col-xs-4 text-center"><a ><h4>积分</h4><p>1200</p></a></div>
        <div class="col-xs-4 text-center"><a ><h4>领取码</h4><p>3</p></a></div>
    </div>--}}
    <ul class="vipul">
        <li>
            <a href="#">
                <div class="icc"><i class="iconfont icon-xitongmingpian"></i></div>
                <div class="lzz">会员状态</div>
                <div class="rizi lvzi">@if($user->state == 0) <p style="color: green;">正常</p>
                    @else<p style="color: red;">暂停</p>@endif
                </div>
            </a>
        </li>
        <li>
            <a href="{{ url('/my/orders') }}">
                <div class="icc"><i class="iconfont icon-liebiao"></i></div>
                <div class="lzz">订单中心</div>
                <div class="rizi"><i class="iconfont icon-jiantouri"></i></div>
            </a>
        </li>
        {{--<li>
            <a href="userinfo.html">
                <div class="icc"><i class="iconfont icon-yonghux"></i></div>
                <div class="lzz">个人信息</div>
                <div class="rizi"><i class="iconfont icon-jiantouri"></i></div>
            </a>
        </li>--}}
        <li>
            <a href="javascript:;" onclick="addr('我的收货地址','{{ url('/select/addr') }}')">
                <div class="icc"><i class="iconfont icon-chakangonglve"></i></div>
                <div class="lzz">收货地址</div>
                <div class="rizi"><i class="iconfont icon-jiantouri"></i></div>
            </a>
        </li>
    </ul>
</div>
<link rel="stylesheet" type="text/css" href="{{ URL::asset('home/new/css/aui.css') }}"/>
{{--<link rel="stylesheet" href="{{ URL::asset('home/new/css/aui-flex.css') }}">--}}

<footer class="aui-bar aui-bar-tab aui-bar-tab-cl aui-border-t" id="footer">
    <a href="{{ url('/') }}" class="aui-bar-tab-item " tapmode>
        <i class="aui-iconfont aui-icon-home"></i>
        <div class="aui-bar-tab-label">首页</div>
    </a>
    <a class="aui-bar-tab-item" tapmode href="{{ url('/my/orders') }}">
        <i class="aui-iconfont aui-icon-menu"></i>
        <div class="aui-bar-tab-label">我的订单</div>
    </a>
    <a class="aui-bar-tab-item" tapmode href="{{ url('/cart') }}">
        <i class="aui-iconfont aui-icon-cart"></i>
        <div class="aui-bar-tab-label">购物车</div>
    </a>
    <a href="{{ url('/center') }}" class="aui-bar-tab-item" tapmode>
        <i class="aui-iconfont aui-icon-my"></i>
        <div class="aui-bar-tab-label">个人中心</div>
    </a>
</footer>
{{--<script type="text/javascript" src="{{ URL::asset('home/new/script/api.js') }}"></script>--}}
<script type="text/javascript" src="{{ URL::asset('home/new/script/aui-tab.js') }}"></script>
{{--<script type="text/javascript" src="{{ URL::asset('home/new/script/aui-slide.js') }}"></script>--}}
<script>
    function addr(title,url) {
        var index = layer.open({
            type: 2,
            title: title,
            content: url
        });
        layer.full(index);
    }
</script>

</body>
</html>