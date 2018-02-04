<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/2/2
 * Time: 17:53
 */

namespace app\Components;

use App\Models\UserModel;

class MemberManager
{
    /*
     * 配置用户信息，用于更新用户信息和新建用户信息
     *
     * By zm
     *
     * 2018-02-02
     *
     */
    public static function setUser($user, $data)
    {
        if (array_key_exists('nick_name', $data)) {
            $user->nick_name = array_get($data, 'nick_name');
        }
        if (array_key_exists('real_name', $data)) {
            $user->real_name = array_get($data, 'real_name');
        }
        if (array_key_exists('password', $data)) {
            $user->password = array_get($data, 'password');
        }
        if (array_key_exists('xcx_openid', $data)) {
            $user->xcx_openid = array_get($data, 'xcx_openid');
        }
        if (array_key_exists('app_openid', $data)) {
            $user->app_openid = array_get($data, 'app_openid');
        }
        if (array_key_exists('fwh_openid', $data)) {
            $user->fwh_openid = array_get($data, 'fwh_openid');
        }
        if (array_key_exists('web_openid', $data)) {
            $user->web_openid = array_get($data, 'web_openid');
        }
        if (array_key_exists('unionid', $data)) {
            $user->unionid = array_get($data, 'unionid');
        }
        if (array_key_exists('token', $data)) {
            $user->token = array_get($data, 'token');
        }
        if (array_key_exists('phonenum', $data)) {
            $user->phonenum = array_get($data, 'phonenum');
        }
        if (array_key_exists('email', $data)) {
            $user->email = array_get($data, 'email');
        }
        if (array_key_exists('avatar', $data)) {
            $user->avatar = array_get($data, 'avatar');
        }
        if (array_key_exists('gender', $data)) {
            $user->gender = array_get($data, 'gender');
        }
        if (array_key_exists('qq', $data)) {
            $user->qq = array_get($data, 'qq');
        }
        if (array_key_exists('wechat', $data)) {
            $user->wechat = array_get($data, 'wechat');
        }
        if (array_key_exists('score', $data)) {
            $user->score = array_get($data, 'score');
        }
        return $user;
    }

    /*
     * 更新用户信息
     *
     * By TerryQi
     *
     * 2017-09-28
     *
     */
    public static function updateUser($data)
    {
        //配置用户信息
        $user = self::getUserInfoByIdWithToken($data['id']);
        $user = self::setUser($user, $data);
        $user->save();
        return $user;
    }

    /*
     * 根据id获取用户信息，带token
     *
     * By zm
     *
     * 2018-02-02
     */
    public static function getUserInfoByIdWithToken($id)
    {
        $user = UserModel::find($id);
        return $user;
    }


    /*
     * 根据user_code和token校验合法性，全部插入、更新、删除类操作需要使用中间件
     *
     * By zm
     *
     * 2018-02-02
     *
     * 返回值
     *
     */
    public static function ckeckToken($id, $token)
    {
        //根据id、token获取用户信息
        $count = UserModel::where('id', $id)->where('token', $token)->count();
        if ($count > 0) {
            return true;
        } else {
            return false;
        }
    }

    /*
     * 注册用户（停用）
     *
     * By zm
     *
     * 2018-02-02
     *
     */
    public static function register($data)
    {
        $return=null;
        //判断此用户是否注册过
        if(array_key_exists('phonenum',$data)){
            $users=self::getUserInfoByPhonenum($data['phonenum']);
            if($users){
                $return['result']='false';
                $return['msg']='此用户已注册';
            }
            else{
                //创建用户信息
                $user = new UserModel();
                $user = self::setUser($user, $data);
                $user->token = self::getGUID();
                $result=$user->save();
                if($result){
                    $return['result']='true';
                    $return['msg']='注册成功';
                }
                else{
                    $return['result']='false';
                    $return['msg']='注册失败';
                }
            }
        }
        else if(array_key_exists('email',$data)){
            $users=self::getUserInfoByEmail($data['email']);
            if($users){
                $return['result']='false';
                $return['msg']='此用户已注册';
            }
            else{
                //创建用户信息
                $user = new UserModel();
                $user = self::setUser($user, $data);
                $user->token = self::getGUID();
                $result=$user->save();
                if($result){
                    $return['result']='true';
                    $return['msg']='注册成功';
                }
                else{
                    $return['result']='false';
                    $return['msg']='注册失败';
                }
            }
        }
        else{
            $return['result']='false';
            $return['msg']='非法操作';
        }
        return $return;
    }

    /*
     * 登录
     *
     * By zm
     *
     * 2018-02-02
     *
     */
    public static function login($data){
        $name=$data['phonenum'];
        $password=$data['password'];
        $user=UserModel::where('password',$password)->where(function($user) use ($name){
            $user->where('phonenum','like','%'.$name.'%')
                ->orwhere('email','like','%'.$name.'%');
        })->first();
        return $user;
    }

    /*
     * 根据phonenum查找
     *
     * By zm
     *
     * 2018-02-02
     */
    public static function getUserInfoByPhonenum($phonenum)
    {
        $user = UserModel::where('phonenum',$phonenum)->first();
        return $user;
    }

    /*
     * 根据email查找
     *
     * By zm
     *
     * 2018-02-02
     */
    public static function getUserInfoByEmail($email)
    {
        $user = UserModel::where('email',$email)->first();
        return $user;
    }

    // 生成guid
    /*
     * 生成uuid全部用户相同，uuid即为token
     *
     */
    public static function getGUID()
    {
        if (function_exists('com_create_guid')) {
            return com_create_guid();
        } else {
            mt_srand((double)microtime() * 10000);//optional for php 4.2.0 and up.
            $charid = strtoupper(md5(uniqid(rand(), true)));

            $uuid = substr($charid, 0, 8)
                . substr($charid, 8, 4)
                . substr($charid, 12, 4)
                . substr($charid, 16, 4)
                . substr($charid, 20, 12);
            return $uuid;
        }
    }
}