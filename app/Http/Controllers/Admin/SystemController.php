<?php

namespace App\Http\Controllers\Admin;

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
        $result = System::find($type);
        return $result['data'];
    }
}
