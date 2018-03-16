<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/3/8
 * Time: 16:03
 */

namespace App\Components;


use App\Http\Controllers\Home\ChemController;
use App\Http\Controllers\Home\MachiningController;
use App\Http\Controllers\Home\TestingController;
use App\Models\GoodsMachiningAttributeModel;
use App\Models\GoodsModel;
use App\Models\MenuModel;
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
        if (array_key_exists('code_url', $data)) {
            $order->code_url = array_get($data, 'code_url');
        }
        if (array_key_exists('user_id', $data)) {
            $order->user_id = array_get($data, 'user_id');
        }
        if (array_key_exists('total_fee', $data)) {
            $order->total_fee = array_get($data, 'total_fee');
        }
        if (array_key_exists('count', $data)) {
            $order->count = array_get($data, 'count');
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
        if (array_key_exists('logistics_company', $data)) {
            $order->logistics_company = array_get($data, 'logistics_company');
        }
        if (array_key_exists('logistics_no', $data)) {
            $order->logistics_no = array_get($data, 'logistics_no');
        }
        if (array_key_exists('delete', $data)) {
            $order->delete = array_get($data, 'delete');
        }
        return $order;
    }

    /*
     * 根据user_id和订单号获取订单（含子订单及商品信息）
     *
     * By zm
     *
     * 2018-03-09
     */
    public static function getOrderByUserIdAndTradeNo($user_id, $trade_no){
        if($trade_no){
            $where=array(
                "status"=>1,
                "user_id"=>$user_id,
                "trade_no"=>$trade_no
            );
        }
        else{
            $where=array(
                "status"=>1,
                "user_id"=>$user_id
            );
        }
        $order=OrderModel::where($where)->orderBy('id','desc')->first();
        $order['suborders']=SuborderManager::getSubordersByTradeNo($order['trade_no']);
        foreach ($order['suborders'] as $suborder){
            $goods_id=$suborder['goods_id'];
            $suborder['goods_info']=GoodsModel::find($goods_id);
            $menu_id=$suborder['goods_info']['menu_id'];
            $suborder['goods_menu']=MenuModel::find($menu_id);
            if($suborder['goods_menu']['menu_id']==1){
                $suborder['goods_column']=ChemController::COLUMN;
            }
            else if($suborder['goods_menu']['menu_id']==2){
                $suborder['goods_column']=TestingController::COLUMN;
            }
            else if($suborder['goods_menu']['menu_id']==3){
                $suborder['goods_column']=MachiningController::COLUMN;
                $attribute=GoodsMachiningAttributeModel::where('goods_id',$goods_id)->first();
                if($attribute){
                    $suborder['goods_type']=0;
                }
                else{
                    $suborder['goods_type']=1;
                }
            }
        }
        return $order;
    }

    /*
     * 根据user_id和订单号获取订单（用于判断支付状态）
     *
     * By zm
     *
     * 2018-03-16
     */
    public static function getOrderByUserIdAndTradeNoWithoutSuborderForPay($user_id, $trade_no){
        $where=array(
            "user_id"=>$user_id,
            "trade_no"=>$trade_no
        );
        $order=OrderModel::where($where)->first();
        return $order;
    }

    /*
     * 根据user_id和订单号获取主订单（不含子订单）
     *
     * By zm
     *
     * 2018-03-14
     */
    public static function getOrderByUserIdAndTradeNoWithoutSuborder($user_id, $trade_no){
        if($trade_no){
            $where=array(
                "status"=>1,
                "user_id"=>$user_id,
                "trade_no"=>$trade_no
            );
        }
        else{
            $where=array(
                "status"=>1,
                "user_id"=>$user_id
            );
        }
        $order=OrderModel::where($where)->orderBy('id','desc')->first();
        return $order;
    }

    /*
     * 根据user_id获取订单（全部）
     *
     * By zm
     *
     * 2018-03-09
     */
    public static function getOrdersByUserId($user_id){
        $orders=OrderModel::where('user_id',$user_id)->orderBy('id','desc')->get();
        foreach ($orders as $order){
            $order['suborders']=SuborderManager::getSubordersByTradeNo($order['trade_no']);
            foreach ($order['suborders'] as $suborder){
                $goods_id=$suborder['goods_id'];
                $suborder['goods_info']=GoodsModel::find($goods_id);
                $menu_id=$suborder['goods_info']['menu_id'];
                $suborder['goods_menu']=MenuModel::find($menu_id);
                if($suborder['goods_menu']['menu_id']==1){
                    $suborder['goods_column']=ChemController::COLUMN;
                }
                else if($suborder['goods_menu']['menu_id']==2){
                    $suborder['goods_column']=TestingController::COLUMN;
                }
                else if($suborder['goods_menu']['menu_id']==3){
                    $suborder['goods_column']=MachiningController::COLUMN;
                    $attribute=GoodsMachiningAttributeModel::where('goods_id',$goods_id)->first();
                    if($attribute){
                        $suborder['goods_type']=0;
                    }
                    else{
                        $suborder['goods_type']=1;
                    }
                }
            }
        }
        return $orders;
    }


    /*
     * 根据user_id获取订单（不显示已删除的订单）
     *
     * By zm
     *
     * 2018-03-15
     */
    public static function getOrdersByUserIdWithoutDetele($user_id){
        $orders=OrderModel::where('user_id',$user_id)->where('delete',0)->orderBy('id','desc')->get();
        foreach ($orders as $order){
            $order['suborders']=SuborderManager::getSubordersByTradeNo($order['trade_no']);
            foreach ($order['suborders'] as $suborder){
                $goods_id=$suborder['goods_id'];
                $suborder['goods_info']=GoodsModel::find($goods_id);
                $menu_id=$suborder['goods_info']['menu_id'];
                $suborder['goods_menu']=MenuModel::find($menu_id);
                if($suborder['goods_menu']['menu_id']==1){
                    $suborder['goods_column']=ChemController::COLUMN;
                }
                else if($suborder['goods_menu']['menu_id']==2){
                    $suborder['goods_column']=TestingController::COLUMN;
                }
                else if($suborder['goods_menu']['menu_id']==3){
                    $suborder['goods_column']=MachiningController::COLUMN;
                    $attribute=GoodsMachiningAttributeModel::where('goods_id',$goods_id)->first();
                    if($attribute){
                        $suborder['goods_type']=0;
                    }
                    else{
                        $suborder['goods_type']=1;
                    }
                }
            }
        }
        return $orders;
    }

    /*
     * 根据id获取订单
     *
     * By zm
     *
     * 2018-03-15
     */
    public static function getOrderById($id){
        $order=OrderModel::find($id);
        return $order;
    }


    /*
     * 根据search获取订单列表
     *
     * By zm
     *
     * 2018-03-15
     */
    public static function getOrdersBySearch($search){
        $orders=OrderModel::where('trade_no','like','%'.$search.'%')->orderBy('id','desc')->get();
        return $orders;
    }
}