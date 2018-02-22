<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/2/17
 * Time: 9:03
 */

namespace app\Http\Controllers\Home;

use App\Components\AttributeManager;
use App\Components\BannerManager;
use App\Components\GoodsManager;
use App\Components\MenuManager;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class MachiningController extends Controller
{
    const MENU_ID = 3;  //一级栏目
    const COLUMN = 'machining';
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
            $menu['machining_goodses']=GoodsManager::getMachiningGoodsesWithHot($menu_id);
        }
        $param=array(
            'common'=>$common,
            'column'=>$column,
            'user'=>$user,
            'menus'=>$menus,
            'channel'=>$channel,
            'banners'=>$banners
        );
        return view('home.machining.index',$param);
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
        $goodses=GoodsManager::getMachiningClassByMenuId($goods_param);
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
        return view('home.machining.lists',$param);
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
        $goodses=GoodsManager::getMachiningClassBysearch($goods_param);
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
        return view('home.machining.search',$param);
    }
}