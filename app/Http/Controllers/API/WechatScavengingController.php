<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/5/28
 * Time: 9:38
 */

namespace App\Http\Controllers\API;

use App\Components\Utils;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class WechatScavengingController extends Controller
{
    /**
     * 处理微信的请求消息
     *
     * @return string
     */
    public function logincallback(Request $request)
    {
        $app_id = Utils::WECHAT_LOGIN_APP_ID;
        $app_secret = Utils::WECHAT_LOGIN_APP_SECRET;

        //这里需要拼接一个url 获取 access_token
        //appid app_secret不做赘述  code为微信服务器返回的code  grant_type参数写法固定
        $url='https://api.weixin.qq.com/sns/oauth2/access_token?appid='.$app_id.'&secret='.$app_secret.'&code='.$_GET['code'].'&grant_type=authorization_code';
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($ch, CURLOPT_URL, $url);
        $json =  curl_exec($ch);
        curl_close($ch);
        $arr=json_decode($json,1);
        if(array_key_exists('access_token',$arr)){
//        dd($arr);
            //用获取到的access_token调用接口

            //拼接URL的参数也不需要赘述了
//        $url='https://api.weixin.qq.com/sns/userinfo?access_token='.$arr['access_token'].'&openid='.$arr['openid'].'&lang=zh_CN';
            $url='https://api.weixin.qq.com/sns/userinfo?access_token='.$arr['access_token'].'&openid='.$arr['openid'].'&lang=zh_CN';
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
            curl_setopt($ch, CURLOPT_URL, $url);
            $json =  curl_exec($ch);
            curl_close($ch);
            $userinfo=json_decode($json,1);

//        dd($userinfo);
            if(array_key_exists('openid',$userinfo)){
                $data['signInBinding']=$userinfo;
                return redirect()->action('Home\SignController@signIn', $data);
            }
            else{

            }
        }
        else{

        }
    }
}