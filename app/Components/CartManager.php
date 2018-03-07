<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/3/7
 * Time: 9:30
 */

namespace app\Components;


use App\Models\CartModel;

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
        return $carts;
    }
}