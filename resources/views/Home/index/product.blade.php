<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport"
          content="maximum-scale=1.0,minimum-scale=1.0,user-scalable=0,width=device-width,initial-scale=1.0"/>
    <meta name="format-detection" content="telephone=no,email=no,date=no,address=no">
    <link rel="stylesheet" type="text/css" href="{{ URL::asset('layui/css/layui.css') }}" media="all"/>
    <script type="text/javascript" src="{{ URL::asset('layui/layui.js') }}"></script>
    <script type="text/javascript" src="{{ URL::asset('layer/layer.js') }}"></script>
    <link rel="stylesheet" type="text/css" href="{{ URL::asset('layer/theme/default/layer.css') }}" media="all"/>
    <script type="text/javascript" src="{{ URL::asset('home/new/script/api.js') }}"></script>
    <script type="text/javascript" src="{{ URL::asset('home/new/script/aui-popup-new.js') }}"></script>
    <script type="text/javascript" src="{{ URL::asset('home/new/script/aui-slide.js') }}"></script>
    <script type="text/javascript" src="{{ URL::asset('home/new/script/aui-collapse.js') }}"></script>
    <script src="{{ URL::asset('home/new/script/jquery.min.js') }}"></script>
    <script src="{{ URL::asset('home/new/script/ratchet.min.js') }}"></script>
    <title>恒昀达商贸</title>
    <style type="text/css">
        .aui-bar-tab {
            position: static;
        }

        .search-input {
            height: 1.6rem;
            line-height: 1.6rem;
            background: #f5f5f5;
            border-radius: 30px;
            position: relative;
            font-family: "aui_iconfont" !important;
            text-align: left;
            padding-left: 1.5rem;
            color: #999999;
        }

        .search-input:after {
            position: absolute;
            left: 0;
            padding-left: 0.5rem;
            content: "\e610";
        }
    </style>
    <link rel="stylesheet" type="text/css" href="{{ URL::asset('home/new/css/aui.css') }}"/>
    <link rel="stylesheet" href="{{ URL::asset('home/new/css/aui-slide.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('home/new/css/pop.css') }}">
</head>
<body style="background:#fff">
<header class="aui-bar aui-bar-nav">
    <a class="aui-pull-left aui-btn" onClick="javascript :history.back(-1);">
        <span class="aui-iconfont aui-icon-left" style="font-weight:800"></span>
    </a>
    <div class="aui-title">商品详情</div>
    {{--<a class="aui-pull-right aui-btn">
        <span class="aui-iconfont aui-icon-more" tapmode onclick="showPopup('top-right')"
              style="display:block; height:40px; line-height:40px;"></span>
    </a>--}}
</header>
<div id="aui-slide2">
    {{--轮播图--}}
    <div class="aui-slide-wrap">
        @foreach($img as $v)
        <div class="aui-slide-node aui-slide-node-middle aui-slide-node-center">
            <img src="{{ $v }}" alt="轮播图" title="轮播图">
        </div>
        @endforeach
    </div>
    <div class="aui-slide-page-wrap">
        <!--分页容器-->
    </div>
</div>
<div class="aui-title-text ">
    <a href="#">
        <h2>
            {{--<span>促销</span>--}}
            {{ $data->title }}
        </h2>
    </a>
    <div style="font-size:18px; font-weight:800; color:#f34347">￥{{ $data->xs_price }}
    </div>
</div>
<div class="div-border t-line"></div>

<section id="s-rate" data-spm=""></section>

<div class="div-border "></div>
<div class="wrap" id="wrap">

    <div class="lineBorder">
        <div class="lineDiv">
            <!--移动的div-->
            @csrf
        </div>
    </div>
    <div class="tabCon">
        <div class="tabBox">
            <div class="tabList">
                <div style="margin-top:10px;">
                    {{--<img src="{{ URL::asset('home/new/image/sspp2.jpg') }}" alt="">--}}
                    {!! $data->content !!}
                </div>
            </div>
        </div>
    </div>
</div>
<div style="height:52px"></div>
<!-- 弹出 -->

<!-- 弹出 -->
<footer class="aui-bar aui-bar-tab aui-margin-t-15  aui-border-t">
    <div class="aui-bar-tab-item" tapmode style="width: 3rem;cursor: pointer;" onclick="window.location.href='{{ url('/cart') }}' ">

        <i class="aui-iconfont aui-icon-cart aui-text-info"></i>
        <div class="aui-bar-tab-label aui-text-info">
            购物车
        </div>

    </div>
    <div class="aui-bar-tab-item" tapmode style="width: 3rem;cursor: pointer;">
        <a href="tel:15567599555">
            <i class="aui-iconfont aui-icon-comment aui-text-info"></i>
            <div class="aui-bar-tab-label aui-text-info">
                咨询客服
            </div>
        </a>
    </div>
    <div class="aui-bar-tab-item aui-bg-warning aui-text-white" tapmode style="width: auto; cursor: pointer"
         onclick="toCart({{ $data->id }})">加入购物车
    </div>
    {{--<div class="aui-bar-tab-item aui-bg-danger aui-text-white" tapmode style="width: auto;">立即购买</div>--}}
</footer>
<script src="http://res.wx.qq.com/open/js/jweixin-1.2.0.js"></script>
<script charset="utf-8">

    wx.onMenuShareAppMessage({
        title: '{{ $data->title }}', // 分享标题
        desc: '我分享了个商品给你', // 分享描述
        link: '{{ url('/product') }}', // 分享链接，该链接域名或路径必须与当前页面对应的公众号JS安全域名一致
        imgUrl: '{{ $data->thumb }}', // 分享图标
        type: '不填默认为link', // 分享类型,music、video或link，不填默认为link
        dataUrl: '', // 如果type是music或video，则要提供数据链接，默认为空
        success: function () {
// 用户点击了分享后执行的回调函数
        }
    });

    function toCart(id) {
        //加入购物车
        //var num = parseInt(document.getElementById('number'+id).value);
        var num = parseInt(1);
        //执行PSOT请求
        var _token = $('input[name=_token]').val();

        $.ajax({
            type: "POST",
            url: "{{url('/to_cart')}}",
            dataType: "json",
            data: {_token: _token, id: id, num: num},
            beforeSend: function () {
                //some js code
            },
            success: function (result) {
                if (result.msg = 'success') {
                    layer.msg('加入购物车成功', {time: 2000, icon: 1});
                } else {
                    layer.msg('加入购物车失败，请重试！');
                }
            },
            error: function () {
                layer.msg('加入购物车失败，请稍后再试！', {time: 2000, icon: 5});
            }
        })
    }

    window.onload = function () {

        //加入购物车

        var windowWidth = document.body.clientWidth;
        //window 宽度;
        var wrap = document.getElementById('wrap');
        var tabClick = wrap.querySelectorAll('.tabClick')[0];
        var tabLi = tabClick.getElementsByTagName('li');

        var tabBox = wrap.querySelectorAll('.tabBox')[0];
        var tabList = tabBox.querySelectorAll('.tabList');

        var lineBorder = wrap.querySelectorAll('.lineBorder')[0];
        var lineDiv = lineBorder.querySelectorAll('.lineDiv')[0];

        var tar = 0;
        var endX = 0;
        var dist = 0;

        tabBox.style.overflow = 'hidden';
        tabBox.style.position = 'relative';
        tabBox.style.width = windowWidth * tabList.length + "px";

        for (var i = 0; i < tabLi.length; i++) {
            tabList[i].style.width = windowWidth + "px";
            tabList[i].style.float = 'left';
            tabList[i].style.float = 'left';
            tabList[i].style.padding = '0';
            tabList[i].style.margin = '0';
            tabList[i].style.verticalAlign = 'top';
            tabList[i].style.display = 'table-cell';
        }

        for (var i = 0; i < tabLi.length; i++) {
            tabLi[i].start = i;
            tabLi[i].onclick = function () {
                var star = this.start;
                for (var i = 0; i < tabLi.length; i++) {
                    tabLi[i].className = '';
                }
                ;tabLi[star].className = 'active';
                init.lineAnme(lineDiv, windowWidth / tabLi.length * star)
                init.translate(tabBox, windowWidth, star);
                endX = -star * windowWidth;
            }
        }

        function OnTab(star) {
            if (star < 0) {
                star = 0;
            } else if (star >= tabLi.length) {
                star = tabLi.length - 1
            }
            for (var i = 0; i < tabLi.length; i++) {
                tabLi[i].className = '';
            }
            ;
            tabLi[star].className = 'active';
            init.translate(tabBox, windowWidth, star);
            endX = -star * windowWidth;
        }
        ;
        tabBox.addEventListener('touchstart', chstart, false);
        tabBox.addEventListener('touchmove', chmove, false);
        tabBox.addEventListener('touchend', chend, false);

        //按下
        function chstart(ev) {
            ev.preventDefault;
            var touch = ev.touches[0];
            tar = touch.pageX;
            tabBox.style.webkitTransition = 'all 0s ease-in-out';
            tabBox.style.transition = 'all 0s ease-in-out';
        }
        ;//滑动
        //        function chmove(ev){
        //            var stars = wrap.querySelector('.active').start;
        //            ev.preventDefault;
        //            var touch = ev.touches[0];
        //            var distance = touch.pageX-tar;
        //            dist = distance;
        //            init.touchs(tabBox,windowWidth,tar,distance,endX);
        //            init.lineAnme(lineDiv,-dist/tabLi.length-endX/4);
        //        };
        //离开
        function chend(ev) {
            var str = tabBox.style.transform;
            var strs = JSON.stringify(str.split(",", 1));
            endX = Number(strs.substr(14, strs.length - 18));

            if (endX > 0) {
                init.back(tabBox, windowWidth, tar, 0, 0, 0.3);
                endX = 0
            } else if (endX < -windowWidth * tabList.length + windowWidth) {
                endX = -windowWidth * tabList.length + windowWidth
                init.back(tabBox, windowWidth, tar, 0, endX, 0.3);
            } else if (dist < -windowWidth / 3) {
                OnTab(tabClick.querySelector('.active').start + 1);
                init.back(tabBox, windowWidth, tar, 0, endX, 0.3);
            } else if (dist > windowWidth / 3) {
                OnTab(tabClick.querySelector('.active').start - 1);
            } else {
                OnTab(tabClick.querySelector('.active').start);
            }
            var stars = wrap.querySelector('.active').start;
            init.lineAnme(lineDiv, stars * windowWidth / 4);

        }
        ;
    }
    ;

    var init = {
        translate: function (obj, windowWidth, star) {
            obj.style.webkitTransform = 'translate3d(' + -star * windowWidth + 'px,0,0)';
            obj.style.transform = 'translate3d(' + -star * windowWidth + ',0,0)px';
            obj.style.webkitTransition = 'all 0.3s ease-in-out';
            obj.style.transition = 'all 0.3s ease-in-out';
        },
        touchs: function (obj, windowWidth, tar, distance, endX) {
            obj.style.webkitTransform = 'translate3d(' + (distance + endX) + 'px,0,0)';
            obj.style.transform = 'translate3d(' + (distance + endX) + ',0,0)px';
        },
        lineAnme: function (obj, stance) {
            obj.style.webkitTransform = 'translate3d(' + stance + 'px,0,0)';
            obj.style.transform = 'translate3d(' + stance + 'px,0,0)';
            obj.style.webkitTransition = 'all 0.1s ease-in-out';
            obj.style.transition = 'all 0.1s ease-in-out';
        },
        back: function (obj, windowWidth, tar, distance, endX, time) {
            obj.style.webkitTransform = 'translate3d(' + (distance + endX) + 'px,0,0)';
            obj.style.transform = 'translate3d(' + (distance + endX) + ',0,0)px';
            obj.style.webkitTransition = 'all ' + time + 's ease-in-out';
            obj.style.transition = 'all ' + time + 's ease-in-out';
        },
    }
</script>
<script type="text/javascript">


    $(function () {
        $(".clickwn").click(function () {
            $(".flick-menu-mask").show();
            $(".spec-menu").show();
        })

        $(".tclck").click(function () {
            $(".flick-menu-mask").hide();
            $(".spec-menu").hide();
        })

        /* $("#cool").focus(function(){
         var oi = $('#cool').val();

         $('.amount').html(oi)
         });*/

        $('#cool').bind('input propertychange', function () {
            /* alert(this.value);*/
            $('.amount').html(this.value)

        }).bind('input input', function () {

        });


        $('#color a').click(function () {
            var cook = $(this).index();
            $('#color a').eq(cook).addClass('selected').siblings().removeClass('selected');
        })

        $('#color1 a').click(function () {
            var cook = $(this).index();
            $('#color1 a').eq(cook).addClass('selected').siblings().removeClass('selected');
        })


        //加减面板
        $(function () {
            //加号
            $(".jia").click(function () {

                var $parent = $(this).parent(".num");
                var $num = window.Number($(".inputBorder", $parent).val());
                $(".inputBorder", $parent).val($num + 1);

                $('.amount').html($num + 1)

            });

            //减号
            $(".jian").click(function () {
                var $parent = $(this).parent(".num");
                var $num = window.Number($(".inputBorder", $parent).val());
                if ($num > 2) {
                    $(".inputBorder", $parent).val($num - 1);
                    $('.amount').html($num - 1)

                } else {
                    $(".inputBorder", $parent).val(1);
                    $('.amount').html($num)


                }
            });

        })


    })


</script>
<script type="text/javascript">

    apiready = function () {
        api.parseTapmode();
    }
    var collapse = new auiCollapse({
        autoHide: false //是否自动隐藏已经展开的容器
    });

</script>
<script type="text/javascript">

    var popup = new auiPopup();

    function showPopup(location) {
        popup.init({
            frameBounces: true,//当前页面是否弹动，（主要针对安卓端）
            location: location,//位置，top(默认：顶部中间),top-left top-right,bottom,bottom-left,bottom-right
            buttons: [{
                image: 'image/share/wx.png',
                text: '微信',
                value: 'wx'//可选
            }, {
                image: 'image/share/wx-circle.png',
                text: '朋友圈',
                value: 'wx-circle'
            }, {
                image: 'image/share/qq.png',
                text: 'QQ好友',
                value: 'qq'
            }, {
                image: 'image/share/qzone.png',
                text: 'QQ空间',
                value: 'qq-qzone'
            }, {
                image: 'image/share/sina-weibo.png',
                text: '新浪微博'
            }],
        }, function (ret) {
            if (ret) {
                document.getElementById("button-index").textContent = ret.buttonIndex;
                document.getElementById("button-value").textContent = ret.buttonValue;
            }
        })
    }

</script>
<script type="text/javascript">

    var slide = new auiSlide({
        container: document.getElementById("aui-slide"),
        // "width":300,
        "height": 260,
        "speed": 300,
        "pageShow": true,
        "pageStyle": 'dot',
        "loop": true,
        'dotPosition': 'center',
        currentPage: currentFun
    })

    function currentFun(index) {
        //console.log(index);
    }

    var slide2 = new auiSlide({
        container: document.getElementById("aui-slide2"),
        // "width":300,
        "height": 290,
        "speed": 300,
        "autoPlay": 4000, //自动播放
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
</body>
</html>
