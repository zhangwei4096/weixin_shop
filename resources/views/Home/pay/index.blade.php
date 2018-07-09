{{--订单支付页面--}}
        <!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <title>支付订单</title>
    <script type="text/javascript" src="{{ URL::asset('home/js/jquery.js') }}"></script>
    <style type="text/css">
        html {
            font-size: 125%; /* 20梅16=125% min-font-size:12px bug*/
        }
        @media only screen and (min-width: 481px) {
            html {
                font-size: 188%!important; /* 30.08梅16=188% */
            }
        }
        @media only screen and (min-width: 561px) {
            html {
                font-size: 218%!important; /* 38.88梅16=218% */
            }
        }
        @media only screen and (min-width: 641px) {
            html {
                font-size: 250%!important; /* 40梅16=250% */
            }
        }
        body, div, span, applet, object, iframe, h1, h2, h3, h4, h5, h6, p, blockquote, pre, a, abbr, acronym, address, big, cite, code, del, dfn, em, img, ins, kbd, q, s, samp, small, strike, strong, tt, var, b, u, i, center, dl, dt, dd, ol, ul, li, fieldset, form, label, legend, table, caption, tbody, tfoot, thead, tr, th, td, article, aside, canvas, details, embed, figure, figcaption, footer, header, hgroup, menu, nav, output, ruby, section, summary, time, mark, audio, video {
            margin: 0;padding: 0;border: 0;font-size: 1em;font: inherit;vertical-align: baseline;font-family: "Microsoft YaHei"}
        body {font-family: "Microsoft YaHei";font-size: 0.7rem;color: #333;line-height: 0.7rem;width: 100%;background: #f2f2f2;}
        em {font-style: normal}
        li {list-style: none}
        a {text-decoration: none;outline: 0;color: #333;}
        .center{ text-align:center}

        /*************************************页面开始************************************/
        header{background: #3bc25c;width: 100%;height: 2.5rem;line-height: 2.5rem;text-align: center;font-size: 0.9rem;position: fixed;left: 0;top: 0;z-index: 97;border-bottom:1px solid #efefef; }
        header ._left {display: block;position: absolute;left: 0;top: 0;}
        header ._left img {height: 1rem;margin:0 0 0 0.6rem;}
        header ._right {display: block;position: absolute;right: 0.6rem;top: 0; font-size:0.8rem; color:#f00}
        header ._right a{ color:#fff}
        header span{ color:#fff}

        .contaniner {width: 100%; margin-top:2.5rem}
        img {border: 0;vertical-align: middle;}
        .textfl { text-align:left}
        .textfr { text-align:right}

        /**** 支付订单 ****/
        .pay_img{ width:100%;}
        .pay_img img{ width:100%;}
        .payTime{ width:100%; background:#fff; margin-bottom:10px; font-size:12px; color:#999; font-weight:300;  }
        .payTime li{ width:100%; height:30px; line-height:30px; text-align:center}
        .payTime strong{ font-size:24px; color:#333}
        .payTime span{ font-size:14px}

        .pay { width:100%; height:300px; position:relative; }
        .show{ width:100%; position:absolute; top:0; left:0}
        .show li{ width:100%; height:60px; line-height:60px;list-style:none; background:#fff;border-bottom:1px solid #eee}
        .show img{ width:40px; height:40px; margin-left:10px; margin-right:10px;}
        .show input[type="radio"]{display:none;}
        .show input[type="radio"] + span{border:1px solid #CCCCCC;border-radius:20px;width:20px; height:20px; float:right; margin-top:20px;margin-right:20px;}
        .show input[type="radio"]:checked + span{border:1px solid #66c068;border-radius:20px;background:url({{ URL::asset('home/images/checkbox-on.png')}}) no-repeat;background-size: 20px 20px;}

        .showList{ width:100%; position:absolute; top:183px; left:0}
        .showList li{ width:100%; height:60px; line-height:60px; list-style:none; background:#fff;border-bottom:1px solid #eee}
        .showList img{ width:40px; height:40px; margin-left:10px; margin-right:10px;}
        .showList input[type="radio"]{display:none;}
        .showList input[type="radio"] + span{border:1px solid #ccc;border-radius:20px;width:20px; height:20px; float:right; margin-top:20px;margin-right:20px;}
        .showList input[type="radio"]:checked + span{border:1px solid #66c068;border-radius:20px;background:url({{ URL::asset('home/images/checkbox-on.png')}}) no-repeat;background-size: 20px 20px;}

        label{width: 100%;height: 60px;display: inline-block;}


        .book-recovery-bot2{ width: 100%; position:fixed; bottom: 0;left: 0; height: 60px; line-height: 60px;background:#65bf67;}
        .book-recovery-bot2 div{ width: 100%; height: 100%; float: left;}
        .book-recovery-bot2 a{ color: #fff;font-size: 0.75rem; text-align: center; display: block;}

        .payBottom{ width:100%; height:60px; line-height:60px; text-align:center; background:#65bf67; color:#fff; position:absolute; bottom:0; left:0; font-size:16px}
        .payBottom li{ width:50%; height:60px; float:left}
        .payBottom span{ font-size:24px; margin-top:10px}
    </style>
</head>

<body>
<!--头部  star-->
<header style="color:#fff">
    <a href="javascript:history.go(-1);">
        <div class="_left"><img src="{{ URL::asset('home/images/left.png')}}"></div><span>支付订单</span></a>
</header>
<!--头部 end-->
<!--内容 star-->
<div class="contaniner fixed-cont">
    <div class="pay_img"><img src="{{ URL::asset('home/images/pay.jpg')}}"></div>

    <div class="payTime">
        {{--<li><span>剩余时间14:56</span></li>--}}
        <li><strong>总价：¥{{ $pay->order_price }}</strong></li>
        <li>订单号：{{ $pay->order_id }}</li>
    </div>

    <!--支付 star-->
    <div class="pay">
        <div class="show">
            <li><label><img src="{{ URL::asset('home/images/weixin.png') }}" >微信支付<input name="pay_type" type="radio" value="1" checked/><span></span></label> </li>
            <li><label><img src="{{ URL::asset('home/images/zhifubao.png') }}" >支付宝支付<input name="pay_type" type="radio" value="2" /><span></span></label> </li>
            {{--<li><label><img src="{{ URL::asset('home/images/yue.png') }}" >余额支付<input name="Fruit" type="radio" value="" /><span></span></label> </li>--}}
            {{--<li class="center"><a href="#" onClick="showHideCode()">查看更多支付方式↓</a></li>--}}
        </div>
        {{--<div class="showList" id = "showdiv" style="display:none;">--}}
            {{--<li><label><img src="{{ URL::asset('home/images/yinhang.png') }}" >银行卡<input name="Fruit" type="radio" value="" /><span></span></label> </li>--}}
            {{--<li><label><img src="{{ URL::asset('home/images/weixin.png') }}" >添加更多<input name="Fruit" type="radio" value=""/><span></span></label> </li>--}}

            {{--<li style="background:none" ></li>--}}
        {{--</div>--}}
    </div>
    <!--支付 end-->

@csrf
</div>


<div class="book-recovery-bot2" id="footer">
    <a href="javascript:;" onclick="go_pay();">
        <div class="payBottom">
            <li class="textfr">确认支付：</li>
            <li class="textfl"><span>¥{{ $pay->order_price }}</span></li>
        </div>
    </a>
</div>
<!--内容 end-->


<script type="text/javascript">
    function showHideCode(){
        $("#showdiv").toggle();
    }
    function go_pay() {
        //去支付
        var order_id = '{{ $pay->order_id }}';
        var pay_type = $("input[name='pay_type']:checked").val();
        var _token   = $("input[name='_token']").val();
        location.href= "{{ url('pay_type') }}/"+order_id+'/'+pay_type;
    }
</script>

</body>
</html>