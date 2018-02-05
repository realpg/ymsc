<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/1/27
 * Time: 14:25
 */

namespace App\Components;

use App\Models\SearchingModel;

class SearchingManager
{
    /*
     * 根据条件搜索信息
     *
     * by zm
     *
     * 2018-01-27
     */
    public static function getAllSearchingLists($search){
        $searchings = SearchingModel::where(function ($searchings) use ($search) {
            $searchings->where('goods'  , 'like', '%'.$search.'%')
                ->orwhere('name'  , 'like', '%'.$search.'%')
                ->orwhere('phonenum', 'like', '%'.$search.'%');
        })->orderBy('id','asc')->get();
        return $searchings;
    }

    /*
     * 根据id获取信息详情
     *
     * by zm
     *
     * 2018-01-27
     */
    public static function getSearchingInfoById($id){
        $searching = SearchingModel::find($id);
        return $searching;
    }

    /*
     * 标记已联系
     *
     * by zm
     *
     * 2018-01-27
     */
    public static function stampSearchingInfoStatus($data){
        $searching=SearchingModel::find($data['id']);
        $data['status']=1;
        $searching=self::setSearching($searching,$data);
        $result=$searching->save();
        return $result;
    }

    /*
     * 配置帮你找货信息的参数
     *
     * By zm
     *
     * 2018-01-27
     *
     */
    public static function setSearching($banner, $data){
        if (array_key_exists('goods', $data)) {
            $banner->goods = array_get($data, 'goods');
        }
        if (array_key_exists('count', $data)) {
            $banner->count = array_get($data, 'count');
        }
        if (array_key_exists('count', $data)) {
            $banner->count = array_get($data, 'count');
        }
        if (array_key_exists('unit', $data)) {
            $banner->unit = array_get($data, 'unit');
        }
        if (array_key_exists('purity', $data)) {
            $banner->purity = array_get($data, 'purity');
        }
        if (array_key_exists('name', $data)) {
            $banner->name = array_get($data, 'name');
        }
        if (array_key_exists('phonenum', $data)) {
            $banner->phonenum = array_get($data, 'phonenum');
        }
        if (array_key_exists('time', $data)) {
            $banner->time = array_get($data, 'time');
        }
        if (array_key_exists('province', $data)) {
            $banner->province = array_get($data, 'province');
        }
        if (array_key_exists('city', $data)) {
            $banner->city = array_get($data, 'city');
        }
        if (array_key_exists('address', $data)) {
            $banner->address = array_get($data, 'address');
        }
        if (array_key_exists('content', $data)) {
            $banner->content = array_get($data, 'content');
        }
        if (array_key_exists('status', $data)) {
            $banner->status = array_get($data, 'status');
        }
        return $banner;
    }

    /*
     * whereIn查找信息
     *
     * By zm
     *
     * 2018-01-27
     *
     */
    public static function getSearchingByMoreId($data){
        $searchings=SearchingModel::whereIn('id',$data)->get();
        return $searchings;
    }
}