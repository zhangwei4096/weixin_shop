<?php

namespace App\Http\Controllers\Home;

use App\Http\Model\Order;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

//支付宝
require_once '../resources/org/alipay/wappay/buildermodel/AlipayTradeQueryContentBuilder.php';
require_once '../resources/org/alipay/wappay/buildermodel/AlipayTradeWapPayContentBuilder.php';
require_once '../resources/org/alipay/wappay/service/AlipayTradeService.php';

class PayController extends Controller
{
    //订单支付

    public function pay($order){
        //支付页面
        $pay = Order::where('order_id',$order)->get()[0];
        return view('home.pay.index',[
            'pay' => $pay
        ]);
    }

    public function pay_type($order_id,$pay_type){
        //判断支付类型 1是微信支付 2是支付宝支付
        $order_info = Order::where('order_id',$order_id)->get()[0];

        switch ($pay_type){
            case 1:
                echo '未开通';
                break;
            case 2:
                //开始支付宝支付的业务代码
                return $this->alipay($order_id,'购买商品:'.$order_info['order_price'].'元',$order_info['order_price'],'在线支付');
                break;
        }



    }


    public function alipay($out_trade_no,$subject,$total_amount,$body){
        //支付宝支付业务逻辑
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

        $config = array (
            //应用ID,您的APPID。
            'app_id' => "2018070960504615",

            //商户私钥，您的原始格式RSA私钥
            'merchant_private_key' => "MIIEowIBAAKCAQEAoOGNkTDQVFMqRlwoghn91wrBIM2SkoZgnjpfWtCAEmpdUiQXtY8KjQUAXRr9wDR6LSLfL++Qfjg8On/TtES01J6l0FHFtX/pJdsKNZLDRmgFGtbVsNPwcFGgA6c9tVKHxZC7TxHlfkjrDjWgsNmzY7JuTTN5UrIq0+U5E+4N1o+jbU8b592fFhL6NVtZlFgnH7IGwn1U++1VaSjTUwQxMg0MNsG0Nn3QV45qFIU9KF6t9BwWdlCmhAUEeHjljIouBHMVjn07/nMqpUwJ/A5sLmW32PMWL8AfeEZv1aoqRsiMkD0nitGYDE6zXObC6xmGkU1v4Bypz2x3mTIb/SQHwQIDAQABAoIBAQCABf1Z5LZj5CpoAz5ZCcXuMiitqelRoI2SXHE1G2ZPQUUx8HbNjB6hSbGYZbo4EYqIEI/63XDmgGmtQ7t8YJBmAjmBJRFn9XnbHgtpxniOtogZa4xxQra7KrljLtr0R9CzbxEfQuaVMAGdNR/Cm/sdAwizdpq9K/rY1Dgvm+h3LGNNpOYnXLQ3sht7S64AfxGsUhtwxtQ1HBuUup/cVN4C3MullCiL46i4nXxSLp8EHnwRaw1VazUFLgyIQV8QbysGuWNXdM1PKhl1wsAPPvz5ynJ6FO+Fm5KilGtErYSp4cAU2/JUz+V5/Qt1U/Xoar3q2XNd0buUmn8szc3ZwLIBAoGBANTKDTEhtFFshxgYkz2Pynds4fUDB6XBkqIUbo6C3kmzvk/QyePmLPDnouy6Uev8mhPIqbTedUG7DpBB5+f2iRRcm6uO7uJXRaiPA45yOzp/YMRIqdG1ZMyoPBJlO2BQjw52cOrIjsj1Ba6FvD10LBOhH8jUR5mnBJeHNbaBy9xJAoGBAMGNB588vgApTKSq+1mmomj/BFaxCVqVBtslfqyHofxEuWZszUswVGJrm+eePZmSMioD/CVZ2OhgVTQiE+tlKUuoDi9xW/ufIV7m5y7BjbR81diQIcsfKDFnMdd8A3U4cPihJCCPMwLg7GTX9FAnZyeDPzcDUzDgtWAX5Cdl/R+5AoGAf724Q6l3JXZgd1+xbMCYjC8qSrsB6UkWrQRVBmqb5WTpN+MggBbbHdgA39pOebvQB1ZsQq9VdxtDd+iIvqEq07VwooIQ+IHpyHHqcaYz1j9HqS3x/HnHxHCud2CcT4qtBsKlsNyrkwo82fNg+Qd3umT8vsRpI123jPvXi/PJnTkCgYAHe9J9n7Wg//fMrifF0aGZ+bJLP9EixXxcYNjDBwOGY4nfoflWHOpGW+7NR9sN4w85fKn1L8IpSgBBYcfvZBvypu7VesaZtg9uQfNSZX17KxCBrSEBX5UIQ/szX8IqeCI2GtTwxVitldDOHWN+7ecZKgP5tpEy5J1et83EkDb3UQKBgGaBGnBHKwWupf4YqbwJv9QagKj0i+17/u/FLCtLomb5lFgfFa5zcEVEqQeOX4vz0B1RFiZxc2ewWR4zCaBYSdXp9zqHJTRG707a1miidqsYi0hWB7C8iyV4AwN7kkNJua3lhSAkNwAIc1uOwcdNhI6iTO4LiwuQnjsWqOrlXB69",

            //异步通知地址
            'notify_url' => "http://vimx.cn/notify_url.php",

            //同步跳转
            'return_url' => "http://vimx.cn/return_url.php",

            //编码格式
            'charset' => "UTF-8",

            //签名方式
            'sign_type'=>"RSA2",

            //支付宝网关
            'gatewayUrl' => "https://openapi.alipay.com/gateway.do",

            //支付宝公钥,查看地址：https://openhome.alipay.com/platform/keyManage.htm 对应APPID下的支付宝公钥。
            'alipay_public_key' => "MIIBIjANBgkqhkiG9w0BAQEFAAOCAQ8AMIIBCgKCAQEAt/zacoHuFZR7BzN2IDOTIUfXw9Qx3AbKA2S15C/RYvFTtce496y0vf4uSth1VZO8EOfaqkcUsSAT1TYVSd5PLpK/UXZKC1I0pimW+N1dOpSHVPfFXMHq/7ba2TiiOpJBE2U2suLPHTXm4NuuiMIiSKd4y4dufuwC/qSKW7cEHwuFFWUXX0JhlZQBQ7G1pB8pj9DG0E29f1sv7lxQ3asOeBE8nxVDj0FvfD/AADrWnhe2/h1dWQQ7JDxCFYOSGmZuy2wyZL5GvmS1U2bnWfwq8j8RFoScAvLGNga6kw8ET8BOo4lPlJMKekAWSayXu6PPE4F5zGYGKrkgiZPCUcWqhQIDAQAB",
        );


        $payRequestBuilder = new \AlipayTradeWapPayContentBuilder();
        $payRequestBuilder->setBody($body);
        $payRequestBuilder->setSubject($subject);
        $payRequestBuilder->setOutTradeNo($out_trade_no);
        $payRequestBuilder->setTotalAmount($total_amount);
        //$payRequestBuilder->setTimeExpress($timeout_express);

        $payResponse = new \AlipayTradeService($config);
        $result=$payResponse->wapPay($payRequestBuilder,$config['return_url'],$config['notify_url']);

        return ;
    }








}
