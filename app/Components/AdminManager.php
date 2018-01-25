<?php

/**
 * Created by PhpStorm.
 * admin: HappyQi
 * Date: 2017/9/28
 * Time: 10:30
 */

namespace App\Components;


use App\Models\AdminModel;
use Qiniu\Auth;

class AdminManager
{

    /*
     * 设置管理员信息，用于编辑
     *
     * By zm
     *
     * 2018-01-25
     */
    public static function setAdmin($admin, $data)
    {
        if (array_key_exists('name', $data)) {
            $admin->name = array_get($data, 'name');
        }
        if (array_key_exists('password', $data)) {
            $admin->password = array_get($data, 'password');
        }
        if (array_key_exists('phonenum', $data)) {
            $admin->phonenum = array_get($data, 'phonenum');
        }
        if (array_key_exists('avatar', $data)) {
            $admin->avatar = array_get($data, 'avatar');
        }
        return $admin;
    }

    /*
     * 后台登录
     *
     * By zm
     *
     * 2018-01-25
     */
    public static function login($phonenum){
        $admin=AdminModel::where('phonenum',$phonenum)->first();
        return $admin;
    }

    /*
     * 查询电话号码
     *
     * By zm
     *
     * 2018-01-25
     */
    public static function getAdminByTel($phonenum){
        $admin=AdminModel::where('phonenum',$phonenum)->first();
        if($admin){
            unset($admin['password']);
        }
        return $admin;
    }
}