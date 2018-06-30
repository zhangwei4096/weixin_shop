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
    <link rel="stylesheet" type="text/css" href="{{ URL::asset('admin/static/h-ui.admin/css/style.css') }}" media="all" />
    <link rel="stylesheet" href="{{ URL::asset('layui/css/layui.css') }}" />
    <link type="text/css" rel="stylesheet" href="{{ URL::asset('liandon/ydui.css') }}">
    <link type="text/css" rel="stylesheet" href="{{ URL::asset('liandon/demo.css') }}">
    <script type="text/javascript" src="{{ URL::asset('liandon/ydui.flexible.js') }}"></script>
    <script type="text/javascript" src="{{ URL::asset('liandon/jquery.min.js') }}"></script>
    <script type="text/javascript" src="{{ URL::asset('admin/lib/layer/2.4/layer.js') }}"></script>
    <!--/meta 作为公共模版分离出去-->
    <link href="{{ URL::asset('admin/lib/webuploader/0.1.5/webuploader.css') }}" rel="stylesheet" type="text/css" />
    <style>
        .box {
            width: 100%;
            border: 1px solid #ccc;
            border-bottom: none;
            padding: 10px 25px;
            background-color: #fff;
            position: relative;
            cursor: pointer;
        }
        .box strong {
            color: #333;
            font-size: 16px;
        }
        .box li:last-child {
            position: absolute;
            top: 15px;
            right: 5px;

        }
        .bottoms {
            /*浏览器定位*/
            position: fixed;
            bottom: 5px;
            border-radius: 5px;
        }
    </style>
</head>
<body>
    @csrf
    @foreach($addrs as $v)
    <ul class="box" id="addr{{ $v->id }}" >
        <li>
            <strong>{{ $v->name }}</strong>
            <strong>{{ $v->phone }}</strong>
        </li>
        <li><p>{{ $v->province }}{{ $v->city }} {{ $v->district }} {{ $v->more }}</p></li>
        <li>
            <div class="layui-btn-group">
                {{--<button class="layui-btn layui-btn-primary layui-btn-sm" onclick="set_select({{ $v->id }});"></button>--}}
                <button class="layui-btn layui-btn-primary layui-btn-sm" onclick="set_default({{ $v->id }})">选择地址</button>
                <button class="layui-btn layui-btn-primary layui-btn-sm" onclick="set_edit({{ $v->id }})"><i class="layui-icon"></i></button>
                <button class="layui-btn layui-btn-primary layui-btn-sm" onclick="set_del({{ $v->id }})"><i class="layui-icon"></i></button>
            </div>
        </li>
    </ul>
    @endforeach
    <button class="layui-btn layui-btn-fluid bottoms" onclick="addr_add('添加收货地址','{{ url('/add/addr') }}')">添加收货地址</button>
    <script>
        var _token = $('input[name=_token]').val(); //token

        function set_select(id) {
            //选择地址
            $.post('{{ url('/select/addr') }}',{},function (result) {
                
            });
        }
        function set_default(id) {
            //设置默认收货地址
            $.post('{{ url('/default/addr') }}',{_token:_token,id:id},function (result) {
                if (result.msg == 'success'){
                    layer.msg('地址选择成功',function(){//关闭弹出层
                        var index = parent.layer.getFrameIndex(window.name); //获取窗口索引
                        parent.layer.close(index);
                    });
                }
            });
        }
        
        function set_edit(id) {
            //修改当前收货地址
            var index = layer.open({
                type: 2,
                title:'地址信息修改',
                content:'{{ url('/edit/addr') }}/'+id,
                end:function(){
                    location.reload();
                }
            });
            layer.full(index);
        }

        function set_del(id) {
            //删除地址
            layer.confirm('您确定要删除当前地址？', {
                btn: ['确定','取消'] //按钮
            }, function(){

                $.post('{{ url('/del/addr') }}',{id:id,_token:_token},function (result) {
                    if (result.msg=='success'){
                        //删除成功
                        layer.msg('删除成功');
                        $('#addr'+id).hide();
                    }
                });
            }, function(){

            });
        }
        function addr_add(title,url){
            //添加地址
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
    </script>
</body>
</html>