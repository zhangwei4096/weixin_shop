{{--我的订单中心页面--}}
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
    <link rel="stylesheet" href="{{ URL::asset('layui/css/layui.css') }}" />
    <script src="{{ URL::asset('home/js/jquery.js') }}"></script>
    <script src="{{ URL::asset('layer/layer.js') }}"></script>
    <script src="{{ URL::asset('home/js/bootstrap.min.js') }}"></script>
    <!--必要样式-->
    <link rel="stylesheet" type="text/css" href="{{ URL::asset('home/css/menu_elastic.css') }}"/>
</head>
<style type="text/css">
    .nav li {
        width: 33.33%;
    }

    @font-face {
        font-family: 'icomoon';
        src: url('{{ URL::asset('home/fonts/icomoon.eot?4av2ov')}}');
        src: url('{{ URL::asset('home/fonts/icomoon.eot?4av2ov#iefix')}}') format('embedded-opentype'),
        url('{{ URL::asset('home/fonts/icomoon.ttf?4av2ov')}}') format('truetype'),
        url('{{ URL::asset('home/fonts/icomoon.woff?4av2ov')}}') format('woff'),
        url('{{ URL::asset('home/fonts/icomoon.svg?4av2ov#icomoon')}}') format('svg');
        font-weight: normal;
        font-style: normal;
    }
</style>
<body class="huibg">


<nav class="navbar text-center">
    <button class="topleft" onclick="javascript:location.href='{{ url('/') }}';">
        <span style="font-family: 'icomoon'; font-size: 26px;"></span>
    </button>
    <a class="navbar-tit center-block">订单中心</a>
    <button class="topnav" id="open-button">
        <span class="iconfont icon-1"></span>
    </button>
</nav>
<br/>
<ul id="myTab" class="nav nav-tabs ">
    <li class="active"><a href="#sp1" data-toggle="tab">未完成</a></li>
    <li><a href="#sp2" data-toggle="tab">待发货</a></li>
    <li><a href="#sp3" data-toggle="tab">已完成</a></li>
</ul>
@csrf
<div id="myTabContent" class="tab-content">
    <div class="tab-pane fade in active" id="sp1"> {{--未完成--}}
        <ul class="ddlist">
            @foreach($n_pay as $v)
                <li style="position: relative;">
                    <a href="{{ url('/my/orders',[$v->id]) }}">
                        <p>订单时间：{{ $v->order_time }}</p>
                        <p>订单号：{{ $v->order_id }}</p>
                        <p>
                            商品:@foreach(json_decode($v->order_info,true) as $k) {{ $k['title'].' X '.$k['num'].'，' }} @endforeach</p>
                        <p><span>价格：{{ $v->order_price }} 元</span></p>
                        <p>状态：<span style="color: red"> 未支付 </span></p>
                    </a>
                    <button class="layui-btn layui-btn-danger" value="{{ $v->id }}" style="cursor: pointer;position: absolute; top: 35px;right: 3px;" >删除</button>
                </li>

            @endforeach
        </ul>
    </div>

    <script>
        window.onload=function(){
          var buttons = document.getElementsByClassName('layui-btn');
          for (var i=0;i<buttons.length;i++){
              buttons[i].onclick=function(){
                  if(window.confirm('你确定要删除订单吗？')){
                      var id = this.value;
                      var _token= $('input[name=_token]').val();
                      $.post("{{ url('/my/orders/del') }}",{id:id,_token:_token},function(result){
                          if (result.msg=='success'){
                              //buttons[index].parentNode.remove();
                              layer.msg('删除成功',{icon:1,time:1500},function () {
                                  $('button[value='+id+']').parent().remove();
                              })
                          }else {
                              layer.msg(result.data,{icon:5,time:2000});
                          }
                      });

                      return true;
                  }else{

                      return false;
                  }

              }
          }
        }

    </script>

    <div class="tab-pane fade" id="sp2"> {{--待发货--}}
        <ul class="ddlist">
            @foreach($y_pay as $v)
                <li>
                    <a href="{{ url('/my/orders',[$v->id]) }}">
                        <p>订单时间：{{ $v->order_time }}</p>
                        <p>订单号：{{ $v->order_id }}</p>
                        <p>
                            商品:@foreach(json_decode($v->order_info,true) as $k) {{ $k['title'].' X '.$k['num'].'，' }} @endforeach</p>
                        <p><span>价格：{{ $v->order_price }} 元</span></p>
                        <p>状态：<span style="color: yellow"> 待发货 </span></p>
                    </a>
                </li>
            @endforeach
        </ul>
    </div>

    <div class="tab-pane fade" id="sp3"> {{--已完成--}}
        <ul class="ddlist">
            @foreach($w_pay as $v)
                <li>
                    <a href="{{ url('/my/orders',[$v->id]) }}">
                        <p>订单时间：{{ $v->order_time }}</p>
                        <p>订单号：{{ $v->order_id }}</p>
                        <p>
                            商品:@foreach(json_decode($v->order_info,true) as $k) {{ $k['title'].' X '.$k['num'].'，' }} @endforeach</p>
                        <p><span>价格：{{ $v->order_price }} 元</span></p>
                        <p>状态：<span style="color: green"> 已完成 </span></p>
                    </a>
                </li>
            @endforeach
        </ul>
    </div>

</div>
</body>
</html>