<?php

namespace App\Http\Controllers\Home;

use App\Http\Model\Addrs;
use App\Http\Model\Cart;
use App\Http\Model\Order;
use App\Http\Model\Product;
use App\Http\Model\Shop;
use App\Http\Model\System;
use App\Http\Model\users;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class IndexController extends Controller
{

    public function verify(){
        //微信跳转认证获取用户openid

        $AppID =  (json_decode(System::find(3)['data'],true))['AppID'];
        header("Location: https://open.weixin.qq.com/connect/oauth2/authorize?appid=".$AppID."&redirect_uri=http%3A%2F%2Fshop.veimx.com&response_type=code&scope=snsapi_userinfo&state=STATE#wechat_redirect");
    }

//微信商城首页
    public function index(Request $request){
        //获取所有商品信息
        //session(['openid'=>'ouTkduJIVI_J5P7CTg8ucpdVhMlM']);
        if ($request->get('code')){
            $info  = new GetController();
            $openid= $info->get_webuser_info($request->post('code'),$request->post('state'));  //吧CODE传递过去拿到 openID

            //开启全局SESSION
            session(['openid'=>$openid]);
        }

        if (!session('openid')){
            $this->verify();
        }

        $data = DB::table('weixin_product')->where('type','1')->orderBy('id','DESC')->get();
        $info  = json_decode(System::find(2)['data'],true);
        return view('Home.index.home',[
            'data' => $data,
            'loop' => explode(',',$info['images']),
            'img'  => $info['thumb']
        ]); //首页
    }

    public function cart(){
        //购物车 获取当前用户的购物车商品
        $user_id  = users::where('openid',session('openid'))->value('id');
        $data = DB::table('weixin_product')->join('weixin_cart','weixin_product.id','=','weixin_cart.product_id')->where('user_id',$user_id)
            ->select('weixin_product.title','weixin_product.id as pid','weixin_product.thumb','weixin_product.xs_price','weixin_cart.num','weixin_cart.id as cid')->get();

        return view('Home.index.cart',[
            'data' => $data
        ]);
    }


    public function to_cart(Request $request){
        //加入到购物车  根据用户的openid查询到对应的user_id
        $user_id  = users::where('openid',session('openid'))->value('id');
        //$price    = Product::where('id',$request->post('id'))->value('xs_price');
        $num      = $request->post('num');
        //根据商品ID 来查询出购物车是否有此记录
        $cart_id  = Cart::where([['user_id',$user_id],['product_id',$request->post('id')]])->value('id');
        if (is_null($cart_id)){
            //为空就添加数据
            $cart             = new Cart();
            $cart->num        = $num;
            $cart->user_id    = $user_id;
            $cart->product_id = $request->post('id');  //商品ID
            return self::msg($cart->save());
        }else{
            //修改数据
          $result = Cart::where('id',$cart_id)->increment('num',$num);
          return self::msg($result);


        }

        return true;
    }

    public function sum_cart(Request $request){
        //购物车商品减1
        $user_id = users::where('openid',session('openid'))->value('id');
        $num     = $request->post('num');
        $cart_id = Cart::where([['user_id',$user_id],['product_id',$request->post('id')]])->value('id');
        //执行数据修改
        $result  = Cart::where('id',$cart_id)->decrement('num',$num);
        return self::msg($result);

    }

    public function del_cart(Request $request){
        //删除购物车的数据
        $user_id = users::where('openid',session('openid'))->value('id');
        $cid = $request->post('cid'); //获取需要删除购物车的ID号
        return self::msg(Cart::where([['user_id',$user_id],['product_id',$cid]])->delete());
    }



    public function order(Request $request,$cid){
        //填写订单页面
        $addr_id  = users::where('openid',session('openid'))->value('addrs_id');
        $user_id  = users::where('openid',session('openid'))->value('id');
        $addrs    = Addrs::where([['id',$addr_id],['user_id',$user_id]])->get();
        $data = DB::table('weixin_product')
            ->join('weixin_cart','weixin_product.id','=','weixin_cart.product_id')
            ->where('user_id',$user_id)
            ->select('weixin_product.title','weixin_product.id as pid','weixin_product.thumb','weixin_product.xs_price','weixin_cart.num','weixin_cart.id as cid')
            ->get();
        $price = 0;
        $cids = explode(',',$cid);
        for ($i=0;$i<count($cids);$i++){
            foreach ($data as $k => $v){

                if ($v->cid == $cids[$i]){
                    $datas[] = $v;
                    $price  += $v->num*$v->xs_price;
                }
            }
        }


//        var_dump(count($addrs))  ;
//        die();
        if (is_null(@$datas)){
            return '<h1>请勿非法操作</h1>';
        }else{
            return view('Home.index.son.order',[
                'addrs' => $addrs,
                'data'  => $datas,
                'price' => $price,
                'cid'   => $cid
            ]);
        }
    }




    public function add_addr(Request $request){
        //添加地址
        $user_id  = users::where('openid',session('openid'))->value('id');
        $user_add = users::where('id',$user_id)->value('addrs_id');
        $addrs    = explode(' ',$request->post('addrs'));
        //1 首先查询当前用户是否有默认收货地址  没有就吧当前设置为默认收货地址

        $addrs_id  = Addrs::insertGetId([
            'province' => $addrs[0],
            'city'     => $addrs[1],
            'district' => $addrs[2],
            'name'     => $request->post('name'),
            'phone'    => $request->post('phone'),
            'more'     => $request->post('more'),
            'user_id'  => $user_id
        ]);

        if ($user_add == 0 ){
            $user = users::find($user_id);
            $user->addrs_id = $addrs_id;
            return self::msg($user->save());
        }else{
            return self::msg($addrs_id);
        }
    }


    public function select_addr(){
        //选择收货地址
        $user_id  = users::where('openid',session('openid'))->value('id');
        //获取当前用户的收货地址
        $addrs    = Addrs::where('user_id',$user_id)->get();

        return view('Home.index.son.select',[
            'addrs' => $addrs
        ]);
    }


    public function del_addr(Request $request){
        //删除地址
        return self::msg(Addrs::destroy($request->post('id')));
    }

    public function set_default(Request $request){
        //设置为默认收货地址
        $user_id  = self::get_user_id();
        $user   = users::find($user_id);
        $user->addrs_id = $request->post('id');
        return self::msg($user->save());
    }

    public function edit_addr($id){
        //修改收货地址展示页面
        $addrs = Addrs::find($id);
        return view('Home.index.son.edit',[
            'addrs' => $addrs
        ]);
    }

    public function update(Request $request){
        //修改收货地址信息写入到数据库
        $addrs = Addrs::find($request->post('id'));
        $addr  = explode(' ',$request->post('addrs'));
        $addrs->name = $request->post('name');  //收货人
        $addrs->phone= $request->post('phone'); //收货电话
        $addrs->more = $request->post('more'); //详细地址
        $addrs->province = $addr[0];
        $addrs->city     = $addr[1];
        $addrs->district = $addr[2];
        return self::msg($addrs->save());
    }


    /*
     * 提交订单处理
     * 计算总成本价格
     * 计算总销售价格
     * 计算利润
     *
     * */
    public function to_order(Request $request){
        //提交订单 事务处理 order_info 订单信息表 用JSON存储
        $cid     = explode(',',$request->post('cid'));  //获取选中的商品
        $user_id = users::where('openid',session('openid'))->value('id'); //用户ID

        foreach ($cid as &$v){
            $cart = Cart::find($v);
            $product[] = DB::table('weixin_product')
                ->join('weixin_cart','weixin_product.id','=','weixin_cart.product_id')
                ->where('weixin_product.id','=',$cart['product_id'])
                ->select('weixin_product.title','weixin_product.thumb','weixin_product.xs_price','weixin_product.cb_price','weixin_cart.num','weixin_product.id')
                ->get();


        }

        //三维数组转二位数组

        foreach ($product as $c => $n){
            $new_json[] = $n[0];

        }

        $price = 0;
        foreach ($new_json as &$v){  //JSON对象
            $v->price = $v->num*$v->xs_price; //销售价格*数量
            $price   += $v->price; //总价

            /*
             * 可能后续还需要添加总成本价格 以便于计算利润
             * */
        }

        //需要吧收货地址信息提取出来单独写入订单表中

        $addrs_id = $request->post('addrsid'); //收货地址ID
        $addrs    = Addrs::where([['id',$addrs_id],['user_id',$user_id]])->get()[0]; //订单地址信息
        $order_id = 'Wx_'.time().mt_rand(1000,9999); //订单ID
        $shop_id  = Shop::where('id',users::where('openid',session('openid'))->value('shop_id'))->value('id');//所属店铺ID  为了方便后续的统计
        //执行事务处理
        DB::beginTransaction();
        try{
            $one = DB::table('weixin_order')->insert([
                'user_id'    => $user_id,
                'shop_id'    => $shop_id ?? 0,  //如果不存在就是管理员ID
                'order_id'   => $order_id,
                'order_info' => json_encode($new_json),
                'order_data' => $request->post('order_data'), //用户备注
                'order_time' => date('Y-m-d H:i:s'),
                'addrs_id'   => $request->post('addrsid'),//订单收货地址ID
                'addrs_name' => $addrs->name,
                'addrs_phone'=> $addrs->phone,
                'addrs_info' => $addrs->province.$addrs->city.$addrs->district.','.$addrs->more,
                'order_price'=> $price //总价

            ]);
            foreach ($cid as &$v){
                $two = DB::table('weixin_cart')->where('id','=',$v)->delete();
            }
            if ($one&&$two){
                DB::commit();  //没有错误 提交事务
                return self::msg(1,$order_id);
            }
        } catch (\Exception $e){
            DB::rollBack(); //回滚
        }


    }



    public function product($id){
        //商品详细信息列表页面
        $product = Product::where('id',$id)->first();

        /*
         * 单独提取出图片作为轮播图
         * */
        $images = explode(',',$product['images']);



        return view('Home.index.product',[
            'data' => $product,
            'img'  => $images
        ]);
    }


    public static function msg($result,$order=0){
        //返回信息
        if ($result){
            return [
                'msg'   => 'success',
                'cod'   => 0,
                'order' => $order
            ];
        }else{
            return [
                'msg' => 'error',
                'cod' => 1
            ];
        }
    }

    public static function get_user_id(){
       return users::where('openid',session('openid'))->value('id');
    }

}
