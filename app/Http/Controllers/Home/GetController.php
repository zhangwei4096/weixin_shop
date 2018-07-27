<?php
namespace App\Http\Controllers\Home;

use App\Http\Model\{System,users};
use App\Http\Controllers\Controller;

class GetController extends Controller
{
    ///获取微信的基本信息

    public function access_token($access_token_file='./access_json'):string
    {
        //获取基础access_token 。。。目前暂时用不着
        $info = System::find(3);
        $info = json_decode($info['data'],true);
        $AppSecret = $info['AppSecret'];
        $AppID     = $info['AppID'];

        //下面是获取access_token
        if (file_exists($access_token_file) && (time()-filemtime($access_token_file)<3600)){
            //文件存在并且没有超时
            $access_token = file_get_contents($access_token_file);
            return $access_token;

        }else{

            $url = 'https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid='.$AppID.'&secret='.$AppSecret.'';
            $access_token  = $this->msg_get($url);
            //下面进行文件的写入覆盖操作
            $myfile = fopen($access_token_file,'w');
            fwrite($myfile,$access_token);
            fclose($myfile);
            return $access_token;

        }




    }


    //获取网页用户授权信息
    public function get_webuser_info($code,$state):string
    {
        //先拿到CODE 后 通过code换取网页授权access_token
        $info      = (json_decode(System::find(3)['data'],true));
        $AppSecret = $info['AppSecret'];
        $AppID     = $info['AppID'];
        $url       = 'https://api.weixin.qq.com/sns/oauth2/access_token?appid='.$AppID.'&secret='.$AppSecret.'&code='.$code.'&grant_type=authorization_code';
        $info      = json_decode(self::msg_get($url),true);  //获取openid
        //先查询数据库中是否有这个openID



        if (count(users::where('openid',$info['openid'])->get())==0){
           //没有数据 去获取用户的基本信息 写入到数据库中
            $url = 'https://api.weixin.qq.com/sns/userinfo?access_token='.$info['access_token'].'&openid='.$info['openid'].'&lang=zh_CN';
            $data= json_decode(self::msg_get($url),true); //获取到JSON数据
            $user= new users();
            $user->openid       = $info['openid'];
            $user->nickname     = $data['nickname'];
            $user->sex          = $data['sex'];
            $user->province     = $data['province'];
            $user->city         = $data['city'];
            $user->country      = $data['country'];
            $user->thumb        = stripslashes($data['headimgurl']);
            $user->shop_id      = $state == 'STATE' ? 0 : $state;  //判断用户属于哪个商铺的
            if ($user->save()){
                //开启全局SESSION
                return $info['openid'];

            }
        }else{
            //用户存在 每次登陆修改下他的头像 以防头像失效
            $url = 'https://api.weixin.qq.com/sns/userinfo?access_token='.$info['access_token'].'&openid='.$info['openid'].'&lang=zh_CN';
            $data= json_decode(self::msg_get($url),true); //获取到JSON数据
            users::where('openid',$info['openid'])->update(['thumb'=>stripslashes($data['headimgurl'])]);
            //开启全局SESSION
            return $info['openid'];
        }



    }






    //发送请求
    public static function msg_get(string $url):string
    {
        //发送GET请求

        $ch = curl_init();

        //设置选项，包括URL
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);//绕过ssl验证
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);

        //执行并获取HTML文档内容
        $output = curl_exec($ch);

        //释放curl句柄
        curl_close($ch);
        return $output;
    }


    public static function msg_post($url,$post_data):string
    {
        //发送POST请求
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        // 执行后不直接打印出来
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        // 设置请求方式为post
        curl_setopt($ch, CURLOPT_POST, true);
        // post的变量
        curl_setopt($ch, CURLOPT_POSTFIELDS, $post_data);
        // 请求头，可以传数组
        curl_setopt($ch, CURLOPT_HEADER, 0);
        // 跳过证书检查
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        // 不从证书中检查SSL加密算法是否存在
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
        $output = curl_exec($ch);
        curl_close($ch);
        return $output;

    }


}
