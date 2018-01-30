<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/1/28
 * Time: 10:28
 */

namespace App\Components;

use App\Models\ChemClassModel;
use App\Models\GoodsChemAttributeModel;
use App\Models\GoodsDetailModel;
use App\Models\GoodsModel;
use App\Models\GoodsTestingAttributeModel;

class GoodsManager
{
    /*
     * 按menu_id获取商品
     *
     * By zm
     *
     * 2018-01-28
     *
     */
    public static function getAllGoodsByMenuId($menu_id)
    {
        $goodses=GoodsModel::where('menu_id',$menu_id)->orderBy('sort','desc')->get();
        return $goodses;
    }

    /*
     * 通过模糊搜索获取商品
     *
     * By zm
     *
     * 2018-01-28
     *
     */
    public static function getAllGoodsListsByMenuId($search ,$menu_id )
    {
        //判断menu_id是否为一级栏目
        $menu=MenuManager::getMenuById($menu_id);
        if($menu['menu_id']){
            $goodses = GoodsModel::where('menu_id',$menu_id)->where(function ($goodses) use ($search) {
                $goodses->where('name'  , 'like', '%'.$search.'%')
                    ->orwhere('number', 'like', '%'.$search.'%');
            })->orderBy('sort','desc')->get();
        }
        else{
            $menus=MenuManager::getAllMenuListsByMenuId($menu_id);
            $menu_id_array=null;
            foreach ($menus as $k=>$menu){
                $menu_id_array[$k]=$menu['id'];
            }
            $goodses = GoodsModel::whereIn('menu_id',$menu_id_array)->where(function ($goodses) use ($search) {
                $goodses->where('name'  , 'like', '%'.$search.'%')
                    ->orwhere('number', 'like', '%'.$search.'%');
            })->orderBy('sort','desc')->get();
        }
        foreach ($goodses as $goods){
            $menu_id=$goods['menu_id'];
            $goods['menu']=MenuManager::getMenuById($menu_id);
        }
        return $goodses;
    }

    /*
     * whereIn查找信息
     *
     * By zm
     *
     * 2018-01-28
     *
     */
    public static function getGoodsByMoreId($data){
        $goodses=GoodsModel::whereIn('id',$data)->get();
        return $goodses;
    }

    /*
     * 根据id获得商品
     *
     * By zm
     *
     * 2018-01-28
     *
     */
    public static function getGoodsById($id){
        $goods=GoodsModel::where('id',$id)->first();
        return $goods;
    }

    /*
     * 配置商品的参数
     *
     * By zm
     *
     * 2018-01-29
     *
     */
    public static function setGoods($goods, $data){
        if (array_key_exists('menu_id', $data)) {
            $goods->menu_id = array_get($data, 'menu_id');
        }
        if (array_key_exists('number', $data)) {
            $goods->number = array_get($data, 'number');
        }
        if (array_key_exists('name', $data)) {
            $goods->name = array_get($data, 'name');
        }
        if (array_key_exists('picture', $data)) {
            $goods->picture = array_get($data, 'picture');
        }
        if (array_key_exists('drimecost', $data)) {
            $goods->drimecost = array_get($data, 'drimecost');
        }
        if (array_key_exists('price', $data)) {
            $goods->price = array_get($data, 'price');
        }
        if (array_key_exists('unit', $data)) {
            $goods->unit = array_get($data, 'unit');
        }
        if (array_key_exists('content', $data)) {
            $goods->content = array_get($data, 'content');
        }
        if (array_key_exists('hot', $data)) {
            $goods->hot = array_get($data, 'hot');
        }
        if (array_key_exists('f_attribute_id', $data)) {
            $goods->f_attribute_id = array_get($data, 'f_attribute_id');
        }
        if (array_key_exists('s_attribute_id', $data)) {
            $goods->s_attribute_id = array_get($data, 's_attribute_id');
        }
        if (array_key_exists('seo_title', $data)) {
            $goods->seo_title = array_get($data, 'seo_title');
        }
        if (array_key_exists('seo_keywords', $data)) {
            $goods->seo_keywords = array_get($data, 'seo_keywords');
        }
        if (array_key_exists('seo_description', $data)) {
            $goods->seo_description = array_get($data, 'seo_description');
        }
        if (array_key_exists('sort', $data)) {
            $goods->sort = array_get($data, 'sort');
        }
        return $goods;
    }

    /*
     * 根据goods_id获取商品详情
     *
     * By zm
     *
     * 2018-01-29
     *
     */
    public static function getGoodsDetailByGoodsId($goods_id){
        $dtails=GoodsDetailModel::where('goods_id',$goods_id)->orderBy('sort','asc')->get();
        return $dtails;
    }

    /*
     * 根据id获取商品详情
     *
     * By zm
     *
     * 2018-01-29
     *
     */
    public static function getGoodsDetailById($id){
        $dtail=GoodsDetailModel::where('id',$id)->first();
        return $dtail;
    }

    /*
     * 配置商品详情的参数
     *
     * By zm
     *
     * 2018-01-29
     *
     */
    public static function setGoodsDetail($goods_detail, $data){
        if (array_key_exists('goods_id', $data)) {
            $goods_detail->goods_id = array_get($data, 'goods_id');
        }
        if (array_key_exists('content', $data)) {
            $goods_detail->content = array_get($data, 'content');
        }
        if (array_key_exists('type', $data)) {
            $goods_detail->type = array_get($data, 'type');
        }
        if (array_key_exists('sort', $data)) {
            $goods_detail->sort = array_get($data, 'sort');
        }
        return $goods_detail;
    }

    /*
     * 配置第三方检测商品属性的参数
     *
     * By zm
     *
     * 2018-01-29
     *
     */
    public static function setGoodsTestingAttribute($goods_testing_attribute, $data){
        if (array_key_exists('goods_id', $data)) {
            $goods_testing_attribute->goods_id = array_get($data, 'goods_id');
        }
        if (array_key_exists('lab', $data)) {
            $goods_testing_attribute->lab = array_get($data, 'lab');
        }
        if (array_key_exists('contacts', $data)) {
            $goods_testing_attribute->contacts = array_get($data, 'contacts');
        }
        if (array_key_exists('address', $data)) {
            $goods_testing_attribute->address = array_get($data, 'address');
        }
        return $goods_testing_attribute;
    }

    /*
     * 根据id获取第三方检测商品属性
     *
     * By zm
     *
     * 2018-01-29
     *
     */
    public static function getGoodsTestingAttributeById($id){
        $goods_testing_attribute=GoodsTestingAttributeModel::where('id',$id)->first();
        return $goods_testing_attribute;
    }

    /*
     * 根据goods_id获取第三方检测商品属性
     *
     * By zm
     *
     * 2018-01-29
     *
     */
    public static function getGoodsTestingAttributeByGoodsId($goods_id){
        $goods_testing_attribute=GoodsTestingAttributeModel::where('goods_id',$goods_id)->first();
        return $goods_testing_attribute;
    }

    /*
     * 通过模糊搜索获取化学商品大类的列表
     *
     * By zm
     *
     * 2018-01-30
     *
     */
    public static function getAllChemClassesByMenuId($search ,$menu_id )
    {
        //判断menu_id是否为一级栏目
        $menu=MenuManager::getMenuById($menu_id);
        if($menu['menu_id']){
            $chem_classes = ChemClassModel::where('menu_id',$menu_id)->where(function ($chem_classes) use ($search) {
                $chem_classes->where('name'  , 'like', '%'.$search.'%')
                    ->orwhere('sub_name', 'like', '%'.$search.'%')
                    ->orwhere('english_name', 'like', '%'.$search.'%')
                    ->orwhere('cas', 'like', '%'.$search.'%');
            })->orderBy('sort','desc')->get();
        }
        else{
            $menus=MenuManager::getAllMenuListsByMenuId($menu_id);
            $menu_id_array=null;
            foreach ($menus as $k=>$menu){
                $menu_id_array[$k]=$menu['id'];
            }
            $chem_classes = ChemClassModel::whereIn('menu_id',$menu_id_array)->where(function ($chem_classes) use ($search) {
                $chem_classes->where('name'  , 'like', '%'.$search.'%')
                    ->orwhere('english_name', 'like', '%'.$search.'%')
                    ->orwhere('cas', 'like', '%'.$search.'%');
            })->orderBy('sort','desc')->get();
        }
        foreach ($chem_classes as $chem_class){
            $menu_id=$chem_class['menu_id'];
            $chem_class['menu']=MenuManager::getMenuById($menu_id);
        }
        return $chem_classes;
    }

    /*
     * 按chem_class_id查找化学商品
     *
     * By zm
     *
     * 2018-01-30
     *
     */
    public static function getAllChemGoodsByChemClassId($chem_class_id ){
        $chem_attributes=GoodsChemAttributeModel::where('chem_class_id',$chem_class_id)->get();
        $goodses=array();
        foreach ($chem_attributes as $k=>$chem_attribute){
            $goods_id=$chem_attribute['goods_id'];
            $goods=GoodsModel::find($goods_id);
            $goods['attribute']=$chem_attribute;
            array_push($goodses,$goods);
        }
        return $goodses;
    }

    /*
     * 按chem_class_id模糊查找化学商品
     *
     * By zm
     *
     * 2018-01-30
     *
     */
    public static function getAllChemGoodsListsByChemClassId($search,$chem_class_id){
        $get=array(
            'goods_info.id as id',
            'goods_info.menu_id as menu_id',
            'goods_info.name as name',
            'goods_info.number as number',
            'goods_info.price as price',
            'goods_info.unit as unit',
            'f_attribute.name as brand',
            's_attribute.name as purity',
            'goods_chem_attribute_info.chem_class_id as chem_class_id',
            'goods_chem_attribute_info.spec as spec',
            'goods_chem_attribute_info.delivery as delivery',
            'menu_info.name as menu',
            'goods_info.updated_at as updated_at',
        );
        $goodses=GoodsChemAttributeModel::join('chem_class_info','chem_class_info.id','=','goods_chem_attribute_info.chem_class_id')
            ->join('goods_info','goods_info.id','=','goods_chem_attribute_info.goods_id')
            ->join('menu_info','menu_info.id','=','chem_class_info.menu_id')
            ->join('attribute_info as f_attribute','f_attribute.id','=','goods_info.f_attribute_id')
            ->join('attribute_info as s_attribute','s_attribute.id','=','goods_info.s_attribute_id')
            ->where('goods_chem_attribute_info.chem_class_id',$chem_class_id)
            ->where(function ($goodses) use ($search) {
                $goodses->where('goods_info.number'  , 'like', '%'.$search.'%');
            })
            ->orderBy('goods_info.sort','desc')
            ->get($get);
        return $goodses;
    }

    /*
     * 按chem_class_id查找化学商品大类
     *
     * By zm
     *
     * 2018-01-30
     *
     */
    public static function getAllChemClassByChemClassId($chem_class_id ){
        $chem_class=ChemClassModel::find($chem_class_id);
        return $chem_class;
    }

    /*
     * 配置化学商品大类的参数
     *
     * By zm
     *
     * 2018-01-30
     *
     */
    public static function setChemClass($chem_class, $data){
        if (array_key_exists('menu_id', $data)) {
            $chem_class->menu_id = array_get($data, 'menu_id');
        }
        if (array_key_exists('name', $data)) {
            $chem_class->name = array_get($data, 'name');
        }
        if (array_key_exists('sub_name', $data)) {
            $chem_class->sub_name = array_get($data, 'sub_name');
        }
        if (array_key_exists('english_name', $data)) {
            $chem_class->english_name = array_get($data, 'english_name');
        }
        if (array_key_exists('picture', $data)) {
            $chem_class->picture = array_get($data, 'picture');
        }
        if (array_key_exists('cas', $data)) {
            $chem_class->cas = array_get($data, 'cas');
        }
        if (array_key_exists('molecule', $data)) {
            $chem_class->molecule = array_get($data, 'molecule');
        }
        if (array_key_exists('hot', $data)) {
            $chem_class->hot = array_get($data, 'hot');
        }
        if (array_key_exists('sort', $data)) {
            $chem_class->sort = array_get($data, 'sort');
        }
        if (array_key_exists('seo_title', $data)) {
            $chem_class->seo_title = array_get($data, 'seo_title');
        }
        if (array_key_exists('seo_keywords', $data)) {
            $chem_class->seo_keywords = array_get($data, 'seo_keywords');
        }
        if (array_key_exists('seo_description', $data)) {
            $chem_class->seo_description = array_get($data, 'seo_description');
        }
        return $chem_class;
    }

    /*
     * 根据goods_id获取化学商品属性
     *
     * By zm
     *
     * 2018-01-30
     *
     */
    public static function getGoodsChemAttributeByGoodsId($goods_id){
        $goods_chem_attribute=GoodsChemAttributeModel::where('goods_id',$goods_id)->first();
        return $goods_chem_attribute;
    }

    /*
     * 配置化学商品属性的参数
     *
     * By zm
     *
     * 2018-01-29
     *
     */
    public static function setGoodsChemAttribute($goods_chem_attribute, $data){
        if (array_key_exists('goods_id', $data)) {
            $goods_chem_attribute->goods_id = array_get($data, 'goods_id');
        }
        if (array_key_exists('spec', $data)) {
            $goods_chem_attribute->spec = array_get($data, 'spec');
        }
        if (array_key_exists('delivery', $data)) {
            $goods_chem_attribute->delivery = array_get($data, 'delivery');
        }
        if (array_key_exists('depot', $data)) {
            $goods_chem_attribute->depot = array_get($data, 'depot');
        }
        if (array_key_exists('merchant', $data)) {
            $goods_chem_attribute->merchant = array_get($data, 'merchant');
        }
        if (array_key_exists('molecular', $data)) {
            $goods_chem_attribute->molecular = array_get($data, 'molecular');
        }
        if (array_key_exists('accurate', $data)) {
            $goods_chem_attribute->accurate = array_get($data, 'accurate');
        }
        if (array_key_exists('chem_class_id', $data)) {
            $goods_chem_attribute->chem_class_id = array_get($data, 'chem_class_id');
        }
        return $goods_chem_attribute;
    }
}