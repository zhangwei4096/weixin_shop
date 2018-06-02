<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
class IndexController extends Controller
{
    //后台主体部分
    public function index(){
        //后台首页
        return view('Admin.index.index');
    }
}
