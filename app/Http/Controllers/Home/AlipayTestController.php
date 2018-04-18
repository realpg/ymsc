<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/4/13
 * Time: 13:57
 */

namespace App\Http\Controllers\Home;

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

class AlipayTestController
{
    const POSTAGE = 0;  //邮费
    /*
     * 配置支付宝支付
     */
    private function getConfigForAli()
    {
        $config = [
            'appid' => Utils::ALIPAY_APPID, // APP APPID
            'notify_url' => Utils::ALIPAY_NOTIFY_URL,
            'return_url' => "http://localhost/ymsc/public/api/order/aliReturn",
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
     * 编辑订单
     */
    public function edit(Request $request, $trade_no=''){
        $data=$request->all();
        $user=$request->cookie('user');
        $common=$data['common'];
        if($user){
            $column='cart';
            $progress=2;
            //购物车信息
            $carts = CartManager::getCartsByUserId($user['id']);
            $addresses=AddressManager::getAddressListsByUserId($user['id']);
            $invoices=InvoiceManager::getInvoiceListsByUserId($user['id']);
            $order=OrderManager::getOrderByUserIdAndTradeNo($user['id'],$trade_no);
            $postage=Utils::POSTAGE;  //邮费
            $param=array(
                'common'=>$common,
                'column'=>$column,
                'progress'=>$progress,
                'user'=>$user,
                'carts'=>$carts,
                'addresses'=>$addresses,
                'invoices'=>$invoices,
                'order'=>$order,
                'postage'=>$postage
            );
            return view('home.alipay.edit',$param);
        }
        else{
            return redirect('signIn');
        }
    }

    /*
     * 执行编辑订单（支付宝）
     */
    public function aliPayDo(Request $request){

        //进行总订单支付
        $pay_order = [
            'out_trade_no' => '27152325473000148957',
            'total_amount' => 0.01,    //支付宝以“元”为单位
            'subject' => '优迈商城订单',
            'qr_pay_mode' => '0',
        ];
        //配置config
        $config = self::getConfigForAli();
        $result = Pay::alipay($config)->app($pay_order);
        $result_rs=explode('&',$result);
//        foreach ($result_rs as $result_r){
//            echo $result_r.'<br />';
//        }
        return $result;
    }
}