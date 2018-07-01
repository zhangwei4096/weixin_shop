<?php

namespace App\Http\Controllers\Home;

use App\Http\Model\Order;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class OrderController extends Controller
{
    //我的订单中心


    public function index(){
        $user_id = IndexController::get_user_id(); //当前用户的ID

        //查询出当前用户为支付的订单
        $n_pay  = Order::where([['order_type','0'],['user_id',$user_id]])->OrderBy('order_time','desc')->get();
        //查询出当前用户支付成功了的订单
        $y_pay  = Order::where([['order_type','1'],['is_goods','0'],['user_id',$user_id]])->OrderBy('order_time','desc')->get();
        //查询出当前用户支付成功并且发货的订单
        $w_pay  = Order::where([['order_type','1'],['is_goods','1'],['user_id',$user_id]])->OrderBy('order_time','desc')->get(); //is_goods 代表是否发货


        return view('Home.index.order',[
            'n_pay' => $n_pay,  //未支付
            'y_pay' => $y_pay,  //支付成功
            'w_pay' => $w_pay   //发货成功{已完成}
        ]);
    }

    public function more($id){
        //订单详细页面
        $order  = Order::find($id);
        return view('Home.index.order.more',[
            'order' => $order
        ]);
    }
}
