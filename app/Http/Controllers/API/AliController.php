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
            'appid' => Utils::ALIPAY_APPID, // APP APPID
            'notify_url' => Utils::ALIPAY_NOTIFY_URL,
            'ali_public_key' => Utils::ALIPAY_PUBLIC_KEY,     // 支付宝公钥，1行填写
            'private_key' => Utils::ALIPAY_PRIVATE_KEY,        // 自己的私钥，1行填写
            'log' => [ // optional
                'file' => app_path() . Utils::ALIPAY_LOG_FILE,
                'level' => Utils::ALIPAY_LOG_LEVEL
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