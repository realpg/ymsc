<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/1/28
 * Time: 9:41
 */

namespace App\Http\Controllers\Admin;

use App\Components\AttributeManager;
use App\Components\MenuManager;
use Illuminate\Http\Request;

class ChemController
{
    //首页
    public function index(Request $request){
        $data=$request->all();
        $admin = $request->session()->get('admin');
        $menu_id=1;
        //栏目管理
        $menus=MenuManager::getMenuByMenuId($menu_id);
        //搜索属性管理
        $attributes=AttributeManager::getAttributeByMenuId($menu_id);
        //商品管理
        if(array_key_exists('search',$data)){
            $search=$data['search'];
        }
        else{
            $search='';
        }
    }

}