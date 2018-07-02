<?php

namespace App\Http\Controllers\Home;

use App\Http\Model\users;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CenterController extends Controller
{
    //个人信息中心

    public function index(){
        //个人中心首页
        $user_id = IndexController::get_user_id(); //获取用户的user_id

        $user    = users::find($user_id);

        return view('Home.index.center',[
            'user' => $user
        ]);
    }


}
