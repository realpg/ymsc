<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/1/28
 * Time: 14:23
 */

namespace App\Http\Controllers\Admin;

use App\Components\AdminManager;
use App\Components\AttributeManager;
use App\Components\MenuManager;
use App\Models\AttributeModel;
use Illuminate\Http\Request;

class AttributeController
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
        $attributes=AttributeManager::getAllAttributeByMenuId($search,$menu_id);
        $param=array(
            'admin'=>$admin,
            'menu_lists'=>$menu_lists,
            'datas'=>$attributes,
            'menu_id'=>$menu_id
        );
        return view('admin.attribute.index', $param);
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
                $attribute = AttributeModel::find($id);
                $return=null;
                $result=$attribute->delete();
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
    //创建或编辑搜索属性
    public function edit(Request $request){
        $data = $request->all();
        $admin = $request->session()->get('admin');
        if(array_key_exists('menu_id', $data))
        {
            $menu_id=$data['menu_id'];
            $menu=MenuManager::getMenuById($menu_id);
            $ClassAAttributes=AttributeManager::getClassAAttributeLists($menu_id);
            if (array_key_exists('id', $data)) {
                $attribute = AttributeManager::getAttributeById($data['id']);
            }
            else{
                $attribute=new AttributeModel();
            }
            $param=array(
                'admin'=>$admin,
                'data'=>$attribute,
                'menu'=>$menu,
                'ClassAAttributes'=>$ClassAAttributes
            );
            return view('admin.attribute.edit', $param);
        }
        else{
            $param=array(
                'msg'=>'合规校验失败，缺少参数'
            );
            return view('admin.index.error500', $param);
        }
    }
    //创建或编辑搜索属性
    public function editDo(Request $request){
        $data = $request->all();
        $admin = $request->session()->get('admin');
        $return=null;
        if(empty($data['id'])){
            if(array_key_exists('menu_id',$data)){
                $attribute=new AttributeModel();
            }
            else{
                $return['result']=false;
                $return['msg']='缺少参数';
                return $return;
            }
        }
        else{
            $attribute = AttributeManager::getAttributeById($data['id']);
        }
        $attribute = AttributeManager::setAttribute($attribute,$data);
        $result=$attribute->save();
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