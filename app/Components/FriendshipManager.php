<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/3/18
 * Time: 15:54
 */

namespace App\Components;


use App\Models\FriendshipModel;

class FriendshipManager
{
    /*
     * 模糊查询友情链接列表
     *
     * By zm
     *
     * 2018-01-26
     *
     */
    public static function getAllFriendshipLists($search)
    {
        $friendships = FriendshipModel::where('name'  , 'like', '%'.$search.'%')->orderBy('sort','desc')->get();
        return $friendships;
    }

    /*
     * 配置友情链接的参数
     *
     * By zm
     *
     * 2018-01-26
     *
     */
    public static function setFriendship($friendship, $data){
        if (array_key_exists('name', $data)) {
            $friendship->name = array_get($data, 'name');
        }
        if (array_key_exists('picture', $data)) {
            $friendship->picture = array_get($data, 'picture');
        }
        if (array_key_exists('sort', $data)) {
            $friendship->sort = array_get($data, 'sort');
        }
        if (array_key_exists('link', $data)) {
            $friendship->link = array_get($data, 'link');
        }
        return $friendship;
    }

    /*
     * 通过id获得友情链接
     *
     * By zm
     *
     * 2018-01-26
     *
     */
    public static function getFriendshipById($id){
        $friendship=FriendshipModel::where('id',$id)->first();
        return $friendship;
    }
}