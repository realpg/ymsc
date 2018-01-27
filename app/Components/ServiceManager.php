<?php
/**
 * Created by PhpStorm.
 * User: Serviceistrator
 * Date: 2018/1/27
 * Time: 15:11
 */

namespace App\Components;

use App\Models\ServiceModel;

class ServiceManager
{
    /*
     * 配置客服参数
     *
     * By zm
     *
     * 2018-01-27
     */
    public static function setService($service, $data)
    {
        if (array_key_exists('name', $data)) {
            $service->name = array_get($data, 'name');
        }
        if (array_key_exists('phonenum', $data)) {
            $service->phonenum = array_get($data, 'phonenum');
        }
        if (array_key_exists('qq', $data)) {
            $service->qq = array_get($data, 'qq');
        }
        return $service;
    }
    
    /*
     * 根据id获取客服信息
     *
     * By zm
     *
     * 2018-01-27
     */
    public static function getServiceById($id)
    {
        $service = ServiceModel::find($id);
        return $service;
    }

    /*
     * 查找客服
     *
     * By zm
     *
     * 2018-01-27
     */
    public static function getAllServiceLists($search)
    {
        $services = ServiceModel::where(function ($services) use ($search) {
            $services->where('name'  , 'like', '%'.$search.'%')
                ->orwhere('qq', 'like', '%'.$search.'%')
                ->orwhere('phonenum', 'like', '%'.$search.'%');
        })->orderBy('id','asc')->get();
        return $services;
    }
}