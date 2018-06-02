<?php

namespace App\Http\Controllers\Admin;

use App\Http\Model\Admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
class IndexController extends Controller
{
    //后台主体部分
    public function index(){
        //后台首页
        return view('Admin.index.index');
    }

    public function posts(Request $request){
        //修改密码
        $password = $request->post('pass1');

        $user = Admin::find($request->post('id'));
        $user->password = encrypt($password);
        if ($user->save()){
            return [
                'msg' => 'success',
                'data'=> '密码修改成功,将在下次登录生效'
            ];
        }
    }

    public function out(Request $request){
        //退出登录
        $request->session()->pull('username','default');
        $request->session()->pull('id','default');
        return redirect('admin/login');
}


}
