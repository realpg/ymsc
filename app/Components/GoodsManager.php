<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/1/28
 * Time: 10:28
 */

namespace App\Components;

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
}