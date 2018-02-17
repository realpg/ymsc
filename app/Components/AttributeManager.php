<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/1/28
 * Time: 9:53
 */

namespace App\Components;

use App\Models\AttributeModel;

class AttributeManager
{
    /*
     * 获取一级搜索属性列表
     *
     * By zm
     *
     * 2018-01-28
     *
     */
    public static function getClassAAttributeLists($menu_id)
    {
        $where=array(
            'menu_id'=>$menu_id,
            'attribute_id'=>0
        );
        $attributes = AttributeModel::where($where)->orderBy('sort','desc')->get();
        return $attributes;
    }

    /*
     * 根据id获得搜索的详细信息
     *
     * By zm
     *
     * 2018-01-28
     *
     */
    public static function getAttributeById($id)
    {
        $attribute = AttributeModel::find($id);
        return $attribute;
    }

    /*
     * 根据menu_id获取所有搜索属性
     *
     * By zm
     *
     * 2018-01-28
     *
     */
    public static function getAllAttributeByMenuId($search,$menu_id)
    {
        $attributes=AttributeModel::where('menu_id',$menu_id)->where('name','like','%'.$search.'%')->orderBy('sort','desc')->get();
        foreach ($attributes as $attribute){
            if($attribute['attribute_id']!=0){
                $attribute['attribute_father']=self::getAttributeById($attribute['attribute_id']);
            }
        }
        return $attributes;
    }

    /*
     * 配置搜索属性的参数
     *
     * By zm
     *
     * 2018-01-28
     *
     */
    public static function setAttribute($attribute, $data){
        if (array_key_exists('name', $data)) {
            $attribute->name = array_get($data, 'name');
        }
        if (array_key_exists('menu_id', $data)) {
            $attribute->menu_id = array_get($data, 'menu_id');
        }
        if (array_key_exists('attribute_id', $data)) {
            $attribute->attribute_id = array_get($data, 'attribute_id');
        }
        if (array_key_exists('sort', $data)) {
            $attribute->sort = array_get($data, 'sort');
        }
        return $attribute;
    }

    /*
     * 根据attribute_id获取二级搜索属性
     *
     * By zm
     *
     * 2018-01-28
     *
     */
    public static function getAttributeByAttributeId($attribute_id)
    {
        $attributes=AttributeModel::where('attribute_id',$attribute_id)->orderBy('sort','desc')->get();
        return $attributes;
    }

    /*
     * 根据一级栏目获取搜索属性列表
     *
     * By zm
     *
     * 2018-02-17
     *
     */
    public static function getClassAAttributeListsByMenuId($menu_id)
    {
        $where=array(
            'menu_id'=>$menu_id,
            'attribute_id'=>0
        );
        $attributes = AttributeModel::where($where)->orderBy('sort','desc')->get();
        foreach ($attributes as $attribute){
            $attribute_id=$attribute['id'];
            $attribute['attributes']=AttributeModel::where('attribute_id',$attribute_id)->orderBy('sort','desc')->get();
        }
        return $attributes;
    }
}