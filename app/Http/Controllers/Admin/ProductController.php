<?php

namespace App\Http\Controllers\Admin;

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
