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
            <label class="form-label col-xs-4 col-sm-2"><span class="c-red">*</span>产品标题：</label>
            <div class="formControls col-xs-8 col-sm-9">
                <input type="text" class="input-text"  value="" name="title">
            </div>
        </div>

        <div class="row cl">
            <label class="form-label col-xs-4 col-sm-2">产地：</label>
            <div class="formControls col-xs-8 col-sm-9">
                <input type="text" name="chandi" value="" class="input-text">
            </div>
        </div>

        <div class="row cl">
            <label class="form-label col-xs-4 col-sm-2">价格计算单位：</label>
            <div class="formControls col-xs-8 col-sm-9"> <span class="select-box">
				<select class="select"name="jjdw" >
					<option value="件">件</option>
					<option value="斤">斤</option>
					<option value="KG">KG</option>
					<option value="吨">吨</option>
					<option value="套">套</option>
				</select>
				</span> </div>
        </div>
        <div class="row cl">
            <label class="form-label col-xs-4 col-sm-2">产品重量：</label>
            <div class="formControls col-xs-8 col-sm-9">
                <input type="text" name="zl"  value="" class="input-text" style="width:90%">
                kg</div>
        </div>
        <div class="row cl">
            <label class="form-label col-xs-4 col-sm-2">产品出售价格：</label>
            <div class="formControls col-xs-8 col-sm-9">
                <input type="text" name="xs_price" id="" placeholder="" value="" class="input-text" style="width:90%">
                元</div>
        </div>
        <div class="row cl">
            <label class="form-label col-xs-4 col-sm-2">市场价格：</label>
            <div class="formControls col-xs-8 col-sm-9">
                <input type="text" name="sc_price" id="" placeholder="" value="" class="input-text" style="width:90%">
                元</div>
        </div>
        <div class="row cl">
            <label class="form-label col-xs-4 col-sm-2">成本价格：</label>
            <div class="formControls col-xs-8 col-sm-9">
                <input type="text" name="cb_price" id="" placeholder="" value="" class="input-text" style="width:90%">
                元</div>
        </div>

        <div class="row cl">
            <label class="form-label col-xs-4 col-sm-2">销售开始时间：</label>
            <div class="formControls col-xs-8 col-sm-9">
                <input type="text" name="start_time" id="datemin" class="input-text Wdate" style="width:180px;">
            </div>
        </div>
        <div class="row cl">
            <label class="form-label col-xs-4 col-sm-2">销售结束时间：</label>
            <div class="formControls col-xs-8 col-sm-9">
                <input type="text" name="end_time" id="datemax" class="input-text Wdate" style="width:180px;">
            </div>
        </div>

        <div class="row cl">
            <label class="form-label col-xs-4 col-sm-2">产品摘要：</label>
            <div class="formControls col-xs-8 col-sm-9">
                <textarea name="info" cols="" rows="" class="textarea"  placeholder="说点什么...最少输入10个字符" datatype="*10-100" dragonfly="true" nullmsg="备注不能为空！" onKeyUp="textarealength(this,200)"></textarea>
                <p class="textarea-numberbar"><em class="textarea-length">0</em>/200</p>
            </div>
        </div>

        <div class="row cl">
            <label class="form-label col-xs-4 col-sm-2">封面图片上传：</label>
            <div class="layui-upload">
                <button type="button" class="layui-btn" id="test1">上传图片</button>
                {{ csrf_field() }}
                <div class="layui-upload-list">
                    <img class="layui-upload-img" id="demo1" width="300" height="80" style="margin-left: 320px;">
                    <input type="hidden" name="thumb" value="" />
                    <p id="demoText"></p>
                </div>
            </div>
        </div>
        <div class="row cl">
            <label class="form-label col-xs-4 col-sm-2">详细内容：</label>
            <div class="formControls col-xs-8 col-sm-9">
                <script id="editor" type="text/plain" style="width:100%;height:400px;"></script>
            </div>
        </div>
        <div class="row cl">
            <div class="col-xs-8 col-sm-9 col-xs-offset-4 col-sm-offset-2">
                <button onClick="saveContent();" class="btn btn-primary radius" type="button">
                    <i class="Hui-iconfont">&#xe632;</i> 保存并提交审核
                </button>
                <button onClick="layer_close();" class="btn btn-default radius" type="button">&nbsp;&nbsp;取消&nbsp;&nbsp;</button>
            </div>
        </div>
    </form>
</div>



		<!--_footer 作为公共模版分离出去-->
		<script type="text/javascript" src="{{ URL::asset('admin/lib/jquery/1.9.1/jquery.min.js') }}"></script>
		<script type="text/javascript" src="{{ URL::asset('admin/lib/layer/2.4/layer.js') }}"></script>
		<script type="text/javascript" src="{{ URL::asset('admin/static/h-ui/js/H-ui.js') }}"></script>
		<script type="text/javascript" src="{{ URL::asset('admin/static/h-ui.admin/js/H-ui.admin.page.js') }}"></script>
		<!--/_footer /作为公共模版分离出去-->

		<!--请在下方写此页面业务相关的脚本-->
		<script type="text/javascript" src="{{ URL::asset('admin/lib/jquery.validation/1.14.0/jquery.validate.js') }}"></script>
		<script type="text/javascript" src="{{ URL::asset('admin/lib/jquery.validation/1.14.0/validate-methods.js') }}"></script>
		<script type="text/javascript" src="{{ URL::asset('admin/lib/jquery.validation/1.14.0/messages_zh.js') }}"></script>
		<script type="text/javascript" src="{{ URL::asset('admin/lib/webuploader/0.1.5/webuploader.min.js') }}"></script>
		<script type="text/javascript" src="{{ URL::asset('admin/lib/ueditor/1.4.3/ueditor.config.js') }}"></script>
		<script type="text/javascript" src="{{ URL::asset('admin/lib/ueditor/1.4.3/ueditor.all.min.js') }}"> </script>
		<script type="text/javascript" src="{{ URL::asset('admin/lib/ueditor/1.4.3/lang/zh-cn/zh-cn.js') }}"></script>
                <script type="text/javascript" src="{{ URL::asset('layui/layui.js') }}"></script>
		<script type="text/javascript">
		    var ue = UE.getEditor('editor');
            layui.use('upload', function(){
                var $ = layui.jquery
                    ,upload = layui.upload;
                var _token  = $('input[name=_token]').val();
                //普通图片上传
                var uploadInst = upload.render({
                    elem: '#test1'
                    ,url: '{{ url('admin/file/upload') }}'
                    ,data: {'_token':_token}
                    ,field: 'photo'
                    ,before: function(obj){
                        //预读本地文件示例，不支持ie8
                        obj.preview(function(index, file, result){
                            $('#demo1').attr('src', result); //图片链接（base64）
                        });
                    }
                    ,done: function(res){
                        //如果上传失败
                        if(res.msg == 'error'){
                            return layer.msg('上传失败');
                        }
                        //上传成功
                        if (res.msg == 'success'){
                            layer.msg('上传成功');
                            $('input[name=thumb]').val(res.url);
                        }
                    }
                    ,error: function(){
                        //演示失败状态，并实现重传
                        var demoText = $('#demoText');
                        demoText.html('<span style="color: #FF5722;">上传失败</span> <a class="layui-btn layui-btn-mini demo-reload">重试</a>');
                        demoText.find('.demo-reload').on('click', function(){
                            uploadInst.upload();
                        });
                    }
                });
            });

            layui.use('laydate', function(){
                var laydate = layui.laydate;

                //执行一个laydate实例
                laydate.render({
                    elem: '#datemin' //指定元素
                    ,type: 'datetime'
                    ,min: 0
                });

                laydate.render({
                    elem: '#datemax' //指定元素
                    ,type: 'datetime'
                    ,min: 0
                });
            });

            function saveContent (){
                //保存
                var title = $('input[name=title]').val();
                var chandi= $('input[name=chandi]').val();
                var jjdw  = $('select[name=jjdw]').val();
                var zl  = $('input[name=zl]').val();
                var xs_price  = $('input[name=xs_price]').val();
                var sc_price  = $('input[name=sc_price]').val();
                var cb_price  = $('input[name=cb_price]').val();
                var start_time  = $('input[name=start_time]').val();
                var end_time  = $('input[name=end_time]').val();
                var info     = $('textarea[name=info]').val();
                var thumb	= $('input[name=thumb]').val();
                var content = ue.getContent();;
                var _token  = $('input[name=_token]').val();
                if (title == null || title =="") {
                	 layer.msg('标题不能为空');
                	 return false;
                }
                if (chandi == null || chandi =="") {
                	 layer.msg('产地不能为空');
                	 return false;
                }
                if (jjdw == null || jjdw =="") {
                	 layer.msg('计价单位不能为空');
                	 return false;
                }
                if (zl == null || zl =="") {
                	 layer.msg('重量不能为空');
                	 return false;
                }
                if (xs_price == null || xs_price =="") {
                	 layer.msg('销售价格不能为空');
                	 return false;
                }
                if (sc_price == null || sc_price =="") {
                	 layer.msg('市场不能为空');
                	 return false;
                }
                if (cb_price == null || cb_price =="") {
                	 layer.msg('成本不能为空');
                	 return false;
                }
               
                if (start_time == null || start_time =="") {
                	 layer.msg('开始时间不能为空');
                	 return false;
                }
                if (end_time == null || end_time =="") {
                	 layer.msg('结束时间不能为空');
                	 return false;
                }
                if (info == null || info =="") {
                	 layer.msg('简介不能为空');
                	 return false;
                }
                if (thumb == null || thumb =="") {
                	 layer.msg('请上传封面图片');
                	 return false;
                }
                if (content == null || content =="") {
                	 layer.msg('内容不能为空');
                	 return false;
                }

                $.post('{{ url('admin/product/posts') }}',{_token:_token,title:title,chandi:chandi,jjdw:jjdw,
                zl:zl,xs_price:xs_price,sc_price:sc_price,cb_price:cb_price,start_time:start_time,end_time:end_time,
                info:info,thumb:thumb,content:content},function(result){
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