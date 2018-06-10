@extends('Admin.index.layout.common')
@section('content')
    <style>
        .layui-table-cell {
            height: 50%!important;
        }
    </style>
<section class="Hui-article-box">
    <nav class="breadcrumb"><i class="Hui-iconfont">&#xe67f;</i> 首页 <span class="c-gray en">&gt;</span> 用户中心 <span class="c-gray en">&gt;</span> 会员列表<a class="btn btn-success radius r" style="line-height:1.6em;margin-top:3px" href="javascript:location.replace(location.href);" title="刷新" ><i class="Hui-iconfont">&#xe68f;</i></a></nav>
    <div class="Hui-article">
        <article class="cl pd-20">

            {{--<div class="cl pd-5 bg-1 bk-gray mt-20">
                <span class="l">
                    <a href="javascript:;" onclick="datadel()" class="btn btn-danger radius">
                        <i class="Hui-iconfont">&#xe6e2;</i> 批量删除
                    </a>
                    <a href="javascript:;" onclick="member_add('添加用户','member-add.html','','510')" class="btn btn-primary radius">
                        <i class="Hui-iconfont">&#xe600;</i> 添加用户
                    </a>
                </span>
            </div>--}}
            <div class="mt-20">
                <table class="layui-hide" id="list" lay-filter="demo"></table>
                <script type="text/html" id="barDemo">
                    <a class="layui-btn layui-btn-xs" lay-event="end">暂停/启用</a>
                    <a class="layui-btn layui-btn-danger layui-btn-xs" lay-event="del">删除</a>
                </script>
            </div>
            {{ csrf_field() }}
        </article>
    </div>
</section>
@endsection
@section('javascript')

<!--请在下方写此页面业务相关的脚本-->
<script type="text/javascript" src="{{ URL::asset('admin/lib/My97DatePicker/4.8/WdatePicker.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('admin/lib/datatables/1.10.0/jquery.dataTables.min.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('admin/lib/laypage/1.2/laypage.js ') }}"></script>
<script type="text/javascript" src="{{ URL::asset('admin/lib/zTree/v3/js/jquery.ztree.all-3.5.min.js ') }}"></script>
<script type="text/javascript" src="{{ URL::asset('layui/layui.js') }}"></script>
<script type="text/javascript">
    var _token = $('input[name=_token]').val();
    layui.use('table', function() {
        var table = layui.table;

        table.render({
            elem: '#list'
            , url: '{{ url('admin/member/get') }}'
            , page: { //支持传入 laypage 组件的所有参数（某些参数除外，如：jump/elem） - 详见文档
                layout: ['limit', 'count', 'prev', 'page', 'next', 'skip'] //自定义分页布局
                //,curr: 5 //设定初始在第 5 页
                , groups: 1 //只显示 1 个连续页码
                , first: false //不显示首页
                , last: false //不显示尾页

            }
            , cols: [[
                  {field: 'id', width: 50, title: 'ID', sort: false}
                , {field: 'nickname', width: 150, title: '微信名称',align:'center'}
                , {field: 'sex',width: 80 ,title:'性别',align:'center', templet:function(d){
                        if (d.sex=='1'){return '男'}else if(d.sex=='0'){return '未知'}else {return '女'}
                    }}
                , {field: 'city', width: 120, title: '城市',align:'center'}

                , {
                    field: 'thumb',
                    width: 150,
                    title: '头像',
                    templet: function (d) {
                        if (d.thumb == null) {
                            return '未知头像'
                        } else {
                            return '<div><img  src="' + d.thumb + '"  height="45" width="45"/></a></div>'
                        }
                    },
                    align: 'center'
                }
                , {field: 'shop_name',title:'所属店铺',align:'center',width:150,templet:function(d){
                        if (d.shop_name == null){ return '管理员所属'}else {return d.shop_name}
                    }}
                , {field: 'state' , title:'状态',align:'center',width:80,templet:function (d) {
                        if(d.state  == '0'){
                            return '正常'
                        }else{
                            return '暂停'
                        }
                    }}
                , {fixed: 'right', title: '操作', align: 'center', toolbar: '#barDemo'}
            ]]

        });

        //监听工具
        table.on('tool(demo)',function(obj){
            var data = obj.data;
            if (obj.event === 'edit'){
                layer.open({
                    type:1,
                    area:['520px','320px'],
                    title:'用户修改',
                    content: '',
                    end:function(){
                        location.reload();
                    }
                });
            }else if(obj.event === 'del'){
                layer.confirm('真的要删除这个用户吗?',function(index){
                    $.post('{{url('admin/member/delete')}}',{_token:_token,id:data.id},function(result){
                            if (result.msg == 'success'){
                                layer.msg(result.data);
                                obj.del();
                                layer_close(index);
                            }
                    });
                });
            }else if (obj.event === 'end'){
                //启用或者暂停用户
                $.post('{{url('admin/member/state')}}',{_token:_token,id:data.id,state:data.state},function(result){
                        if (result.msg == 'success'){
                            layer.msg(result.data);
                            obj.update({
                                //修改
                                state: result.state
                            });
                        }
                });
            }
        });

    });
</script>
@endsection