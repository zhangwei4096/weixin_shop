<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1,user-scalable=no">
    <title>我的购物车</title>
    <link rel="stylesheet" type="text/css" href="{{ URL::asset('home/css/reset.css') }}"/>
    <link rel="stylesheet" type="text/css" href="{{ URL::asset('home/css/index.css') }}"/>
    <link rel="stylesheet" type="text/css" href="{{ URL::asset('layui/css/layui.css') }}" media="all" />
    <link rel="stylesheet" type="text/css" href="{{ URL::asset('layer/theme/default/layer.css') }}" media="all" />
    <script type="text/javascript" src="{{ URL::asset('layui/layui.js') }}"></script>
    <script type="text/javascript" src="{{ URL::asset('layer/layer.js') }}"></script>
    <script type="text/javascript" src="{{ URL::asset('home/js/jquery.js') }}"></script>
</head>
<body>
<!--头部-->
<header>
    购物车<span class="fr">编辑</span>
</header>
<!--头部-->
<!--主题-->
<div class="no">
    <p>暂无数据，快去逛逛吧！</p>
</div>
<div class="con">
    <div class="content">
        <div class="list">
            <div class="fl">
                <label>
                    <input type="checkbox" checked="checked"/>
                    <img src="{{ URL::asset('home/images/c_checkbox_on.png') }}"/>
                </label>
            </div>
            <p>全选</p>
        </div>
        <ul ind="0" id="fruit">
            @foreach($data as $v)
            <li class="clearfix">
                <div class="label fl">
                    <label>
                        <input type="checkbox" checked="checked" value="{{ $v->cid }}"/>
                        <img src="{{ URL::asset('home/images/c_checkbox_on.png') }}"/>
                    </label>
                </div>
                <div class="img fl">
                    <img src="{{ $v->thumb }}"/>
                </div>
                <div class="text fl">
                    <p class="overflow">{{ $v->title }}</p>
                    <p class="clearfix">
                        <span class="fl red">￥{{ $v->xs_price }}</span>
                        <span class="fr">
		    					<input type="button" value="-" class="btn1" id="{{ $v->pid }}" />
		    					<span class="number">{{ $v->num }}</span>
		    					<input type="button" value="+"  class="btn2" id="{{ $v->pid }}" />
		    				</span>
                    </p>
                </div>
            </li>
            @endforeach
            @csrf
        </ul>
        <p class="total">一共<number></number>件商品：<span></span></p>
    </div>
</div>
<!--主题-->
<!--结算-->
<div class="bottom fixed">
    <div class="fl bottom-label">
        <label>
            <input type="checkbox" checked="checked"/>
            <img src="{{ URL::asset('home/images/c_checkbox_on.png') }}" class="fl" />
            全选
        </label>
    </div>
    <div class="fr">
        需要支付：<span></span>
        <button class="sett">结算</button>
    </div>
</div>
<!--结算-->
<!--删除-->
<div class="bottom fixed" style="display: none;">
    <div class="fr">
        <button class="delete">删除</button>
    </div>
</div>
<!--删除-->
<!--弹框-->
<div class="text1 fixed">
    <form>
        <input type="number"/>
        <input type="button"  value="确定"/>
    </form>
</div>
<!--弹框-->
<!--弹框2-->
<div class="alert fixed"></div>
<!--弹框2-->
<script src="{{ URL::asset('home/js/web.js') }}"></script>
<script src="{{ URL::asset('home/js/zepto.js') }}"></script>
<script src="{{ URL::asset('home/js/index.js') }}"></script>
</body>
</html>
