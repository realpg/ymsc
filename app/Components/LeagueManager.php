<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/1/26
 * Time: 16:49
 */

namespace App\Components;

use App\Models\LeagueModel;

class LeagueManager
{
    /*
     * 根据条件搜索信息
     *
     * by zm
     *
     * 2018-01-26
     */
    public static function getAllLeagueLists($search){
//        $leagues = LeagueModel::where('name','like','%'.$search.'%')->orderBy('id','desc')->get();
        $leagues = LeagueModel::where(function ($leagues) use ($search) {
            $leagues->where('name'  , 'like', '%'.$search.'%')
                ->orwhere('phonenum', 'like', '%'.$search.'%');
        })->orderBy('id','asc')->get();
        return $leagues;
    }

    /*
     * 根据id获取信息详情
     *
     * by zm
     *
     * 2018-01-26
     */
    public static function getLeagueInfoById($id){
        $league = LeagueModel::find($id);
        return $league;
    }

    /*
     * 标记已联系
     *
     * by zm
     *
     * 2018-01-26
     */
    public static function stampLeagueInfoStatus($data){
        $league=LeagueModel::find($data['id']);
        $data['status']=1;
        $league=self::setLeague($league,$data);
        $result=$league->save();
        return $result;
    }

    /*
     * 配置加盟信息的参数
     *
     * By zm
     *
     * 2018-01-26
     *
     */
    public static function setLeague($league, $data){
        if (array_key_exists('name', $data)) {
            $league->name = array_get($data, 'name');
        }
        if (array_key_exists('phonenum', $data)) {
            $league->phonenum = array_get($data, 'phonenum');
        }
        if (array_key_exists('email', $data)) {
            $league->email = array_get($data, 'email');
        }
        if (array_key_exists('content', $data)) {
            $league->content = array_get($data, 'content');
        }
        if (array_key_exists('status', $data)) {
            $league->status = array_get($data, 'status');
        }
        return $league;
    }

    /*
     * whereIn查找信息
     *
     * By zm
     *
     * 2018-01-27
     *
     */
    public static function getLeagueByMoreId($data){
        $leagues=LeagueModel::whereIn('id',$data)->get();
        return $leagues;
    }
}