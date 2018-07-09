<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
require_once '../resources/org/alipay/config.php';  //读取配置文件
require_once '../resources/org/alipay/wappay/buildermodel/AlipayTradeQueryContentBuilder.php';
require_once '../resources/org/alipay/wappay/service/AlipayTradeService.php';
/*
 * 支付宝支付
 *
 * */


class AlipayController extends Controller
{
    public function pay(){
        //生成支付订单

    }
}
