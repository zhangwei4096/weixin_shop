<?php

namespace App\Http\Controllers\Home;

use App\Http\Model\System;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class GetController extends Controller
{
    ///获取微信的基本信息

    public function access_token($access_token_file='./access_json'){
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


    public static function msg_get($url){
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


    public static function msg_post($url,$post_data){
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
