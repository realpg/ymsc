<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/1/27
 * Time: 13:58
 */

namespace App\Components;

use App\Models\AdviceModel;

class AdviceManager
{
    /*
     * 根据条件搜索信息
     *
     * by zm
     *
     * 2018-01-27
     */
    public static function getAllAdviceLists($search){
        $advices = AdviceModel::where(function ($advices) use ($search) {
            $advices->where('name'  , 'like', '%'.$search.'%')
                ->orwhere('phonenum', 'like', '%'.$search.'%');
        })->orderBy('id','asc')->get();
        return $advices;
    }

    /*
     * 根据id获取信息详情
     *
     * by zm
     *
     * 2018-01-27
     */
    public static function getAdviceInfoById($id){
        $advice = AdviceModel::find($id);
        return $advice;
    }

    /*
     * 标记已联系
     *
     * by zm
     *
     * 2018-01-27
     */
    public static function stampAdviceInfoStatus($data){
        $advice=AdviceModel::find($data['id']);
        $data['status']=1;
        $advice=self::setAdvice($advice,$data);
        $result=$advice->save();
        return $result;
    }

    /*
     * 配置投诉信息的参数
     *
     * By zm
     *
     * 2018-01-27
     *
     */
    public static function setAdvice($banner, $data){
        if (array_key_exists('name', $data)) {
            $banner->name = array_get($data, 'name');
        }
        if (array_key_exists('phonenum', $data)) {
            $banner->phonenum = array_get($data, 'phonenum');
        }
        if (array_key_exists('email', $data)) {
            $banner->email = array_get($data, 'email');
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
    public static function getAdviceByMoreId($data){
        $advices=AdviceModel::whereIn('id',$data)->get();
        return $advices;
    }
}