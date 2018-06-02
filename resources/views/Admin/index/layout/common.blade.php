<!--_meta 作为公共模版分离出去-->
<!DOCTYPE HTML>
<html>
<head>
    <meta charset="utf-8">
    <meta name="renderer" content="webkit|ie-comp|ie-stand">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no" />
    <meta http-equiv="Cache-Control" content="no-siteapp" />
    <link rel="Bookmark" href="favicon.ico" >
    <link rel="Shortcut Icon" href="favicon.ico" />
    <!--[if lt IE 9]>
    <script type="text/javascript" src="{{ URL::asset('admin/lib/html5.js') }}"></script>
    <script type="text/javascript" src="{{ URL::asset('admin/lib/respond.min.js') }}"></script>
    <![endif]-->
    <link rel="stylesheet" type="text/css" href="{{ URL::asset('admin/static/h-ui/css/H-ui.min.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ URL::asset('admin/static/h-ui.admin/css/H-ui.admin.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ URL::asset('admin/lib/Hui-iconfont/1.0.8/iconfont.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ URL::asset('admin/static/h-ui.admin/skin/default/skin.css') }}" id="skin" />
    <link rel="stylesheet" type="text/css" href="{{ URL::asset('admin/static/h-ui.admin/css/style.css') }}" />
    <!--/meta 作为公共模版分离出去-->

    <title>后台管理</title>
    <meta name="keywords" content="">
    <meta name="description" content="">
</head>

<body>

<!--_header 作为公共模版分离出去-->
<header class="navbar-wrapper">
    <div class="navbar navbar-fixed-top">
        <div class="container-fluid cl"> <a class="logo navbar-logo f-l mr-10 hidden-xs" href="javascript:;">后台管理</a>
            <span class="logo navbar-slogan f-l mr-10 hidden-xs">v1.0</span>
            <a aria-hidden="false" class="nav-toggle Hui-iconfont visible-xs" href="javascript:;">&#xe667;</a>
            {{--<nav class="nav navbar-nav">
                <ul class="cl">
                    <li class="dropDown dropDown_hover"><a href="javascript:;" class="dropDown_A"><i class="Hui-iconfont">&#xe600;</i> 新增 <i class="Hui-iconfont">&#xe6d5;</i></a>
                        <ul class="dropDown-menu menu radius box-shadow">
                            <li><a href="javascript:;" onclick="article_add('添加资讯','article-add.html')"><i class="Hui-iconfont">&#xe616;</i> 资讯</a></li>
                            <li><a href="javascript:;" onclick="picture_add('添加资讯','picture-add.html')"><i class="Hui-iconfont">&#xe613;</i> 图片</a></li>
                            <li><a href="javascript:;" onclick="product_add('添加资讯','product-add.html')"><i class="Hui-iconfont">&#xe620;</i> 产品</a></li>
                            <li><a href="javascript:;" onclick="member_add('添加用户','member-add.html','','510')"><i class="Hui-iconfont">&#xe60d;</i> 用户</a></li>
                        </ul>
                    </li>
                </ul>
            </nav>--}}
            <nav id="Hui-userbar" class="nav navbar-nav navbar-userbar hidden-xs">
                <ul class="cl">
                    <li>超级管理员</li>
                    <li class="dropDown dropDown_hover"> <a href="#" class="dropDown_A">{{ session('username') }}<i class="Hui-iconfont">&#xe6d5;</i></a>
                        <ul class="dropDown-menu menu radius box-shadow">
                            <li><a href="#" onclick="editPassword( {{ session('id') }} )">密码修改</a></li>
                            <li><a href="#" onclick="switchs()">切换账户</a></li>
                            <li><a href="#" onclick="out();">退出</a></li>
                        </ul>
                    </li>
                    {{--<li id="Hui-msg"> <a href="#" title="消息"><span class="badge badge-danger">1</span><i class="Hui-iconfont" style="font-size:18px">&#xe68a;</i></a> </li>
                    <li id="Hui-skin" class="dropDown right dropDown_hover"> <a href="javascript:;" class="dropDown_A" title="换肤"><i class="Hui-iconfont" style="font-size:18px">&#xe62a;</i></a>
                        <ul class="dropDown-menu menu radius box-shadow">
                            <li><a href="javascript:;" data-val="default" title="默认（黑色）">默认（黑色）</a></li>
                            <li><a href="javascript:;" data-val="blue" title="蓝色">蓝色</a></li>
                            <li><a href="javascript:;" data-val="green" title="绿色">绿色</a></li>
                            <li><a href="javascript:;" data-val="red" title="红色">红色</a></li>
                            <li><a href="javascript:;" data-val="yellow" title="黄色">黄色</a></li>
                            <li><a href="javascript:;" data-val="orange" title="橙色">橙色</a></li>
                        </ul>
                    </li>--}}
                </ul>
            </nav>
        </div>
    </div>
</header>
<!--/_header 作为公共模版分离出去-->

@include('Admin.index.layout.menu')

@yield('content')

<!--_footer 作为公共模版分离出去-->
<script type="text/javascript" src="{{ URL::asset('admin/lib/jquery/1.9.1/jquery.min.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('admin/lib/layer/2.4/layer.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('admin/static/h-ui/js/H-ui.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('admin/static/h-ui.admin/js/H-ui.admin.page.js') }}"></script>
<!--/_footer /作为公共模版分离出去-->

<!--请在下方写此页面业务相关的脚本-->
<script type="text/javascript">
    function editPassword (id){
        layer.open({
            type: 1,
            skin: 'layui-layer-rim', //加上边框
            area: ['500px', '260px'], //宽高
            title: '密码修改',
            content: '<div id="" class="layui-layer-content"> <article class="cl pd-20">\n' +
            '\t<form action="/" method="post" class="form form-horizontal" id="form-change-password">\n' +
            '\t\t<div class="row cl">\n' +
            '\t\t\t<label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>账户：</label>\n' +
            '\t\t\t<div class="formControls col-xs-8 col-sm-9">{{ session('username') }}</div>\n' +
            '\t\t</div>\n' +
            '\t\t<div class="row cl">\n' +
            '\t\t\t<label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>新密码：</label>\n' +
            '\t\t\t<div class="formControls col-xs-8 col-sm-9">\n' +
            '\t\t\t\t<input type="password" name="pass1" class="input-text" autocomplete="off" placeholder="不修改请留空" name="newpassword" id="newpassword">\n' +
            '\t\t\t</div>\n' +
            '\t\t</div>\n' +
            '\t\t<div class="row cl">\n' +
            '\t\t\t<label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>确认密码：</label>\n' +
            '\t\t\t<div class="formControls col-xs-8 col-sm-9">\n' +
            '\t\t\t\t<input type="password" name="pass2" class="input-text" autocomplete="off" placeholder="不修改请留空" name="newpassword2" id="new-password2">\n' +
            '\t\t\t</div>\n' +
            '\t\t</div>\n' +
            '\t\t<div class="row cl">\n' +
            '\t\t\t<div class="col-xs-8 col-sm-9 col-xs-offset-4 col-sm-offset-3">{{ csrf_field() }}\n \n' +
            '\t\t\t\t<input class="btn btn-primary radius" type="button" onclick="newPass();" value="&nbsp;&nbsp;保存&nbsp;&nbsp;">\n' +
            '\t\t\t</div>\n' +
            '\t\t</div>\n' +
            '\t</form>\n' +
            '</article>\n  </div>'
        });
    }
    
    function newPass (){
       var pass1 = $('input[name=pass1]').val();
       var pass2 = $('input[name=pass2]').val();
       var _token= $('input[name=_token]').val();
       var id    = {{ session('id') }}
       if (pass1 == '' || pass1 == null){
           layer.msg('密码不能为空');
           return false;
       }
       if (pass1 != pass2){
           layer.msg('两次密码不一致');
           return false;
       }
       
       $.post('{{ url('admin/posts') }}',{id:id,pass1:pass1,_token:_token},function(result){
                if(result.msg=='success'){
                    layer.msg(result.data,function(){
                        layer.closeAll('page');
                    });
                }
       });
    }

    function out(){
        //退出
        layer.confirm('您确定要退出登录？', {
            btn: ['确定','取消'] //按钮
        }, function(){
            location.href='{{ url('admin/out') }}';
        }, function(){

        });
    }

    function switchs(){
        //用户切换
        location.href='{{ url('admin/login') }}';
    }
    
</script>
@yield('javascript');
<!--/请在上方写此页面业务相关的脚本-->
</body>
</html>