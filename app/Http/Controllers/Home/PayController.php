<?php

namespace App\Http\Controllers\Home;

use App\Http\Model\Order;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

//支付宝
require_once '../resources/org/alipay/wappay/buildermodel/AlipayTradeQueryContentBuilder.php';
require_once '../resources/org/alipay/wappay/buildermodel/AlipayTradeWapPayContentBuilder.php';
require_once '../resources/org/alipay/wappay/service/AlipayTradeService.php';


//微信
require_once "../resources/org/wxpay/lib/WxPay.Api.php";
require_once "../resources/org/wxpay/example/WxPay.JsApiPay.php";
require_once "../resources/org/wxpay/example/WxPay.Config.php";
require_once '../resources/org/wxpay/example/log.php';



class PayController extends Controller
{
    //订单支付


    public $config = array (
        //支付宝的配置文件
        //应用ID,您的APPID。
        'app_id' => "2018070960504615",

        //商户私钥，您的原始格式RSA私钥
        'merchant_private_key' => "MIIEowIBAAKCAQEAoOGNkTDQVFMqRlwoghn91wrBIM2SkoZgnjpfWtCAEmpdUiQXtY8KjQUAXRr9wDR6LSLfL++Qfjg8On/TtES01J6l0FHFtX/pJdsKNZLDRmgFGtbVsNPwcFGgA6c9tVKHxZC7TxHlfkjrDjWgsNmzY7JuTTN5UrIq0+U5E+4N1o+jbU8b592fFhL6NVtZlFgnH7IGwn1U++1VaSjTUwQxMg0MNsG0Nn3QV45qFIU9KF6t9BwWdlCmhAUEeHjljIouBHMVjn07/nMqpUwJ/A5sLmW32PMWL8AfeEZv1aoqRsiMkD0nitGYDE6zXObC6xmGkU1v4Bypz2x3mTIb/SQHwQIDAQABAoIBAQCABf1Z5LZj5CpoAz5ZCcXuMiitqelRoI2SXHE1G2ZPQUUx8HbNjB6hSbGYZbo4EYqIEI/63XDmgGmtQ7t8YJBmAjmBJRFn9XnbHgtpxniOtogZa4xxQra7KrljLtr0R9CzbxEfQuaVMAGdNR/Cm/sdAwizdpq9K/rY1Dgvm+h3LGNNpOYnXLQ3sht7S64AfxGsUhtwxtQ1HBuUup/cVN4C3MullCiL46i4nXxSLp8EHnwRaw1VazUFLgyIQV8QbysGuWNXdM1PKhl1wsAPPvz5ynJ6FO+Fm5KilGtErYSp4cAU2/JUz+V5/Qt1U/Xoar3q2XNd0buUmn8szc3ZwLIBAoGBANTKDTEhtFFshxgYkz2Pynds4fUDB6XBkqIUbo6C3kmzvk/QyePmLPDnouy6Uev8mhPIqbTedUG7DpBB5+f2iRRcm6uO7uJXRaiPA45yOzp/YMRIqdG1ZMyoPBJlO2BQjw52cOrIjsj1Ba6FvD10LBOhH8jUR5mnBJeHNbaBy9xJAoGBAMGNB588vgApTKSq+1mmomj/BFaxCVqVBtslfqyHofxEuWZszUswVGJrm+eePZmSMioD/CVZ2OhgVTQiE+tlKUuoDi9xW/ufIV7m5y7BjbR81diQIcsfKDFnMdd8A3U4cPihJCCPMwLg7GTX9FAnZyeDPzcDUzDgtWAX5Cdl/R+5AoGAf724Q6l3JXZgd1+xbMCYjC8qSrsB6UkWrQRVBmqb5WTpN+MggBbbHdgA39pOebvQB1ZsQq9VdxtDd+iIvqEq07VwooIQ+IHpyHHqcaYz1j9HqS3x/HnHxHCud2CcT4qtBsKlsNyrkwo82fNg+Qd3umT8vsRpI123jPvXi/PJnTkCgYAHe9J9n7Wg//fMrifF0aGZ+bJLP9EixXxcYNjDBwOGY4nfoflWHOpGW+7NR9sN4w85fKn1L8IpSgBBYcfvZBvypu7VesaZtg9uQfNSZX17KxCBrSEBX5UIQ/szX8IqeCI2GtTwxVitldDOHWN+7ecZKgP5tpEy5J1et83EkDb3UQKBgGaBGnBHKwWupf4YqbwJv9QagKj0i+17/u/FLCtLomb5lFgfFa5zcEVEqQeOX4vz0B1RFiZxc2ewWR4zCaBYSdXp9zqHJTRG707a1miidqsYi0hWB7C8iyV4AwN7kkNJua3lhSAkNwAIc1uOwcdNhI6iTO4LiwuQnjsWqOrlXB69",

        //异步通知地址
        'notify_url' => "http://shop.veimx.com/pay/alipay_verify",

        //同步跳转
        'return_url' => "http://shop.veimx.com/",

        //编码格式
        'charset' => "UTF-8",

        //签名方式
        'sign_type'=>"RSA2",

        //支付宝网关
        'gatewayUrl' => "https://openapi.alipay.com/gateway.do",

        //支付宝公钥,查看地址：https://openhome.alipay.com/platform/keyManage.htm 对应APPID下的支付宝公钥。
        'alipay_public_key' => "MIIBIjANBgkqhkiG9w0BAQEFAAOCAQ8AMIIBCgKCAQEAt/zacoHuFZR7BzN2IDOTIUfXw9Qx3AbKA2S15C/RYvFTtce496y0vf4uSth1VZO8EOfaqkcUsSAT1TYVSd5PLpK/UXZKC1I0pimW+N1dOpSHVPfFXMHq/7ba2TiiOpJBE2U2suLPHTXm4NuuiMIiSKd4y4dufuwC/qSKW7cEHwuFFWUXX0JhlZQBQ7G1pB8pj9DG0E29f1sv7lxQ3asOeBE8nxVDj0FvfD/AADrWnhe2/h1dWQQ7JDxCFYOSGmZuy2wyZL5GvmS1U2bnWfwq8j8RFoScAvLGNga6kw8ET8BOo4lPlJMKekAWSayXu6PPE4F5zGYGKrkgiZPCUcWqhQIDAQAB",
    );



    public function pay($order){
        //支付页面
        $pay = Order::where('order_id',$order)->first();

        //微信支付
        $tools = new \JsApiPay();
        $openId = $tools->GetOpenid();   //获取用户的OPENID

        //②、统一下单
        $input = new \WxPayUnifiedOrder();
        $input->SetBody("test");
        $input->SetAttach("test");
        $input->SetOut_trade_no($order);
        $input->SetTotal_fee("1");
        $input->SetTime_start(date("YmdHis"));
        $input->SetTime_expire(date("YmdHis", time() + 5800));
        $input->SetGoods_tag("test");
        $input->SetNotify_url("http://shop.veimx.com/wx/notify");
        $input->SetTrade_type("JSAPI");
        $input->SetOpenid($openId);
        $config = new \WxPayConfig();
        $order = \WxPayApi::unifiedOrder($config, $input);

        $jsApiParameters = $tools->GetJsApiParameters($order);


        //

        return view('Home.pay.index',[
            'pay' => $pay,
            'jsApiParameters' => $jsApiParameters
        ]);
    }


    public function wx_notify(){
        //微信异步通知
        $xml = file_get_contents('php://input');
        $arr = json_decode(json_encode(simplexml_load_string($xml, 'SimpleXMLElement', LIBXML_NOCDATA)), true);


        ksort($arr);
        $str = '';
        foreach ($arr as $k => $v){
            if ($k == 'sign'){
               continue;
            }
            $str .= $k.'='.$v.'&';
        }

        $str .= 'key=01c6d59a3f9024db6336662ac95c8e73';
        $sign = strtoupper(hash_hmac('sha256', $str,'01c6d59a3f9024db6336662ac95c8e73'));

        //验签名
        if ( $sign === $arr['sign']) {
//            校验返回的订单金额是否与商户侧的订单金额一致。修改订单表中的支付状态。
            //交易成功
            Order::where('order_id',$arr['out_trade_no'])
                ->update([
                    'pay_type'  => '1',  //支付类型 1为微信
                    'end_time'  => date("Y-m-d H:i:s",strtotime($arr['time_end'])),   //支付时间
                    'order_type'=> '1'     //是否支付 0未支付  1为支付成功
                ]);

        }


        $return = ['return_code'=>'SUCCESS','return_msg'=>'OK'];
        $xml = '<xml>';
        foreach($return as $k=>$v){
            $xml.='<'.$k.'><![CDATA['.$v.']]></'.$k.'>';
        }
        $xml.='</xml>';

        echo $xml;
    }

    public function pay_type($order_id,$pay_type){
        //判断支付类型 1是微信支付 2是支付宝支付
        $order_info = Order::where('order_id',$order_id)->first();

        switch ($pay_type){
            case 2:
                //开始支付宝支付的业务代码
                if ($this->is_weixin()){
                    return view('Home.pay.pay');
                }else{
                    return $this->alipay($order_id,'购买商品:'.$order_info['order_price'].'元','0.01','在线支付');
                }

                break;
        }



    }



    public function is_weixin(){
            //判断当前浏览器是不是微信
        if ( strpos($_SERVER['HTTP_USER_AGENT'],

                'MicroMessenger') !== false ) {

            return true;

        }

        return false;

    }



    public function alipay($out_trade_no,$subject,$total_amount,$body){//支付宝支付业务逻辑

        //商户订单号，商户网站订单系统中唯一订单号，必填
        //$out_trade_no = $_POST['WIDout_trade_no'];

        //订单名称，必填
        //$subject = $_POST['WIDsubject'];

        //付款金额，必填
        //$total_amount = $_POST['WIDtotal_amount'];

        //商品描述，可空
        //$body = $_POST['WIDbody'];

        //超时时间
        $timeout_express="1m";



        $payRequestBuilder = new \AlipayTradeWapPayContentBuilder();
        $payRequestBuilder->setBody($body);
        $payRequestBuilder->setSubject($subject);
        $payRequestBuilder->setOutTradeNo($out_trade_no);
        $payRequestBuilder->setTotalAmount($total_amount);
        //$payRequestBuilder->setTimeExpress($timeout_express);

        $payResponse = new \AlipayTradeService($this->config);
        $result=$payResponse->wapPay($payRequestBuilder,$this->config['return_url'],$this->config['notify_url']);

        return ;
    }



    public function notify_url(){
        //异步通知接口

        $arr=$_POST;
        $alipaySevice = new \AlipayTradeService($this->config);
        $alipaySevice->writeLog(var_export($_POST,true));
        $result = $alipaySevice->check($arr);

        if($result) {//验证成功

            /*
             * 2018-07-14 22:56:26  array (
              'gmt_create' => '2018-07-14 22:41:59',
              'charset' => 'UTF-8',
              'seller_email' => 'admin@veimx.com',
              'subject' => '购买商品:1000元',
              'sign' => 'pzS7t4VM5liSmxjgpl7g4acAohqypbj35HStPRKcfhmPUNzkws9v6KtiTEYdqgS5ra8Fd127hZwmmFzzTw/Oco9Wl6H+XyHuhKX3d+9yTSnJTvRaT968FbHAxo0BL3mqXBybzMa3nSXG6+oKaIWPwyopCBRU0NQvlvANdMXpkeLgED/SL32yr6FiTbZZXtEAa1momPW+8BRvxRChvg71+KkoRyT0cgSiw4ENoB9+QwlBePukUwe7pZIBNPJPZRv8N0gyE8ngBzVg16zqAKa3KxYa5AqJghoDs1eHN++zL15/2z9mYu9gycWrHF0PbD8XGTMLnwymTuZpRiwLFGrNrA==',
              'body' => '在线支付',
              'buyer_id' => '2088421357618795',
              'invoice_amount' => '0.01',
              'notify_id' => '6765a063d4e82a008cd7cabefdb1d8fm3l',
              'fund_bill_list' => '[{"amount":"0.01","fundChannel":"ALIPAYACCOUNT"}]',
              'notify_type' => 'trade_status_sync',
              'trade_status' => 'TRADE_SUCCESS',        //交易状态
              'receipt_amount' => '0.01',
              'buyer_pay_amount' => '0.01',
              'app_id' => '2018070960504615',
              'sign_type' => 'RSA2',
              'seller_id' => '2088702382635572',
              'gmt_payment' => '2018-07-14 22:41:59',  //买家付款时间
              'notify_time' => '2018-07-14 22:56:26',
              'version' => '1.0',
              'out_trade_no' => 'Wx_15315793102519',   //商户订单号
              'total_amount' => '0.01',                 //本次交易支付的订单金额，单位为人民币（元）
              'trade_no' => '2018071421001004790510831822',
              'auth_app_id' => '2018070960504615',
              'buyer_logon_id' => 'ser***@veimx.com',   //
              'point_amount' => '0.00',
            )
             *
             * */
            $order_id = $_POST['out_trade_no'];   //商户订单号

            if ($_POST['trade_status'] == 'TRADE_SUCCESS'){
                //交易成功
                Order::where('order_id',$order_id)
                    ->update([
                        'pay_type'  => '2',  //支付类型 2为支付宝
                        'end_time'  => $_POST['gmt_payment'],   //支付时间
                        'order_type'=> '1'     //是否支付 0未支付  1为支付成功
                    ]);
            }

            echo "success";		//请不要修改或删除

        }else {
            //验证失败
            echo "fail";	//请不要修改或删除

        }
    }





}
