<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/2/10
 * Time: 14:30
 */

namespace app\Http\Controllers\Home;

use App\Components\AttributeManager;
use App\Components\BannerManager;
use App\Components\GoodsManager;
use App\Components\MenuManager;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ChemController extends Controller
{
    const MENU_ID = 1;  //一级栏目
    public function index(Request $request){
        $data=$request->all();
        $user=$request->cookie('user');
        $common=$data['common'];
        $column='chem';
        $menu_id=self::MENU_ID;
        $menus=MenuManager::getAllMenuListsByMenuId($menu_id);
        $banners=BannerManager::getBannersByMenuId($menu_id);
        $channel=MenuManager::getMenuById($menu_id);
        foreach ($menus as $menu){
            $menu_id=$menu['id'];
            $menu['chem_classes']=GoodsManager::getChemClassWithHot($menu_id);
        }
        $param=array(
            'common'=>$common,
            'column'=>$column,
            'user'=>$user,
            'menus'=>$menus,
            'channel'=>$channel,
            'banners'=>$banners
        );
        return view('home.chem.index',$param);
    }
    /*
     * 列表页
     */
    public function lists(Request $request, $menu_id, $f_attribute_id='', $s_attribute_id=''){
        $data=$request->all();
        $user=$request->cookie('user');
        $common=$data['common'];
        $column='chem';
        $channel=MenuManager::getMenuById($menu_id);
        $parant_menu_id=self::MENU_ID;
        $channel['parent_channel']=MenuManager::getMenuById($parant_menu_id);
        $attributes=AttributeManager::getClassAAttributeListsByMenuId($parant_menu_id);
        $goods_param=array(
            'menu_id'=>$menu_id,
            'f_attribute_id'=>$f_attribute_id,
            's_attribute_id'=>$s_attribute_id
        );
        $goodses=GoodsManager::getChemClassByMenuId($goods_param);
        $param=array(
            'common'=>$common,
            'column'=>$column,
            'user'=>$user,
            'channel'=>$channel,
            'attributes'=>$attributes,
            'goodses'=>$goodses
        );
        return view('home.chem.lists',$param);
    }
}