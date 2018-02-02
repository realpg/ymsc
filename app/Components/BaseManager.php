<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/1/26
 * Time: 13:53
 */

namespace App\Components;


use App\Models\BaseModel;

class BaseManager
{
    /*
     * 获取网站基本设置
     *
     * By zm
     *
     * 2018-01-26
     *
     */
    public static function getBaseInfo(){
        $base=BaseModel::where('id',1)->first();
        return $base;
    }

    /*
     * 配置网站基本设置参数
     *
     * By zm
     *
     * 2018-01-26
     *
     */
    public static function setBase($banner, $data){
        if (array_key_exists('name', $data)) {
            $banner->name = array_get($data, 'name');
        }
        if (array_key_exists('logo', $data)) {
            $banner->logo = array_get($data, 'logo');
        }
        if (array_key_exists('phonenum', $data)) {
            $banner->phonenum = array_get($data, 'phonenum');
        }
        if (array_key_exists('email', $data)) {
            $banner->email = array_get($data, 'email');
        }
        if (array_key_exists('qq', $data)) {
            $banner->qq = array_get($data, 'qq');
        }
        if (array_key_exists('address', $data)) {
            $banner->address = array_get($data, 'address');
        }
        if (array_key_exists('time', $data)) {
            $banner->time = array_get($data, 'time');
        }
        if (array_key_exists('copyright', $data)) {
            $banner->copyright = array_get($data, 'copyright');
        }
        if (array_key_exists('number', $data)) {
            $banner->number = array_get($data, 'number');
        }
        if (array_key_exists('content', $data)) {
            $banner->content = array_get($data, 'content');
        }
        if (array_key_exists('picture', $data)) {
            $banner->picture = array_get($data, 'picture');
        }
        if (array_key_exists('seo_title', $data)) {
            $banner->seo_title = array_get($data, 'seo_title');
        }
        if (array_key_exists('seo_keywords', $data)) {
            $banner->seo_keywords = array_get($data, 'seo_keywords');
        }
        if (array_key_exists('seo_description', $data)) {
            $banner->seo_description = array_get($data, 'seo_description');
        }
        return $banner;
    }
}