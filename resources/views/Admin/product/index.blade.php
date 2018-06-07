{{--产品展示页面--}}
@extends('Admin.index.layout.common');
@section('content')
    <style>
        .layui-table-cell {
            height: 100%!important;
        }
    </style>
    <section class="Hui-article-box">
        <nav class="breadcrumb"><i class="Hui-iconfont">&#xe67f;</i> 首页 <span class="c-gray en">&gt;</span> 产品管理 <span class="c-gray en">&gt;</span> 产品列表 <a class="btn btn-success radius r" style="line-height:1.6em;margin-top:3px" href="javascript:location.replace(location.href);" title="刷新" ><i class="Hui-iconfont">&#xe68f;</i></a></nav>
        <div class="Hui-article">

                <div class="pd-20">
                    <div class="cl pd-5 bg-1 bk-gray mt-20">
                        <span class="l">
                            <a href="javascript:;" data-type="getCheckData" class="btn btn-danger radius">
                                <i class="Hui-iconfont">&#xe6e2;</i> 批量删除
                            </a>
                            <a class="btn btn-primary radius" onclick="product_add('添加产品','{{ url('admin/product/add') }}')" href="javascript:;">
                                <i class="Hui-iconfont">&#xe600;</i> 添加产品
                            </a>
                        </span>
                    </div>
                    <div class="mt-20">
                        <table class="layui-hide" id="list" lay-filter="demo"></table>
                        <script type="text/html" id="barDemo">
                            <a class="layui-btn layui-btn-primary layui-btn-xs" lay-event="send">上架|下架</a>
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
                ,url:'{{ url('admin/product/get') }}'
                ,page: { //支持传入 laypage 组件的所有参数（某些参数除外，如：jump/elem） - 详见文档
                    layout: ['limit', 'count', 'prev', 'page', 'next', 'skip'] //自定义分页布局
                    //,curr: 5 //设定初始在第 5 页
                    ,groups: 1 //只显示 1 个连续页码
                    ,first: false //不显示首页
                    ,last: false //不显示尾页

                }
                ,cols: [[
                    {type:'checkbox'}
                    ,{field:'id', width:50, title: 'ID', sort: true}
                    ,{field:'title', width:200, title: '标题'}
                    ,{field:'thumb', width:180, title: '缩略图' ,templet: function(d){
                            return '<img src="'+d.thumb+'" width="100" height="100" />'
                        } ,align:'center'}
                    ,{field:'xs_price', width:120, title: '销售价格' , sort: true}
                    ,{field:'cb_price', title: '成本价格', width: 120 , sort: true}
                    ,{field:'chandi', width:80, title: '产地'}
                    ,{field:'start_time', width:180, title: '开始时间', sort: true}
                    ,{field:'end_time', width:180, title: '结束时间',sort: true}
                    ,{field:'info', width:180, title: '简介' }
                    ,{field:'type',width:100,title:'是否上架' ,templet:function (d) {
                            if(d.type == 0 ){ return '已下架'}
                            else { return '已上架'}
                        }}
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
                        $.post("{{url('admin/product/delete')}}",{_token:_token,id:id},function(result){
                            if (result.msg == 'success'){
                                layer.msg(result.data);
                                obj.del();
                                layer.close(index);
                            }
                        });

                    });
                } else if(obj.event === 'edit'){
                    //layer.alert('编辑行：<br>'+ JSON.stringify(data.id))

                    var index = layer.open({
                        type: 2,
                        title: '产品修改',
                        content: "{{ url('admin/product/update?id')}}="+id,
                        end: function () {
                            location.reload();
                        }
                    });
                    layer.full(index);
                }else if(obj.event === 'send'){
                    //上下架商品
                    $.post('{{url('admin/product/type')}}',{_token:_token,id:id,type:data.type},function(result){
                            if (result.msg == 'success'){
                                //有个BUG
                                layer.msg(result.data);
                                obj.update({
                                    type: result.data
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

        /*产品-添加*/
        function product_add(title,url){
            var index = layer.open({
                type: 2,
                title: title,
                content: url,
                end: function () {
                    location.reload();
                }
            });
            layer.full(index);
        }
        /*图片-查看*/
        // function product_show(title,url,id){
        //     var index = layer.open({
        //         type: 2,
        //         title: title,
        //         content: url
        //     });
        //     layer.full(index);
        // }
        // /*图片-审核*/
        // function product_shenhe(obj,id){
        //     layer.confirm('审核文章？', {
        //             btn: ['通过','不通过'],
        //             shade: false
        //         },
        //         function(){
        //             $(obj).parents("tr").find(".td-manage").prepend('<a class="c-primary" onClick="product_start(this,id)" href="javascript:;" title="申请上线">申请上线</a>');
        //             $(obj).parents("tr").find(".td-status").html('<span class="label label-success radius">已发布</span>');
        //             $(obj).remove();
        //             layer.msg('已发布', {icon:6,time:1000});
        //         },
        //         function(){
        //             $(obj).parents("tr").find(".td-manage").prepend('<a class="c-primary" onClick="product_shenqing(this,id)" href="javascript:;" title="申请上线">申请上线</a>');
        //             $(obj).parents("tr").find(".td-status").html('<span class="label label-danger radius">未通过</span>');
        //             $(obj).remove();
        //             layer.msg('未通过', {icon:5,time:1000});
        //         });
        // }
        // /*图片-下架*/
        // function product_stop(obj,id){
        //     layer.confirm('确认要下架吗？',function(index){
        //         $(obj).parents("tr").find(".td-manage").prepend('<a style="text-decoration:none" onClick="product_start(this,id)" href="javascript:;" title="发布"><i class="Hui-iconfont">&#xe603;</i></a>');
        //         $(obj).parents("tr").find(".td-status").html('<span class="label label-defaunt radius">已下架</span>');
        //         $(obj).remove();
        //         alert(id);
        //         layer.msg('已下架!',{icon: 5,time:1000});
        //     });
        // }
        // /*图片-发布*/
        // function product_start(obj,id){
        //     layer.confirm('确认要发布吗？',function(index){
        //         $(obj).parents("tr").find(".td-manage").prepend('<a style="text-decoration:none" onClick="product_stop(this,id)" href="javascript:;" title="下架"><i class="Hui-iconfont">&#xe6de;</i></a>');
        //         $(obj).parents("tr").find(".td-status").html('<span class="label label-success radius">已发布</span>');
        //         $(obj).remove();
        //         layer.msg('已发布!',{icon: 6,time:1000});
        //     });
        // }
        // /*图片-申请上线*/
        // function product_shenqing(obj,id){
        //     $(obj).parents("tr").find(".td-status").html('<span class="label label-default radius">待审核</span>');
        //     $(obj).parents("tr").find(".td-manage").html("");
        //     layer.msg('已提交申请，耐心等待审核!', {icon: 1,time:2000});
        // }
        // /*图片-编辑*/
        // function product_edit(title,url,id){
        //     var index = layer.open({
        //         type: 2,
        //         title: title,
        //         content: url
        //     });
        //     layer.full(index);
        // }
        // /*图片-删除*/
        // function product_del(obj,id){
        //     layer.confirm('确认要删除吗？',function(index){
        //         $(obj).parents("tr").remove();
        //         layer.msg('已删除!',{icon:1,time:1000});
        //     });
        // }


    </script>
@endsection
