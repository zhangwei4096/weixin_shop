<?php

namespace App\Http\Controllers\Admin;

use App\Http\Model\Shop;
use App\Http\Model\users;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class MemberController extends Controller
{
    //会员列表
    public function get(Request $request){
        $page   = $request->post('page');
        $limit  = $request->post('limit');
        $page   = ($page-1)*$limit;
        $data   = DB::table('weixin_users')->select('id','nickname','city','sex','thumb','shop_id','state')->offset($page)->limit($limit)->get();

        foreach (json_decode(json_encode($data),true) as $k => $v){

            $v['shop_name']  =   DB::table('weixin_shop')->where('id',$v['shop_id'])->value('name');
            $new[]           = $v;
        }

        $result = [
            'code' => 0,
            'msg'  => '',
            'count'=> count($data),
            'data' => $new
        ];
        return $result;
    }


    public function delete(Request $request){
        if (users::destroy($request->post('id'))){
            return [
                'msg' => 'success',
                'data'=> '删除成功'
            ];
        }
    }

    public function state (Request $request){
        $state  = $request->post('state');
        $user   = users::find($request->post('id'));
        $user->state = ($state == '0') ? '1' : '0';
        if ($user->save()){
            return [
                'msg'  => 'success',
                'data' => ($state == '0') ? '暂停成功' : '启用成功',
                'state'=> ($state == '0') ? '暂停' : '正常',
            ];
        }
    }

}
