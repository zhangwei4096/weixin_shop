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

Route::group(['prefix' => 'admin','namespace'=>'Admin'],function (){
    Route::get('login','LoginController@index');
    Route::get('code','LoginController@code');
    //Route::get('admin/getcode','LoginController@getcode');
    Route::post('login/posts','LoginController@posts'); //后台登陆验证


});


Route::group(['prefix' => 'admin','namespace'=>'Admin','middleware'=>['admin.login']],function(){
//添加验证
    Route::get('index','IndexController@index'); //后台首页
    Route::post('posts','IndexController@posts'); //管理员密码修改
    Route::get('out','IndexController@out'); //退出登录

    //产品管理
    Route::get('product/list','ProductController@index'); //产品展示首页
    Route::get('product/get','ProductController@get');  //异步数据请求接口
    Route::get('product/add','ProductController@add'); //添加产品页面
    Route::post('product/posts','ProductController@posts');//添加产品业务逻辑
    Route::get('product/update','ProductController@update'); //产品修改展示页面
    Route::post('product/edit','ProductController@edit'); //产品数据修改
    Route::any('product/delete','ProductController@delete'); //删除数据
    Route::any('product/type','ProductController@type'); //上下架商品
    Route::post('file/upload','ProductController@upload'); //缩略图上传

    //店铺管理
    Route::get('shop/index','ShopController@index');
    Route::get('shop/add',function(){
        return view('Admin.shop.add');
    });
    Route::post('shop/posts','ShopController@posts');
    Route::get('shop/get','ShopController@get');
    Route::post('shop/delete','ShopController@delete');
    Route::post('shop/update','ShopController@update');
    Route::post('shop/scerweima','ShopController@scerweima'); //生成二维码
    Route::get('shop/{id}','ShopController@getOrders');   //获取对应店铺的订单数据
    Route::get('shop/pays/{id}','OrderController@getShopOrders'); //获取店铺已售商品数据


    //会员管理
    Route::get('member/index',function(){
        return view('Admin.member.index');
    });
    Route::get('member/get','MemberController@get');
    Route::post('member/delete','MemberController@delete');
    Route::post('member/state','MemberController@state');

    //订单管理
    Route::get('order/index',function(){
        return view('Admin.order.index');
    });

    Route::get('order/paid',function(){
        return view('Admin.order.paid');  //已支付的订单展示页面
    });
    Route::get('order/nys',function(){
        return view('Admin.order.nys');  //已支付但未发货的订单展示页面
    });

    Route::get('order/get/{type}','OrderController@get'); //获取用户的订单数据  type参数为可选的

    Route::get('order/info/{id}','OrderController@info'); //获取订单里面的信息
    Route::post('/order/edit','OrderController@edit'); //修改订单
    Route::post('/order/delete','OrderController@delete'); //删除订单
    //系统设置
    Route::get('sys/index',function(){
        return view('Admin.system.index');
    });
    Route::post('sys/save/{type}','SystemController@save');
    Route::post('sys/get/{type}','SystemController@get'); //获取数据
});



//首页路由
//强制跳转到微信授权页面
//header("Location: https://open.weixin.qq.com/connect/oauth2/authorize?appid=wxeba0c3cbc3992a59&redirect_uri=http%3A%2F%2Fwww.vimx.cn&response_type=code&scope=snsapi_userinfo&state=STATE#wechat_redirect");
//

Route::get('index/verify','Home\IndexController@verify');  //微信网页认证跳转

Route::get('/pay_type/{order}/{type}','Home\PayController@pay_type'); //订单支付类型 并且调起支付宝支付
//订单异步通知 需要取消CSRF 验证
Route::post('/pay/alipay_verify','Home\PayController@notify_url');  //订单异步通知
Route::post('/wx/notify','Home\PayController@wx_notify'); //微信异步通知
//'middleware'=>['home.login']
//
Route::get('/','Home\IndexController@index');  //首页

Route::group(['namespace'=>'Home','middleware'=>['home.login']],function(){

    Route::get('/product/{id}','IndexController@product'); //商品详细列表页面
    Route::post('/to_cart','IndexController@to_cart'); //加入到购物车
    Route::post('/del_cart','IndexController@del_cart'); //删除购物车
    Route::post('/sum_cart','IndexController@sum_cart'); //购物车减一
    Route::get('/cart','IndexController@cart'); //购物车展示
    Route::get('/order/cid/{cid}','IndexController@order');  //填写订单);
    Route::get('/add/addr',function (){  //添加地址页面
        return view('Home.index.son.addr');
    });

    Route::post('/to_order','IndexController@to_order'); //提交订单
    Route::get('/pay/{order}','PayController@pay'); //支付页面


    //收货地址操作
    Route::get('/select/addr','IndexController@select_addr');//选择收货地址
    Route::post('/add/addr','IndexController@add_addr');//添加收货地址
    Route::post('/del/addr','IndexController@del_addr');
    Route::post('/default/addr','IndexController@set_default'); //设置为默认收货地址
    Route::get('/edit/addr/{id}','IndexController@edit_addr');  //修改收货地址
    Route::post('/edit/addr','IndexController@update');

    //我的订单中心操作
    Route::get('/my/orders','OrderController@index');  //订单中心首页
    Route::get('/my/orders/{id}','OrderController@more'); //订单详细页面

    //我的个人中心
    Route::get('/center','CenterController@index'); //个人中心首页
});



//下面是测试的

Route::group(['middleware'=>['home.login']],function(){
    //用户登陆成功

    Route::get('/a',function(){
       echo session('openid');
    });
});

//
Route::get('get/access_token','Home\GetController@access_token');
Route::get('get/info/{code}','Home\GetController@get_webuser_info');
//Route::get('/home/wx','Home\PayController@wxpay');

























