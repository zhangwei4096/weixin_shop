<!DOCTYPE HTML>
<html>
<head>
    <meta charset="utf-8">
    <meta name="renderer" content="webkit|ie-comp|ie-stand">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no" />
    <meta http-equiv="Cache-Control" content="no-siteapp" />
    <!--[if lt IE 9]>
    <script type="text/javascript" src="{{URL::asset('admin/lib/html5.js')}}"></script>
    <script type="text/javascript" src="{{ URL::asset('admin/lib/respond.min.js') }}"></script>
    <![endif]-->
    <link href="{{ URL::asset('admin/static/h-ui/css/H-ui.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ URL::asset('admin/static/h-ui/css/H-ui.login.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ URL::asset('admin/static/h-ui.admin/css/style.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ URl::asset('admin/lib/Hui-iconfont/1.0.8/iconfont.css') }}" rel="stylesheet" type="text/css" />
    <title>后台登录 - {{$title}} v{{$version}}</title>
    <meta name="keywords" content="">
    <meta name="description" content="">
</head>
<body>
<input type="hidden" id="TenantId" name="TenantId" value="" />
<div class="header"></div>
<div class="loginWraper">
    <div id="loginform" class="loginBox">
        <form class="form form-horizontal" action="index.html" method="post">
            <div class="row cl">
                <label class="form-label col-xs-3"><i class="Hui-iconfont">&#xe60d;</i></label>
                <div class="formControls col-xs-8">
                    <input  name="user" type="text" placeholder="账户" class="input-text size-L" />
                </div>
            </div>
            <div class="row cl">
                <label class="form-label col-xs-3"><i class="Hui-iconfont">&#xe60e;</i></label>
                <div class="formControls col-xs-8">
                    <input  name="pwd" type="password" placeholder="密码" class="input-text size-L" />
                </div>
            </div>
            <div class="row cl">
                <div class="formControls col-xs-8 col-xs-offset-3">
                    <input class="input-text size-L" name="code" type="text" placeholder="验证码"  style="width:150px;" />
                    <img id="code" src="{{url('admin/code')}}" width="120" height="41" onclick="this.src='{{url('admin/code')}}?'+Math.random()" />
                    <a href="javascript:;" onclick="document.getElementById('code').src='{{url('admin/code')}}?'+Math.random();">看不清，换一张</a>
                </div>
            </div>

            <div class="row cl">
                <div class="formControls col-xs-8 col-xs-offset-3">
                    <input type="button" class="btn btn-success radius size-L" value="&nbsp;登&nbsp;&nbsp;&nbsp;&nbsp;录&nbsp;">
                    <input type="reset" class="btn btn-default radius size-L" value="&nbsp;取&nbsp;&nbsp;&nbsp;&nbsp;消&nbsp;">
                </div>
            </div>
            @csrf
        </form>
    </div>
</div>
<div class="footer">Copyright {{$title}} by <a href="www.veimx.com" style="color:#ff4814;">巴蜀风博客技术支持</a> v{{$version}}</div>

<script type="text/javascript" src="{{ URL::asset('admin/lib/jquery/1.9.1/jquery.min.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('admin/static/h-ui/js/H-ui.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('layer/layer.js') }}"></script>
<script>
    $('input[type=button]').click(function(){
         var username = $('input[name=user]').val();
         var pwd      = $('input[name=pwd]').val();
         var code     = $('input[name=code]').val();
         var _token   = $('input[name=_token]').val();
         if (username == '' || username == null){
             layer.msg('用户名不能为空');
             return false;
         }
         if (pwd == '' || pwd == null){
            layer.msg('密码不能为空');
            return false;
         }
         if (code == '' || code == null){
            layer.msg('验证码不能为空');
            return false;
         }
         $.post('{{ url('admin/posts') }}',{_token:_token,username:username,pwd:pwd,code:code},function(result){
                if (result.msg == 'error'){
                    layer.msg(result.data);
                }else if (result.msg == 'success'){
                    layer.msg(result.data,function(){
                        location.href='{{ url('admin/code') }}';
                    });

                }
         });

    });


</script>
</body>
</html>