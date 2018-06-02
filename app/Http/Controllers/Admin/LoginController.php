<?php

namespace App\Http\Controllers\Admin;
use App\Http\Model\Admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
require_once '../resources/org/code/Code.class.php';
class LoginController extends Controller
{
    public function index(){
        //用户登录页面

        return view('Admin.login.index',[
            'title' => '重庆好健康医药有限公司',
            'version' => '1.0'
        ]);
    }


    public function code(){
        //产生验证码
        $code = new \Code();
        $code->doimg();

        session([
           'code' => $code->getCode()
        ]);
    }


    public function posts(Request $request){
        //登陆验证POST提交

      $username = $request->post('username');
      $password = $request->post('pwd');
      $code     = $request->post('code');
      if ($code != session('code')){
          return [
              'msg' => 'error',
              'data'=> '验证码错误'
          ];

      }

      //下面开始验证账号密码是否正确
      $user = Admin::first();
      if ($user->username == $username && decrypt($user->password) == $password){
          //账号密码验证成功开启SESSION
          session([
              'username' => $user->username,
              'id'       => $user->id
          ]);
          return [
              'msg' => 'success',
              'data'=> '恭喜您登陆成功'
          ];


      }else{
          return [
              'msg' => 'error',
              'data'=> '账号或者密码错误'
          ];
      }





    }



}
