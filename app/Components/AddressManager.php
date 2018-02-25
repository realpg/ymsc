<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/2/25
 * Time: 18:16
 */

namespace App\Components;

use App\Models\AddressModel;

class AddressManager
{
    /*
     * 配置地址参数
     *
     * By zm
     *
     * 2018-02-25
     *
     */
    public static function setAddress($address, $data){
        if (array_key_exists('user_id', $data)) {
            $address->user_id = array_get($data, 'user_id');
        }
        if (array_key_exists('name', $data)) {
            $address->name = array_get($data, 'name');
        }
        if (array_key_exists('phonenum', $data)) {
            $address->phonenum = array_get($data, 'phonenum');
        }
        if (array_key_exists('phone', $data)) {
            $address->phone = array_get($data, 'phone');
        }
        if (array_key_exists('province', $data)) {
            $address->province = array_get($data, 'province');
        }
        if (array_key_exists('city', $data)) {
            $address->city = array_get($data, 'city');
        }
        if (array_key_exists('town', $data)) {
            $address->town = array_get($data, 'town');
        }
        if (array_key_exists('detail', $data)) {
            $address->detail = array_get($data, 'detail');
        }
        if (array_key_exists('code', $data)) {
            $address->code = array_get($data, 'code');
        }
        if (array_key_exists('status', $data)) {
            $address->status = array_get($data, 'status');
        }
        if (array_key_exists('delete', $data)) {
            $address->delete = array_get($data, 'delete');
        }
        return $address;
    }

    /*
     * 根据id获取地址
     *
     * By zm
     *
     * 2018-02-25
     *
     */
    public static function getAddressById($id){
        $address=AddressModel::where('id',$id)->first();
        return $address;
    }

    /*
     * 根据user_id和address_id获取之前的默认地址
     *
     * By zm
     *
     * 2018-02-25
     *
     */
    public static function getAddressByUserIdAndAddressId($user_id,$address_id){
        $addresses=AddressModel::where('user_id',$user_id)->where('status',1)->whereNotIn('id',[$address_id])->get();
        return $addresses;
    }

    /*
     * 根据user_id获取地址列表
     *
     * By zm
     *
     * 2018-02-25
     *
     */
    public static function getAddressListsByUserId($user_id){
        $addresses=AddressModel::where('delete',0)->where('user_id',$user_id)->orderBy('id','asc')->get();
        return $addresses;
    }
}