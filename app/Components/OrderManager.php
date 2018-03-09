<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/3/8
 * Time: 16:03
 */

namespace App\Components;


use App\Models\OrderModel;

class OrderManager
{
    /*
     * 配置主订单参数
     *
     * By zm
     *
     * 2018-03-08
     */
    public static function setOrder($order, $data)
    {
        if (array_key_exists('trade_no', $data)) {
            $order->trade_no = array_get($data, 'trade_no');
        }
        if (array_key_exists('prepay_id', $data)) {
            $order->prepay_id = array_get($data, 'prepay_id');
        }
        if (array_key_exists('user_id', $data)) {
            $order->user_id = array_get($data, 'user_id');
        }
        if (array_key_exists('total_fee', $data)) {
            $order->total_fee = array_get($data, 'total_fee');
        }
        if (array_key_exists('content', $data)) {
            $order->content = array_get($data, 'content');
        }
        if (array_key_exists('status', $data)) {
            $order->status = array_get($data, 'status');
        }
        if (array_key_exists('pay_at', $data)) {
            $order->pay_at = array_get($data, 'pay_at');
        }
        if (array_key_exists('address_id', $data)) {
            $order->address_id = array_get($data, 'address_id');
        }
        if (array_key_exists('invoice_id', $data)) {
            $order->invoice_id = array_get($data, 'invoice_id');
        }
        if (array_key_exists('invoice_type', $data)) {
            $order->invoice_type = array_get($data, 'invoice_type');
        }
        return $order;
    }

    /*
     * 根据user_id和订单号获取主订单
     *
     * By zm
     *
     * 2018-03-09
     */
    public static function getOrderByUserIdAndTradeNo($user_id, $trade_no){
        if($trade_no){
            $where=array(
                "status"=>0,
                "user_id"=>$user_id,
                "trade_no"=>$trade_no
            );
        }
        else{
            $where=array(
                "status"=>0,
                "user_id"=>$user_id
            );
        }
        $order=OrderModel::where($where)->orderBy('id','desc')->first();
        $order['suborders']=SuborderManager::getSubordersByTradeNo($order['trade_no']);
        return $order;
    }
}