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
use App\Components\GoodsManager;
use App\Components\InvoiceManager;
use App\Components\OrderManager;
use App\Components\SuborderManager;
use App\Models\OrderModel;
use App\Models\SuborderModel;
use Illuminate\Http\Request;

class OrderController
{
    /*
     * 添加订单
     */
    public function addDo(Request $request){
        $data=$request->all();
        $user=$request->cookie('user');
        $return=null;
        if($user){
            if (array_key_exists('id_array', $data)&&$data['id_array']) {
                //生成主订单
                $order=new OrderModel();
                $order_data['user_id']=$user['id'];
                $order_data['trade_no']=self::ProduceOrderNumber($user['id']);
                $order_data['count']=$data['count'];
                $order_data['total_fee']=$data['total']*100+1000;
                $order=OrderManager::setOrder($order,$order_data);
                $order_result=$order->save();
                if($order_result){
                    $trade_no=$order->trade_no;
                    $cart_ids=$data['id_array'];
                    foreach ($cart_ids as $cart_id){
                        $suborder=new SuborderModel();
                        $suborder_data['sub_trade_no']=self::ProduceOrderNumber($user['id']);
                        $suborder_data['trade_no']=$trade_no;
                        $suborder_data['user_id']=$user['id'];
                        $cart=CartManager::getCartInfoById($cart_id);
                        $suborder_data['goods_id']=$cart['goods_id'];
                        $goods=GoodsManager::getGoodsById($suborder_data['goods_id']);
                        $suborder_data['goods_number']=$goods['number'];
                        $suborder_data['goods_name']=$goods['name'];
                        $suborder_data['goods_picture']=$goods['picture'];
                        $suborder_data['total_fee']=$goods['price'];
                        $suborder_data['goods_unit']=$goods['unit'];
                        $suborder_data['count']=$cart['count'];
                        $suborder=SuborderManager::setSuborder($suborder,$suborder_data);
                        $suborder_result=$suborder->save();
                        if($suborder_result){
                            $delete_cart_result=$cart->delete();
                        }
                    }
                    $return['result']=true;
                    $return['msg']='添加订单成功';
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
            $return['msg']='结算失败，用户信息已过期或已经被清除，请重新登录';
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
            $order=OrderManager::getOrderByUserIdAndTradeNo($user['id'],$trade_no);
            $param=array(
                'common'=>$common,
                'column'=>$column,
                'progress'=>$progress,
                'user'=>$user,
                'carts'=>$carts,
                'addresses'=>$addresses,
                'invoices'=>$invoices,
                'order'=>$order
            );
            return view('home.order.edit',$param);
        }
        else{
            return redirect('signIn');
        }
    }

    /*
     * 执行编辑订单
     */
    public function payDo(Request $request){
        $data=$request->all();
        unset($data['common']);
        $user=$request->cookie('user');
        $return=null;
        if($user){
            if (array_key_exists('trade_no', $data)&&$data['trade_no']) {
                $order=OrderManager::getOrderByUserIdAndTradeNo($user['id'],$data['trade_no']);
                $data['status']=1;
                $invoice=InvoiceManager::getInvoiceById($data['invoice_id']);
                $data['invoice_type']=$invoice['type'];
                $order=OrderManager::setOrder($order,$data);
                unset($order['suborders']);
                $result=$order->save();
                if($result){
                    $return['result']=true;
                    $return['msg']='提交订单成功';
                }
                else{
                    $return['result']=false;
                    $return['msg']='提交订单失败';
                }
            }
            else{
                $return['result'] = false;
                $return['msg'] = '合规校验失败，缺少参数';
            }
        }
        else{
            $return['result']=false;
            $return['msg']='提交订单失败，用户信息已过期或已经被清除，请重新登录';
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
}