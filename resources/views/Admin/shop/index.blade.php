{{--商铺展示页面--}}
@extends('Admin.index.layout.common')
@section('content')
    <style>
        .layui-table-cell {
            height: 100%!important;
        }
    </style>
    <section class="Hui-article-box">
        <nav class="breadcrumb"><i class="Hui-iconfont">&#xe67f;</i> 首页 <span class="c-gray en">&gt;</span> 商铺管理 <span class="c-gray en">&gt;</span> 商铺列表 <a class="btn btn-success radius r" style="line-height:1.6em;margin-top:3px" href="javascript:location.replace(location.href);" title="刷新" ><i class="Hui-iconfont">&#xe68f;</i></a></nav>
        <div class="Hui-article">

            <div class="pd-20">
                <div class="cl pd-5 bg-1 bk-gray mt-20">
                        <span class="l">
                            <a href="javascript:;" data-type="getCheckData" class="btn btn-danger radius">
                                <i class="Hui-iconfont">&#xe6e2;</i> 批量删除
                            </a>
                            <a class="btn btn-primary radius" onclick="product_add('添加产品')" href="javascript:;">
                                <i class="Hui-iconfont">&#xe600;</i> 添加商铺
                            </a>
                        </span>
                </div>
                <div class="mt-20">
                    <table class="layui-hide" id="list" lay-filter="demo"></table>
                    <script type="text/html" id="barDemo">
                        <a class="layui-btn layui-btn-primary layui-btn-xs" lay-event="send">生成二维码</a>
                        {{--<a class="layui-btn layui-btn-danger layui-btn-xs" lay-event="down">下载二维码</a>--}}
                        <a class="layui-btn layui-btn-xs" lay-event="edit">编辑</a>
                        <a class="layui-btn layui-btn-danger layui-btn-xs" lay-event="del">删除</a>
                    </script>
                </div>
            </div>
        </div>
        {{ csrf_field() }}
    </section>
@endsection

@section('javascript')
    <script type="text/javascript" src="{{ URL::asset('admin/lib/My97DatePicker/4.8/WdatePicker.js') }}"></script>
    <script type="text/javascript" src="{{ URL::asset('admin/lib/datatables/1.10.0/jquery.dataTables.min.js') }}"></script>
    <script type="text/javascript" src="{{ URL::asset('admin/lib/laypage/1.2/laypage.js ') }}"></script>
    <script type="text/javascript" src="{{ URL::asset('admin/lib/zTree/v3/js/jquery.ztree.all-3.5.min.js ') }}"></script>
    <script type="text/javascript" src="{{ URL::asset('layui/layui.js') }}"></script>
    <script type="text/javascript">
        var _token = $('input[name=_token]').val();
        layui.use('table', function(){
            var table = layui.table;

            table.render({
                elem: '#list'
                ,url:'{{ url('admin/shop/get') }}'
                ,page: { //支持传入 laypage 组件的所有参数（某些参数除外，如：jump/elem） - 详见文档
                    layout: ['limit', 'count', 'prev', 'page', 'next', 'skip'] //自定义分页布局
                    //,curr: 5 //设定初始在第 5 页
                    ,groups: 1 //只显示 1 个连续页码
                    ,first: false //不显示首页
                    ,last: false //不显示尾页

                }
                ,cols: [[
                    {type:'checkbox'}
                    ,{field:'id', width:50, title: 'ID', sort: false}
                    ,{field:'name', width:400, title: '店铺名称'}
                    ,{field:'addr', width:400, title: '店铺地址' }
                    ,{field:'thumb', width:400,style:'height:50px;width:100%;line-height:48px!important;', title: '店铺二维码' ,templet: function(d){
                            if (d.thumb == null){
                                return '请生成二维码'
                            }else{
                                return '<div><a href="'+d.thumb+'" title="二维码下载" download="'+d.id+'.png"><img  src="'+d.thumb+'"  height="45" width="45"/></a></div>'
                            }
                        } ,align:'center'}
                    ,{fixed: 'right',  title: '操作', align:'center', toolbar: '#barDemo'}
                ]]

            });



            //监听工具条
            table.on('tool(demo)', function(obj){
                var data = obj.data;
                var id    = JSON.stringify(data.id);
                if(obj.event === 'detail'){
                    layer.msg('ID：'+ data.id + ' 的查看操作');
                } else if(obj.event === 'del'){
                    layer.confirm('真的删除行么', function(index){
                        $.post("{{url('admin/shop/delete')}}",{_token:_token,id:id},function(result){
                            if (result.msg == 'success'){
                                layer.msg(result.data);
                                obj.del();
                                layer.close(index);
                            }
                        });

                    });
                } else if(obj.event === 'edit'){
                    //layer.alert('编辑行：<br>'+ JSON.stringify(data.id))

                   layer.open({
                        type: 1,
                        area:['520px', '260px'],
                        title: '店铺修改',
                        content: '<div class="page-container">\n' +
                        '    <form action="" method="post" class="form form-horizontal" id="form-article-add">\n' +
                        '        <div class="row cl">\n' +
                        '            <label class="form-label col-xs-4 col-sm-2"><span class="c-red">*</span>店铺名称：</label>\n' +
                        '            <div class="formControls col-xs-8 col-sm-9">\n' +
                        '                <input type="text" class="input-text"  value='+data.name+' name="name">\n' +
                        '            </div>\n' +
                        '        </div>\n' +
                        '\n' +
                        '        <div class="row cl">\n' +
                        '            <label class="form-label col-xs-4 col-sm-2"><span class="c-red">*</span>地址：</label>\n' +
                        '            <div class="formControls col-xs-8 col-sm-9">\n' +
                        '                <input type="text" name="addr" value='+data.addr+' class="input-text">\n' +
                        '            </div>\n' +
                        '        </div>\n' +
                        '        <div class="row cl">\n' +
                        '        <div class="col-xs-8 col-sm-9 col-xs-offset-4 col-sm-offset-2">\n' +
                        '            <button onClick="saveContent('+data.id+');" class="btn btn-primary radius" type="button">\n' +
                        '                <i class="Hui-iconfont">&#xe632;</i> 确认修改\n' +
                        '            </button>\n' +
                        '            <button onClick="layer_close();" class="btn btn-default radius" type="button">&nbsp;&nbsp;取消&nbsp;&nbsp;</button>\n' +
                        '        </div>\n' +
                        '</div>\n' +
                        '    </form>\n' +
                        '</div>',
                        end: function () {
                            location.reload();
                        }
                    });

                }else if(obj.event === 'send'){
                    //生成二维码
                    var url = id;
                    $.post('{{url('admin/shop/scerweima')}}',{_token:_token,id:id},function(result){
                        if (result.msg == 'success'){
                            //有个BUG
                            layer.msg(result.data);
                            obj.update({
                                thumb: '<div><a href="'+result.url+'" title="二维码下载" download="'+id+'.png"><img src="'+result.url+'" width="45" height="45" /></a></div>',
                            });
                        }
                    });
                }
            });


            var $ = layui.$, active = {
                getCheckData: function(){ //获取选中数据
                    var checkStatus = table.checkStatus('list')
                        ,data = checkStatus.data;
                    layer.alert(JSON.stringify(data));
                }
                ,getCheckLength: function(){ //获取选中数目
                    var checkStatus = table.checkStatus('list')
                        ,data = checkStatus.data;
                    layer.msg('选中了：'+ data.length + ' 个');
                }
                ,isAll: function(){ //验证是否全选
                    var checkStatus = table.checkStatus('list');
                    layer.msg(checkStatus.isAll ? '全选': '未全选')
                }
            };

            $('.btn-danger').on('click', function(){
                var type = $(this).data('type');
                active[type] ? active[type].call(this) : '';
            });

        });

        /*商铺-添加*/
        function product_add(title){
            layer.open({
                type: 1,
                area: ['520px', '260px'], //宽高
                title: title,
                content: '<div class="page-container">\n' +
                '    <form action="" method="post" class="form form-horizontal" id="form-article-add">\n' +
                '        <div class="row cl">\n' +
                '            <label class="form-label col-xs-4 col-sm-2"><span class="c-red">*</span>店铺名称：</label>\n' +
                '            <div class="formControls col-xs-8 col-sm-9">\n' +
                '                <input type="text" class="input-text"  value="" name="name">\n' +
                '            </div>\n' +
                '        </div>\n' +
                '\n' +
                '        <div class="row cl">\n' +
                '            <label class="form-label col-xs-4 col-sm-2"><span class="c-red">*</span>地址：</label>\n' +
                '            <div class="formControls col-xs-8 col-sm-9">\n' +
                '                <input type="text" name="addr" value="" class="input-text">\n' +
                '            </div>\n' +
                '        </div>\n' +
                '        <div class="row cl">\n' +
                '        <div class="col-xs-8 col-sm-9 col-xs-offset-4 col-sm-offset-2">\n' +
                '            <button onClick="saveContent(0);" class="btn btn-primary radius" type="button">\n' +
                '                <i class="Hui-iconfont">&#xe632;</i> 保存\n' +
                '            </button>\n' +
                '            <button onClick="layer_close();" class="btn btn-default radius" type="button">&nbsp;&nbsp;取消&nbsp;&nbsp;</button>\n' +
                '        </div>\n' +
                '</div>\n' +
                '    </form>\n' +
                '</div>',
                end: function () {
                    location.reload();
                }
            });

        }

        function saveContent (id){
            //保存
            var name   = $('input[name=name]').val();
            var addr   = $('input[name=addr]').val();
            var _token = $('input[name=_token]').val();
            if (name == null || name =="") {
                layer.msg('店铺名称不能为空');
                return false;
            }
            if (addr == null || addr =="") {
                layer.msg('产地不能为空');
                return false;
            }



            if (id == 0){
                //保存
                $.post('{{ url('admin/shop/posts') }}',{_token:_token,name:name,addr:addr},function(result){
                    if(result.msg=='success'){
                        layer.msg(result.data,function(){
                            layer.closeAll('page');
                        });
                    }
                });
            }else {
                //修改
                $.post('{{ url('admin/shop/update') }}',{id:id,_token:_token,name:name,addr:addr},function(result){
                    if(result.msg=='success'){
                        layer.msg(result.data,function(){
                            layer.closeAll('page');
                        });
                    }
                });
            }


        }
        
        function layer_close () {
            layer.closeAll('page');
        }

    </script>
@endsection
