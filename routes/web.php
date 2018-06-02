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
Route::post('admin/posts','Admin\LoginController@posts'); //后台登陆验证

Route::group(['middleware'=>['admin.login']],function(){
//添加验证
    Route::get('admin/index','Admin\IndexController@index');
});