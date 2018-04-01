<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/2/17
 * Time: 7:15
 */

namespace App\Http\Controllers\Home;

use App\Components\CartManager;
use App\Components\AttributeManager;
use App\Components\BannerManager;
use App\Components\GoodsManager;
use App\Components\MenuManager;
use App\Components\ServiceManager;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TestingController extends Controller
{
    const MENU_ID = 2;  //一级栏目
    const COLUMN = 'testing';
    const SERVICE_ID = 2;  //客服id
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
            $menu['testing_goodses']=GoodsManager::getTestingGoodsesWithHot($menu_id);
        }
        //QQ客服
        $service=ServiceManager::getServiceById(self::SERVICE_ID);
        if($user) {
            //购物车信息
            $carts = CartManager::getCartsByUserId($user['id']);
            $param=array(
                'common'=>$common,
                'column'=>$column,
                'user'=>$user,
                'menus'=>$menus,
                'channel'=>$channel,
                'banners'=>$banners,
                'carts'=>$carts,
                'service'=>$service
            );
        }
        else{
            $param=array(
                'common'=>$common,
                'column'=>$column,
                'user'=>$user,
                'menus'=>$menus,
                'channel'=>$channel,
                'banners'=>$banners,
                'service'=>$service
            );
        }
        return view('home.testing.index',$param);
    }
    /*
     * 列表页
     */
    public function lists(Request $request, $menu_id, $f_attribute_id='',  $s_attribute_id=''){
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
        $goodses=GoodsManager::getTestingClassByMenuId($goods_param);
        //QQ客服
        $service=ServiceManager::getServiceById(self::SERVICE_ID);
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
                'service'=>$service
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
                'service'=>$service
            );
        }
        return view('home.testing.lists',$param);
    }
    /*
     * 模糊查询
     */
    public function search(Request $request, $f_attribute_id='',  $s_attribute_id=''){
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
        $goodses=GoodsManager::getTestingClassBysearch($goods_param);
        //QQ客服
        $service=ServiceManager::getServiceById(self::SERVICE_ID);
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
                'carts'=>$carts,
                'service'=>$service
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
                'search'=>$search,
                'service'=>$service
            );
        }
        return view('home.testing.search',$param);
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
        $goods['attribute']=GoodsManager::getGoodsTestingAttributeByGoodsId($goods_id);
        $goods['f_attribute']=AttributeManager::getAttributeById($goods['f_attribute_id']);
        $goods['s_attribute']=AttributeManager::getAttributeById($goods['s_attribute_id']);
        $channel=MenuManager::getMenuById($goods['menu_id']);
        $channel['parent_channel']=MenuManager::getMenuById($menu_id);
        $goods['details']=GoodsManager::getGoodsDetailByGoodsId($goods_id);
        //QQ客服
        $service=ServiceManager::getServiceById(self::SERVICE_ID);
        if($user) {
            //购物车信息
            $carts = CartManager::getCartsByUserId($user['id']);
            $param=array(
                'common'=>$common,
                'column'=>$column,
                'user'=>$user,
                'channel'=>$channel,
                'goods'=>$goods,
                'carts'=>$carts,
                'service'=>$service
            );
        }
        else{
            $param=array(
                'common'=>$common,
                'column'=>$column,
                'user'=>$user,
                'channel'=>$channel,
                'goods'=>$goods,
                'service'=>$service
            );
        }
        return view('home.testing.detail',$param);
    }
}