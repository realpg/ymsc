<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/3/13
 * Time: 18:44
 */

namespace App\Http\Controllers\API;

use App\Components\AddressManager;
use App\Components\CartManager;
use App\Components\DateTool;
use App\Components\GoodsManager;
use App\Components\InvoiceManager;
use App\Components\MemberManager;
use App\Components\OrderManager;
use App\Components\SuborderManager;
use App\Components\Utils;
use App\Models\OrderModel;
use App\Models\SuborderModel;
use Illuminate\Http\Request;
use Yansongda\Pay\Log;
use Yansongda\Pay\Pay;

class WechatController extends Controller
{
    //获取小程序微信支付的相关信息
    private function getConfig()
    {
        $config = [
            'appid' => '', // APP APPID
            'app_id' => '', // 公众号 APPID
            'miniapp_id' => 'wxb4077b9735ca748a',       //小程序miniapp_id
            'mch_id' => '1497470122',                    // 微信商户号
            'key' => 'LltO2bE5r4sGVJZjn0zd4aRsNQHezIiJ',                     // 微信支付签名秘钥  ImpYNtH4B5x7C587qy5ujzS6fbZnNv6T
            'notify_url' => 'https://yxp.isart.me/api/wechat/notify',      //支付结果通知地址  https://tclm.isart.me/api/wechat/notify
            'cert_client' => app_path() . '/cert/apiclient_cert.pem',        // 客户端证书路径，退款时需要用到
            'cert_key' => app_path() . '/cert/apiclient_key.pem',             // 客户端秘钥路径，退款时需要用到
            'log' => [ // optional
                'file' => app_path() . '/../storage/logs/wechat.log',
                'level' => 'debug'
            ]
        ];
        return $config;
    }

    /*
         * 微信支付成功回调
         *
         * By TerryQi
         *
         * 2018-01-12
         */
    public function wechatNotify(Request $request)
    {
        $config = $this->getConfig();
        $wechat = Pay::wechat($config);
        $user=$request->cookie('user');
        try {
            $data = $wechat->verify($request->getContent()); // 是的，验签就这么简单！
            Log::info('Wechat notify', $data->all());
            //支付成功
            if ($data->result_code == "SUCCESS") {
                //总订单out_trade_no
                $out_trade_no = $data->out_trade_no;
                //针对总订单进行处理
                $order = OrderManager::getOrderByUserIdAndTradeNo($user['id'],$out_trade_no);
                $order->pay_at = DateTool::getCurrentTime();
                $order->status = Utils::ORDER_PAYSUCCESS;
                $order->save();     //总订单设定支付时间和订单状态
                Log::info('order trade_no:'.$order->trade_no);
            }
            return $wechat->success();
        } catch (Exception $e) {
            Log::info($e->getMessage());
        }
    }
}