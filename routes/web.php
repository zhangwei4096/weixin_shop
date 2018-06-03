<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});


Route::get('admin/login','Admin\LoginController@index');
Route::get('admin/code','Admin\LoginController@code');
//Route::get('admin/getcode','Admin\LoginController@getcode');
Route::post('admin/login/posts','Admin\LoginController@posts'); //后台登陆验证

Route::group(['middleware'=>['admin.login']],function(){
//添加验证
    Route::get('admin/index','Admin\IndexController@index'); //后台首页
    Route::post('admin/posts','Admin\IndexController@posts'); //管理员密码修改
    Route::get('admin/out','Admin\IndexController@out'); //退出登录

    //产品管理
    Route::get('admin/product/list','Admin\ProductController@index'); //产品展示首页
    Route::get('admin/product/add','Admin\ProductController@add'); //添加产品页面
    Route::post('admin/product/posts','Admin\ProductController@posts');//添加产品业务逻辑

    Route::post('admin/file/upload','Admin\ProductController@upload'); //缩略图上传
});