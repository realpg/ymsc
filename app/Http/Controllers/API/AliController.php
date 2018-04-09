<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/4/3
 * Time: 13:51
 */

namespace app\Http\Controllers\API;

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

class AliController extends Controller
{
    //获取支付宝支付的相关信息
    private function getConfigForAli()
    {
        $config = [
            'appid' => '2018040802517697', // APP APPID
            'notify_url' => 'http://ymsc.isart.me/api/order/aliNotify',
            'ali_public_key' => 'MIIBIjANBgkqhkiG9w0BAQEFAAOCAQ8AMIIBCgKCAQEApVtiVVrGOKwpiMpWpw4QMc+BHlMzQoBiMOJFfNFyhYjgA2KsZN9MqwlzmaQLYS/H2U7ahAqIv6qcMTIbaGLYi15xqdZUkqjBXRCFpcC4H/7tEMvFT2h3WpR6iCG6OPc99TdprLwJQkqK/9ZYs6TuyA/gOMboCYrGRXS85sR2U0yfNSBWzDMzgYCINrjGcEARG/gjo5aIR380a3Xmc2it5bl9E9HMrmqWL6GamNlHeeDCz/Vj5MaaAB3uDijpJxWcjmUvJTDIIApc7YO96iASZFaVlXuKo5/GekfCKHGDuzzsLeEQ7PiLMAcIMjxy4mcHmoqHow+zpO4GVP7nMMiHqwIDAQAB',     // 支付宝公钥，1行填写
            'private_key' => 'MIIEowIBAAKCAQEApVtiVVrGOKwpiMpWpw4QMc+BHlMzQoBiMOJFfNFyhYjgA2KsZN9MqwlzmaQLYS/H2U7ahAqIv6qcMTIbaGLYi15xqdZUkqjBXRCFpcC4H/7tEMvFT2h3WpR6iCG6OPc99TdprLwJQkqK/9ZYs6TuyA/gOMboCYrGRXS85sR2U0yfNSBWzDMzgYCINrjGcEARG/gjo5aIR380a3Xmc2it5bl9E9HMrmqWL6GamNlHeeDCz/Vj5MaaAB3uDijpJxWcjmUvJTDIIApc7YO96iASZFaVlXuKo5/GekfCKHGDuzzsLeEQ7PiLMAcIMjxy4mcHmoqHow+zpO4GVP7nMMiHqwIDAQABAoIBAQCKWssNJdWjB5H9DWexgVfVhYzAhdbm9qqxwjFn/Yt35Y2h54bdI+VvWoop7JNE7wilb4/wWSwQSr1DgGxkTAhpnE04UMgUqjSYHMHmbTjiNJfArO7bwUnUNVXM34OENILX0VSPHgoVOG/THlK7hO3x4S638t2lVkMNTF7eK1Xh3WsHBnKQvK8UXpJ2C/MwcUnhu6dxV2hc07AXAVcth5HN2VnvNiXu+sZHrsq6KMr63PXyaglIEe7xkMf9jqZSeNtgd4hXHCkatZAz0sZmCEHD+ErnIEqJZ0PqsqhlvN/jPkpFRyDR/luU7d0Blc4SA8yM8Ab6FO4yUDtD/t9eSHoRAoGBANQTFozX8YcEy7Ej0KXUclvD3mQE0ARBTDep6KjGO57LdcAfDVdfBEymxUHyV2PnNbVEY1n68ca2YTue6/Xz0lwqjWa5zVLbTH1m8REPpr3QxN3t1YIEXbvatixPCMxi3K+mciwYAGZN34vWFjUH9RShROMJQtyWf3A6YX8u86NZAoGBAMebK8EnLg/ij9LwddN93KVvAbRkcoB5mwMq27RUC5MYNuHGPE8BDHL4dRqiNIj7NhjluZUwlj9+TmeRbEL8NwjdjDuNYyFaF6/oyQ2vSpz2Fa8WDK/2i/sDCL64d2tRO3Ij2LEu47KjUXE99qIidnmXtewJ11VrPaN4DiZsMPajAoGAZrjYM2BlnQC1qRev+KLuwYQeNFQgbe8y+8NQ7m8WcdQbNPPVgnyDmJ0u7sJzkfBsE2EMvojOk3HDpx1TLc7sFbiGxTs6OOgAJL24BouOOGLm+Jg60r9Kp7NIii2+FUHNo0b8Bl+Z0fPmU9Ve7FDuZQ+4TkAuIqrDD5k3oGMdoAECgYAdSl7sVCSFPjjeulx/8Xs8Z4K3hvnqcm3V1CczWhXsuuPq050r9rpt8Jm2k9DjvQFeO++0vdF+dblpp0RcvAgTa/dVEdVXIpJRRPaj5HItgEsES1cHR0WZSwOwgP89J0ly4WG99mSBZUfhNzeG6Um7ZBDVF0ibB0afQ1HIP54bwwKBgA38rcC67IY8Hby82ws8jYvUJki77Q4voWUxuiKrn1MIfFProfVVZmLCyfQQXmpy94Ml8lBYaPYSUPQzbmZG025KSCxKCaytdi5kOofQnqeuHwXfdNC6UzTOkz8EltqvQkGZLTm4CVs6Bjz9kOA6Wps12ewNYa4Hc4Ukm1cLEjLj',        // 自己的私钥，1行填写
            'log' => [ // optional
                'file' => app_path() . '/../storage/logs/ali.log',
                'level' => 'debug'
            ]
        ];
        return $config;
    }

    /*
     * 支付宝支付成功回调（根据微信改编）
     *
     * By zm
     *
     * 2018-04-03
     */
//    public function aliNotify(Request $request)
//    {
//        $config = $this->getConfigForAli();
//        $ali = Pay::alipay($config);
//        $user=$request->cookie('user');
//        try {
//            $data = $ali->verify($request->getContent()); // 是的，验签就这么简单！
//            Log::info('Ali notify', $data->all());
//            $data=$data->alipay_trade_precreate_response;
//            //支付成功
//            if ($data->code == "10000") {
//                //总订单out_trade_no
//                $out_trade_no = $data->out_trade_no;
//                Log::info('order out_trade_no:'.$data->out_trade_no);
//                //针对总订单进行处理
////                $order = OrderManager::getOrderByUserIdAndTradeNoWithoutSuborder($user['id'],$out_trade_no);
//                $order=OrderModel::where('trade_no',$out_trade_no)->first();
//                $order_data['pay_at']=date("Y-m-d H:i:s");
//                $order_data['status']=2;
//                $order=OrderManager::setOrder($order,$order_data);
//                $reuslt=$order->save();     //总订单设定支付时间和订单状态
//                if($reuslt){
//                    Log::info('order trade_no:'.$order->trade_no);
//                    //会员积分变更
//                    $member=UserModel::find($order['user_id']);
//                    $member_data['score']=$member['score']+floor($order['total_fee']/100);       //积分按元取整来算
////                    $member_data['score']=$member['score']+$order['total_fee'];       //积分按分来算
//                    $member=MemberManager::setUser($member,$member_data);
//                    $member->save();
//                }
//            }
//        } catch (Exception $e) {
//            Log::info($e->getMessage());
//        }
//    }
    /*
     * 支付宝支付成功回调（根据文档写的）
     *
     * By zm
     *
     * 2018-04-08
     */
    public function aliNotify(Request $request)
    {
        $config = $this->getConfigForAli();
        $ali = new Pay($config);
        $user=$request->cookie('user');
        try {
            $data = $ali->driver('alipay')->gateway()->verify($request->all());
            Log::info('Ali notify', $data->all());
            $data=$data->alipay_trade_precreate_response;
            //支付成功
            if ($data) {
                file_put_contents(storage_path('notify.txt'), "收到来自支付宝的异步通知\r\n", FILE_APPEND);
                file_put_contents(storage_path('notify.txt'), '订单号：' . $data->out_trade_no . "\r\n", FILE_APPEND);
                file_put_contents(storage_path('notify.txt'), '订单金额：' . $data->total_amount . "\r\n\r\n", FILE_APPEND);



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
                    $member_data['score']=$member['score']+floor($order['total_fee']/100);       //积分按元取整来算
//                    $member_data['score']=$member['score']+$order['total_fee'];       //积分按分来算
                    $member=MemberManager::setUser($member,$member_data);
                    $member->save();
                }
            }
            else{
                file_put_contents(storage_path('notify.txt'), "收到异步通知\r\n", FILE_APPEND);
            }
        } catch (Exception $e) {
            Log::info($e->getMessage());
        }
    }
}