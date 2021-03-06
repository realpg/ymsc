<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/1/28
 * Time: 10:28
 */

namespace App\Components;

use App\Http\Controllers\Home\ChemController;
use App\Http\Controllers\Home\MachiningController;
use App\Http\Controllers\Home\TestingController;
use App\Models\AttributeModel;
use App\Models\ChemClassModel;
use App\Models\GoodsCaseModel;
use App\Models\GoodsChemAttributeModel;
use App\Models\GoodsDetailModel;
use App\Models\GoodsExplainModel;
use App\Models\GoodsMachiningAttributeModel;
use App\Models\GoodsModel;
use App\Models\GoodsStandardAttributeModel;
use App\Models\GoodsTestingAttributeModel;
use App\Models\MenuModel;

class GoodsManager
{
    const PAGINATE = 20;  //分页数目
    const PAGINATE_ADMIN = 10;  //后台分页数目
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
     * 通过模糊搜索获取商品（无分页）
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
                    ->orwhere('region', 'like', '%'.$search.'%')
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
     * 通过模糊搜索获取商品（有分页）
     *
     * By zm
     *
     * 2018-04-17
     *
     */
    public static function getAllGoodsListsByMenuIdWithPage($search ,$menu_id )
    {
        //分页数目
        $paginate=self::PAGINATE_ADMIN;
        //判断menu_id是否为一级栏目
        $menu=MenuManager::getMenuById($menu_id);
        if($menu['menu_id']){
            $goodses = GoodsModel::where('menu_id',$menu_id)->where(function ($goodses) use ($search) {
                $goodses->where('name'  , 'like', '%'.$search.'%')
                    ->orwhere('region', 'like', '%'.$search.'%')
                    ->orwhere('number', 'like', '%'.$search.'%');
            })->orderBy('sort','desc')->paginate($paginate);
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
            })->orderBy('sort','desc')->paginate($paginate);
        }
        foreach ($goodses as $goods){
            $menu_id=$goods['menu_id'];
            $goods['menu']=MenuManager::getMenuById($menu_id);
        }
        return $goodses;
    }

    /*
     * 通过模糊搜索获取第三方检测商品（没有分页）
     *
     * By zm
     *
     * 2018-03-18
     *
     */
    public static function getAllTestingGoodsListsByMenuId($search ,$menu_id )
    {
        //判断menu_id是否为一级栏目
        $menu=MenuManager::getMenuById($menu_id);
        if($menu['menu_id']){
            $goodses = GoodsModel::where('menu_id',$menu_id)->where(function ($goodses) use ($search) {
                $goodses->where('name'  , 'like', '%'.$search.'%')
                    ->orwhere('region', 'like', '%'.$search.'%')
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
        if (array_key_exists('stock', $data)) {
            $goods->stock = array_get($data, 'stock');
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
        if (array_key_exists('region', $data)) {
            $goods->region = array_get($data, 'region');
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
        if (array_key_exists('cas', $data)) {
            $goods->cas = array_get($data, 'cas');
        }
        if (array_key_exists('other', $data)) {
            $goods->other = array_get($data, 'other');
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
        $details=GoodsDetailModel::where('goods_id',$goods_id)->orderBy('sort','asc')->get();
        return $details;
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
        $detail=GoodsDetailModel::where('id',$id)->first();
        return $detail;
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
        if (array_key_exists('region', $data)) {
            $goods_testing_attribute->region = array_get($data, 'region');
        }
        if (array_key_exists('contacts', $data)) {
            $goods_testing_attribute->contacts = array_get($data, 'contacts');
        }
        if (array_key_exists('address', $data)) {
            $goods_testing_attribute->address = array_get($data, 'address');
        }
        if (array_key_exists('explain', $data)) {
            $goods_testing_attribute->explain = array_get($data, 'explain');
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
     * 通过模糊搜索获取化学商品大类的列表（加分页）
     *
     * By zm
     *
     * 2018-04-17
     *
     */
    public static function getAllChemClassesByMenuIdWithPage($search ,$menu_id )
    {
        //分页数目
        $paginate=self::PAGINATE_ADMIN;
        //判断menu_id是否为一级栏目
        $menu=MenuManager::getMenuById($menu_id);
        if($menu['menu_id']){
            $chem_classes = ChemClassModel::where('menu_id',$menu_id)->where(function ($chem_classes) use ($search) {
                $chem_classes->where('name'  , 'like', '%'.$search.'%')
                    ->orwhere('sub_name', 'like', '%'.$search.'%')
                    ->orwhere('english_name', 'like', '%'.$search.'%')
                    ->orwhere('molecule','like','%'.$search.'%')
                    ->orwhere('cas', 'like', '%'.$search.'%');
            })->orderBy('sort','desc')->paginate($paginate);
        }
        else{
            $menus=MenuManager::getAllMenuListsByMenuId($menu_id);
            $menu_id_array=null;
            foreach ($menus as $k=>$menu){
                $menu_id_array[$k]=$menu['id'];
            }
            $chem_classes = ChemClassModel::whereIn('menu_id',$menu_id_array)->where(function ($chem_classes) use ($search) {
                $chem_classes->where('name'  , 'like', '%'.$search.'%')
                    ->orwhere('sub_name', 'like', '%'.$search.'%')
                    ->orwhere('english_name', 'like', '%'.$search.'%')
                    ->orwhere('molecule','like','%'.$search.'%')
                    ->orwhere('cas', 'like', '%'.$search.'%');
            })->orderBy('sort','desc')->paginate($paginate);
        }
        foreach ($chem_classes as $chem_class){
            $menu_id=$chem_class['menu_id'];
            $chem_class['menu']=MenuManager::getMenuById($menu_id);
        }
        return $chem_classes;
    }

    /*
     * 通过模糊搜索获取化学商品大类的列表（没有分页）
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
                    ->orwhere('molecule','like','%'.$search.'%')
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
                    ->orwhere('sub_name', 'like', '%'.$search.'%')
                    ->orwhere('english_name', 'like', '%'.$search.'%')
                    ->orwhere('molecule','like','%'.$search.'%')
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
     * 按chem_class_id模糊查找化学商品（未分页）
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
            'goods_info.stock as stock',
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
                $goodses->where('goods_info.name'  , 'like', '%'.$search.'%')
                ->orwhere('goods_info.number'  , 'like', '%'.$search.'%');
            })
            ->orderBy('goods_info.sort','desc')
            ->get($get);
        return $goodses;
    }

    /*
     * 按chem_class_id模糊查找化学商品（有分页）
     *
     * By zm
     *
     * 2018-04-17
     *
     */
    public static function getAllChemGoodsListsByChemClassIdWithPage($search,$chem_class_id){
        //分页数目
        $paginate=self::PAGINATE_ADMIN;
        $get=array(
            'goods_info.id as id',
            'goods_info.menu_id as menu_id',
            'goods_info.name as name',
            'goods_info.number as number',
            'goods_info.stock as stock',
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
            ->leftjoin('attribute_info as f_attribute','f_attribute.id','=','goods_info.f_attribute_id')
            ->leftjoin('attribute_info as s_attribute','s_attribute.id','=','goods_info.s_attribute_id')
            ->where('goods_chem_attribute_info.chem_class_id',$chem_class_id)
            ->where(function ($goodses) use ($search) {
                $goodses->where('goods_info.name'  , 'like', '%'.$search.'%')
                    ->orwhere('goods_info.number'  , 'like', '%'.$search.'%');
            })
            ->orderBy('goods_info.sort','desc')
            ->paginate($paginate,$get);
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
        if (array_key_exists('f_attribute_ids', $data)) {
            $chem_class->f_attribute_ids = array_get($data, 'f_attribute_ids');
        }
        if (array_key_exists('s_attribute_ids', $data)) {
            $chem_class->s_attribute_ids = array_get($data, 's_attribute_ids');
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

    /*
     * 配置机加工商品（购买方式为咨询客服的商品）属性的参数
     *
     * By zm
     *
     * 2018-01-31
     *
     */
    public static function setGoodsMachiningAttribute($goods_machining_attribute, $data){
        if (array_key_exists('goods_id', $data)) {
            $goods_machining_attribute->goods_id = array_get($data, 'goods_id');
        }
        if (array_key_exists('accuracy', $data)) {
            $goods_machining_attribute->accuracy = array_get($data, 'accuracy');
        }
        if (array_key_exists('service', $data)) {
            $goods_machining_attribute->service = array_get($data, 'service');
        }
        if (array_key_exists('material', $data)) {
            $goods_machining_attribute->material = array_get($data, 'material');
        }
        if (array_key_exists('explain', $data)) {
            $goods_machining_attribute->explain = array_get($data, 'explain');
        }
        return $goods_machining_attribute;
    }

    /*
     * 配置国标商品（购买方式为直接购买的商品）属性的参数
     *
     * By zm
     *
     * 2018-01-31
     *
     */
    public static function setGoodsStandardAttribute($goods_standard_attribute, $data){
        if (array_key_exists('goods_id', $data)) {
            $goods_standard_attribute->goods_id = array_get($data, 'goods_id');
        }
        if (array_key_exists('accuracy', $data)) {
            $goods_standard_attribute->accuracy = array_get($data, 'accuracy');
        }
        if (array_key_exists('size', $data)) {
            $goods_standard_attribute->size = array_get($data, 'size');
        }
        if (array_key_exists('component', $data)) {
            $goods_standard_attribute->component = array_get($data, 'component');
        }
        return $goods_standard_attribute;
    }

    /*
     * 根据goods_id获取机加工商品属性
     *
     * By zm
     *
     * 2018-01-31
     *
     */
    public static function getGoodsMachiningAttributeByGoodsId($goods_id){
        $goods_machining_attribute=GoodsMachiningAttributeModel::where('goods_id',$goods_id)->first();
        return $goods_machining_attribute;
    }

    /*
     * 根据goods_id获取国标商品属性
     *
     * By zm
     *
     * 2018-01-31
     *
     */
    public static function getGoodsStandardAttributeByGoodsId($goods_id){
        $goods_standard_attribute=GoodsStandardAttributeModel::where('goods_id',$goods_id)->first();
        return $goods_standard_attribute;
    }

    /*
     * 根据goods_id获取商品案例
     *
     * By zm
     *
     * 2018-01-31
     *
     */
    public static function getGoodsCaseByGoodsId($goods_id){
        $cases=GoodsCaseModel::where('goods_id',$goods_id)->orderBy('sort','asc')->get();
        return $cases;
    }



    /*
     * 根据id获取商品案例
     *
     * By zm
     *
     * 2018-01-31
     *
     */
    public static function getGoodsCaseById($id){
        $case=GoodsCaseModel::where('id',$id)->first();
        return $case;
    }

    /*
     * 配置商品案例的参数
     *
     * By zm
     *
     * 2018-01-31
     *
     */
    public static function setGoodsCase($goods_case, $data){
        if (array_key_exists('goods_id', $data)) {
            $goods_case->goods_id = array_get($data, 'goods_id');
        }
        if (array_key_exists('content', $data)) {
            $goods_case->content = array_get($data, 'content');
        }
        if (array_key_exists('name', $data)) {
            $goods_case->name = array_get($data, 'name');
        }
        if (array_key_exists('sort', $data)) {
            $goods_case->sort = array_get($data, 'sort');
        }
        return $goods_case;
    }

    /*
     * 化学商城首页的热门商品
     *
     * by zm
     *
     * 2018-02-16
     */
    public static function getChemClassWithHot($menu_id){
        $where=array(
            'menu_id'=>$menu_id,
            'hot'=>1
        );
        $chem_classes=ChemClassModel::where($where)->orderBy('sort','desc')->offset(0)->limit(4)->get();
        return $chem_classes;
    }

    /*
     * 化学商城根据menu_id获取商品列表
     *
     * by zm
     *
     * 2018-02-16
     */
    public static function getChemClassByMenuId($data){
        $menu_id=$data['menu_id'];
        $f_attribute_id=$data['f_attribute_id']?$data['f_attribute_id']:'';
        $s_attribute_id=$data['s_attribute_id']?$data['s_attribute_id']:'';
        $chem_classes=ChemClassModel::where('menu_id',$menu_id)->orderBy('sort','desc')->orderBy('id','desc')->get();
        $goods_paginate=7;
        if(empty($f_attribute_id)&&empty($s_attribute_id)){
            $where=array(
                'goods_info.menu_id'=>$menu_id,
            );
        }
        else if(!empty($f_attribute_id)&&empty($s_attribute_id)){
            $where=array(
                'goods_info.menu_id'=>$menu_id,
                'goods_info.f_attribute_id'=>$f_attribute_id
            );
        }
        else if(empty($f_attribute_id)&&!empty($s_attribute_id)){
            $where=array(
                'goods_info.menu_id'=>$menu_id,
                'goods_info.s_attribute_id'=>$s_attribute_id
            );
        }
        else{
            $where=array(
                'goods_info.menu_id'=>$menu_id,
                'goods_info.f_attribute_id'=>$f_attribute_id,
                'goods_info.s_attribute_id'=>$s_attribute_id
            );
        }
        $select=array(
            'chem_class_info.id as id',
            'chem_class_info.name as name',
            'chem_class_info.sub_name as sub_name',
            'chem_class_info.english_name as english_name',
            'chem_class_info.menu_id as menu_id',
            'chem_class_info.picture as picture',
            'chem_class_info.cas as cas',
            'chem_class_info.molecule as molecule',
            'goods_info.id as goods_id',
            'goods_info.number as number',
            'goods_info.price as price',
            'goods_info.unit as unit',
            'goods_info.f_attribute_id as f_attribute_id',
            'goods_info.s_attribute_id as s_attribute_id',
            'goods_chem_attribute_info.spec as spec',
            'goods_chem_attribute_info.delivery as delivery',
            'f_attribute.name as f_attribute',
            's_attribute.name as s_attribute',
        );
        foreach ($chem_classes as $k=>$chem_class){
            $chem_class_id=$chem_class['id'];
            $chem_class['goodses']=GoodsModel::join('goods_chem_attribute_info','goods_chem_attribute_info.goods_id','=','goods_info.id')
                ->join('chem_class_info','chem_class_info.id','=','goods_chem_attribute_info.chem_class_id')
                ->join('attribute_info as f_attribute','f_attribute.id','=','goods_info.f_attribute_id')
                ->join('attribute_info as s_attribute','s_attribute.id','=','goods_info.s_attribute_id')
                ->where($where)->where('goods_chem_attribute_info.chem_class_id',$chem_class_id)->orderBy('goods_info.sort','desc')->orderBy('goods_info.id','desc')->select($select)->paginate($goods_paginate);
            if(count($chem_class['goodses'])==0){
                unset($chem_classes[$k]);
            }
        }
        return $chem_classes;
    }

    /*
     * 化学商城根据menu_id获取商品列表（改）
     *
     * by zm
     *
     * 2018-04-18
     */
    public static function newGetChemClassByMenuId($data){
        $paginate=self::PAGINATE;
        $goods_paginate=7;
        //查询满足条件的商品大类
        $menu_id=$data['menu_id'];
        $f_attribute_id=$data['f_attribute_id']?$data['f_attribute_id']:'';
        $s_attribute_id=$data['s_attribute_id']?$data['s_attribute_id']:'';
        $chem_classes=ChemClassModel::where('menu_id',$menu_id);
        if(!empty($f_attribute_id)&&empty($s_attribute_id)){
            $chem_classes=$chem_classes->whereRaw('FIND_IN_SET('.$f_attribute_id.',f_attribute_ids)');
        }
        else if(empty($f_attribute_id)&&!empty($s_attribute_id)){
            $chem_classes=$chem_classes->whereRaw('FIND_IN_SET('.$s_attribute_id.',s_attribute_ids)');
        }
        else if(!empty($f_attribute_id)&&!empty($s_attribute_id)){
            $chem_classes=$chem_classes->whereRaw('FIND_IN_SET('.$f_attribute_id.',f_attribute_ids)')->whereRaw('FIND_IN_SET('.$s_attribute_id.',s_attribute_ids)');
        }
        $chem_classes=$chem_classes->orderBy('sort','desc')->orderBy('id','desc')->paginate($paginate);
        //如果有满足条件的商品大类，查询下面的商品
        if(count($chem_classes)>0){
            if(empty($f_attribute_id)&&empty($s_attribute_id)){
                $where=array(
                    'goods_info.menu_id'=>$menu_id,
                );
            }
            else if(!empty($f_attribute_id)&&empty($s_attribute_id)){
                $where=array(
                    'goods_info.menu_id'=>$menu_id,
                    'goods_info.f_attribute_id'=>$f_attribute_id
                );
            }
            else if(empty($f_attribute_id)&&!empty($s_attribute_id)){
                $where=array(
                    'goods_info.menu_id'=>$menu_id,
                    'goods_info.s_attribute_id'=>$s_attribute_id
                );
            }
            else{
                $where=array(
                    'goods_info.menu_id'=>$menu_id,
                    'goods_info.f_attribute_id'=>$f_attribute_id,
                    'goods_info.s_attribute_id'=>$s_attribute_id
                );
            }
            $select=array(
                'chem_class_info.id as id',
                'chem_class_info.name as name',
                'chem_class_info.sub_name as sub_name',
                'chem_class_info.english_name as english_name',
                'chem_class_info.menu_id as menu_id',
                'chem_class_info.picture as picture',
                'chem_class_info.cas as cas',
                'chem_class_info.molecule as molecule',
                'goods_info.id as goods_id',
                'goods_info.number as number',
                'goods_info.price as price',
                'goods_info.unit as unit',
                'goods_info.f_attribute_id as f_attribute_id',
                'goods_info.s_attribute_id as s_attribute_id',
                'goods_chem_attribute_info.spec as spec',
                'goods_chem_attribute_info.delivery as delivery',
                'f_attribute.name as f_attribute',
                's_attribute.name as s_attribute',
            );
            foreach ($chem_classes as $k=>$chem_class){
                $chem_class_id=$chem_class['id'];
                $chem_class['goodses']=GoodsModel::join('goods_chem_attribute_info','goods_chem_attribute_info.goods_id','=','goods_info.id')
                    ->join('chem_class_info','chem_class_info.id','=','goods_chem_attribute_info.chem_class_id')
                    ->leftjoin('attribute_info as f_attribute','f_attribute.id','=','goods_info.f_attribute_id')
                    ->leftjoin('attribute_info as s_attribute','s_attribute.id','=','goods_info.s_attribute_id')
                    ->where($where)
                    ->where('goods_chem_attribute_info.chem_class_id',$chem_class_id)
                    ->orderBy('goods_info.sort','desc')
                    ->orderBy('goods_info.id','desc')
                    ->offset(0)
                    ->limit($goods_paginate)
                    ->get($select);
//                    ->select($select)
//                    ->paginate($goods_paginate);
            }
        }
        return $chem_classes;
    }

    /*
     * 化学商城模糊搜索
     *
     * by zm
     *
     * 2018-02-16
     */
    public static function getChemClassBySearch($data){
        $search=$data['search'];
        $f_attribute_id=$data['f_attribute_id']?$data['f_attribute_id']:'';
        $s_attribute_id=$data['s_attribute_id']?$data['s_attribute_id']:'';
        $goods_paginate=7;
        $chem_classes=ChemClassModel::where(function ($chem_classes) use ($search) {
            $chem_classes->where('name'  , 'like', '%'.$search.'%')
                ->orwhere('sub_name', 'like', '%'.$search.'%')
                ->orwhere('english_name', 'like', '%'.$search.'%')
                ->orwhere('molecule','like','%'.$search.'%')
                ->orwhere('cas', 'like', '%'.$search.'%');
//                ->orwhere('molecule','like','%'.$search.'%')
//                ->orwhere('cas', 'like', '%'.$search.'%');
        })->orderBy('sort','desc')->orderBy('id','desc')->get();
        if(empty($f_attribute_id)&&empty($s_attribute_id)){
            $where=array();
        }
        else if(!empty($f_attribute_id)&&empty($s_attribute_id)){
            $where=array(
                'goods_info.f_attribute_id'=>$f_attribute_id
            );
        }
        else if(empty($f_attribute_id)&&!empty($s_attribute_id)){
            $where=array(
                'goods_info.s_attribute_id'=>$s_attribute_id
            );
        }
        else{
            $where=array(
                'goods_info.f_attribute_id'=>$f_attribute_id,
                'goods_info.s_attribute_id'=>$s_attribute_id
            );
        }
        $select=array(
            'chem_class_info.id as id',
            'chem_class_info.name as name',
            'chem_class_info.sub_name as sub_name',
            'chem_class_info.english_name as english_name',
            'chem_class_info.menu_id as menu_id',
            'chem_class_info.picture as picture',
            'chem_class_info.cas as cas',
            'chem_class_info.molecule as molecule',
            'goods_info.id as goods_id',
            'goods_info.number as number',
            'goods_info.price as price',
            'goods_info.unit as unit',
            'goods_info.f_attribute_id as f_attribute_id',
            'goods_info.s_attribute_id as s_attribute_id',
            'goods_chem_attribute_info.spec as spec',
            'goods_chem_attribute_info.delivery as delivery',
            'f_attribute.name as f_attribute',
            's_attribute.name as s_attribute',
        );
        foreach ($chem_classes as $k=>$chem_class){
            $chem_class_id=$chem_class['id'];
            $chem_class['goodses']=GoodsModel::join('goods_chem_attribute_info','goods_chem_attribute_info.goods_id','=','goods_info.id')
                ->join('chem_class_info','chem_class_info.id','=','goods_chem_attribute_info.chem_class_id')
                ->join('attribute_info as f_attribute','f_attribute.id','=','goods_info.f_attribute_id')
                ->join('attribute_info as s_attribute','s_attribute.id','=','goods_info.s_attribute_id')
                ->join('menu_info','menu_info.id','=','chem_class_info.menu_id')
                ->where($where)->where('menu_info.status',1)->where('goods_chem_attribute_info.chem_class_id',$chem_class_id)->orderBy('goods_info.sort','desc')->orderBy('goods_info.id','desc')->select($select)->paginate($goods_paginate);
            if(count($chem_class['goodses'])==0){
                unset($chem_classes[$k]);
            }
        }
        return $chem_classes;
    }

    /*
     * 化学商城模糊搜索（改）
     *
     * by zm
     *
     * 2018-04-19
     */
    public static function newGetChemClassBySearch($data){
        $paginate=self::PAGINATE;
        $goods_paginate=7;
        //查询满足条件的商品大类
        $search=$data['search'];
        $f_attribute_id=$data['f_attribute_id']?$data['f_attribute_id']:'';
        $s_attribute_id=$data['s_attribute_id']?$data['s_attribute_id']:'';
        $chem_classes=ChemClassModel::where(function ($chem_classes) use ($search) {
            $chem_classes->where('name'  , 'like', '%'.$search.'%')
                ->orwhere('sub_name', 'like', '%'.$search.'%')
                ->orwhere('english_name', 'like', '%'.$search.'%')
                ->orwhere('molecule','like','%'.$search.'%')
                ->orwhere('cas', 'like', '%'.$search.'%');
        });
        //如果有满足条件的商品大类，查询下面的商品
        if(!empty($f_attribute_id)&&empty($s_attribute_id)){
            $chem_classes=$chem_classes->whereRaw('FIND_IN_SET('.$f_attribute_id.',f_attribute_ids)');
        }
        else if(empty($f_attribute_id)&&!empty($s_attribute_id)){
            $chem_classes=$chem_classes->whereRaw('FIND_IN_SET('.$s_attribute_id.',s_attribute_ids)');
        }
        else if(!empty($f_attribute_id)&&!empty($s_attribute_id)){
            $chem_classes=$chem_classes->whereRaw('FIND_IN_SET('.$f_attribute_id.',f_attribute_ids)')->whereRaw('FIND_IN_SET('.$s_attribute_id.',s_attribute_ids)');
        }
        $chem_classes=$chem_classes->orderBy('sort','desc')->orderBy('id','desc')->paginate($paginate);
        if(count($chem_classes)>0){
            if(empty($f_attribute_id)&&empty($s_attribute_id)){
                $where=array();
            }
            else if(!empty($f_attribute_id)&&empty($s_attribute_id)){
                $where=array(
                    'goods_info.f_attribute_id'=>$f_attribute_id
                );
            }
            else if(empty($f_attribute_id)&&!empty($s_attribute_id)){
                $where=array(
                    'goods_info.s_attribute_id'=>$s_attribute_id
                );
            }
            else{
                $where=array(
                    'goods_info.f_attribute_id'=>$f_attribute_id,
                    'goods_info.s_attribute_id'=>$s_attribute_id
                );
            }
            $select=array(
                'chem_class_info.id as id',
                'chem_class_info.name as name',
                'chem_class_info.sub_name as sub_name',
                'chem_class_info.english_name as english_name',
                'chem_class_info.menu_id as menu_id',
                'chem_class_info.picture as picture',
                'chem_class_info.cas as cas',
                'chem_class_info.molecule as molecule',
                'goods_info.id as goods_id',
                'goods_info.number as number',
                'goods_info.price as price',
                'goods_info.unit as unit',
                'goods_info.f_attribute_id as f_attribute_id',
                'goods_info.s_attribute_id as s_attribute_id',
                'goods_chem_attribute_info.spec as spec',
                'goods_chem_attribute_info.delivery as delivery',
                'f_attribute.name as f_attribute',
                's_attribute.name as s_attribute',
            );
            foreach ($chem_classes as $k=>$chem_class){
                $chem_class_id=$chem_class['id'];
                $chem_class['goodses']=GoodsModel::join('goods_chem_attribute_info','goods_chem_attribute_info.goods_id','=','goods_info.id')
                    ->join('chem_class_info','chem_class_info.id','=','goods_chem_attribute_info.chem_class_id')
                    ->leftjoin('attribute_info as f_attribute','f_attribute.id','=','goods_info.f_attribute_id')
                    ->leftjoin('attribute_info as s_attribute','s_attribute.id','=','goods_info.s_attribute_id')
                    ->join('menu_info','menu_info.id','=','chem_class_info.menu_id')
                    ->where($where)
                    ->where('menu_info.status',1)
                    ->where('goods_chem_attribute_info.chem_class_id',$chem_class_id)
                    ->orderBy('goods_info.sort','desc')
                    ->orderBy('goods_info.id','desc')
                    ->offset(0)
                    ->limit($goods_paginate)
                    ->get($select);
            }
        }
        return $chem_classes;
    }

    /*
     * 化学商城根据chem_class_id获取商品列表
     *
     * by zm
     *
     * 2018-02-21
     */
    public static function getGoodsesByClassId($data){
        $chem_class_id=$data['class_id'];
        $f_attribute_id=$data['f_attribute_id']?$data['f_attribute_id']:'';
        $s_attribute_id=$data['s_attribute_id']?$data['s_attribute_id']:'';
        $paginate=self::PAGINATE;
        if(empty($f_attribute_id)&&empty($s_attribute_id)){
            $where=array(
                'goods_chem_attribute_info.chem_class_id'=>$chem_class_id,
            );
        }
        else if(!empty($f_attribute_id)&&empty($s_attribute_id)){
            $where=array(
                'goods_chem_attribute_info.chem_class_id'=>$chem_class_id,
                'goods_info.f_attribute_id'=>$f_attribute_id
            );
        }
        else if(empty($f_attribute_id)&&!empty($s_attribute_id)){
            $where=array(
                'goods_chem_attribute_info.chem_class_id'=>$chem_class_id,
                'goods_info.s_attribute_id'=>$s_attribute_id
            );
        }
        else{
            $where=array(
                'goods_chem_attribute_info.chem_class_id'=>$chem_class_id,
                'goods_info.f_attribute_id'=>$f_attribute_id,
                'goods_info.s_attribute_id'=>$s_attribute_id
            );
        }
        $select=array(
            'chem_class_info.id as id',
            'chem_class_info.name as name',
            'chem_class_info.sub_name as sub_name',
            'chem_class_info.english_name as english_name',
            'chem_class_info.menu_id as menu_id',
            'chem_class_info.picture as picture',
            'chem_class_info.cas as cas',
            'chem_class_info.molecule as molecule',
            'goods_info.id as goods_id',
            'goods_info.number as number',
            'goods_info.price as price',
            'goods_info.unit as unit',
            'goods_info.f_attribute_id as f_attribute_id',
            'goods_info.s_attribute_id as s_attribute_id',
            'goods_chem_attribute_info.spec as spec',
            'goods_chem_attribute_info.delivery as delivery',
            'f_attribute.name as f_attribute',
            's_attribute.name as s_attribute',
        );
        $chem_class=ChemClassModel::find($chem_class_id);
        $chem_class['goodses']=GoodsModel::join('goods_chem_attribute_info','goods_chem_attribute_info.goods_id','=','goods_info.id')
            ->join('chem_class_info','chem_class_info.id','=','goods_chem_attribute_info.chem_class_id')
            ->leftjoin('attribute_info as f_attribute','f_attribute.id','=','goods_info.f_attribute_id')
            ->leftjoin('attribute_info as s_attribute','s_attribute.id','=','goods_info.s_attribute_id')
            ->where($where)->orderBy('goods_info.sort','desc')->orderBy('goods_info.id','desc')->select($select)->paginate($paginate);
        return $chem_class;
    }

    /*
     * 化学商城根据属性获取推荐商品列表
     *
     * by zm
     *
     * 2018-02-22
     */
    public static function getChemClassByAttribute($data){
        $chem_class_id=$data['attribute']['chem_class_id'];
        $paginate=6;
        $select=array(
            'chem_class_info.id as id',
            'chem_class_info.name as name',
            'chem_class_info.sub_name as sub_name',
            'chem_class_info.english_name as english_name',
            'chem_class_info.menu_id as menu_id',
            'chem_class_info.picture as picture',
            'chem_class_info.cas as cas',
            'chem_class_info.molecule as molecule',
            'goods_info.id as goods_id',
            'goods_info.number as number',
            'goods_info.price as price',
            'goods_info.unit as unit',
            'goods_info.f_attribute_id as f_attribute_id',
            'goods_info.s_attribute_id as s_attribute_id',
            'goods_chem_attribute_info.spec as spec',
            'goods_chem_attribute_info.delivery as delivery',
            'f_attribute.name as f_attribute',
            's_attribute.name as s_attribute',
        );
        $chem_class=GoodsModel::join('goods_chem_attribute_info','goods_chem_attribute_info.goods_id','=','goods_info.id')
            ->join('chem_class_info','chem_class_info.id','=','goods_chem_attribute_info.chem_class_id')
            ->leftjoin('attribute_info as f_attribute','f_attribute.id','=','goods_info.f_attribute_id')
            ->leftjoin('attribute_info as s_attribute','s_attribute.id','=','goods_info.s_attribute_id')
            ->where('goods_chem_attribute_info.chem_class_id',$chem_class_id)
            ->where(function($chem_class) use ($data){
                $chem_class->where('goods_info.f_attribute_id',$data['f_attribute_id'])
                ->orwhere('goods_info.s_attribute_id',$data['s_attribute_id']);
            })
            ->orderBy('goods_info.sort','desc')
            ->orderBy('goods_info.f_attribute_id','desc')
            ->orderBy('goods_info.s_attribute_id','desc')
            ->select($select)->paginate($paginate);
        return $chem_class;
    }

    /*
     * 第三方检测商城首页的热门商品
     *
     * by zm
     *
     * 2018-02-16
     */
    public static function getTestingGoodsesWithHot($menu_id){
        $where=array(
            'menu_id'=>$menu_id,
            'hot'=>1
        );
        $goodses=GoodsModel::where($where)->orderBy('sort','desc')->offset(0)->limit(4)->get();
        foreach ($goodses as $goods){
            $goods_id=$goods['id'];
            $goods['goods_attribute']=GoodsTestingAttributeModel::where('goods_id',$goods_id)->first();
            $f_attribute_id=$goods['f_attribute_id'];
            $goods['f_attribute']=AttributeModel::where('id',$f_attribute_id)->first();
            $s_attribute_id=$goods['s_attribute_id'];
            $goods['s_attribute']=AttributeModel::where('id',$s_attribute_id)->first();
        }
        return $goodses;
    }

    /*
     * 第三方检测商城根据menu_id获取商品列表
     *
     * by zm
     *
     * 2018-02-16
     */
    public static function getTestingClassByMenuId($data){
        $menu_id=$data['menu_id'];
        $f_attribute_id=$data['f_attribute_id']?$data['f_attribute_id']:'';
        $s_attribute_id=$data['s_attribute_id']?$data['s_attribute_id']:'';
        $paginate=self::PAGINATE;
        if(empty($f_attribute_id)&&empty($s_attribute_id)){
            $where=array(
                'menu_id'=>$menu_id
            );
        }
        else if(!empty($f_attribute_id)&&empty($s_attribute_id)){
            $where=array(
                'menu_id'=>$menu_id,
                'f_attribute_id'=>$f_attribute_id
            );
        }
        else if(empty($f_attribute_id)&&!empty($s_attribute_id)){
            $where=array(
                'menu_id'=>$menu_id,
                's_attribute_id'=>$s_attribute_id
            );
        }
        else{
            $where=array(
                'menu_id'=>$menu_id,
                'f_attribute_id'=>$f_attribute_id,
                's_attribute_id'=>$s_attribute_id
            );
        }
        $goodses=GoodsModel::where($where)->orderBy('sort','desc')->paginate($paginate);
        foreach ($goodses as $goods){
            $goods_id=$goods['id'];
            $goods['goods_attribute']=GoodsTestingAttributeModel::where('goods_id',$goods_id)->first();
            $f_attribute_id=$goods['f_attribute_id'];
            $goods['f_attribute']=AttributeModel::where('id',$f_attribute_id)->first();
            $s_attribute_id=$goods['s_attribute_id'];
            $goods['s_attribute']=AttributeModel::where('id',$s_attribute_id)->first();
        }
        return $goodses;
    }

    /*
     * 第三方检测商城模糊搜索获取商品列表
     *
     * by zm
     *
     * 2018-02-16
     */
    public static function getTestingClassBysearch($data){
        $menu_id=$data['menu_id'];
        $search=$data['search'];
        $f_attribute_id=$data['f_attribute_id']?$data['f_attribute_id']:'';
        $s_attribute_id=$data['s_attribute_id']?$data['s_attribute_id']:'';
        $paginate=self::PAGINATE;
        $select=array(
            'goods_info.id as id',
            'goods_info.name as name',
            'goods_info.picture as picture',
            'goods_info.f_attribute_id as f_attribute_id',
            'goods_info.s_attribute_id as s_attribute_id',
            'goods_info.price as price',
            'goods_info.unit as unit',
        );
        if(empty($f_attribute_id)&&empty($s_attribute_id)){
            $goodses=GoodsModel::join('menu_info','menu_info.id','=','goods_info.menu_id')->where('menu_info.menu_id','=',$menu_id)
                    ->where('menu_info.status',1)
                    ->where(function($goodses) use ($search){
                    $goodses->where('goods_info.name','like','%'.$search.'%')
                        ->orwhere('goods_info.region','like','%'.$search.'%')
                        ->orwhere('goods_info.number','like','%'.$search.'%');
                })
                ->select($select)->paginate($paginate);
        }
        else if(!empty($f_attribute_id)&&empty($s_attribute_id)){
            $goodses=GoodsModel::join('menu_info','menu_info.id','=','goods_info.menu_id')->where('goods_info.f_attribute_id',$f_attribute_id)->where('menu_info.menu_id','=',$menu_id)
                ->where('menu_info.status',1)
                ->where(function($goodses) use ($search){
                    $goodses->where('goods_info.name','like','%'.$search.'%')
                        ->orwhere('goods_info.number','like','%'.$search.'%');
                })
                ->select($select)->paginate($paginate);
        }
        else if(empty($f_attribute_id)&&!empty($s_attribute_id)){
            $goodses=GoodsModel::join('menu_info','menu_info.id','=','goods_info.menu_id')->where('goods_info.s_attribute_id',$s_attribute_id)->where('menu_info.menu_id','=',$menu_id)
                ->where('menu_info.status',1)
                ->where(function($goodses) use ($search){
                    $goodses->where('goods_info.name','like','%'.$search.'%')
                        ->orwhere('goods_info.number','like','%'.$search.'%');})
                ->select($select)->paginate($paginate);
        }
        else{
            $goodses=GoodsModel::join('menu_info','menu_info.id','=','goods_info.menu_id')->where('goods_info.f_attribute_id',$f_attribute_id)->where('goods_info.s_attribute_id',$s_attribute_id)->where('menu_info.menu_id','=',$menu_id)
                ->where('menu_info.status',1)
                ->where(function($goodses) use ($search){
                    $goodses->where('goods_info.name','like','%'.$search.'%')
                        ->orwhere('goods_info.number','like','%'.$search.'%');})
                ->select($select)->paginate($paginate);
        }
        foreach ($goodses as $goods){
            $goods_id=$goods['id'];
            $goods['goods_attribute']=GoodsTestingAttributeModel::where('goods_id',$goods_id)->first();
            $f_attribute_id=$goods['f_attribute_id'];
            $goods['f_attribute']=AttributeModel::where('id',$f_attribute_id)->first();
            $s_attribute_id=$goods['s_attribute_id'];
            $goods['s_attribute']=AttributeModel::where('id',$s_attribute_id)->first();
        }
        return $goodses;
    }

    /*
     * 机加工商城首页的热门商品
     *
     * by zm
     *
     * 2018-02-16
     */
    public static function getMachiningGoodsesWithHot($menu_id){
        $where=array(
            'menu_id'=>$menu_id,
            'hot'=>1
        );
        $goodses=GoodsModel::where($where)->orderBy('sort','desc')->offset(0)->limit(4)->get();
        foreach ($goodses as $goods){
            $goods_id=$goods['id'];
            $goods['goods_attribute']=GoodsMachiningAttributeModel::where('goods_id',$goods_id)->first();
            if($goods['goods_attribute']){
                $goods['type']=0;
            }
            else{
                $goods['goods_attribute']=GoodsStandardAttributeModel::where('goods_id',$goods_id)->first();
                $goods['type']=1;
            }
            $f_attribute_id=$goods['f_attribute_id'];
            $goods['f_attribute']=AttributeModel::where('id',$f_attribute_id)->first();
        }
        return $goodses;
    }

    /*
     * 机加工商城根据menu_id获取商品列表
     *
     * by zm
     *
     * 2018-02-16
     */
    public static function getMachiningClassByMenuId($data){
        $menu_id=$data['menu_id'];
        $f_attribute_id=$data['f_attribute_id']?$data['f_attribute_id']:'';
        $s_attribute_id=$data['s_attribute_id']?$data['s_attribute_id']:'';
        $paginate=self::PAGINATE;
        if(empty($f_attribute_id)&&empty($s_attribute_id)){
            $where=array(
                'menu_id'=>$menu_id
            );
        }
        else if(!empty($f_attribute_id)&&empty($s_attribute_id)){
            $where=array(
                'menu_id'=>$menu_id,
                'f_attribute_id'=>$f_attribute_id
            );
        }
        else if(empty($f_attribute_id)&&!empty($s_attribute_id)){
            $where=array(
                'menu_id'=>$menu_id,
                's_attribute_id'=>$s_attribute_id
            );
        }
        else{
            $where=array(
                'menu_id'=>$menu_id,
                'f_attribute_id'=>$f_attribute_id,
                's_attribute_id'=>$s_attribute_id
            );
        }
        $goodses=GoodsModel::where($where)->orderBy('sort','desc')->paginate($paginate);
        foreach ($goodses as $goods){
            $goods_id=$goods['id'];
            $goods['goods_attribute']=GoodsMachiningAttributeModel::where('goods_id',$goods_id)->first();
            if($goods['goods_attribute']){
                $goods['type']=0;
            }
            else{
                $goods['goods_attribute']=GoodsStandardAttributeModel::where('goods_id',$goods_id)->first();
                $goods['type']=1;
            }
            $f_attribute_id=$goods['f_attribute_id'];
            $goods['f_attribute']=AttributeModel::where('id',$f_attribute_id)->first();
        }
        return $goodses;
    }

    /*
     * 第三方检测商城模糊搜索获取商品列表
     *
     * by zm
     *
     * 2018-02-16
     */
    public static function getMachiningClassBysearch($data){
        $menu_id=$data['menu_id'];
        $search=$data['search'];
        $f_attribute_id=$data['f_attribute_id']?$data['f_attribute_id']:'';
        $s_attribute_id=$data['s_attribute_id']?$data['s_attribute_id']:'';
        $paginate=self::PAGINATE;
        $select=array(
            'goods_info.id as id',
            'goods_info.name as name',
            'goods_info.picture as picture',
            'goods_info.f_attribute_id as f_attribute_id',
            'goods_info.s_attribute_id as s_attribute_id',
            'goods_info.price as price',
            'goods_info.unit as unit',
        );
        if(empty($f_attribute_id)&&empty($s_attribute_id)){
            $goodses=GoodsModel::join('menu_info','menu_info.id','=','goods_info.menu_id')->where('menu_info.menu_id','=',$menu_id)
                ->where('menu_info.status',1)
                ->where(function($goodses) use ($search){
                    $goodses->where('goods_info.name','like','%'.$search.'%')
                        ->orwhere('goods_info.number','like','%'.$search.'%');})
                ->select($select)->paginate($paginate);
        }
        else if(!empty($f_attribute_id)&&empty($s_attribute_id)){
            $goodses=GoodsModel::join('menu_info','menu_info.id','=','goods_info.menu_id')->where('goods_info.f_attribute_id',$f_attribute_id)->where('menu_info.menu_id','=',$menu_id)
                ->where('menu_info.status',1)
                ->where(function($goodses) use ($search){
                    $goodses->where('goods_info.name','like','%'.$search.'%')
                        ->orwhere('goods_info.number','like','%'.$search.'%');})
                ->select($select)->paginate($paginate);
        }
        else if(empty($f_attribute_id)&&!empty($s_attribute_id)){
            $goodses=GoodsModel::join('menu_info','menu_info.id','=','goods_info.menu_id')->where('goods_info.s_attribute_id',$s_attribute_id)->where('menu_info.menu_id','=',$menu_id)
                ->where('menu_info.status',1)
                ->where(function($goodses) use ($search){
                    $goodses->where('goods_info.name','like','%'.$search.'%')
                        ->orwhere('goods_info.number','like','%'.$search.'%');})
                ->select($select)->paginate($paginate);
        }
        else{
            $goodses=GoodsModel::join('menu_info','menu_info.id','=','goods_info.menu_id')->where('goods_info.f_attribute_id',$f_attribute_id)->where('goods_info.s_attribute_id',$s_attribute_id)->where('menu_info.menu_id','=',$menu_id)
                ->where('menu_info.status',1)
                ->where(function($goodses) use ($search){
                    $goodses->where('goods_info.name','like','%'.$search.'%')
                        ->orwhere('goods_info.number','like','%'.$search.'%');})
                ->select($select)->paginate($paginate);
        }
        foreach ($goodses as $goods){
            $goods_id=$goods['id'];
            $goods['goods_attribute']=GoodsMachiningAttributeModel::where('goods_id',$goods_id)->first();
            if($goods['goods_attribute']){
                $goods['type']=0;
            }
            else{
                $goods['goods_attribute']=GoodsStandardAttributeModel::where('goods_id',$goods_id)->first();
                $goods['type']=1;
            }
            $f_attribute_id=$goods['f_attribute_id'];
            $goods['f_attribute']=AttributeModel::where('id',$f_attribute_id)->first();
        }
        return $goodses;
    }

    /*
     * 标品库商品按成分搜索相似产品
     *
     * by zm
     *
     * 2018-02-22
     */
    public static function getStandardListsByComponent($id,$component){
        $get=array(
            'goods_info.id as id',
            'goods_info.picture as picture',
            'goods_info.name as name'
        );
        $goodses=GoodsStandardAttributeModel::join('goods_info','goods_info.id','=','goods_standard_attribute_info.goods_id')
            ->where('component',$component)
            ->whereNotIn('goods_standard_attribute_info.id', [$id])
            ->orderBy('goods_info.sort','desc')
            ->get($get);
        return $goodses;
    }

    /*
     * 对所有商品做模糊查询
     *
     * by zm
     *
     * 2018-02-23
     */
    public static function getGoodsesByName($search){
        //化学商城
        $chem_menu_id=ChemController::MENU_ID;
        $chem_column=ChemController::COLUMN;
        //第三方检测
        $testing_menu_id=TestingController::MENU_ID;
        $testing_column=TestingController::COLUMN;
        //机加工
        $machining_menu_id=MachiningController::MENU_ID;
        $machining_column=MachiningController::COLUMN;
//        $menus=MenuManager::getClassAMenuLists();
        $menus=MenuManager::getClassAMenuListswhichCanShow();
        foreach ($menus as $k=>$menu){
            if($menu['id']==$chem_menu_id){
                $chem_goodses=self::getAllChemClassesByMenuId($search,$chem_menu_id);
                $goodses[$k]['goodses']=$chem_goodses;
                $goodses[$k]['column']=$chem_column;
                $goodses[$k]['column_id']=$chem_menu_id;
                $menu=MenuManager::getMenuById($chem_menu_id);
                $goodses[$k]['column_status']=$menu['status'];
            }
            else if($menu['id']==$testing_menu_id){
                $testing_goodses=self::getAllTestingGoodsListsByMenuId($search,$testing_menu_id);
                $goodses[$k]['goodses']=$testing_goodses;
                $goodses[$k]['column']=$testing_column;
                $goodses[$k]['column_id']=$testing_menu_id;
                $menu=MenuManager::getMenuById($testing_menu_id);
                $goodses[$k]['column_status']=$menu['status'];
            }
            else if($menu['id']==$machining_menu_id){
                $machining_goodses=self::getAllGoodsListsByMenuId($search,$machining_menu_id);
                foreach ($machining_goodses as $machining_goods){
                    $goods_id=$machining_goods['id'];
                    $attribute=GoodsManager::getGoodsMachiningAttributeByGoodsId($goods_id);
                    if($attribute){
                        $machining_goods['type']=0;
                    }
                    else{
                        $machining_goods['type']=1;
                    }
                }
                $goodses[$k]['goodses']=$machining_goodses;
                $goodses[$k]['column']=$machining_column;
                $goodses[$k]['column_id']=$machining_menu_id;
                $menu=MenuManager::getMenuById($machining_menu_id);
                $goodses[$k]['column_status']=$menu['status'];
            }
            $goodses[$k]['menu']=$menu;
        }
        $goods_lists=array();
        foreach($goodses as $k=>$goods){
            if($goods['column_status']==1){
                array_push($goods_lists,$goods);
            }
        }
        foreach ($goods_lists as $goods_list){
            foreach ($goods_list['goodses'] as $k=>$goods){
                $menu=MenuManager::getMenuById($goods['menu_id']);
                if($menu['status']==0){
                    unset($goods_list['goodses'][$k]);
                }
            }
        }
        return $goods_lists;
    }

    /*
     * 对所有商品做模糊查询（改）
     *
     * by zm
     *
     * 2018-04-19
     */
    public static function newGetGoodsesByName($search){
        //化学商城
        $chem_menu_id=ChemController::MENU_ID;
        $chem_column=ChemController::COLUMN;
        //第三方检测
        $testing_menu_id=TestingController::MENU_ID;
        $testing_column=TestingController::COLUMN;
        //机加工
        $machining_menu_id=MachiningController::MENU_ID;
        $machining_column=MachiningController::COLUMN;
//        $menus=MenuManager::getClassAMenuLists();
        $menus=MenuManager::getClassAMenuListswhichCanShow();
        foreach ($menus as $k=>$menu){
            if($menu['id']==$chem_menu_id){
                $chem_goodses=self::getAllChemClassesByMenuIdWithPage($search,$chem_menu_id);
                $goodses[$k]['goodses']=$chem_goodses;
                $goodses[$k]['column']=$chem_column;
                $goodses[$k]['column_id']=$chem_menu_id;
                $menu=MenuManager::getMenuById($chem_menu_id);
                $goodses[$k]['column_status']=$menu['status'];
            }
            else if($menu['id']==$testing_menu_id){
                $testing_goodses=self::getAllTestingGoodsListsByMenuId($search,$testing_menu_id);
                $goodses[$k]['goodses']=$testing_goodses;
                $goodses[$k]['column']=$testing_column;
                $goodses[$k]['column_id']=$testing_menu_id;
                $menu=MenuManager::getMenuById($testing_menu_id);
                $goodses[$k]['column_status']=$menu['status'];
            }
            else if($menu['id']==$machining_menu_id){
                $machining_goodses=self::getAllGoodsListsByMenuId($search,$machining_menu_id);
                foreach ($machining_goodses as $machining_goods){
                    $goods_id=$machining_goods['id'];
                    $attribute=GoodsManager::getGoodsMachiningAttributeByGoodsId($goods_id);
                    if($attribute){
                        $machining_goods['type']=0;
                    }
                    else{
                        $machining_goods['type']=1;
                    }
                }
                $goodses[$k]['goodses']=$machining_goodses;
                $goodses[$k]['column']=$machining_column;
                $goodses[$k]['column_id']=$machining_menu_id;
                $menu=MenuManager::getMenuById($machining_menu_id);
                $goodses[$k]['column_status']=$menu['status'];
            }
            $goodses[$k]['menu']=$menu;
        }
        $goods_lists=array();
        foreach($goodses as $k=>$goods){
            if($goods['column_status']==1){
                array_push($goods_lists,$goods);
            }
        }
        foreach ($goods_lists as $goods_list){
            foreach ($goods_list['goodses'] as $k=>$goods){
                $menu=MenuManager::getMenuById($goods['menu_id']);
                if($menu['status']==0){
                    unset($goods_list['goodses'][$k]);
                }
            }
        }
        return $goods_lists;
    }

    /*
     * 对所有商品做模糊查询（改）
     *
     * by zm
     *
     * 2018-04-19
     */
    public static function newGetGoodsesByNameWithPage($search,$menu_id){
        $paginate=self::PAGINATE;
        //化学商城
        $chem_menu_id=ChemController::MENU_ID;
        $chem_column=ChemController::COLUMN;
        //第三方检测
        $testing_menu_id=TestingController::MENU_ID;
        $testing_column=TestingController::COLUMN;
        //机加工
        $machining_menu_id=MachiningController::MENU_ID;
        $machining_column=MachiningController::COLUMN;
        $get=array(
            'goods_info.id as id',
            'goods_info.menu_id as menu_id',
            'goods_info.name as name',
            'goods_info.picture as picture',
            'goods_info.number as number',
            'menu_info.name as menu_name',
            'menu_info.menu_id as column_id',
        );
        if($menu_id){
            if($menu_id==$chem_menu_id){
                $goodses=GoodsModel::join('menu_info','menu_info.id','=','goods_info.menu_id')
                    ->join('goods_chem_attribute_info','goods_chem_attribute_info.goods_id','=','goods_info.id')
                    ->where(function($goodses) use ($search){
                        $goodses->where('goods_info.name','like','%'.$search.'%')
                            ->orwhere('goods_info.cas','like','%'.$search.'%')
                            ->orwhere('goods_info.number','like','%'.$search.'%');})
                    ->where('menu_info.menu_id',$menu_id)
                    ->groupBy('goods_chem_attribute_info.chem_class_id')
                    ->orderBy('goods_info.id','desc')
                    ->paginate($paginate,$get);
            }
            else{
                $goodses=GoodsModel::join('menu_info','menu_info.id','=','goods_info.menu_id')
                    ->where(function($goodses) use ($search){
                        $goodses->where('goods_info.name','like','%'.$search.'%')
                            ->orwhere('goods_info.cas','like','%'.$search.'%')
                            ->orwhere('goods_info.number','like','%'.$search.'%');})
                    ->where('menu_info.menu_id',$menu_id)
                    ->orderBy('goods_info.id','desc')
                    ->paginate($paginate,$get);
            }
        }
        else{
            $goodses=GoodsModel::join('menu_info','menu_info.id','=','goods_info.menu_id')
                ->where(function($goodses) use ($search){
                    $goodses->where('goods_info.name','like','%'.$search.'%')
                        ->orwhere('goods_info.cas','like','%'.$search.'%')
                        ->orwhere('goods_info.number','like','%'.$search.'%');})
                ->groupBy('goods_info.menu_id','goods_info.name')
                ->orderBy('goods_info.id','desc')->paginate($paginate,$get);
        }
        foreach ($goodses as $goods){
            if($goods['column_id']==$chem_menu_id){
                $goods['column_code']=$chem_column;
                $menu=MenuManager::getMenuById($chem_menu_id);
                $goods['column']=$menu;
                $attribute=GoodsChemAttributeModel::where('goods_id',$goods['id'])->first();
                $goods['chem_class_id']=$attribute['chem_class_id'];
            }
            else if($goods['column_id']==$testing_menu_id){
                $goods['column_code']=$testing_column;
                $menu=MenuManager::getMenuById($testing_menu_id);
                $goods['column']=$menu;
            }
            else if($goods['column_id']==$machining_menu_id){
                $goods['column_code']=$machining_column;
                $menu=MenuManager::getMenuById($machining_menu_id);
                $goods['column']=$menu;
                $goods_id=$goods['id'];
                $attribute=GoodsManager::getGoodsMachiningAttributeByGoodsId($goods_id);
                if($attribute){
                    $goods['type']=0;
                }
                else{
                    $goods['type']=1;
                }
            }
        }
        return $goodses;
    }




    /*
     * 根据goods_id获取商品开发和收费详情
     *
     * By zm
     *
     * 2018-04-20
     *
     */
    public static function getGoodsExplainByGoodsId($goods_id){
        $explains=GoodsExplainModel::where('goods_id',$goods_id)->orderBy('sort','asc')->get();
        return $explains;
    }

    /*
     * 根据id获取商品开发和收费详情
     *
     * By zm
     *
     * 2018-04-20
     *
     */
    public static function getGoodsExplainById($id){
        $explain=GoodsExplainModel::where('id',$id)->first();
        return $explain;
    }

    /*
     * 配置商品开发和收费详情的参数
     *
     * By zm
     *
     * 2018-04-20
     *
     */
    public static function setGoodsExplain($goods_explain, $data){
        if (array_key_exists('goods_id', $data)) {
            $goods_explain->goods_id = array_get($data, 'goods_id');
        }
        if (array_key_exists('content', $data)) {
            $goods_explain->content = array_get($data, 'content');
        }
        if (array_key_exists('type', $data)) {
            $goods_explain->type = array_get($data, 'type');
        }
        if (array_key_exists('sort', $data)) {
            $goods_explain->sort = array_get($data, 'sort');
        }
        return $goods_explain;
    }
}