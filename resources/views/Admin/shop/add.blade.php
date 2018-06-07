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
    <!--/meta 作为公共模版分离出去-->

    <link href="{{ URL::asset('admin/lib/webuploader/0.1.5/webuploader.css') }}" rel="stylesheet" type="text/css" />
</head>
<body>
<div class="page-container">
    <form action="" method="post" class="form form-horizontal" id="form-article-add">
        <div class="row cl">
            <label class="form-label col-xs-4 col-sm-2"><span class="c-red">*</span>店铺名称：</label>
            <div class="formControls col-xs-8 col-sm-9">
                <input type="text" class="input-text"  value="" name="name">
            </div>
        </div>

        <div class="row cl">
            <label class="form-label col-xs-4 col-sm-2"><span class="c-red">*</span>地址：</label>
            <div class="formControls col-xs-8 col-sm-9">
                <input type="text" name="addr" value="" class="input-text">
            </div>
        </div>
        <div class="row cl">
        <div class="col-xs-8 col-sm-9 col-xs-offset-4 col-sm-offset-2">
            <button onClick="saveContent();" class="btn btn-primary radius" type="button">
                <i class="Hui-iconfont">&#xe632;</i> 保存
            </button>
            <button onClick="layer_close();" class="btn btn-default radius" type="button">&nbsp;&nbsp;取消&nbsp;&nbsp;</button>
        </div>
</div>
    </form>
</div>
<script>

    function saveContent (){
        //保存
        var name = $('input[name=name]').val();
        var addr = $('input[name=addr]').val();
        var _token  = $('input[name=_token]').val();
        if (name == null || name =="") {
            layer.msg('标题不能为空');
            return false;
        }
        if (addr == null || addr =="") {
            layer.msg('产地不能为空');
            return false;
        }


        $.post('{{ url('admin/shop/posts') }}',{_token:_token,name:name,addr:addr},function(result){
            if(result.msg=='success'){
                layer.msg(result.data,function(){
                    var index=parent.layer.getFrameIndex(window.name);
                    parent.layer.close(index);
                });
            }
        });


    }

</script>
</body>
</html>