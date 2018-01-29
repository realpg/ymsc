<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/1/28
 * Time: 10:28
 */

namespace App\Components;

use App\Models\GoodsDetailModel;
use App\Models\GoodsModel;

class GoodsManager
{
    /*
     * 按menu_id获取商品
     *
     * By zm
     *
     * 2018-01-28
     *
     */
    public static function getAllGoodsByMenuId($menu_id)
    {
        $goodses=GoodsModel::where('menu_id',$menu_id)->orderBy('sort','desc')->get();
        return $goodses;
    }

    /*
     * 通过模糊搜索获取商品
     *
     * By zm
     *
     * 2018-01-28
     *
     */
    public static function getAllGoodsListsByMenuId($search ,$menu_id )
    {
        //判断menu_id是否为一级栏目
        $menu=MenuManager::getMenuById($menu_id);
        if($menu['menu_id']){
            $goodses=GoodsModel::where('menu_id',$menu_id)->where('name','like','%'.$search.'%')->orderBy('sort','desc')->get();
        }
        else{
            $menus=MenuManager::getAllMenuListsByMenuId($menu_id);
            $menu_id_array=null;
            foreach ($menus as $k=>$menu){
                $menu_id_array[$k]=$menu['id'];
            }
            $goodses=GoodsModel::whereIn('menu_id',$menu_id_array)->where('name','like','%'.$search.'%')->get();
        }
        foreach ($goodses as $goods){
            $menu_id=$goods['menu_id'];
            $goods['menu']=MenuManager::getMenuById($menu_id);
        }
        return $goodses;
    }

    /*
     * whereIn查找信息
     *
     * By zm
     *
     * 2018-01-28
     *
     */
    public static function getGoodsByMoreId($data){
        $goodses=GoodsModel::whereIn('id',$data)->get();
        return $goodses;
    }

    /*
     * 根据id获得商品
     *
     * By zm
     *
     * 2018-01-28
     *
     */
    public static function getGoodsById($id){
        $goods=GoodsModel::where('id',$id)->first();
        return $goods;
    }

    /*
     * 配置商品的参数
     *
     * By zm
     *
     * 2018-01-29
     *
     */
    public static function setGoods($goods, $data){
        if (array_key_exists('menu_id', $data)) {
            $goods->menu_id = array_get($data, 'menu_id');
        }
        if (array_key_exists('number', $data)) {
            $goods->name = array_get($data, 'name');
        }
        if (array_key_exists('name', $data)) {
            $goods->name = array_get($data, 'name');
        }
        if (array_key_exists('drimecost', $data)) {
            $goods->drimecost = array_get($data, 'drimecost');
        }
        if (array_key_exists('price', $data)) {
            $goods->price = array_get($data, 'price');
        }
        if (array_key_exists('unit', $data)) {
            $goods->unit = array_get($data, 'unit');
        }
        if (array_key_exists('content', $data)) {
            $goods->content = array_get($data, 'content');
        }
        if (array_key_exists('hot', $data)) {
            $goods->hot = array_get($data, 'hot');
        }
        if (array_key_exists('f_attribute_id', $data)) {
            $goods->f_attribute_id = array_get($data, 'f_attribute_id');
        }
        if (array_key_exists('s_attribute_id', $data)) {
            $goods->s_attribute_id = array_get($data, 's_attribute_id');
        }
        if (array_key_exists('seo_title', $data)) {
            $goods->seo_title = array_get($data, 'seo_title');
        }
        if (array_key_exists('seo_keywords', $data)) {
            $goods->seo_keywords = array_get($data, 'seo_keywords');
        }
        if (array_key_exists('seo_description', $data)) {
            $goods->seo_description = array_get($data, 'seo_description');
        }
        if (array_key_exists('sort', $data)) {
            $goods->sort = array_get($data, 'sort');
        }
        return $goods;
    }

    /*
     * 根据goods_id获取商品详情
     *
     * By zm
     *
     * 2018-01-29
     *
     */
    public static function getGoodsDetailByGoodsId($goods_id){
        $dtails=GoodsDetailModel::where('goods_id',$goods_id)->orderBy('sort','asc')->get();
        return $dtails;
    }

    /*
     * 根据id获取商品详情
     *
     * By zm
     *
     * 2018-01-29
     *
     */
    public static function getGoodsDetailById($id){
        $dtail=GoodsDetailModel::where('id',$id)->first();
        return $dtail;
    }

    /*
     * 配置商品详情的参数
     *
     * By zm
     *
     * 2018-01-29
     *
     */
    public static function setGoodsDetail($goods_detail, $data){
        if (array_key_exists('goods_id', $data)) {
            $goods_detail->goods_id = array_get($data, 'goods_id');
        }
        if (array_key_exists('content', $data)) {
            $goods_detail->content = array_get($data, 'content');
        }
        if (array_key_exists('type', $data)) {
            $goods_detail->type = array_get($data, 'type');
        }
        if (array_key_exists('sort', $data)) {
            $goods_detail->sort = array_get($data, 'sort');
        }
        return $goods_detail;
    }
}