<?php

namespace App\Http\Controllers\Admin;

use App\Http\Model\Order;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    //
    public function get(Request $request){
        //数据请求接口
        $result = $request->post();
        $limit  = $result['limit'];
        $page   = ($result['page']-1)*$limit;;
        $data   = DB::table('weixin_order')
            ->select('id','order_id','order_price','order_data','order_time','order_type','end_time','is_goods')
            ->offset($page)->limit($limit)->orderBy('id','desc')->get();
        $info   = [
            'code' => 0,
            'msg'  => '',
            'count'=> count($data),
            'data' => $data
        ];

        return $info;

    }
    public function info($id){
        $order = Order::find($id);
        $data  = json_decode($order->order_info,true);
        $html  = '
    <link rel="stylesheet" type="text/css" href="/admin/static/h-ui/css/H-ui.min.css" />
    <link rel="stylesheet" type="text/css" href="/layui/css/layui.css" />
    <link rel="stylesheet" type="text/css" href="/admin/static/h-ui.admin/css/H-ui.admin.css" />
    <link rel="stylesheet" type="text/css" href="/admin/lib/Hui-iconfont/1.0.8/iconfont.css" />
    <link rel="stylesheet" type="text/css" href="/admin/static/h-ui.admin/skin/default/skin.css" id="skin" />
    <link rel="stylesheet" type="text/css" href="/admin/static/h-ui.admin/css/style.css" />
    <script type="text/javascript" src="/admin/lib/jquery/1.9.1/jquery.min.js"></script>
    <script type="text/javascript" src="/admin/lib/layer/2.4/layer.js"></script>
    <script type="text/javascript" src="/admin/static/h-ui/js/H-ui.js"></script>
    <script type="text/javascript" src="/admin/static/h-ui.admin/js/H-ui.admin.page.js"></script>
    ';
        foreach ($data as &$v){
            $html .='<div style="width: 500px; margin-top: 10px; border: 1px solid red; border-radius: 5px; overflow: hidden;">';
            $html .='    <div style="float: left; width: 150px;"> ';
            $html .='        <img src="'.$v['thumb'].'" alt="图片" width=150 height=150 /> ';
            $html .='   </div>';
            $html .='    <div style="float: right; width: 330px;">';
            $html .='        <p>商品名：'.$v['title'].'</p>';
            $html .='        <p>单价：<strong style="color: red;">'.$v['xs_price'].'</strong> 元 X 数量： '.$v['num'].' </p>';
            $html .='    </div>';
	        $html .='</div>';
        }
        $html .= '   <div class="page-container">
    <form action="" method="post" class="form form-horizontal" id="form-article-add">';
        $html .= '<div class="row cl">';
        $html .= '<label class="form-label col-xs-4 col-sm-2">';
        $html .= '<span class="c-red">*</span>总价：</label>';
        $html .= '<div class="formControls col-xs-8 col-sm-9">';
        $html .= '<input type="text" name="price"  value="'.$order->order_price.'" class="input-text">';
        $html .= '</div>';
        $html .= '</div>';
        if ($order->order_type == 1){
            $html .= '<div class="row cl">';
            $html .= '<label class="form-label col-xs-4 col-sm-2">';
            $html .= '<span class="c-red">*</span>发货快递：</label>';
            $html .= '<div class="formControls col-xs-8 col-sm-9">';
            $html .= '<input type="text" name="express" value="'.$order->express.'" class="input-text">';
            $html .= '</div>';
            $html .= '</div>';
            $html .= '<div class="row cl">';
            $html .= '<label class="form-label col-xs-4 col-sm-2">';
            $html .= '<span class="c-red">*</span>快递单号：</label>';
            $html .= '<div class="formControls col-xs-8 col-sm-9">';
            $html .= '<input type="text" name="number" value="'.$order->number.'" class="input-text">';
            $html .= '</div>';
            $html .= '</div>';
        }
        $html .= '
                    <div class="row cl">
                        <div class="col-xs-8 col-sm-9 col-xs-offset-4 col-sm-offset-2">
                            <button onClick="saveContent('.$order->id.');" class="btn btn-primary radius" type="button">
                                <i class="Hui-iconfont">&#xe632;</i> 确认修改
                            </button>
                            <!--<button onClick="layer_close();" class="btn btn-default radius" type="button">&nbsp;&nbsp;取消&nbsp;&nbsp;</button>-->
                        </div>
                    </div>'.csrf_field().'';
        $html .= '</form></div>';
        $html .= '
            <script>
                function saveContent(id) {
                    var _token = $("input[name=_token]").val();
                    var price  = $("input[name=price]").val();
                    var express= $("input[name=express]").val();
                    var number = $("input[name=number]").val();
                    if (express == null || express == ""){
                        express = 0;
                    }
                     if (number == null || number == ""){
                        number = 0;
                    }
                    
                    $.post("/admin/order/edit",{id:id,_token:_token,price:price,number:number,express:express},function(result){
                        if (result.msg == "success"){
                            layer.msg(result.data,{icon: 1});
                        }else{
                            layer.msg(result.data,{icon: 5});
                        }
                    });
                }
                function layer_close () {
                    layer.closeAll("page");
                }
            </script>
        ';
        return $html;
    }

    public function edit(Request $request){
        //修改订单
        $id     = $request->post('id');
        $order  = Order::find($id);
        if ($order->order_type == '0'){
            //订单状态为未支付 可能是修改价格
            $price = $request->post('price');
            $order->order_price = $price;
            if ($order->save()){
                return [
                    'msg' => 'success',
                    'code'=> 0,
                    'data'=> '总价修改成功'
                ];
            }
        }else{
            //订单状态为支付成功 修改发货快递
            $express = $request->post('express');
            $number  = $request->post('number');
            if ($express == '0' || $number == '0'){
                return [
                'msg' => 'error',
                'code'=> 1,
                'data'=> '快递公司或快递单号不能为空'
                ];
            }else{
                $order->express = $express;  //快递公司
                $order->number  = $number;  //快递单号
                $order->is_goods= '1'; //是否发货
                if ($order->save()){
                    return [
                        'msg' => 'success',
                        'code'=> 0,
                        'data'=> '发货成功'
                    ];
                }
            }


        }
    }



}
