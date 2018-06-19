<?php

namespace App\Http\Controllers\Home;

use App\Http\Model\Cart;
use App\Http\Model\Order;
use App\Http\Model\Product;
use App\Http\Model\users;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class IndexController extends Controller
{
//微信商城首页
    public function index(){
        //获取所有商品信息
        session(['openid'=>'ouTkduJIVI_J5P7CTg8ucpdVhMlM']);

        $data = DB::table('weixin_product')->orderBy('id','DESC')->get();

        return view('Home.index.home',[
            'data' => $data
        ]); //首页
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
        //删除购物车
        $cid = $request->post('cid'); //获取需要删除购物车的ID号
        return self::msg(Cart::destroy($cid));
    }


    public function cart(){
        //购物车 获取当前用户的购物车商品

        $data = DB::table('weixin_product')->join('weixin_cart','weixin_product.id','=','weixin_cart.product_id')->where('user_id','5')
            ->select('weixin_product.title','weixin_product.id as pid','weixin_product.thumb','weixin_product.xs_price','weixin_cart.num','weixin_cart.id as cid')->get();


        return view('Home.index.cart',[
            'data' => $data
        ]);
    }


    public function to_order(Request $request){
        //提交订单 事务处理 order_info 订单信息表 用JSON存储
        $cid     = explode(',',$request->post('cid'));  //获取选中的商品
        $user_id = users::where('openid',session('openid'))->value('id'); //用户ID

        foreach ($cid as &$v){
            $cart = Cart::find($v);
            $product[] = DB::table('weixin_product')->join('weixin_cart','weixin_product.id','=','weixin_cart.product_id')
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
            $v->price = $v->num*$v->xs_price;
            $price   += $v->price; //总价
        }

        //执行事务处理
        DB::beginTransaction();
            try{
                $one = DB::table('weixin_order')->insert([
                    'user_id'    => $user_id,
                    'order_id'   => 'Wx_'.time().mt_rand(1000,9999),
                    'order_info' => json_encode($new_json),
                    'order_data' => $request->post('order_data'), //用户备注
                    'order_time' => date('Y-m-d H:i:s'),
                    'order_price'=> $price //总价

                ]);
                foreach ($cid as &$v){
                    $two = DB::table('weixin_cart')->where('id','=',$v)->delete();
                }
                if ($one&&$two){
                    DB::commit();  //没有错误 提交事务
                    return self::msg(1);
                }
            } catch (\Exception $e){
                DB::rollBack(); //事务回滚
            }



    }


    public static function msg($result){
        //返回信息
        if ($result){
            return [
                'msg' => 'success',
                'cod' => 0
            ];
        }else{
            return [
                'msg' => 'error',
                'cod' => 1
            ];
        }
    }
}
