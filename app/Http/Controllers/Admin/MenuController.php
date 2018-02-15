<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/1/28
 * Time: 10:36
 */

namespace App\Http\Controllers\Admin;

use App\Components\GoodsManager;
use App\Components\MenuManager;
use App\Components\QNManager;
use App\Models\MenuModel;
use Illuminate\Http\Request;

class MenuController
{
    //首页
    public function index(Request $request){
        $data=$request->all();
        $admin = $request->session()->get('admin');
        //获取一级栏目
        $menu_lists=MenuManager::getClassAMenuLists();
        //判断是否有menu_id，如果没有默认第一条数据
        if(array_key_exists('menu_id',$data)){
            $menu_id=$data['menu_id'];
        }
        else{
            $menu_id=$menu_lists[0]['id'];
        }
        if(array_key_exists('search',$data)){
            $search=$data['search'];
        }
        else{
            $search='';
        }
        $menus=MenuManager::getAllMenuByMenuId($search,$menu_id);
        $param=array(
            'admin'=>$admin,
            'menu_lists'=>$menu_lists,
            'datas'=>$menus
        );
        return view('admin.menu.index', $param);
    }
    //删除
    public function del(Request $request)
    {
        $data=$request->all();
        if(array_key_exists('id',$data)){
            $id=$data['id'];
            if (is_numeric($id) !== true) {
                $return['result']=false;
                $return['msg']='合规校验失败，参数类型不正确';
            }
            else{
                $menu = MenuModel::find($id);
                $return=null;
                $goodses=GoodsManager::getAllGoodsByMenuId($menu['id']);
                if($goodses){
                    $return['result']=false;
                    $return['msg']='删除失败,为了保证网站正常运行，请先将该栏目下的商品删除或转移到其他栏目下';
                }
                else{
                    $result=$menu->delete();
                    if($result){
                        $return['result']=true;
                        $return['msg']='删除成功';
                    }
                    else{
                        $return['result']=false;
                        $return['msg']='删除失败';
                    }
                }
            }
        }
        else{
            $return['result']=false;
            $return['msg']='合规校验失败，缺少参数';
        }
        return $return;
    }
    //创建或编辑栏目
    public function edit(Request $request){
        $data = $request->all();
        $admin = $request->session()->get('admin');
        if(array_key_exists('menu_id', $data))
        {
            $menu_id=$data['menu_id'];
            $menuClassA=MenuManager::getMenuById($menu_id);
            if (array_key_exists('id', $data)) {
                $menu = MenuManager::getMenuById($data['id']);
            }
            else{
                $menu=new MenuModel();
            }
            //生成七牛token
            $upload_token = QNManager::uploadToken();
            $param=array(
                'admin'=>$admin,
                'data'=>$menu,
                'menuClassA'=>$menuClassA,
                'upload_token'=>$upload_token
            );
            return view('admin.menu.edit', $param);
        }
        else{
            $param=array(
                'msg'=>'合规校验失败，缺少参数'
            );
            return view('admin.index.error500', $param);
        }
    }
    //创建或编辑栏目执行
    public function editDo(Request $request){
        $data = $request->all();
        $admin = $request->session()->get('admin');
        $return=null;
        if(empty($data['id'])){
            if(array_key_exists('menu_id',$data)){
                $menu=new MenuModel();
            }
            else{
                $return['result']=false;
                $return['msg']='缺少参数';
                return $return;
            }
        }
        else{
            $menu = MenuManager::getMenuById($data['id']);
        }
        $menu = MenuManager::setMenu($menu,$data);
        $result=$menu->save();
        if($result){
            $return['result']=true;
            $return['msg']='编辑栏目成功';
        }
        else{
            $return['result']=false;
            $return['msg']='编辑栏目失败';
        }
        return $return;
    }
}