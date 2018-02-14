<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/2/10
 * Time: 14:30
 */

namespace app\Http\Controllers\Home;

use App\Components\BannerManager;
use App\Components\GoodsManager;
use App\Components\MenuManager;
use Illuminate\Http\Request;

class ChemController
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
        foreach ($menus as $menu){
            $menu_id=$menu['id'];
            $menu['chem_classes']=GoodsManager::getChemClassWithHot($menu_id);
        }
        $param=array(
            'common'=>$common,
            'column'=>$column,
            'user'=>$user,
            'menus'=>$menus,
            'banners'=>$banners
        );
        return view('home.chem.index',$param);
    }
}