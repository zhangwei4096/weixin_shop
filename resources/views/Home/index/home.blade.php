<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1, user-scalable=no">
    <title></title>
    <link rel="stylesheet" type="text/css" href="{{ URL::asset('layui/css/layui.css') }}" media="all" />
    <link rel="stylesheet" type="text/css" href="{{ URL::asset('layer/theme/default/layer.css') }}" media="all" />
    <script type="text/javascript" src="{{ URL::asset('layui/layui.js') }}"></script>
    <script type="text/javascript" src="{{ URL::asset('layer/layer.js') }}"></script>
    <script type="text/javascript" src="{{ URL::asset('home/js/jquery.js') }}"></script>
</head>
<style type="text/css">
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

    img {
        vertical-align: middle;
    }

    li {
        list-style: none;
    }
    i {
        font-style: normal;
    }
    .layui-carousel img {
        max-width: 100%;
        height: 200px;
    }
    .shops {
        margin-top: 10px;
        width: auto;
        /*	height: 360px;*/

    }

    .shops li {
        height: 140px;
        /*background-color: red;*/
        display: flex; /*伸缩布局*/

        /*flex-direction: column;  垂直分布*/
    }
    .shops img {
        width: 100%;
        height: 100%;

    }
    .shops li {
        margin-top: 5px;
        border: 2.5px solid  orange;
        border-radius: 5px;
        overflow: hidden;
    }
    .shops li a:first-child {
        flex: 1;
        /*background-color: #fff;*/
    }
    .shops li a:last-child {
        flex: 2;
        display: flex;
        flex-direction: column;
    }
    .shops li a:last-child i {
        flex: 1;
    }
    .shops a {
        font-size: 13px;
        color: red;
    }
    .shops a i:first-child {
        margin: 3px 5px;
        line-height: 20px;
        text-overflow: ellipsis;
        overflow: hidden;
        /*border: 1px solid #fff;*/
    }
    .shops a i:last-child {
        margin: 10px 5px 0px;
        display: flex;
        position: relative;

    }
    .shops i em {
        flex: 1;
        font-style: normal;
        /*border: 1px solid #fff;*/
    }

    .shops i em:last-child {
        text-align: right;

    }
    .js {
        margin-top: 3px;
    }
    .js b {
        border: 1px solid #b6b6b6;
        padding: 2px 2px;
        background-color: #b6b6b6;
        font-size: 12px;
        color: #000;
        font-weight: 700;
    }
    .js input {
        width: 20px;
        outline: none;
        border: 1px solid #fff;
        padding-left: 10px;
    }
    button {
        transform: translateY(100%);
        outline: none;
        border: 1px solid red;
        height: 30px;
        border-radius: 5px;
        font-size: 13px;
        color: #333;
        cursor: pointer;
        padding: 0 5px;
        color: #fff;
        background-color: #ff697a;
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
<body>
<header class="layui-carousel" id="test1">
    <!-- 轮播图 -->
    <div carousel-item>
        <div><img src="./home/images/700e0n000000egwuwE5D3_1536_307_25.jpg" /></div>
        <div><img src="./home/images/700e0n000000egwuwE5D3_1536_307_25.jpg" /></div>
        <div><img src="./home/images/700e0n000000egwuwE5D3_1536_307_25.jpg" /></div>
        <div><img src="./home/images/700e0n000000egwuwE5D3_1536_307_25.jpg" /></div>
        <div><img src="./home/images/700e0n000000egwuwE5D3_1536_307_25.jpg" /></div>
    </div>
</header>

<!-- 商品展示 -->

<ul class="shops">
    @foreach($data as $v)
    <li>
        <a href="#"><img src="{{ $v->thumb }}" /></a>
        <a href="#">
            <i>{{ $v->title }}</i>
            <i>
                <em>
                    <p>市场价：<del> {{$v->sc_price}} 元</del></p>
                    <p>现价： {{ $v->xs_price }} 元</p>
                    <p class="js">
                        <b onclick="add({{ $v->id }})">＋</b>
                        <input type="text" value="1" id="number{{ $v->id }}" name="number" readonly />
                        <b onclick="sub({{ $v->id }})">－</b>
                    </p>
                </em>
                <em>
                    <button onclick="toCart({{ $v->id }})">加入购物车</button>
                </em>
            </i>
        </a>
    </li>
    @endforeach
    @csrf
    {{--<li>
        <a href="#"><img src="./home/images/1.jpg" /></a>
        <a href="#">
            <i>杞里香枸杞子宁夏杞里香枸香枸香枸香枸香枸杞子宁杞里香枸杞</i>
            <i>
                <em>
                    <p>市场价：<del> 100 RMB</del></p>
                    <p>现价： 89 RMB</p>
                    <p class="js">
                        <b onclick="add(2)">＋</b>
                        <input type="text" value="1" id="number2" name="number" readonly />
                        <b onclick="sub(2)">－</b>
                    </p>
                </em>
                <em>
                    <button onclick="toCart(2)">加入购物车</button>
                </em>
            </i>
        </a>
    </li>--}}
</ul>


<div class="nav">
    <ul>
        <li>
            <a href="{{ url('/') }}"><span style="font-family: 'icomoon';"></span><span>首页</span></a>
        </li>
        <li style="position:relative;">
            <a href="{{ url('/my/orders') }}"><span style="font-family: 'icomoon';"></span><span>我的订单</span></a>
        </li>
        <li>
            <a href="{{ url('/cart') }}"><span style="font-family: 'icomoon';"></span><span>购物车</span></a>
        </li>
        <li>
            <a href="{{ url('/center') }}"><span style="font-family: 'icomoon';"></span><span>个人中心</span></a>
        </li>
    </ul>
</div>








<script>
    layui.use('carousel', function(){
        var carousel = layui.carousel;
        //建造实例
        carousel.render({
            elem: '#test1'
            ,width: '100%' //设置容器宽度
            ,height:'200px'
            ,arrow: 'always' //始终显示箭头
            //,anim: 'updown' //切换动画方式
        });
    });

    function add(id){
        //数量的增加
        var num = parseInt(document.getElementById('number'+id).value);
        if (num < 1000) {
            document.getElementById('number'+id).value = num+1;
        }else{
            layer.msg('最大单位为1000');
        }
    }

    function sub(id){
        //数量的减少
        var num = parseInt(document.getElementById('number'+id).value);
        if (num != 1) {
            document.getElementById('number'+id).value = num-1;
        }else{
            layer.msg('最小单位为1');
        }
    }

    function toCart(id){
        //加入购物车
        var num = parseInt(document.getElementById('number'+id).value);
        //执行PSOT请求
        var _token = $('input[name=_token]').val();

        $.ajax({
            type:"POST",
            url:"{{url('/to_cart')}}",
            dataType:"json",
            data:{_token:_token,id:id,num:num},
            beforeSend:function(){
                //some js code
            },
            success:function(result){
                if (result.msg = 'success'){
                    layer.msg('加入购物车成功',function(){
                        document.getElementById('number'+id).value = 1;
                    });
                }else {
                    layer.msg('加入购物车失败，请重试！');
                }
            },
            error:function(){
                layer.msg('加入购物车失败，请稍后再试！');
            }
        })
    }
</script>
</body>
</html>