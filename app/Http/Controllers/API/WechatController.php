<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/3/13
 * Time: 18:44
 */

namespace App\Http\Controllers\API;

use App\Components\BannerManager;
use App\Components\DateTool;
use App\Components\MemberManager;
use App\Components\OrderManager;
use App\Components\ServiceManager;
use App\Components\Utils;
use App\Http\Controllers\Controller;
use App\Models\OrderModel;
use App\Models\UserModel;
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
            'app_id' => 'wxa2096c6338c06a0f', // 公众号 APPID
            'miniapp_id' => '', // 小程序 APPID
            'mch_id' => '1491365062', //微信商户号
            'key' => 'liuaweiisthelegalpersonofisart66',  // 微信支付签名秘钥
            'notify_url' => 'http://ymsc.isart.me/api/order/notify',
            'trade_type'=>'NATIVE',
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
                Log::info('order out_trade_no:'.$data->out_trade_no);
                //针对总订单进行处理
//                $order = OrderManager::getOrderByUserIdAndTradeNoWithoutSuborder($user['id'],$out_trade_no);
                $order=OrderModel::where('trade_no',$out_trade_no)->first();
                $order_data['pay_at']=date("Y-m-d H:i:s");
                $order_data['status']=2;
                $order=OrderManager::setOrder($order,$order_data);
                $reuslt=$order->save();     //总订单设定支付时间和订单状态
                if($reuslt){
                    Log::info('order trade_no:'.$order->trade_no);
                    //会员积分变更
                    $member=UserModel::find($order['user_id']);
//                    $member_data['score']=$member['score']+floor($order['total_fee']/100);       //积分按元取整来算
                    $member_data['score']=$member['score']+$order['total_fee'];       //积分按分来算
                    $member=MemberManager::setUser($member,$member_data);
                    $member->save();
//                    //跳转页面
//                    $base=BannerManager::getBaseInfo();
//                    $services=ServiceManager::getAllServices();
//                    $common['base']=$base;
//                    $common['services']=$services;
//                    $request['common']=$common;
//                    $column='cart';
//                    $progress=3;
//                    //购物车信息
//                    $carts = CartManager::getCartsByUserId($user['id']);
//                    $param=array(
//                        'common'=>$common,
//                        'column'=>$column,
//                        'progress'=>$progress,
//                        'user'=>$user,
//                        'carts'=>$carts
//                    );
//                    return view('home.order.success',$param);
                }
            }
//            return $wechat->success();
        } catch (Exception $e) {
            Log::info($e->getMessage());
        }
    }
}