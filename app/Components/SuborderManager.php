<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/3/8
 * Time: 17:40
 */

namespace App\Components;


use App\Models\SuborderModel;

class SuborderManager
{

    /*
     * 配置子订单参数
     *
     * By zm
     *
     * 2018-03-08
     */
    public static function setSuborder($suborder, $data)
    {
        if (array_key_exists('sub_trade_no', $data)) {
            $suborder->sub_trade_no = array_get($data, 'sub_trade_no');
        }
        if (array_key_exists('trade_no', $data)) {
            $suborder->trade_no = array_get($data, 'trade_no');
        }
        if (array_key_exists('user_id', $data)) {
            $suborder->user_id = array_get($data, 'user_id');
        }
        if (array_key_exists('goods_id', $data)) {
            $suborder->goods_id = array_get($data, 'goods_id');
        }
        if (array_key_exists('goods_name', $data)) {
            $suborder->goods_name = array_get($data, 'goods_name');
        }
        if (array_key_exists('goods_picture', $data)) {
            $suborder->goods_picture = array_get($data, 'goods_picture');
        }
        if (array_key_exists('total_fee', $data)) {
            $suborder->total_fee = array_get($data, 'total_fee');
        }
        if (array_key_exists('count', $data)) {
            $suborder->count = array_get($data, 'count');
        }
        if (array_key_exists('content', $data)) {
            $suborder->content = array_get($data, 'content');
        }
        if (array_key_exists('wl_np', $data)) {
            $suborder->wl_np = array_get($data, 'wl_np');
        }
        if (array_key_exists('wl_status', $data)) {
            $suborder->wl_status = array_get($data, 'wl_status');
        }
        if (array_key_exists('status', $data)) {
            $suborder->status = array_get($data, 'status');
        }
        return $suborder;
    }

    /*
     * 根据主订单号查找商品
     *
     * By zm
     *
     * 2018-03-09
     */
    public static function getSubordersByTradeNo($trade_no)
    {
        $suborders=SuborderModel::where('trade_no',$trade_no)->orderBy('id','asc')->get();
        return $suborders;
    }
}