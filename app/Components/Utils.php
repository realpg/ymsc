<?php
/**
 * Created by PhpStorm.
 * User: HappyQi
 * Date: 2017/12/4
 * Time: 9:23
 */

namespace App\Components;


class Utils
{
    const PRO_CODE='Hh58wm8f51QGjsYxlnJhDbethlJu3nxB';   //项目pro_code应该统一管理
    const TEMPLATE_ID='198609885'; //短信模板id

    //支付流程状态
    const ORDER_WAITFORPAY = "1";   //待支付
    const ORDER_PAYSUCCESS = "2";    //支付成功
    const ORDER_CLOSED = "3";    //已关闭（交易成功）
    const ORDER_REFUNDING = "4";    //退款中
    const ORDER_REFUNDSUCCESS = "5";    //退款成功
    const ORDER_REFUNDFAILED = "6";    //退款失败

    //支付部分的参数
    //微信支付
    const WECHAT_APPID = "";   //APP APPID
    const WECHAT_APP_ID = "wxe56af7ffb1ffb155";   //微信公众号id(app_id)
    const WECHAT_MINIAPP_ID = "";   //小程序 APPID
    const WECHAT_MCH_ID = "1497102892";   //微信商户号
    const WECHAT_KEY = "dm0ZHUfYJxOIVnajfCA4ZFZHrcLqqCFk";   //微信支付签名秘钥
    const WECHAT_NOTIFY_URL = "http://umylab.com/api/order/notify";   //微信支付回调链接
    const WECHAT_TRADE_TYPE = "NATIVE";   //微信支付类型
    const WECHAT_CERT_CLIENT = '/cert/apiclient_cert.pem';   //客户端证书路径，退款时需要用到
    const WECHAT_CERT_KEY = '/cert/apiclient_key.pem';  // 客户端秘钥路径，退款时需要用到
    const WECHAT_LOG_FILE = '/../storage/logs/wechat.log';   //log的位置
    const WECHAT_LOG_LEVEL = 'debug';

    //支付宝支付
    const ALIPAY_APPID = "2018040802517697";   //APP APPID
    const ALIPAY_NOTIFY_URL = "http://ymsc.isart.me/api/aliNotify/";   //支付宝回调链接
    const ALIPAY_RETRUN_URL = "http://ymsc.isart.me/order/pay/success";   //支付宝支付成功后跳转的页面
    const ALIPAY_PUBLIC_KEY = 'MIIBIjANBgkqhkiG9w0BAQEFAAOCAQ8AMIIBCgKCAQEAkuZnS+VA/YRwJWDs6+bBeJRpS/ZDSCulsD1YVtxKTUYTbvzbr5WGdL9o32NBEnQva88byFy0Kony1Ezwp46mPSUCsHvWkQdiofttuVyLUSnjZhRcM+362urmZT4SYqCTHh9sUPWVD0QyDRo99eLvRWBUE3sSwTSU62HauWUy2seiWTG/0mB0rlSCeLsAn+647o4oclm+KYVU0Hm9YdsV8IBZ/vvFsRjPo58XUpvjjtT6dTa1+yobnNPOqqnd4JUMDvXF7gtcBWarhOa3lOh0JQaEDgxrW77drbiHsh1cDIIl8IvqEQ8lR9PVnf3jzy4M/Ujxut3o/KzIaz30PSOPHwIDAQAB';     // 支付宝公钥，1行填写
    const ALIPAY_PRIVATE_KEY= 'MIIEowIBAAKCAQEA4bnCEhEkLKaJVoSGwxdmw2BDVELA6zdS9VvmX84t28SFxh7M67Y43RBGj5dGL/kg5jWe2Re+Grg1zKb6OW+pwehI5geDK5VRO66A4sjHTfza1TjX8ID9mrQdNgw/YJhHJ7jJamRa7NMN7dDSP9gckVr0j7rNPwUI87+d40QmL4TLAp0kumxynXiXpJUuJpBtTKyMCn/cswSTwG6EDyFUncW9n6eTwsb7v1ScGvWtXmjnNtRMW/aV3OqgUq+ez/h+xtNnM/+ISvMsKeWuhEfkCno5QxyMsHqr9bvroqGo0M0gfc0le1Oukfn8kam5dF6azVdPCCs4wGiuEUAOwFQ/bQIDAQABAoIBAF3pLMbbftNczhLCvFZ6a/SpHhn2U9EIiWkvPN9rJkUitA1DTzpZ67p9RP4Ej9zxpzBf6qCjciIntapZZg1zWYslGv8o7Pe6/br41QKFSfY2Vs0TAzQ6VkiA2w5bdhq4ABKUnKe47ONOw6LHmFGblfcbglgx/aZUb+8JL6UX+1MVAmFjxIp8tg/QdTsM0WbNeQpFh5QJPsfWh/rWIqam5ivQKXKiLmJUI7Z99lLyed5ngXTpJq1EtJlqi4joLGS67cczXyGA8Of0f+Y9//T65f1cxyXOqesPUil59QrtKRVJNOycH6B5L/8uwoOe2TZCXm/gi0g0iIOKJyUf4NOlHQECgYEA8lOwDDQRickeBzZw4EP5/RzMoVsTp7PuSz5Ghr144xCL3KVtJfrq9Tc5d4u6ow5lWzIC8Rx88nCQcbO924I3X4rvZxTH16XqQ8eCwgiQC6KbaK4BZBkcpH44HHbgmb5h1QZ2QikLJC6OuKob7XE5m3Cvjl7bA9236ixjX+9CS+ECgYEA7nZFimkpkxpo01wKFgFk4njb+Yrt6uNu/fdBKCTlQfYsSl7mgCQJHGu8TnHRGyq6CFM1yO0VTxcbvIf2gGOstKFWUU9FCYzHfJeCnn07K1h3GWqrbqeK0mlfu17idvwqHU/IfhClj+ykKlNKACrFHFWCrIsLgpG7f/F9cQXbBQ0CgYAWmXdxq+l20CrcwVcFk1FdKbJr2fKbUUyH9+bb6g+8HW7txP/I6v2+oMfbPkzJqC4Lsz5S/jUo5xaRhBHQxvQjFPH+yxFYK0EN0S2AqwvECgY0XQYEL9NcA+l3vh50OC0nkNK2mN1RIoZs8nBoVIbq2DeHL5F9atAcJsedytKEAQKBgB4GjmMLMszu+lwCrtJugoFxrmEReTumP4eC5pVjb+qKULFcmbFw2CTX+/H0qtu82YfK0m7mS1SWGEv44rTv2AM2fWPnk03MiCHMAgpqwlSG4xg0MjnQps4vrnotTF6nCbZ/IUOeXPpuVY1ux1aWDBOxQK7xIxXhu7Y0dhMRJa7RAoGBAIZ8zcv1dzkhgB10SqH7hMSNriFfuG9iLpz2aQMtc0vLtW9royRsOstuQQGQ/L0qb0QmyFXuR03w4UYWnTC62gN581fLv3XTIy0Om+dDiJ4rv5v5SqBf2QDy0Bmf2HJ8U+wS6+CPADorueqi33KLjqYL30w9YDFulQOHN0VOKBX4';       // 自己的私钥，1行填写
    const ALIPAY_LOG_FILE = '/../storage/logs/ali.log';   //log的位置
    const ALIPAY_LOG_LEVEL = 'debug';

    //提示语
    const UNSIGN_WORD = "请先登录";   //未登录提示语
    const UNSIGN_CODE = 9999;   //未登录编码

    //邮费
    const POSTAGE = 0;  //邮费

    /*
     * 判断一个对象是不是空
     *
     * By TerryQi
     *
     * 2017-12-23
     *
     */
    public static function isObjNull($obj)
    {
        if ($obj == null || $obj == "") {
            return true;
        }
        return false;
    }

    /*
     * 生成订单号
     *
     * By TerryQi
     *
     * 2017-01-12
     *
     */
    public static function generateTradeNo()
    {
        return date('Ymd') . substr(implode(NULL, array_map('ord', str_split(substr(uniqid(), 7, 13), 1))), 0, 8);;
    }

    /**
     * @param $url 请求网址
     * @param bool $params 请求参数
     * @param int $ispost 请求方式
     * @param int $https https协议
     * @return bool|mixed
     */
    public static function curl($url, $params = false, $ispost = 0, $https = 0)
    {
        $httpInfo = array();
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
        curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/41.0.2272.118 Safari/537.36');
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 30);
        curl_setopt($ch, CURLOPT_TIMEOUT, 30);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        if ($https) {
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE); // 对认证证书来源的检查
            curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE); // 从证书中检查SSL加密算法是否存在
        }
        if ($ispost) {
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $params);
            curl_setopt($ch, CURLOPT_URL, $url);
        } else {
            if ($params) {
                if (is_array($params)) {
                    $params = http_build_query($params);
                }
                curl_setopt($ch, CURLOPT_URL, $url . '?' . $params);
            } else {
                curl_setopt($ch, CURLOPT_URL, $url);
            }
        }

        $response = curl_exec($ch);

        if ($response === FALSE) {
            //echo "cURL Error: " . curl_error($ch);
            return false;
        }
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        $httpInfo = array_merge($httpInfo, curl_getinfo($ch));
        curl_close($ch);
        return $response;
    }

}