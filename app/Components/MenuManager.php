<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/1/26
 * Time: 10:36
 */

namespace App\Components;

use App\Models\MenuModel;

class MenuManager
{
    /*
     * 获取一级栏目
     *
     * By zm
     *
     * 2018-01-26
     *
     */
    public static function getClassAMenuLists()
    {
        $menus = MenuModel::where('menu_id',0)->orderBy('sort','asc')->get();
        return $menus;
    }

    /*
     * 根据id获得栏目的详细信息
     *
     * By zm
     *
     * 2018-01-26
     *
     */
    public static function getMenuById($id)
    {
        $menu = MenuModel::find($id);
        return $menu;
    }

}