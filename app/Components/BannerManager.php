<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/1/19
 * Time: 14:37
 */

namespace App\Components;

use App\Models\BannerModel;

class BannerManager
{

    /*
     * 模糊查询Banner列表
     *
     * By zm
     *
     * 2018-01-26
     *
     */
    public static function getAllBannerLists($search)
    {
        $banners = BannerModel::where('name'  , 'like', '%'.$search.'%')->orderBy('sort','desc')->get();
        foreach ($banners as $banner){
            $menu=MenuManager::getMenuById($banner['menu_id']);
            $banner['menu_name']=$menu['name'];
        }
        return $banners;
    }

    /*
     * 配置Banner的参数
     *
     * By zm
     *
     * 2018-01-26
     *
     */
    public static function setBanner($banner, $data){
        if (array_key_exists('name', $data)) {
            $banner->name = array_get($data, 'name');
        }
        if (array_key_exists('picture', $data)) {
            $banner->picture = array_get($data, 'picture');
        }
        if (array_key_exists('sort', $data)) {
            $banner->sort = array_get($data, 'sort');
        }
        if (array_key_exists('link', $data)) {
            $banner->link = array_get($data, 'link');
        }
        if (array_key_exists('menu_id', $data)) {
            $banner->menu_id = array_get($data, 'menu_id');
        }
        if (array_key_exists('status', $data)) {
            $banner->status = array_get($data, 'status');
        }
        return $banner;
    }

    /*
     * 通过id获得Banner
     *
     * By zm
     *
     * 2018-01-26
     *
     */
    public static function getBannerById($id){
        $banner=BannerModel::where('id',$id)->first();
        return $banner;
    }
    
}