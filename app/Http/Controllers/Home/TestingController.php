<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/2/17
 * Time: 7:15
 */

namespace app\Http\Controllers\Home;

use App\Components\BannerManager;
use App\Components\GoodsManager;
use App\Components\MenuManager;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TestingController extends Controller
{
    const MENU_ID = 2;  //一级栏目
    public function index(Request $request){
        $data=$request->all();
        $user=$request->cookie('user');
        $common=$data['common'];
        $column='testing';
        $menu_id=self::MENU_ID;
        $menus=MenuManager::getAllMenuListsByMenuId($menu_id);
        $banners=BannerManager::getBannersByMenuId($menu_id);
        $channel=MenuManager::getMenuById($menu_id);
        foreach ($menus as $menu){
            $menu_id=$menu['id'];
            $menu['testing_goodses']=GoodsManager::getTestingGoodsesWithHot($menu_id);
        }
        $param=array(
            'common'=>$common,
            'column'=>$column,
            'user'=>$user,
            'menus'=>$menus,
            'channel'=>$channel,
            'banners'=>$banners
        );
        return view('home.testing.index',$param);
    }
}