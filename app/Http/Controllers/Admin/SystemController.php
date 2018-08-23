<?php

namespace App\Http\Controllers\Admin;

use App\Http\Model\Product;
use App\Http\Model\System;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class systemController extends Controller
{
    //系统设置控制器

    public function save(Request $request,$type){
        //保存系统设置的JSON数据
        $data = $request->except('_token');
        $sys  = System::find($type);
        $sys->data = json_encode($data);
        if ($sys->save()){
            return [
                'msg' => 'success',
                'data' => '保存成功'
            ];
        }

    }


    function get($type){
        //如果传过来的id为2那么就需要单独做处理
        if ($type==2){
            $info = Product::select('id','title')->get();
//            foreach ($info as &$v){
//
//            }
            $product['info'] = $info;
            $product['data'] = System::find($type)['data'];
            return $product;
        }else{
            $result = System::find($type);
            return $result['data'];
        }

    }
}
