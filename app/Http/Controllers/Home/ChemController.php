<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/2/10
 * Time: 14:30
 */

namespace App\Http\Controllers\Home;

use App\Components\CartManager;
use App\Components\AttributeManager;
use App\Components\BannerManager;
use App\Components\GoodsManager;
use App\Components\MenuManager;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Components\Utils;

class ChemController extends Controller
{
    const MENU_ID = 1;  //一级栏目
    const COLUMN = 'chem';
    public function index(Request $request){
        $data=$request->all();
        $user=$request->cookie('user');
        $common=$data['common'];
        $column=self::COLUMN;
        $menu_id=self::MENU_ID;
        $menus=MenuManager::getAllMenuListsByMenuId($menu_id);
        $banners=BannerManager::getBannersByMenuId($menu_id);
        $channel=MenuManager::getMenuById($menu_id);
        foreach ($menus as $menu){
            $menu_id=$menu['id'];
            $menu['chem_classes']=GoodsManager::getChemClassWithHot($menu_id);
        }
        if($user){
            //购物车信息
            $carts = CartManager::getCartsByUserId($user['id']);
            $param=array(
                'common'=>$common,
                'column'=>$column,
                'user'=>$user,
                'menus'=>$menus,
                'channel'=>$channel,
                'banners'=>$banners,
                'carts'=>$carts
            );
        }
        else{
            $param=array(
                'common'=>$common,
                'column'=>$column,
                'user'=>$user,
                'menus'=>$menus,
                'channel'=>$channel,
                'banners'=>$banners
            );
        }
        return view('home.chem.index',$param);
    }
    /*
     * 列表页
     */
    public function lists(Request $request, $menu_id, $f_attribute_id='', $s_attribute_id=''){
        set_time_limit(0);
        $data=$request->all();
        $user=$request->cookie('user');
        $common=$data['common'];
        $column=self::COLUMN;
        $channel=MenuManager::getMenuById($menu_id);
        $parant_menu_id=self::MENU_ID;
        $channel['parent_channel']=MenuManager::getMenuById($parant_menu_id);
        $attributes=AttributeManager::getClassAAttributeListsByMenuId($parant_menu_id);
        $goods_param=array(
            'menu_id'=>$menu_id,
            'f_attribute_id'=>$f_attribute_id,
            's_attribute_id'=>$s_attribute_id
        );
//        $goodses=GoodsManager::getChemClassByMenuId($goods_param);  //原
        $goodses=GoodsManager::newGetChemClassByMenuId($goods_param);  //改
        if($user) {
            //购物车信息
            $carts = CartManager::getCartsByUserId($user['id']);
            $param=array(
                'common'=>$common,
                'column'=>$column,
                'user'=>$user,
                'channel'=>$channel,
                'attributes'=>$attributes,
                'goodses'=>$goodses,
                'f_attribute_id'=>$f_attribute_id,
                's_attribute_id'=>$s_attribute_id,
                'carts'=>$carts,
            );
        }
        else{
            $param=array(
                'common'=>$common,
                'column'=>$column,
                'user'=>$user,
                'channel'=>$channel,
                'attributes'=>$attributes,
                'goodses'=>$goodses,
                'f_attribute_id'=>$f_attribute_id,
                's_attribute_id'=>$s_attribute_id
            );
        }
        return view('home.chem.lists',$param);
    }
    /*
     * 搜索
     */
    public function search(Request $request, $f_attribute_id='', $s_attribute_id=''){
        set_time_limit(0);
        $data=$request->all();
        $user=$request->cookie('user');
        $common=$data['common'];
        $column=self::COLUMN;
        $menu_id=self::MENU_ID;
        $search=$data['search'];
        $channel=MenuManager::getMenuById($menu_id);
        $attributes=AttributeManager::getClassAAttributeListsByMenuId($menu_id);
        $goods_param=array(
            'menu_id'=>$menu_id,
            'search'=>$search,
            'f_attribute_id'=>$f_attribute_id,
            's_attribute_id'=>$s_attribute_id
        );
//        $goodses=GoodsManager::getChemClassBySearch($goods_param);  //原
        $goodses=GoodsManager::newGetChemClassBySearch($goods_param);  //改
        if(count($goodses)){
            if($user) {
                //购物车信息
                $carts = CartManager::getCartsByUserId($user['id']);
                $param=array(
                    'common'=>$common,
                    'column'=>$column,
                    'user'=>$user,
                    'channel'=>$channel,
                    'attributes'=>$attributes,
                    'goodses'=>$goodses,
                    'f_attribute_id'=>$f_attribute_id,
                    's_attribute_id'=>$s_attribute_id,
                    'search'=>$search,
                    'carts'=>$carts
                );
            }
            else{
                $param=array(
                    'common'=>$common,
                    'column'=>$column,
                    'user'=>$user,
                    'channel'=>$channel,
                    'attributes'=>$attributes,
                    'goodses'=>$goodses,
                    'f_attribute_id'=>$f_attribute_id,
                    's_attribute_id'=>$s_attribute_id,
                    'search'=>$search
                );
            }
            return view('home.chem.search',$param);
        }
        else{
            return redirect('missing');
        }
    }
    /*
     * 大类页
     */
    public function classlists(Request $request, $class_id, $f_attribute_id='', $s_attribute_id=''){
        set_time_limit(0);
        $data=$request->all();
        $user=$request->cookie('user');
        $common=$data['common'];
        $column=self::COLUMN;
        $menu_id=self::MENU_ID;
        $class=GoodsManager::getAllChemClassByChemClassId($class_id);
        $channel=MenuManager::getMenuById($menu_id);
        $attributes=AttributeManager::getClassAAttributeListsByMenuId($menu_id);
        $goods_param=array(
            'class_id'=>$class_id,
            'f_attribute_id'=>$f_attribute_id,
            's_attribute_id'=>$s_attribute_id
        );
        $chem_class=GoodsManager::getGoodsesByClassId($goods_param);
        if($user) {
            //购物车信息
            $carts = CartManager::getCartsByUserId($user['id']);
            $param=array(
                'common'=>$common,
                'column'=>$column,
                'user'=>$user,
                'class'=>$class,
                'channel'=>$channel,
                'attributes'=>$attributes,
                'chem_class'=>$chem_class,
                'f_attribute_id'=>$f_attribute_id,
                's_attribute_id'=>$s_attribute_id,
                'carts'=>$carts
            );
        }
        else{
            $param=array(
                'common'=>$common,
                'column'=>$column,
                'user'=>$user,
                'class'=>$class,
                'channel'=>$channel,
                'attributes'=>$attributes,
                'chem_class'=>$chem_class,
                'f_attribute_id'=>$f_attribute_id,
                's_attribute_id'=>$s_attribute_id
            );
        }
        return view('home.chem.classlists',$param);
    }
    /*
     * 商品详情页
     */
    public function detail(Request $request, $goods_id){
        $data=$request->all();
        $user=$request->cookie('user');
        $common=$data['common'];
        $column=self::COLUMN;
        $menu_id=self::MENU_ID;
        $goods = GoodsManager::getGoodsById($goods_id);
        $goods['attribute']=GoodsManager::getGoodsChemAttributeByGoodsId($goods_id);
        $goods['chem_class']=GoodsManager::getAllChemClassByChemClassId($goods['attribute']['chem_class_id']);
        $goods['f_attribute']=AttributeManager::getAttributeById($goods['f_attribute_id']);
        if($goods['f_attribute']){
            $goods['f_attribute']['father']=AttributeManager::getAttributeById($goods['f_attribute']['attribute_id']);
        }
        $goods['s_attribute']=AttributeManager::getAttributeById($goods['s_attribute_id']);
        if($goods['s_attribute']){
            $goods['s_attribute']['father']=AttributeManager::getAttributeById($goods['s_attribute']['attribute_id']);
        }
        $channel=MenuManager::getMenuById($goods['menu_id']);
        $channel['parent_channel']=MenuManager::getMenuById($menu_id);
        $goods['other_goodses']=GoodsManager::getChemClassByAttribute($goods);
        if($user) {
            //购物车信息
            $carts = CartManager::getCartsByUserId($user['id']);
            $param=array(
                'common'=>$common,
                'column'=>$column,
                'user'=>$user,
                'channel'=>$channel,
                'goods'=>$goods,
                'carts'=>$carts
            );
        }
        else{
            $param=array(
                'common'=>$common,
                'column'=>$column,
                'user'=>$user,
                'channel'=>$channel,
                'goods'=>$goods
            );
        }
        return view('home.chem.detail',$param);
    }
}