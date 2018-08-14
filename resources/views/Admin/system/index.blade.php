@extends('Admin.index.layout.common')
@section('content')
    <section class="Hui-article-box">
        <nav class="breadcrumb"><i class="Hui-iconfont">&#xe67f;</i> 首页 <span class="c-gray en">&gt;</span> 系统管理 <span
                    class="c-gray en">&gt;</span> 基本设置 <a class="btn btn-success radius r"
                                                          style="line-height:1.6em;margin-top:3px"
                                                          href="javascript:location.replace(location.href);" title="刷新"><i
                        class="Hui-iconfont">&#xe68f;</i></a></nav>
        <div class="Hui-article">
            <article class="cl pd-20">
                <form action="" method="post" class="form form-horizontal" id="form-article-add">
                    @csrf
                    <div id="tab-system" class="HuiTab">
                        <div class="tabBar cl">
                            <span>基本设置</span>
                            <span onclick="getHome();">首页设置</span>
                            {{--<span>邮件设置</span>--}}
                            <span onclick="getWx();">微信设置</span>
                            <span onclick="getAlipay();">支付宝设置</span>
                        </div>

                        <div class="tabCon">
                            <div class="row cl">
                                <label class="form-label col-xs-4 col-sm-2"><span class="c-red">*</span>网站名称：</label>
                                <div class="formControls col-xs-8 col-sm-9">
                                    <input type="text" id="website-title" placeholder="控制在25个字、50个字节以内" value=""
                                           class="input-text">
                                </div>
                            </div>
                            <div class="row cl">
                                <label class="form-label col-xs-4 col-sm-2"><span class="c-red">*</span>关键词：</label>
                                <div class="formControls col-xs-8 col-sm-9">
                                    <input type="text" id="website-Keywords" placeholder="5个左右,8汉字以内,用英文,隔开" value=""
                                           class="input-text">
                                </div>
                            </div>
                            <div class="row cl">
                                <label class="form-label col-xs-4 col-sm-2"><span class="c-red">*</span>描述：</label>
                                <div class="formControls col-xs-8 col-sm-9">
                                    <input type="text" id="website-description" placeholder="空制在80个汉字，160个字符以内" value=""
                                           class="input-text">
                                </div>
                            </div>
                            <div class="row cl">
                                <label class="form-label col-xs-4 col-sm-2"><span class="c-red">*</span>css、js、images路径配置：</label>
                                <div class="formControls col-xs-8 col-sm-9">
                                    <input type="text" id="website-static" placeholder="默认为空，为相对路径" value=""
                                           class="input-text">
                                </div>
                            </div>
                            <div class="row cl">
                                <label class="form-label col-xs-4 col-sm-2"><span class="c-red">*</span>上传目录配置：</label>
                                <div class="formControls col-xs-8 col-sm-9">
                                    <input type="text" id="website-uploadfile" placeholder="默认为uploadfile" value=""
                                           class="input-text">
                                </div>
                            </div>
                            <div class="row cl">
                                <label class="form-label col-xs-4 col-sm-2"><span class="c-red">*</span>底部版权信息：</label>
                                <div class="formControls col-xs-8 col-sm-9">
                                    <input type="text" id="website-copyright" placeholder="&copy; 2014 H-ui.net"
                                           value="" class="input-text">
                                </div>
                            </div>
                            <div class="row cl">
                                <label class="form-label col-xs-4 col-sm-2">备案号：</label>
                                <div class="formControls col-xs-8 col-sm-9">
                                    <input type="text" id="website-icp" placeholder="京ICP备00000000号" value=""
                                           class="input-text">
                                </div>
                            </div>
                            <div class="row cl">
                                <label class="form-label col-xs-4 col-sm-2">统计代码：</label>
                                <div class="formControls col-xs-8 col-sm-9">
                                    <textarea class="textarea"></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="tabCon">
                            <div class="row cl">
                                <label class="form-label col-xs-4 col-sm-2">店铺招牌上传：</label>
                                <div class="layui-upload">
                                    <button type="button" class="layui-btn" id="test1">店铺招牌</button>
                                    {{ csrf_field() }}
                                    <div class="layui-upload-list">
                                        <img class="layui-upload-img" id="demo1" width="300" height="80"
                                             style="margin-left: 320px;">
                                        <input type="hidden" name="thumb" value=""/>
                                        <p id="demoText"></p>
                                    </div>
                                </div>
                            </div>
                            <div class="row cl">
                                <label class="form-label col-xs-4 col-sm-2">广告上传：</label>

                                <div class="layui-upload">
                                    <button type="button" class="layui-btn" id="test2">轮播广告上传</button>

                                    <div class="layui-upload-list" id="demo2" style="margin-left: 310px;">

                                    </div>
                                </div>
                            </div>
                            <div class="row cl">
                                <div class="col-xs-8 col-sm-9 col-xs-offset-4 col-sm-offset-2">
                                    <button onClick="homes();" class="btn btn-primary radius" type="button"><i
                                                class="Hui-iconfont">&#xe632;</i> 保存
                                    </button>
                                    <button onClick="layer_close();" class="btn btn-default radius" type="button">&nbsp;&nbsp;取消&nbsp;&nbsp;</button>
                                </div>
                            </div>
                        </div>
                        {{--<div class="tabCon">
                            <div class="row cl">
                                <label class="form-label col-xs-4 col-sm-2">邮件发送模式：</label>
                                <div class="formControls col-xs-8 col-sm-9">
                                    <input type="text" id="" value="" class="input-text">
                                </div>
                            </div>
                            <div class="row cl">
                                <label class="form-label col-xs-4 col-sm-2">SMTP服务器：</label>
                                <div class="formControls col-xs-8 col-sm-9">
                                    <input type="text" id="" value="" class="input-text">
                                </div>
                            </div>
                            <div class="row cl">
                                <label class="form-label col-xs-4 col-sm-2">SMTP 端口：</label>
                                <div class="formControls col-xs-8 col-sm-9">
                                    <input type="text" id="" value="25" class="input-text">
                                </div>
                            </div>
                            <div class="row cl">
                                <label class="form-label col-xs-4 col-sm-2">邮箱帐号：</label>
                                <div class="formControls col-xs-8 col-sm-9">
                                    <input type="text" id="email-name" value="" class="input-text">
                                </div>
                            </div>
                            <div class="row cl">
                                <label class="form-label col-xs-4 col-sm-2">邮箱密码：</label>
                                <div class="formControls col-xs-8 col-sm-9">
                                    <input type="password" id="email-password" value="" class="input-text">
                                </div>
                            </div>
                            <div class="row cl">
                                <label class="form-label col-xs-4 col-sm-2">收件邮箱地址：</label>
                                <div class="formControls col-xs-8 col-sm-9">
                                    <input type="text" id="email-address" value="" class="input-text">
                                </div>
                            </div>
                        </div>--}}
                        {{--微信设置--}}
                        <div class="tabCon">
                            <div class="row cl">
                                <label class="form-label col-xs-4 col-sm-2">开发者ID(AppID)：</label>
                                <div class="formControls col-xs-8 col-sm-9">
                                    <input type="text" id="AppID" value="" class="input-text">
                                </div>
                            </div>
                            <div class="row cl">
                                <label class="form-label col-xs-4 col-sm-2">AppSecret：</label>
                                <div class="formControls col-xs-8 col-sm-9">
                                    <input type="text" id="AppSecret" value="" class="input-text">
                                </div>
                            </div>
                            <div class="row cl">
                                <div class="col-xs-8 col-sm-9 col-xs-offset-4 col-sm-offset-2">
                                    <button onClick="weixin();" class="btn btn-primary radius" type="button"><i
                                                class="Hui-iconfont">&#xe632;</i> 保存
                                    </button>
                                    <button onClick="layer_close();" class="btn btn-default radius" type="button">&nbsp;&nbsp;取消&nbsp;&nbsp;</button>
                                </div>
                            </div>
                        </div>
                        {{--微信设置--}}
                        {{--支付宝设置--}}
                        <div class="tabCon">
                            <div class="row cl">
                                <label class="form-label col-xs-4 col-sm-2">开发者ID(app_id)：</label>
                                <div class="formControls col-xs-8 col-sm-9">
                                    <input type="text" id="app_id" value="" class="input-text">
                                </div>
                            </div>
                            <div class="row cl">
                                <label class="form-label col-xs-4 col-sm-2">商户私钥：</label>
                                <div class="formControls col-xs-8 col-sm-9">
                                    <input type="text" id="private_key" value="" class="input-text">
                                </div>
                            </div>
                            <div class="row cl">
                                <label class="form-label col-xs-4 col-sm-2">支付宝公钥：</label>
                                <div class="formControls col-xs-8 col-sm-9">
                                    <input type="text" id="public_key" value="" class="input-text">
                                </div>
                            </div>
                            <div class="row cl">
                                <div class="col-xs-8 col-sm-9 col-xs-offset-4 col-sm-offset-2">
                                    <button onClick="alipay();" class="btn btn-primary radius" type="button"><i
                                                class="Hui-iconfont">&#xe632;</i> 保存
                                    </button>
                                    <button onClick="layer_close();" class="btn btn-default radius" type="button">&nbsp;&nbsp;取消&nbsp;&nbsp;</button>
                                </div>
                            </div>
                        </div>
                        {{--支付宝设置--}}
                    </div>

                </form>
            </article>
        </div>
    </section>
@endsection

@section('javascript')
    <!--请在下方写此页面业务相关的脚本-->
    <script type="text/javascript"
            src="{{URL::asset('admin/lib/jquery.validation/1.14.0/jquery.validate.js')}}"></script>
    <script type="text/javascript"
            src="{{URL::asset('admin/lib/jquery.validation/1.14.0/validate-methods.js')}}"></script>
    <script type="text/javascript" src="{{URL::asset('admin/lib/jquery.validation/1.14.0/messages_zh.js')}}"></script>
    <script type="text/javascript" src="{{ URL::asset('layui/layui.js') }}"></script>
    <script type="text/javascript">
        $(function () {
            $('.skin-minimal input').iCheck({
                checkboxClass: 'icheckbox-blue',
                radioClass: 'iradio-blue',
                increaseArea: '20%'
            });

            $("#tab-system").Huitab({
                //tabEvent:"mousemove",
                index: 0
            });

        });

        var _token = $('input[name=_token]').val();

        function weixin() {
            //保存微信的设置
            var AppID = $("#AppID").val();
            var AppSecret = $("#AppSecret").val();

            if (AppID == null || AppID == "") {
                layer.msg('AppID不能为空');
                return false;
            }
            if (AppSecret == null || AppSecret == "") {
                layer.msg('AppSecret不能为空');
                return false;
            }

            $.post('{{url('admin/sys/save/3')}}', {
                _token: _token,
                AppSecret: AppSecret,
                AppID: AppID
            }, function (result) {
                if (result.msg == 'success') {
                    layer.msg(result.data);
                    //location.reload();
                }
            });
        }

        function homes() {
            //首页基本设置
            var images = my_array_name('images');
            var thumb = $('input[name=thumb]').val();
            if (images == null || images == "") {
                layer.msg('轮播图不能为空');
                return false;
            }
            if (thumb == null || thumb == "") {
                layer.msg('店铺招牌不能为空');
                return false;
            }

            $.post('{{url('admin/sys/save/2')}}', {_token: _token, images: images, thumb: thumb}, function (result) {

                if (result.msg == 'success') {
                    layer.msg(result.data);
                    //location.reload();
                }
            });
        }

        function deletes(btn) {
            //btn.parentElement.parentElement.remove();
            btn.remove();
            //console.log(btn.src);
        }

        function my_array_name(m) {
            var valArr = new Array;
            $("input[name='" + m + "[]']").each(function (i) {
                valArr[i] = $(this).val();
            });
            var priv = valArr.join(',');
            return priv;
        }


        function alipay() {
            //保存支付宝的配置
            var app_id = $("#app_id").val();
            var public_key = $("#public_key").val();
            var private_key = $("#private_key").val();
            if (app_id == null || app_id == "") {
                layer.msg('AppID不能为空');
                return false;
            }

            if (public_key == null || public_key == "") {
                layer.msg('public_key不能为空');
                return false;
            }

            if (private_key == null || private_key == "") {
                layer.msg('private_key不能为空');
                return false;
            }
            $.post('{{url('admin/sys/save/4')}}', {
                _token: _token,
                app_id: app_id,
                public_key: public_key,
                private_key: private_key
            }, function (result) {
                if (result.msg == 'success') {
                    layer.msg(result.data);
                    //location.reload();
                }
            });
        }

        function getWx() {
            $.post('{{url('admin/sys/get/3')}}', {_token: _token}, function (result) {
                if (result) {
                    var data = eval('(' + result + ')');  //吧JSON字符串转换为JSON对象
                    $("#AppID").attr("value", data.AppID);
                    $("#AppSecret").attr("value", data.AppSecret);
                }
            });
        }

        function getAlipay() {
            $.post('{{url('admin/sys/get/4')}}', {_token: _token}, function (result) {
                if (result) {
                    var data = eval('(' + result + ')');  //吧JSON字符串转换为JSON对象
                    $("#app_id").attr("value", data.app_id);
                    $("#public_key").attr("value", data.public_key);
                    $("#private_key").attr("value", data.private_key);
                }
            });
        }

        function getHome() {
            $.post('{{url('admin/sys/get/2')}}', {_token: _token}, function (result) {
                if (result) {
                    var data = eval('(' + result + ')');  //吧JSON字符串转换为JSON对象
                    var str = data.images;
                    var img = str.split(',');
                    var html = '';
                    for (var i = 0; i < img.length; i++) {
                        html += "<p onclick='deletes(this);'  style='display:inline-block;margin-right: 5px;'><img  class='layui-upload-img' width='100' height='100' src='" + img[i] + "'><input type='hidden' name='images[]' value='" + img[i] + "'></p>";
                    }
                    $('#demo2').append(html);
                    document.getElementsByName('thumb')[0].value = data.thumb;
                    document.getElementById('demo1').src = data.thumb;
                }
            });
        }


        layui.use('upload', function () {
            var $ = layui.jquery
                , upload = layui.upload;
            var _token = $('input[name=_token]').val();
            //普通图片上传
            var uploadInst = upload.render({
                elem: '#test1'
                , url: '{{ url('admin/file/upload') }}'
                , data: {'_token': _token}
                , field: 'photo'
                , before: function (obj) {
                    //预读本地文件示例，不支持ie8
                    obj.preview(function (index, file, result) {
                        $('#demo1').attr('src', result); //图片链接（base64）
                    });
                }
                , done: function (res) {
                    //如果上传失败
                    if (res.msg == 'error') {
                        return layer.msg('上传失败');
                    }
                    //上传成功
                    if (res.msg == 'success') {
                        layer.msg('上传成功');
                        $('input[name=thumb]').val(res.url);
                    }
                }
                , error: function () {
                    //演示失败状态，并实现重传
                    var demoText = $('#demoText');
                    demoText.html('<span style="color: #FF5722;">上传失败</span> <a class="layui-btn layui-btn-mini demo-reload">重试</a>');
                    demoText.find('.demo-reload').on('click', function () {
                        uploadInst.upload();
                    });
                }
            });


            //多图片上传
            upload.render({
                elem: '#test2'
                , url: '{{ url('admin/file/upload') }}'
                , multiple: true
                , url: '{{ url('admin/file/upload') }}'
                , data: {'_token': _token}
                , field: 'photo'
                , before: function (obj) {
                    //预读本地文件示例，不支持ie8
                    obj.preview(function (index, file, result) {
                        //$('#demo2').append('<img  onclick="deletes("'+index+'");"   width="100" height="100" src="'+ result +'" alt="'+ file.name +'" class="layui-upload-img">')
                    });
                }
                , done: function (res) {
                    //上传完毕

                    $('#demo2').append("<p onclick='deletes(this);'  style='display:inline-block;margin-right: 5px;'><img  class='layui-upload-img' width='100' height='100' src='" + res.url + "'><input type='hidden' name='images[]' value='" + res.url + "'></p>");

                }
            });


        });
    </script>

@endsection
