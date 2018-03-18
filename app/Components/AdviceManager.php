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
    public static function setAdvice($advice, $data){
        if (array_key_exists('type', $data)) {
            $advice->type = array_get($data, 'type');
        }
        if (array_key_exists('name', $data)) {
            $advice->name = array_get($data, 'name');
        }
        if (array_key_exists('phonenum', $data)) {
            $advice->phonenum = array_get($data, 'phonenum');
        }
        if (array_key_exists('content', $data)) {
            $advice->content = array_get($data, 'content');
        }
        if (array_key_exists('status', $data)) {
            $advice->status = array_get($data, 'status');
        }
        return $advice;
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

    /*
     * 根据状态查询信息
     *
     * By zm
     *
     * 2018-03-18
     *
     */
    public static function getAdvicesByStatus($status){
        $advices=AdviceModel::where('status',$status)->get();
        return $advices;
    }
}