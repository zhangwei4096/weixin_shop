<?php

namespace App\Http\Controllers\Admin;

use App\Http\Model\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProductController extends Controller
{
    //产品控制器
    public function index(){
        //产品列表页面
        return view('Admin.product.index');
    }


    public function add(){
        //产品添加
        return view('Admin.product.add');
    }

    public function posts(Request $request){
        $info    = $request->except('_token');  //获取除了_token以外的数据
        $product = new Product();
        $product->title = $info['title'];
        $product->chandi= $info['chandi'];
        $product->jjdw  = $info['jjdw'];
        $product->zl    = $info['zl'];
        $product->info  = $info['info'];
        $product->thumb = $info['thumb'];
        $product->content= $info['content'];
        $product->xs_price = $info['xs_price'];
        $product->sc_price = $info['sc_price'];
        $product->cb_price = $info['cb_price'];
        $product->start_time = $info['start_time'];
        $product->end_time   = $info['end_time'];
        if ($product->save()){
            return [
                'msg' => 'success',
                'data'=> '保存成功'
            ];
        }else{
            return [
                'msg' => 'error',
                'data'=> '错误'
            ];
        }


    }


    public function upload(Request $request){
//        if ($request->method()== 'POST') {
//            $date = date('Ymd');
//            $path = $request->file('file')->store('', 'upload');
//            if ($path){
//                $fileUrl = '/upload/images/'.$date.'/'.$path;
//                $status = 1;
//                $data['url'] = $fileUrl;
//                $message = '上传成功';
//            }else{
//                $message = "上传失败";
//            }
//        } else {
//            $message = "参数错误";
//        }
//        return showMsg($status, $message,$data);
        $rs = $request->file('photo');

        if ($request->hasFile('photo') && $request->file('photo')->isValid()){
            $path = $request->photo->storeAs('images',time().mt_rand(1000,9999).'.jpg','upload');
            if ($path){
                $fileUrl = '/upload/images/'.date("Ymd").'/'.$path;
                return [
                    'msg' => 'success',
                    'url' => $fileUrl
                ];
            }else{
                return [
                    'msg' => 'error'
                ];
            }

        }

    }
}
