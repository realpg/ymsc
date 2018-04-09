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
//    const PAGE_SIZE = 15;

    const ORDER_WAITFORPAY = "1";   //待支付
    const ORDER_PAYSUCCESS = "2";    //支付成功
    const ORDER_CLOSED = "3";    //已关闭（交易成功）
    const ORDER_REFUNDING = "4";    //退款中
    const ORDER_REFUNDSUCCESS = "5";    //退款成功
    const ORDER_REFUNDFAILED = "6";    //退款失败

    const PRO_CODE='Hh58wm8f51QGjsYxlnJhDbethlJu3nxB';   //项目pro_code应该统一管理
    const TEMPLATE_ID='198609885'; //短信模板id

    //支付部分的参数
    //微信支付
    const WECHAT_APPID = "";   //APP APPID
    const WECHAT_APP_ID = "wxe56af7ffb1ffb155";   //微信公众号id(app_id)
    const WECHAT_MINIAPP_ID = "";   //小程序 APPID
    const WECHAT_MCH_ID = "1497102892";   //微信商户号
    const WECHAT_KEY = "dm0ZHUfYJxOIVnajfCA4ZFZHrcLqqCFk";   //微信支付签名秘钥
    const WECHAT_NOTIFY_URL = "http://ymsc.isart.me/api/order/notify";   //微信支付回调链接
    const WECHAT_TRADE_TYPE = "NATIVE";   //微信支付类型
    const WECHAT_CERT_CLIENT = '/cert/apiclient_cert.pem';   //客户端证书路径，退款时需要用到
    const WECHAT_CERT_KEY = '/cert/apiclient_key.pem';  // 客户端秘钥路径，退款时需要用到
    const WECHAT_LOG_FILE = '/../storage/logs/wechat.log';   //log的位置
    const WECHAT_LOG_LEVEL = 'debug';

    //支付宝支付
    const ALIPAY_APPID = "2018040802517697";   //APP APPID
    const ALIPAY_NOTIFY_URL = "http://ymsc.isart.me/api/order/aliNotify";   //支付宝回调链接
    const ALIPAY_PUBLIC_KEY = 'MIIBIjANBgkqhkiG9w0BAQEFAAOCAQ8AMIIBCgKCAQEApVtiVVrGOKwpiMpWpw4QMc+BHlMzQoBiMOJFfNFyhYjgA2KsZN9MqwlzmaQLYS/H2U7ahAqIv6qcMTIbaGLYi15xqdZUkqjBXRCFpcC4H/7tEMvFT2h3WpR6iCG6OPc99TdprLwJQkqK/9ZYs6TuyA/gOMboCYrGRXS85sR2U0yfNSBWzDMzgYCINrjGcEARG/gjo5aIR380a3Xmc2it5bl9E9HMrmqWL6GamNlHeeDCz/Vj5MaaAB3uDijpJxWcjmUvJTDIIApc7YO96iASZFaVlXuKo5/GekfCKHGDuzzsLeEQ7PiLMAcIMjxy4mcHmoqHow+zpO4GVP7nMMiHqwIDAQAB';     // 支付宝公钥，1行填写
    const ALIPAY_PRIVATE_KEY= 'MIIEowIBAAKCAQEApVtiVVrGOKwpiMpWpw4QMc+BHlMzQoBiMOJFfNFyhYjgA2KsZN9MqwlzmaQLYS/H2U7ahAqIv6qcMTIbaGLYi15xqdZUkqjBXRCFpcC4H/7tEMvFT2h3WpR6iCG6OPc99TdprLwJQkqK/9ZYs6TuyA/gOMboCYrGRXS85sR2U0yfNSBWzDMzgYCINrjGcEARG/gjo5aIR380a3Xmc2it5bl9E9HMrmqWL6GamNlHeeDCz/Vj5MaaAB3uDijpJxWcjmUvJTDIIApc7YO96iASZFaVlXuKo5/GekfCKHGDuzzsLeEQ7PiLMAcIMjxy4mcHmoqHow+zpO4GVP7nMMiHqwIDAQABAoIBAQCKWssNJdWjB5H9DWexgVfVhYzAhdbm9qqxwjFn/Yt35Y2h54bdI+VvWoop7JNE7wilb4/wWSwQSr1DgGxkTAhpnE04UMgUqjSYHMHmbTjiNJfArO7bwUnUNVXM34OENILX0VSPHgoVOG/THlK7hO3x4S638t2lVkMNTF7eK1Xh3WsHBnKQvK8UXpJ2C/MwcUnhu6dxV2hc07AXAVcth5HN2VnvNiXu+sZHrsq6KMr63PXyaglIEe7xkMf9jqZSeNtgd4hXHCkatZAz0sZmCEHD+ErnIEqJZ0PqsqhlvN/jPkpFRyDR/luU7d0Blc4SA8yM8Ab6FO4yUDtD/t9eSHoRAoGBANQTFozX8YcEy7Ej0KXUclvD3mQE0ARBTDep6KjGO57LdcAfDVdfBEymxUHyV2PnNbVEY1n68ca2YTue6/Xz0lwqjWa5zVLbTH1m8REPpr3QxN3t1YIEXbvatixPCMxi3K+mciwYAGZN34vWFjUH9RShROMJQtyWf3A6YX8u86NZAoGBAMebK8EnLg/ij9LwddN93KVvAbRkcoB5mwMq27RUC5MYNuHGPE8BDHL4dRqiNIj7NhjluZUwlj9+TmeRbEL8NwjdjDuNYyFaF6/oyQ2vSpz2Fa8WDK/2i/sDCL64d2tRO3Ij2LEu47KjUXE99qIidnmXtewJ11VrPaN4DiZsMPajAoGAZrjYM2BlnQC1qRev+KLuwYQeNFQgbe8y+8NQ7m8WcdQbNPPVgnyDmJ0u7sJzkfBsE2EMvojOk3HDpx1TLc7sFbiGxTs6OOgAJL24BouOOGLm+Jg60r9Kp7NIii2+FUHNo0b8Bl+Z0fPmU9Ve7FDuZQ+4TkAuIqrDD5k3oGMdoAECgYAdSl7sVCSFPjjeulx/8Xs8Z4K3hvnqcm3V1CczWhXsuuPq050r9rpt8Jm2k9DjvQFeO++0vdF+dblpp0RcvAgTa/dVEdVXIpJRRPaj5HItgEsES1cHR0WZSwOwgP89J0ly4WG99mSBZUfhNzeG6Um7ZBDVF0ibB0afQ1HIP54bwwKBgA38rcC67IY8Hby82ws8jYvUJki77Q4voWUxuiKrn1MIfFProfVVZmLCyfQQXmpy94Ml8lBYaPYSUPQzbmZG025KSCxKCaytdi5kOofQnqeuHwXfdNC6UzTOkz8EltqvQkGZLTm4CVs6Bjz9kOA6Wps12ewNYa4Hc4Ukm1cLEjLj';        // 自己的私钥，1行填写
    const ALIPAY_LOG_FILE = '/../storage/logs/ali.log';   //log的位置
    const ALIPAY_LOG_LEVEL = 'debug';

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