{{--
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
    --}}
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
    </li>--}}{{--

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
</html>--}}

        <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport"
          content="maximum-scale=1.0,minimum-scale=1.0,user-scalable=0,width=device-width,initial-scale=1.0"/>
    <meta name="format-detection" content="telephone=no,email=no,date=no,address=no">
    <title>恒昀达商贸</title>
    <link rel="stylesheet" type="text/css" href="{{ URL::asset('home/new/css/aui.css') }}"/>
    <link rel="stylesheet" href="{{ URL::asset('home/new/css/aui-flex.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('home/new/css/aui-slide.css') }}">
    <style>
        .aui-searchbar {
            background: transparent;
        }

        .aui-bar-nav .aui-searchbar-input {
            background-color: #ffffff;
        }

        .aui-bar-light .aui-searchbar-input {
            background-color: #f5f5f5;
        }

        .bg-dark {
            background: #333333 !important;
        }

        .aui-slide-node img {
            width: 100%;
            height: 100%;
        }

        .aui-grid .aui-row-img-wt i {
            width: 38px;
            height: 38px;
            display: inline-block;
            margin: 0 auto
        }

    </style>
</head>
<body style="background:none">

<header class="aui-bar aui-bar-nav">
    <a class="aui-pull-left aui-btn">
        <!-- <span class="aui-iconfont aui-icon-camera"></span> -->
    </a>
    {{--<div class="aui-title" style="left:2rem; right: 2rem;">
        <div class="aui-searchbar" id="search">
            <div class="aui-searchbar-input aui-border-radius">
                <i class="aui-iconfont aui-icon-search"></i>
                <input type="search" placeholder="人参特卖会" id="search-input">
                <div class="aui-searchbar-clear-btn">
                    <i class="aui-iconfont aui-icon-close"></i>
                </div>
            </div>
            <div class="aui-searchbar-btn" tapmode>取消</div>
        </div>
    </div>--}}
    <div class="aui-title">重庆恒昀达商贸</div>
    <a class="aui-pull-right aui-btn">
        <span class="aui-iconfont aui-icon-comment"></span>
    </a>
</header>

<div>
    <img src="{{ $img }}" alt="">
</div>

<!-- 轮播图 -->
<div id="aui-slide">
    <div class="aui-slide-wrap">
        @foreach($loop as $v)
        <div class="aui-slide-node bg-dark">
            <img src="{{ $v }}"/>
        </div>
        @endforeach
    </div>
    <div class="aui-slide-page-wrap"><!--分页容器--></div>
</div>


<div style="height:10px; background:#efefef"></div>
<div class="aui-content">
    <ul class="aui-list aui-media-list">

        @foreach($data as $v)
            <li class="aui-list-item">
                <a href="{{ url('/product') }}/{{ $v->id }}">
                    <div class="aui-media-list-item-inner">
                        <div class="aui-list-item-inner">
                            <div class="aui-list-item-text">
                                <div class="aui-list-item-title aui-font-size-18">{{ $v->title }}</div>
                            </div>
                            <div class="aui-info aui-padded-b-0">
                                <div class="aui-info-item aui-font-size-12">
                                    <span class="aui-margin-l-5">￥{{ $v->xs_price }}</span>
                                </div>
                                <div class="aui-info-item aui-font-size-12">好评率100%</div>
                            </div>
                        </div>
                        <div class="aui-list-item-media">
                            <img src="{{ $v->thumb }}">
                        </div>
                    </div>
                </a>
            </li>
        @endforeach
        {{--<li class="aui-list-item">
            <div class="aui-media-list-item-inner">
                <div class="aui-list-item-inner">
                    <div class="aui-list-item-text">
                        <div class="aui-list-item-title aui-font-size-18"><i class="product-name">全球购</i>意大利进口 mellin美林
                            宝宝手指饼干宝宝零食饼干 360g 手指饼干 4M+
                        </div>
                    </div>
                    <div class="aui-info aui-padded-b-0">
                        <div class="aui-info-item aui-font-size-12">
                            <span class="aui-margin-l-5">￥45.00</span>
                        </div>
                        <div class="aui-info-item aui-font-size-12">好评率100%</div>
                    </div>
                </div>
                <div class="aui-list-item-media">
                    <img src="{{ URL::asset('home/new/image/demo/pa4.jpg') }}">
                </div>
            </div>
        </li>--}}
    </ul>
</div>
<div style="padding:0.75rem 0.75rem 0 0.75rem"></div>

<div style="height:48px"></div>
<div id="demo" style="display:none">1</div>
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

</body>
<script type="text/javascript" src="{{ URL::asset('home/new/script/api.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('home/new/script/aui-tab.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('home/new/script/aui-slide.js') }}"></script>
<script type="text/javascript">
    var slide = new auiSlide({
        container: document.getElementById("aui-slide"),
        // "width":300,
        "height": 185,
        "speed": 300,
        "autoPlay": 5000, //自动播放时间
        "pageShow": true,
        "loop": true,
        "pageStyle": 'dot',
        'dotPosition': 'center'
    })

    function currentFun(index) {
        console.log(index);
    }

    var slide2 = new auiSlide({
        container: document.getElementById("aui-slide2"),
        // "width":300,
        "height": 220,
        "speed": 300,
        "autoPlay": 0, //自动播放
        "pageShow": true,
        "loop": true,
        "pageStyle": 'dot',
        'dotPosition': 'center'
    })
    var slide3 = new auiSlide({
        container: document.getElementById("aui-slide3"),
        // "width":300,
        "height": 240,
        "speed": 500,
        "autoPlay": 3000, //自动播放
        "loop": true,
        "pageShow": true,
        "pageStyle": 'line',
        'dotPosition': 'center'
    })
    console.log(slide3.pageCount());
</script>

</html>



