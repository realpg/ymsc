<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/3/8
 * Time: 15:50
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

class OrderController
{
    const POSTAGE = 0;  //邮费
    /*
     * 配置微信支付
     */
    private function getConfig()
    {
        $config = [
            'appid' => Utils::WECHAT_APPID, // APP APPID
            'app_id' => Utils::WECHAT_APP_ID, // 公众号 APPID
            'miniapp_id' => Utils::WECHAT_MINIAPP_ID, // 小程序 APPID
            'mch_id' => Utils::WECHAT_MCH_ID, //微信商户号
            'key' => Utils::WECHAT_KEY,  // 微信支付签名秘钥
//            'notify_url' => Utils::WECHAT_NOTIFY_URL,
            'notify_url' => 'http://'.$_SERVER['SERVER_NAME'].Utils::WECHAT_NOTIFY_URL,
            'trade_type'=>Utils::WECHAT_TRADE_TYPE,
            'cert_client' => app_path() . Utils::WECHAT_CERT_CLIENT,        // 客户端证书路径，退款时需要用到
            'cert_key' => app_path() . Utils::WECHAT_CERT_KEY,             // 客户端秘钥路径，退款时需要用到
            'log' => [ // optional
                'file' => app_path() . Utils::WECHAT_LOG_FILE,
                'level' => Utils::WECHAT_LOG_LEVEL
            ]
        ];
        return $config;
    }

    /*
     * 配置支付宝支付
     */
    private function getConfigForAli()
    {
        $config = [
            'app_id' => Utils::ALIPAY_APPID, // APP APPID
//            'notify_url' => Utils::ALIPAY_NOTIFY_URL,
//            'return_url' => Utils::ALIPAY_RETRUN_URL,
            'notify_url' => 'http://'.$_SERVER['SERVER_NAME'].Utils::ALIPAY_NOTIFY_URL,
            'return_url' => 'http://'.$_SERVER['SERVER_NAME'].Utils::ALIPAY_RETRUN_URL,
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
     * 添加订单
     */
    public function addDo(Request $request){
        $data=$request->all();
        $common=$data['common'];
        $user=$request->cookie('user');
        $return=null;
        if($user){
            if (array_key_exists('id_array', $data)&&$data['id_array']) {
                //生成主订单
                $order=new OrderModel();
                $order_data['user_id']=$user['id'];
                $order_data['trade_no']=self::ProduceOrderNumber($user['id']);
//                $order_data['count']=$data['count'];
//                $postage=Utils::POSTAGE;   //邮费（代码）
                $postage=$common['base']['postage'];   //邮费（数据库）
//                $order_data['total_fee']=$data['total']*100+$postage;
                $order_data['total_fee']=$postage;
                $order_data['postage']=$postage;
                $order=OrderManager::setOrder($order,$order_data);
                $order_result=$order->save();
                if($order_result){
                    $trade_no=$order->trade_no;
                    $cart_ids=$data['id_array'];
                    $all=true;
                    foreach ($cart_ids as $cart_id){
                        $suborder=new SuborderModel();
                        $suborder_data['sub_trade_no']=self::ProduceOrderNumber($user['id']);
                        $suborder_data['trade_no']=$trade_no;
                        $suborder_data['user_id']=$user['id'];
                        $cart=CartManager::getCartInfoById($cart_id);
                        $suborder_data['goods_id']=$cart['goods_id'];
                        $goods=GoodsManager::getGoodsById($suborder_data['goods_id']);
                        if($goods['id']==1){
                            $suborder_data['count']=$cart['count'];
                            $suborder_data['goods_number']=$goods['number'];
                            $suborder_data['goods_name']=$goods['name'];
                            $suborder_data['goods_picture']=$goods['picture'];
                            $suborder_data['total_fee']=$goods['price'];
                            $suborder_data['goods_unit']=$goods['unit'];
                            $suborder=SuborderManager::setSuborder($suborder,$suborder_data);
                            $suborder_result=$suborder->save();
                            if($suborder_result){
                                $order->count+=$suborder_data['count'];
                                $order->total_fee+=$suborder_data['total_fee']*$suborder_data['count'];  //根据最终购买的商品数量计算应支付的金额
                                $delete_cart_result=$cart->delete();
                            }
                        }
                        else{
                            if($goods['stock']>0){
                                if($goods['stock']>=$cart['count']){
                                    $suborder_data['count']=$cart['count'];
                                }
                                else{
                                    $all=false;
                                    $suborder_data['count']=$cart['stock'];
                                }
                                $suborder_data['goods_number']=$goods['number'];
                                $suborder_data['goods_name']=$goods['name'];
                                $suborder_data['goods_picture']=$goods['picture'];
                                $suborder_data['total_fee']=$goods['price'];
                                $suborder_data['goods_unit']=$goods['unit'];
                                $suborder=SuborderManager::setSuborder($suborder,$suborder_data);
                                $suborder_result=$suborder->save();
                                if($suborder_result){
                                    $order->count+=$suborder_data['count'];
                                    $order->total_fee+=$suborder_data['total_fee']*$suborder_data['count'];  //根据最终购买的商品数量计算应支付的金额
                                    $delete_cart_result=$cart->delete();
                                    $goods->stock = $goods['stock'] - $suborder_data['count'];
                                    $goods->save();
                                }
                            }
                            else{
                                $all=false;
                            }
                        }
                    }
                    //保存总金额于总订单中
                    $finish_result=$order->save();
                    if($finish_result){
                        if($all){
                            $return['result']=true;
                            $return['msg']='添加订单成功';
                        }
                        else{
                            $return['result']=true;
                            $return['msg']='添加订单成功，部分商品在结算过程中已被其他人购买，可能出现商品下架或购买数量达不到需求数量，请核对之后再进行付款！';
                        }
                    }
                    else{
                        //添加订单失败后要删除之前的操作，避免业务出错
                        $suborders=SuborderManager::getSubOrderById($order->trade_no);
                        foreach ($suborders as $suborder){
                            $suborder->delete();
                        }
                        $order->delete();
                        $return['result']=false;
                        $return['msg']='添加订单失败';
                    }
                }
                else{
                    $return['result']=false;
                    $return['msg']='添加订单失败';
                }
            }
            else{
                $return['result'] = false;
                $return['msg'] = '合规校验失败，缺少参数';
            }
        }
        else{
            $return['result']=false;
            $return['code']=Utils::UNSIGN_CODE;
            $return['msg']=Utils::UNSIGN_WORD;
        }
        return $return;
    }

    /*
     * 添加订单（商品页立即支付）
     */
    public function addGoodsDo(Request $request){
        $data=$request->all();
        $common=$data['common'];
        $user=$request->cookie('user');
        $return=null;
        if($user){
            if (array_key_exists('goods_id', $data)) {
                $check_goods=GoodsManager::getGoodsById($data['goods_id']);  //检验购买时商品的库存是否够用
                if($check_goods['stock']>0||$check_goods['id']==1){
                    if($check_goods['stock']>=$data['count']||$check_goods['id']==1){
                        //生成主订单
                        $order=new OrderModel();
                        $order_data['user_id']=$user['id'];
                        $order_data['trade_no']=self::ProduceOrderNumber($user['id']);
                        $order_data['count']=$data['count'];
//                        $postage=Utils::POSTAGE;   //邮费（代码）
                        $postage=$common['base']['postage'];   //邮费（数据库）
                        $order_data['postage']=$postage;
                        $order_data['total_fee']=$data['total']*$order_data['count']*100+$postage;
                        $order=OrderManager::setOrder($order,$order_data);
                        $order_result=$order->save();
                        if($order_result){
                            $trade_no=$order->trade_no;
                            $suborder=new SuborderModel();
                            $suborder_data['sub_trade_no']=self::ProduceOrderNumber($user['id']);
                            $suborder_data['trade_no']=$trade_no;
                            $suborder_data['user_id']=$user['id'];
                            $suborder_data['goods_id']=$data['goods_id'];
                            $goods=GoodsManager::getGoodsById($suborder_data['goods_id']);
                            $suborder_data['goods_number']=$goods['number'];
                            $suborder_data['goods_name']=$goods['name'];
                            $suborder_data['goods_picture']=$goods['picture'];
                            $suborder_data['total_fee']=$goods['price'];
                            $suborder_data['goods_unit']=$goods['unit'];
                            $suborder_data['count']=$data['count'];
                            $suborder=SuborderManager::setSuborder($suborder,$suborder_data);
                            $suborder_result=$suborder->save();
                            if($suborder_result){
                                if($goods->id!=1){
                                    $goods->stock=$goods['stock']-$data['count'];
                                    $goods->save();
                                }
                                $return['result']=true;
                                $return['msg']='添加订单成功';
                            }
                            else{
                                $delete_order=OrderModel::find($order->id);
                                $delete_order->delete();
                                $return['result']=true;
                                $return['msg']='添加订单失败';
                            }
                        }
                        else{
                            $return['result']=false;
                            $return['msg']='添加订单失败';
                        }
                    }
                    else{
                        $return['result']=false;
                        $return['msg']='添加订单的过程中，已有人购买了此商品。当前数量少于您的需求数量，请重新购买！请重新刷新页面更新信息！';
                    }
                }
                else{
                    $return['result']=false;
                    $return['msg']='添加订单失败，商品已被抢光现已下架，请重新刷新页面更新信息！';
                }
            }
            else{
                $return['result'] = false;
                $return['msg'] = '合规校验失败，缺少参数';
            }
        }
        else{
            $return['result']=false;
            $return['code']=Utils::UNSIGN_CODE;
            $return['msg']=Utils::UNSIGN_WORD;
        }
        return $return;
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
            //邮费校验
//            $order=OrderManager::getOrderByUserIdAndTradeNoWithSuborder($user['id'],$trade_no);
//            if($order['postage']==null&&$order['postage']!=0){
//                $postage=$common['base']['postage'];   //邮费（数据库）
//                $data_order['postage']=$postage;
//                $data_order['total_fee']=$order['total_fee']+$postage;
//                $order=OrderManager::setOrder($order,$data_order);
//                $order->save();
//            }
//            else{
//                $postage=$order['postage'];
//            }
            $order=OrderManager::getOrderByUserIdAndTradeNo($user['id'],$trade_no);
            $postage=$order['postage'];
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
            return view('home.order.edit',$param);
        }
        else{
            return redirect('signIn');
        }
    }

    /*
     * 执行编辑订单（微信）
     */
    public function payDo(Request $request){
        $data=$request->all();
        $common=$data['common'];
        unset($data['common']);
        $user=$request->cookie('user');
        $return=null;
        if($user){
            if (array_key_exists('trade_no', $data)&&$data['trade_no']) {
//                $order=OrderManager::getOrderByUserIdAndTradeNo($user['id'],$data['trade_no']);
                $order=OrderManager::getOrderByUserIdAndTradeNoWithSuborder($user['id'],$data['trade_no']);
                if($data['invoice_id']){
                    $invoice=InvoiceManager::getInvoiceById($data['invoice_id']);
                    $data['invoice_type']=$invoice['type'];
                }
                $order=OrderManager::setOrder($order,$data);
//                unset($order['suborders']);
                $result=$order->save();
//                dd($result);
                $suborders=SuborderManager::getSubordersByTradeNo($order->trade_no);
                $goods_ids='';
                if($goods_ids){
                    $goods_ids=substr($goods_ids,0,strlen($goods_ids)-1);
                }
                foreach ($suborders as $suborder){
                    $goods_ids.=$suborder['goods_id'].',';
                }

                //进行总订单支付
                $pay_order = [
                    'out_trade_no' => $order->trade_no,
                    'total_fee' => $order->total_fee,
                    'body' => '优迈商城支付',
                    'spbill_create_ip' => $_SERVER['HTTP_HOST'],
                    'product_id' => $goods_ids,            // 订单商品 ID
                ];
                //配置config
                $config = self::getConfig();
                $result = Pay::wechat($config)->scan($pay_order);
//                dd($result);
                if($result['return_code']){
//                    设置微信预付订单id（prepay_id）
                    $order->prepay_id = $result['prepay_id'];
                    $order->code_url = $result['code_url'];
                    $order->save();
                    $return['result']=true;
                    $return['msg']='支付二维码生成成功';
                }
                else{
                    $return['result']=false;
                    $return['msg']='支付失败';
                }
            }
            else{
                $return['result'] = false;
                $return['msg'] = '合规校验失败，缺少参数';
            }
        }
        else{
            $return['result']=false;
            $return['code']=Utils::UNSIGN_CODE;
            $return['msg']=Utils::UNSIGN_WORD;
        }
        return $return;
    }

    /*
     * 执行编辑订单（支付宝）
     */
    public function aliPayDo(Request $request){
        $data=$request->all();
        unset($data['common']);
        $user=$request->cookie('user');
        $return=null;
        if($user){
            if (array_key_exists('trade_no', $data)&&$data['trade_no']) {
                $order=OrderManager::getOrderByUserIdAndTradeNo($user['id'],$data['trade_no']);
                if($data['invoice_id']){
                    $invoice=InvoiceManager::getInvoiceById($data['invoice_id']);
                    $data['invoice_type']=$invoice['type'];
                }
                $order=OrderManager::setOrder($order,$data);
                unset($order['suborders']);
                $result=$order->save();
                $suborders=SuborderManager::getSubordersByTradeNo($order->trade_no);
                $goods_ids='';
                if($goods_ids){
                    $goods_ids=substr($goods_ids,0,strlen($goods_ids)-1);
                }
                foreach ($suborders as $suborder){
                    $goods_ids.=$suborder['goods_id'].',';
                }
                //进行总订单支付
                $pay_order = [
                    'out_trade_no' => $order->trade_no,
                    'total_amount' => ($order->total_fee)/100,    //支付宝以“元”为单位
                    'subject' => '优迈商城订单支付',
                ];
                //配置config
                $config = self::getConfigForAli();
                $result = Pay::alipay($config)->scan($pay_order);

                if($result['code']=='10000'){
                    $order->code_url = $result['qr_code'];
                    $order->save();
//                    //更改会员积分
//                    $member=MemberManager::getUserInfoByIdWithNotToken($user['id']);
//                    $member_data['score']=$member['$member']+(int)($order->total_fee/100);
//                    $member=MemberManager::setUser($member,$member_data);
//                    $member->save();
                    $return['result']=true;
                    $return['msg']='支付二维码生成成功';
                }
                else{
                    $return['result']=false;
                    $return['msg']='支付失败';
                }
            }
            else{
                $return['result'] = false;
                $return['msg'] = '合规校验失败，缺少参数';
            }
        }
        else{
            $return['result']=false;
            $return['code']=Utils::UNSIGN_CODE;
            $return['msg']=Utils::UNSIGN_WORD;
        }
        return $return;
    }

    /*
     * 扫描支付二维码（微信）
     */
    public function qrcode(Request $request, $trade_no=''){
        $data = $request->all();
        $user = $request->cookie('user');
        $common=$data['common'];
        $return = null;
        if ($user) {
            $column='cart';
            $progress=2;
            //购物车信息
            $carts = CartManager::getCartsByUserId($user['id']);
            if(!empty($trade_no)){
                $order=OrderManager::getOrderByUserIdAndTradeNo($user['id'],$trade_no);
                if(count($order['suborders'])>0){
                    $param=array(
                        'common'=>$common,
                        'column'=>$column,
                        'progress'=>$progress,
                        'user'=>$user,
                        'carts'=>$carts,
                        'order'=>$order
                    );
                    return view('home.order.qrcode',$param);
                }
                else{
                    return redirect('center/order');
                }
            }
            else{
                $return['result']=false;
                $return['msg']='校验失败，缺少参数';
            }
        }
        else{
            $return['result']=false;
            $return['code']=Utils::UNSIGN_CODE;
            $return['msg']=Utils::UNSIGN_WORD;
        }
        return $return;
    }

    /*
     * 扫描支付二维码（支付宝）
     */
    public function aliqrcode(Request $request, $trade_no=''){
        $data = $request->all();
        $user = $request->cookie('user');
        $common=$data['common'];
        $return = null;
        if ($user) {
            $column='cart';
            $progress=2;
            //购物车信息
            $carts = CartManager::getCartsByUserId($user['id']);
            if(!empty($trade_no)){
                $order=OrderManager::getOrderByUserIdAndTradeNo($user['id'],$trade_no);
                if(count($order['suborders'])>0){
                    $param=array(
                        'common'=>$common,
                        'column'=>$column,
                        'progress'=>$progress,
                        'user'=>$user,
                        'carts'=>$carts,
                        'order'=>$order
                    );
                    return view('home.order.aliqrcode',$param);
                }
                else{
                    return redirect('center/order');
                }
            }
            else{
                $return['result']=false;
                $return['msg']='校验失败，缺少参数';
            }
        }
        else{
            $return['result']=false;
            $return['code']=Utils::UNSIGN_CODE;
            $return['msg']=Utils::UNSIGN_WORD;
        }
        return $return;
    }

    /*
     * 查询支付状态
     */
    public function getOrderState(Request $request){
        $data=$request->all();
        $common=$data['common'];
        unset($data['common']);
        $user=$request->cookie('user');
        $return=null;
        if($user){
            if (array_key_exists('trade_no', $data)&&$data['trade_no']) {
                $order=OrderManager::getOrderByUserIdAndTradeNoWithoutSuborderForPay($user['id'],$data['trade_no']);
                //如果支付成功，给商城管理者发送短信通知
                if($order['status']==2){
                    $sms_param=array(
                        'phonenum'=>$common['base']['sms_phone'],
                        'template_id'=>Utils::TEMPLATE_ID,
                        'pro_code'=>Utils::PRO_CODE,
                        'sms_txt'=>'您好，商城产生新的订单'.$data['trade_no'].'，请尽快登录系统管理后台查看。'
                    );
                    $result=Utils::curl('http://common.isart.me/api/common/sms/sendSMS',$sms_param,1);
                }
                $return['result']=true;
                $return['code']=$order['status'];
                $return['msg']='查询成功';
            }
            else{
                $return['result'] = false;
                $return['msg'] = '合规校验失败，缺少参数';
            }
        }
        else{
            $return['result']=false;
            $return['code']=Utils::UNSIGN_CODE;
            $return['msg']=Utils::UNSIGN_WORD;
        }
        return $return;
    }

    /*
     * 生成20位订单号
     */
    public function ProduceOrderNumber($user_id){
        $rand_prv=rand(10,100);  //随机数2位
        $time=time(); //时间戳10位
        //取用户编号后4位
        if(strlen($user_id)>=4){
            $given=substr($user_id,-4);
        }
        else{
            $bit = 4;//产生4位数的数字编号
            $num_len = strlen($user_id);
            $zero = '';
            for($i=$num_len; $i<$bit; $i++){
                $zero .= "0";
            }
            $given = $zero.$user_id;
        }
        $rand_end=rand(1000,10000);  //随机数4位
        $number=$rand_prv.$time.$given.$rand_end;
        return $number;
    }

    /*
     * 支付结果
     */
    public function result(Request $request){
        $data=$request->all();
        unset($data['common']);
        $user=$request->cookie('user');
        $return=null;
        if($user){
            if (array_key_exists('trade_no', $data)) {
                $order=OrderManager::getOrderByUserIdAndTradeNoWithoutSuborderForPay($user['id'],$data['trade_no']);
                if($order['status']==2){
                    $return['result']=true;
                    $return['msg']='支付成功';
                }
                else{
                    $return['result']=false;
                    $return['msg']='支付失败';
                }
            }
            else{
                $return['result'] = false;
                $return['msg'] = '合规校验失败，缺少参数';
            }
        }
        else{
            $return['result']=false;
            $return['code']=Utils::UNSIGN_CODE;
            $return['msg']=Utils::UNSIGN_WORD;
        }
        return $return;
    }

    /*
     * 支付成功
     */
    public function success(Request $request){
        $data=$request->all();
        $user=$request->cookie('user');
        $common=$data['common'];
        if($user){
            $column='cart';
            $progress=3;
            //购物车信息
            $carts = CartManager::getCartsByUserId($user['id']);
            $param=array(
                'common'=>$common,
                'column'=>$column,
                'progress'=>$progress,
                'user'=>$user,
                'carts'=>$carts
            );
            return view('home.order.success',$param);
        }
        else{
            return redirect('signIn');
        }
    }

    /*
     * 支付失败
     */
    public function fail(Request $request, $trade_no=''){
        $data=$request->all();
        $user=$request->cookie('user');
        $common=$data['common'];
        if($user){
            $column='cart';
            $progress=2;
            //购物车信息
            $carts = CartManager::getCartsByUserId($user['id']);
            $param=array(
                'common'=>$common,
                'column'=>$column,
                'progress'=>$progress,
                'user'=>$user,
                'carts'=>$carts,
                'trade_no'=>$trade_no
            );
            return view('home.order.fail',$param);
        }
        else{
            return redirect('signIn');
        }
    }
}