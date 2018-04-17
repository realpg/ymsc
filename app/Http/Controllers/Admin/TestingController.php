<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/1/29
 * Time: 11:53
 */

namespace app\Http\Controllers\Admin;

use App\Components\AttributeManager;
use App\Components\GoodsManager;
use App\Components\MenuManager;
use App\Components\QNManager;
use App\Models\GoodsDetailModel;
use App\Models\GoodsModel;
use App\Models\GoodsTestingAttributeModel;
use Illuminate\Http\Request;

class TestingController
{
    const MENU_ID = 2;  //一级栏目
    const F_ATTRIBUTE_ID = 3;  //第一搜索属性
    const S_ATTRIBUTE_ID = 4;  //第二搜索属性
    //首页
    public function index(Request $request){
        $data=$request->all();
        $admin = $request->session()->get('admin');
        //获取二级栏目
        $menu_default=self::MENU_ID;
        $menu_lists=MenuManager::getAllMenuListsByMenuId($menu_default);
        //判断是否有menu_id，如果没有默认第一条数据
        if(array_key_exists('menu_id',$data)){
            if(empty($data['menu_id'])){
                $menu_id=$menu_default;
            }
            else{
                $menu_id=$data['menu_id'];
            }
        }
        else{
            $menu_id=$menu_default;
        }
        if(array_key_exists('search',$data)){
            $search=$data['search'];
        }
        else{
            $search='';
        }
        //获取商品列表
//        $goodses=GoodsManager::getAllGoodsListsByMenuId($search,$menu_id);  //没有分页
        $goodses=GoodsManager::getAllGoodsListsByMenuIdWithPage($search,$menu_id);  //有分页
        //获取栏目信息
        $menu_info=MenuManager::getMenuById($menu_id);
        $param=array(
            'admin'=>$admin,
            'menu_lists'=>$menu_lists,
            'datas'=>$goodses,
            'menu_id'=>$menu_id,
            'menu_info'=>$menu_info,
            'search'=>$search
        );
        return view('admin.testing.index', $param);
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
    //创建或编辑
    public function edit(Request $request){
        $data = $request->all();
        $admin = $request->session()->get('admin');
        $menu_id=self::MENU_ID;
        $menus=MenuManager::getAllMenuListsByMenuId($menu_id);
        $fields=AttributeManager::getAttributeByAttributeId(self::F_ATTRIBUTE_ID);
        $instruments=AttributeManager::getAttributeByAttributeId(self::S_ATTRIBUTE_ID);
        if (array_key_exists('id', $data)) {
            $goods = GoodsManager::getGoodsById($data['id']);
            //获取商品详情
            $goods_details=GoodsManager::getGoodsDetailByGoodsId($data['id']);
            $goods['details']=$goods_details;
            //获取商品的属性
            $goods_attribute=GoodsManager::getGoodsTestingAttributeByGoodsId($data['id']);
            if($goods_attribute){
                $goods['attribute']=$goods_attribute;
            }
        }
        else{
            $goods=new GoodsModel();
        }
        //生成七牛token
        $upload_token = QNManager::uploadToken();
        $param=array(
            'admin'=>$admin,
            'data'=>$goods,
            'menus'=>$menus,
            'fields'=>$fields,
            'instruments'=>$instruments,
            'upload_token'=>$upload_token
        );
        return view('admin.testing.edit', $param);
    }
    //创建或编辑
    public function editDo(Request $request){
        $data = $request->all();
        $admin = $request->session()->get('admin');
        $return=null;
        if(empty($data['id'])){
            if(array_key_exists('menu_id',$data)){
                $goods=new GoodsModel();
                $data['number']=self::ProduceCommodityNumber($data['menu_id']);
            }
            else{
                $return['result']=false;
                $return['msg']='缺少参数';
                return $return;
            }
        }
        else{
            $goods = GoodsManager::getGoodsById($data['id']);
            //获取商品的属性
            $goods_attribute=GoodsManager::getGoodsTestingAttributeByGoodsId($data['id']);
            $data_attribute['goods_id']=$data['id'];
            $data_attribute['lab']=$data['lab'];
            $data_attribute['contacts']=$data['contacts'];
            $data_attribute['address']=$data['address'];
            $data_attribute['explain']=$data['explain'];
            if(!$goods_attribute){
                $goods_attribute=new GoodsTestingAttributeModel();
            }
            $goods_attribute=GoodsManager::setGoodsTestingAttribute($goods_attribute,$data_attribute);
            $goods_attribute->save();
        }
        $data['price']=$data['price']*100;
        $goods = GoodsManager::setGoods($goods,$data);
        $result=$goods->save();
        if($result){
            $return['result']=true;
            $return['msg']='编辑商品成功';
        }
        else{
            $return['result']=false;
            $return['msg']='编辑商品失败';
        }
        return $return;
    }

    //删除商品详情
    public function delDetail(Request $request)
    {
        $data=$request->all();
        if(array_key_exists('id',$data)){
            $id=$data['id'];
            if (is_numeric($id) !== true) {
                $return['result']=false;
                $return['msg']='合规校验失败，参数类型不正确';
            }
            else{
                $goods_detail = GoodsDetailModel::find($id);
                $return=null;
                $result=$goods_detail->delete();
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
    //编辑商品详情执行
    public function editDoDetail(Request $request){
        $data = $request->all();
        $admin = $request->session()->get('admin');
        $return=null;
        if(array_key_exists('id', $data)){
            $goods_detail = GoodsManager::getGoodsDetailById($data['id']);
        }
        else{
            $goods_detail=new GoodsDetailModel();
        }
        $goods_detail = GoodsManager::setGoodsDetail($goods_detail,$data);
        $result=$goods_detail->save();
        if($result){
            $return['result']=true;
            $return['ret']=GoodsManager::getGoodsDetailById($goods_detail->id);
            $return['msg']='编辑商品详情成功';
        }
        else{
            $return['result']=false;
            $return['msg']='编辑商品详情失败';
        }
        return $return;
    }

    //生成商品号
    public function ProduceCommodityNumber($menu_id){
        $menu=MenuManager::getMenuById($menu_id);
        $prefix=$menu['prefix'];
        $number=$prefix.time().rand(100,1000);
        return $number;
    }
}