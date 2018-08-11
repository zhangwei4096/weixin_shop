<?php

namespace App\Http\Controllers\Admin;

use App\Http\Model\Product;
use App\Http\Model\Shop;
use App\Http\Model\System;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
require_once '../resources/org/phpqrcode/phpqrcode.php'; //引入二维码程序
class ShopController extends Controller
{
    //商铺管理

    public function index(){
        return view('Admin.shop.index');
    }

    public function posts(Request $request){
        //店铺添加
        $data = $request->except('_token');
        $shop = new Shop();
        $shop->name = $data['name'];
        $shop->addr = $data['addr'];
        if ($shop->save()){
            return [
                'msg' => 'success',
                'data'=> '店铺添加成功'
            ];
        }
    }

    public function get(Request $request){
        //异步返回数据
        $result  = $request->post();
        $limit   = $result['limit'];
        $page    = ($result['page']-1)*$limit;
        $data    = DB::table('weixin_shop')->select('id','name','addr','thumb')->offset($page)->limit($limit)->get();
        $info    =  [
            'code' => 0,
            'msg'  => '',
            'count'=> count(Shop::all()),
            'data' => $data
        ];
        return $info;
    }

    public function delete(Request $request){
        $id = $request->post('id');
        if (Shop::destroy($id)){
            return [
                'msg' => 'success',
                'data'=> '删除成功'
            ];
        }
    }

    public function update(Request $request){
        $data = $request->post();
        $shop = Shop::find($data['id']);
        $shop->name = $data['name'];
        $shop->addr = $data['addr'];
        if ($shop->save()){
            return [
                'msg' => 'success',
                'data'=> '修改成功'
            ];
        }
    }

    public function scerweima(Request $request){
        //二维码的生成
        $errorCorrectionLevel = 'L';    //容错级别
        $matrixPointSize = 15;           //生成图片大小

        //生成二维码图片
        $path     = public_path('upload/images/').date('Ymd');
        if (!is_dir($path)){
            mkdir($path);
        }
        $filename =  $path.'/'.time().'.png';
        $AppID =  (json_decode(System::find(3)['data'],true))['AppID'];
        $url      = 'https://open.weixin.qq.com/connect/oauth2/authorize?appid='.$AppID.'&redirect_uri=http%3A%2F%2Fshop.veimx.com&response_type=code&scope=snsapi_userinfo&state='.$request->post('id').'#wechat_redirect';

        \QRcode::png($url,$filename,$errorCorrectionLevel,$matrixPointSize,2);
        $QR = $filename;                //已经生成的原始二维码图片文件


        $QR = imagecreatefromstring(file_get_contents($QR));

        //输出图片
        imagepng($QR, $filename);
        imagedestroy($QR);
        $file = '/upload/images/'.date('Ymd').'/'.time().'.png';  //二维码写入数据库
        $shop = Shop::find($request->post('id'));
        $shop->thumb = $file;
        if ($shop->save()){
            return [
                'msg' => 'success',
                'data'=> '二维码生成成功',
                'url'=> $file
            ];
        }
    }

    public function getOrders($id){
        //获取对应店铺的订单数据
        return view('Admin.shop.orders',[
            'id' => $id
        ]);
    }


}
