<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/3/7
 * Time: 9:30
 */

namespace App\Components;

use App\Http\Controllers\Home\ChemController;
use App\Http\Controllers\Home\MachiningController;
use App\Http\Controllers\Home\TestingController;
use App\Models\CartModel;
use App\Models\GoodsMachiningAttributeModel;
use App\Models\GoodsModel;
use App\Models\MenuModel;

class CartManager
{
    /*
     * 配置购物车的参数
     *
     * By zm
     *
     * 2018-03-07
     *
     */
    public static function setCart($cart, $data){
        if (array_key_exists('user_id', $data)) {
            $cart->user_id = array_get($data, 'user_id');
        }
        if (array_key_exists('goods_id', $data)) {
            $cart->goods_id = array_get($data, 'goods_id');
        }
        if (array_key_exists('count', $data)) {
            $cart->count = array_get($data, 'count');
        }
        return $cart;
    }

    /*
     * 根据id获取信息详情
     *
     * by zm
     *
     * 2018-03-07
     */
    public static function getCartInfoById($id){
        $cart = CartModel::find($id);
        return $cart;
    }

    /*
     * 根据goods_id和user_id获取信息详情
     *
     * by zm
     *
     * 2018-03-07
     */
    public static function getCartInfoByGoodsIdAndUserId($goods_id,$user_id){
        $where=array(
            'goods_id'=>$goods_id,
            'user_id'=>$user_id
        );
        $cart = CartModel::where($where)->first();
        return $cart;
    }
    
    /*
     * whereIn查找信息
     *
     * By zm
     *
     * 2018-03-07
     *
     */
    public static function getCartByMoreId($data){
        $carts=CartModel::whereIn('id',$data)->get();
        return $carts;
    }

    /*
     * 根据用户获取购物车信息
     *
     * By zm
     *
     * 2018-03-07
     *
     */
    public static function getCartsByUserId($user_id){
        $carts=CartModel::where('user_id',$user_id)->orderBy('created_at','asc')->get();
        foreach ($carts as $cart){
            $goods_id=$cart['goods_id'];
            $cart['goods_info']=GoodsModel::find($goods_id);
            $menu_id=$cart['goods_info']['menu_id'];
            $cart['goods_menu']=MenuModel::find($menu_id);
            if($cart['goods_menu']['menu_id']==1){
                $cart['goods_column']=ChemController::COLUMN;
            }
            else if($cart['goods_menu']['menu_id']==2){
                $cart['goods_column']=TestingController::COLUMN;
            }
            else if($cart['goods_menu']['menu_id']==3){
                $cart['goods_column']=MachiningController::COLUMN;
                $attribute=GoodsMachiningAttributeModel::where('goods_id',$goods_id)->first();
                if($attribute){
                    $cart['goods_type']=0;
                }
                else{
                    $cart['goods_type']=1;
                }
            }
        }
        return $carts;
    }
}