<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/1/28
 * Time: 16:54
 */

namespace app\Http\Controllers\Admin;

use App\Components\GoodsManager;
use App\Components\MenuManager;
use App\Models\GoodsModel;
use Illuminate\Http\Request;

class GoodsController
{
    //首页
    public function index(Request $request){
        $data=$request->all();
        $admin = $request->session()->get('admin');
        //获取一级栏目
        $menu_lists=MenuManager::getMenuLists();
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
        //获取商品列表
        $goodses=GoodsManager::getAllGoodsListsByMenuId($search,$menu_id);
        //获取栏目信息
        $menu_info=MenuManager::getMenuById($menu_id);
        $param=array(
            'admin'=>$admin,
            'menu_lists'=>$menu_lists,
            'datas'=>$goodses,
            'menu_id'=>$menu_id,
            'menu_info'=>$menu_info
        );
        return view('admin.goods.index', $param);
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
                $goods = GoodsModel::find($id);
                $return=null;
                $result=$goods->delete();
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
        else{
            $return['result']=false;
            $return['msg']='合规校验失败，缺少参数';
        }
        return $return;
    }
    //批量删除
    public function delMore(Request $request)
    {
        $data=$request->all();
        if(array_key_exists('id_array',$data)){
            $id_array=explode(',',$data['id_array']);
            $goodses = GoodsManager::getGoodsByMoreId($id_array);
            $count=0;
            foreach ($goodses as $goods){
                $result=$goods->delete();
                if($result){
                    $count++;
                }
            }
            $return=null;
            if($count==count($goodses)){
                $return['result']=true;
                $return['msg']='删除成功';
            }
            else{
                $return['result']=false;
                $return['msg']='删除失败';
            }
        }
        else{
            $return['result']=false;
            $return['msg']='合规校验失败，缺少参数';
        }
        return $return;
    }
    //创建或编辑化学商品
    public function editChem(Request $request){
        $data = $request->all();
        $admin = $request->session()->get('admin');
        if(array_key_exists('menu_id', $data))
        {
            $menu_id=$data['menu_id'];
            $menu=MenuManager::getMenuById($menu_id);
            $ClassAGoodss=GoodsManager::getClassAGoodsLists($menu_id);
            if (array_key_exists('id', $data)) {
                $goods = GoodsManager::getGoodsById($data['id']);
            }
            else{
                $goods=new GoodsModel();
            }
            $param=array(
                'admin'=>$admin,
                'data'=>$goods,
                'menu'=>$menu,
                'ClassAGoodss'=>$ClassAGoodss
            );
            return view('admin.goods.edit', $param);
        }
        else{
            $param=array(
                'msg'=>'合规校验失败，缺少参数'
            );
            return view('admin.index.error500', $param);
        }
    }
    //创建或编辑化学商品
    public function editChemDo(Request $request){
        $data = $request->all();
        $admin = $request->session()->get('admin');
        $return=null;
        if(empty($data['id'])){
            if(array_key_exists('menu_id',$data)){
                $goods=new GoodsModel();
            }
            else{
                $return['result']=false;
                $return['msg']='缺少参数';
                return $return;
            }
        }
        else{
            $goods = GoodsManager::getGoodsById($data['id']);
        }
        $goods = GoodsManager::setGoods($goods,$data);
        $result=$goods->save();
        if($result){
            $return['result']=true;
            $return['msg']='编辑搜索属性成功';
        }
        else{
            $return['result']=false;
            $return['msg']='编辑搜索属性失败';
        }
        return $return;
    }
}