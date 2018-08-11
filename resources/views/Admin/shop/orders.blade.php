<html>
<body>
<link rel="stylesheet" type="text/css" href="{{ URL::asset('layui/css/layui.css') }}" />
<script type="text/javascript" src="{{ URL::asset('admin/lib/jquery/1.9.1/jquery.min.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('admin/lib/My97DatePicker/4.8/WdatePicker.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('admin/lib/datatables/1.10.0/jquery.dataTables.min.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('admin/lib/laypage/1.2/laypage.js ') }}"></script>
<script type="text/javascript" src="{{ URL::asset('admin/lib/zTree/v3/js/jquery.ztree.all-3.5.min.js ') }}"></script>
<script type="text/javascript" src="{{ URL::asset('layui/layui.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('layui/layui.js') }}"></script>
<style>
    .layui-table-cell {
        height: 100%!important;
    }
</style>
<section class="Hui-article-box">
    <div class="Hui-article">
        <div class="pd-20">
            <div class="mt-20">
                <table class="layui-hide" id="list" lay-filter="demo"></table>
                <script type="text/html" id="barDemo">
                    <a class="layui-btn layui-btn-xs" lay-event="edit">查看详情</a>
                    <a class="layui-btn layui-btn-danger layui-btn-xs" lay-event="del">删除</a>
                </script>
            </div>
        </div>
    </div>
    {{ csrf_field() }}


    <script type="text/javascript">
        var _token = $('input[name=_token]').val();
        layui.use('table', function(){
            var table = layui.table;
            //监听工具条
            table.on('tool(demo)', function(obj){
                var data = obj.data;
                var id    = JSON.stringify(data.id);
                if(obj.event === 'detail'){
                    layer.msg('ID：'+ data.id + ' 的查看操作');
                } else if(obj.event === 'del'){
                    layer.confirm('确定要删除吗？', function(index){
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

            table.render({
                elem: '#list'
                ,url:'{{ url('admin/shop/pays/') }}/'+{{ $id }}
                ,page: { //支持传入 laypage 组件的所有参数（某些参数除外，如：jump/elem） - 详见文档
                    layout: ['limit', 'count', 'prev', 'page', 'next', 'skip'] //自定义分页布局
                    //,curr: 5 //设定初始在第 5 页
                    ,groups: 1 //只显示 1 个连续页码
                    ,first: false //不显示首页
                    ,last: false //不显示尾页

                }
                ,cols: [[
                     {field:'id', width:50, title: 'ID', sort: true}
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


            $('.btn-danger').on('click', function(){
                var type = $(this).data('type');
                active[type] ? active[type].call(this) : '';
            });

        });

    </script>
</body>
</html>

