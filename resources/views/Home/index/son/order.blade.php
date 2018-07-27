<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1,user-scalable=no">
    <title>填写订单</title>
    <link rel="stylesheet" type="text/css" href="{{ URL::asset('home/css/reset.css') }}"/>
    <link rel="stylesheet" type="text/css" href="{{ URL::asset('home/css/index.css') }}"/>
    <link rel="stylesheet" type="text/css" href="{{ URL::asset('layui/css/layui.css') }}" media="all" />
    <link rel="stylesheet" type="text/css" href="{{ URL::asset('layer/theme/default/layer.css') }}" media="all" />
    <script type="text/javascript" src="{{ URL::asset('layui/layui.js') }}"></script>
    <script type="text/javascript" src="{{ URL::asset('layer/layer.js') }}"></script>
    <script type="text/javascript" src="{{ URL::asset('home/js/jquery.js') }}"></script>
</head>
<style type="text/css">
    i {
        font-style: normal;
    }

    .flex {
        display: flex;
        flex-direction: column;
        border: 1px solid gray;
        border-top: none;
        box-shadow: 0 2px 1px rgba(0,0,0,.3);
        padding-left: 8px;
        width: 100%;
        position: relative;
    }
    .flex p {
        flex: 1;
        height: 39px;
        line-height: 39px;
    }
    .padding {
        padding-left: 8px;:
    }
</style>
<body>
<!--头部-->
<header style="background-color: #ff697a; color: #fff;">
    <a href="javascript:;" style="float: left; color: #fff; font-size: 48px;font-weight: 400;" onclick="javascript:history.back(-1);"> < </a>填写订单
</header>
<div class="con">
    <div>
        @if(count($addrs) > 0)
            @foreach($addrs as $v)
                <div class="flex" style="cursor: pointer;" onclick="addr_add('选择收货地址','{{ url('/select/addr') }}')">
                   <p>
                       <strong>{{ $v->name }} &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{ $v->phone }}</strong>
                       <input type="hidden" name="addrsid" value="{{ $v->id }}" />
                   </p>
                   <p>
                       <i style="font-size: 18px;">{{ $v->province }}{{ $v->city }} {{ $v->district }} {{ $v->more }}</i>
                   </p>
                   <i style="font-family:'icomoon';color: #ff697a;position: absolute; top: 19px; right: 15px;">  </i>
                </div>
            @endforeach
        @else
        <div class="flex">
            <p style="color: red;text-align: center;"
               onclick="addr_add('添加收货地址','{{ url('/add/addr') }}')">
                您还没有添加收货地址,点击添加
            </p>
        </div>
        @endif
        <ul ind="0">
            @foreach($data as $v)
                <li class="clearfix padding">
                    <div class="img fl">
                        <img src="{{ $v->thumb }}"/>
                    </div>
                    <div class="text fl">
                        <p class="overflow">{{ $v->title }}</p>
                        <p class="clearfix">
                            <span class="fl red">￥{{ $v->xs_price }}</span>
                            <span class="fr red">
                                <span>X {{ $v->num }} = ￥{{ $v->xs_price *  $v->num }} </span>
                            </span>
                        </p>
                    </div>
                </li>
            @endforeach
        </ul>
    </div>
</div>
<div class="bottom fixed">
    <div class="fl bottom-label">
        <label>
            <a href="javascript:;" onclick="javascript:history.back(-1);">我要修改</a>
        </label>
    </div>
    @csrf
    <div class="fr">
        需要支付：<span>￥ {{$price}}</span>
        <button onclick="send('{{ $cid }}')" class="sett" style="cursor: pointer;">确认提交</button>
    </div>
</div>
<script src="{{ URL::asset('home/js/web.js') }}"></script>
<script type="text/javascript">
    function addr_add(title,url){
        var index = layer.open({
            type: 2,
            title:title,
            content:url,
            end:function(){
                location.reload();
            }
        });
        layer.full(index);
    }

    
    function send(cid) {
        var _token = $('input[name=_token]').val();
        var addrsid= $('input[name=addrsid]').val();
        if (addrsid==null || addrsid == ''){
            layer.msg('请选择收货地址谢谢！');
            return false;
        }
        $.ajax({
            type:"POST",
            url:"/to_order",
            dataType:"json",
            data:{_token:_token,cid:cid,addrsid:addrsid},
            beforeSend:function(){
                //some js code
            },
            success:function(result){
                if (result.msg = 'success'){
                    location.href='{{ url('/pay') }}/'+result.order; //支付页面
                }else {
                    layer.msg('结算失败，请重试！');
                }
            },
            error:function(){
                layer.msg('结算失败，请稍后再试！');
            }
        });
    }
</script>
</body>
</html>