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
    <!--/meta 作为公共模版分离出去-->
    <link href="{{ URL::asset('admin/lib/webuploader/0.1.5/webuploader.css') }}" rel="stylesheet" type="text/css" />
</head>
<body>
<div class="page-container">
    <form action="" method="post" class="form form-horizontal" id="form-article-add">
        <div class="row cl">
            <label class="form-label col-xs-4 col-sm-2"><span class="c-red">*</span>联系人：</label>
            <div class="formControls col-xs-8 col-sm-9">
                <input type="text" class="input-text"  value="" name="name">
            </div>
        </div>

        <div class="row cl">
            <label class="form-label col-xs-4 col-sm-2"><span class="c-red">*</span>联系电话：</label>
            <div class="formControls col-xs-8 col-sm-9">
                <input type="text" name="phone" value="" class="input-text">
            </div>
        </div>

        <div class="row cl">
            <label class="form-label col-xs-4 col-sm-2">所在地区：</label>
            <div class="formControls col-xs-8 col-sm-9">
                <input type="text" name="addrs" readonly id="J_Address" placeholder="请选择收货地址" value="" class="input-text">
            </div>
        </div>

        <div class="row cl">
            <label class="form-label col-xs-4 col-sm-2">详细地址：</label>
            <div class="formControls col-xs-8 col-sm-9">
                <input type="text" name="more"  value="" class="input-text" style="width:90%">
            </div>
        </div>
                {{ csrf_field() }}
        <div class="row cl">
            <div class="col-xs-8 col-sm-9 col-xs-offset-4 col-sm-offset-2">
                <button onClick="saveContent();" class="btn btn-primary radius" type="button">
                   <i class="Hui-iconfont">&#xe632;</i> 保存地址
                </button>
                <button onClick="layer_close();" class="btn btn-default radius" type="button">
                    &nbsp;&nbsp;取消&nbsp;&nbsp;
                </button>
            </div>
        </div>
    </form>
</div>


<script type="text/javascript" src="{{ URL::asset('liandon/ydui.citys.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('liandon/ydui.js') }}"></script>
                <!--_footer 作为公共模版分离出去-->
<script type="text/javascript" src="{{ URL::asset('admin/lib/layer/2.4/layer.js') }}"></script>
                <!--/_footer /作为公共模版分离出去-->
                <!--请在下方写此页面业务相关的脚本-->
<script type="text/javascript" src="{{ URL::asset('layui/layui.js') }}"></script>
<script type="text/javascript">
    //默认调用
    !function () {
        var $target = $('#J_Address');

        $target.citySelect();

        $target.on('click', function (event) {
            event.stopPropagation();
            $target.citySelect('open');
        });

        $target.on('done.ydui.cityselect', function (ret) {
            $(this).val(ret.provance + ' ' + ret.city + ' ' + ret.area);
        });
    }();
    //设置默认值
    !function () {
        var $target = $('#J_Address2');

        $target.citySelect({
            provance: '新疆',
            city: '乌鲁木齐市',
            area: '天山区'
        });

        $target.on('click', function (event) {
            event.stopPropagation();
            $target.citySelect('open');
        });

        $target.on('done.ydui.cityselect', function (ret) {
            $(this).val(ret.provance + ' ' + ret.city + ' ' + ret.area);
        });
    }();
    function saveContent() {
        var _token = $('input[name=_token]').val();
        var name   = $('input[name=name]').val();
        var phone  = $('input[name=phone]').val();
        var addrs  = $('input[name=addrs]').val();
        var more   = $('input[name=more]').val();
        if (name=='' || phone==''){
            layer.msg('收货人或联系电话不能为空');
        }
        if (addrs==''){
            layer.msg('收货地址不能为空');
        }
        $.post("{{ url('/add/addr') }}",{_token:_token,name:name,phone:phone,addrs:addrs,more:more},function(result){
            if (result.msg == 'success'){
                //保存成功关闭当前页面
                layer.msg('地址保存成功',function(){//关闭弹出层
                    var index = parent.layer.getFrameIndex(window.name); //获取窗口索引
                    parent.layer.close(index);
                });
            }else {
                layer.msg(result.data);
            }
        });

    }
</script>
</body>
</html>