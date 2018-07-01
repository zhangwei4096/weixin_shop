@extends('Admin.index.layout.common')
@section('content')
    <style>
        .layui-table-cell {
            height: 100%!important;
        }
    </style>
    <section class="Hui-article-box">
        <nav class="breadcrumb"><i class="Hui-iconfont">&#xe67f;</i> 首页 <span class="c-gray en">&gt;</span> 订单管理 <span class="c-gray en">&gt;</span> 订单列表 <a class="btn btn-success radius r" style="line-height:1.6em;margin-top:3px" href="javascript:location.replace(location.href);" title="刷新" ><i class="Hui-iconfont">&#xe68f;</i></a></nav>
        <div class="Hui-article">

            <div class="pd-20">
                {{--<div class="cl pd-5 bg-1 bk-gray mt-20">
                        <span class="l">
                            <a href="javascript:;" data-type="getCheckData" class="btn btn-danger radius">
                                <i class="Hui-iconfont">&#xe6e2;</i> 批量删除
                            </a>
                            <a class="btn btn-primary radius" onclick="product_add('添加产品','{{ url('admin/product/add') }}')" href="javascript:;">
                                <i class="Hui-iconfont">&#xe600;</i> 添加产品
                            </a>
                        </span>
                </div>--}}
                <div class="mt-20">
                    <table class="layui-hide" id="list" lay-filter="demo"></table>
                    <script type="text/html" id="barDemo">
                        {{--<a class="layui-btn layui-btn-primary layui-btn-xs" lay-event="send">上架|下架</a>--}}
                        <a class="layui-btn layui-btn-xs" lay-event="edit">查看详情</a>
                        <a class="layui-btn layui-btn-danger layui-btn-xs" lay-event="del">删除</a>
                    </script>
                </div>
            </div>
        </div>
    {{ csrf_field() }}
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
                        ,url:'{{ url('admin/order/get') }}'
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
                            ,{field:'order_id', width:200, title: '订单号'}
                            ,{field:'order_price', width:120, title: '订单总价' , sort: true}
                            ,{field:'order_time', width:180, title: '下单时间', sort: true}
                            ,{field:'end_time', width:180, title: '支付时间',sort: true}
                            ,{field:'order_type', width:180, title: '是否支付' ,sort: true,templet:function(d){
                                    if (d.order_type == '0'){return '<p style="color: red;">未支付</p>'}
                                    else{ return '<p style="color: green;">支付成功</p>'}
                                },align:'center'}
                            ,{field:'is_goods', width:180, title: '是否发货' ,sort: true,templet:function(d){
                                    if (d.is_goods == '0'){return '<p style="color: red;">未发货</p>'}
                                    else{ return '<p style="color: green;">发货成功</p>'}
                                },align:'center'}
                            ,{field:'order_data', title: '订单备注', width: 200 }
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
                                $.post("{{url('admin/order/delete')}}",{_token:_token,id:id},function(result){
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
                                type:2 ,
                                area:['520px','600px'],
                                title: '订单编辑',
                                content: "{{ url('admin/order/info') }}/"+id,
                                end: function () {
                                    location.reload();
                                }
                            });
                            //layer.full(index);
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

    </script>
@endsection