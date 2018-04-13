<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/2/17
 * Time: 9:03
 */

namespace App\Http\Controllers\Home;

use App\Components\CartManager;
use App\Components\AttributeManager;
use App\Components\BannerManager;
use App\Components\CommentManager;
use App\Components\DrawingManager;
use App\Components\GoodsManager;
use App\Components\MenuManager;
use App\Components\QNManager;
use App\Components\ServiceManager;
use App\Http\Controllers\Controller;
use App\Models\DrawingModel;
use Illuminate\Http\Request;

class MachiningController extends Controller
{
    const MENU_ID = 3;  //一级栏目
    const COLUMN = 'machining';
    const SERVICE_ID = 3;  //客服id
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
        //生成七牛token
        $upload_token = QNManager::uploadToken();
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
                'upload_token'=>$upload_token,
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
                'upload_token'=>$upload_token,
                'service'=>$service
            );
        }
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
        //QQ客服
        $service=ServiceManager::getServiceById(self::SERVICE_ID);
        if($user){
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
        return view('home.machining.search',$param);
    }
    /*
     * 机加工加工类型详情页
     */
    public function machiningDetail(Request $request, $goods_id){
        $data=$request->all();
        $user=$request->cookie('user');
        $common=$data['common'];
        $column=self::COLUMN;
        $menu_id=self::MENU_ID;
        $goods = GoodsManager::getGoodsById($goods_id);
        $goods['attribute']=GoodsManager::getGoodsMachiningAttributeByGoodsId($goods_id);
        $goods['f_attribute']=AttributeManager::getAttributeById($goods['f_attribute_id']);
        $channel=MenuManager::getMenuById($goods['menu_id']);
        $channel['parent_channel']=MenuManager::getMenuById($menu_id);
        $goods['details']=GoodsManager::getGoodsDetailByGoodsId($goods_id);
        $goods['cases']=GoodsManager::getGoodsCaseByGoodsId($goods_id);
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
        return view('home.machining.detail_machining',$param);
    }
    /*
     * 国标商品详情页
     */
    public function standardDetail(Request $request, $goods_id){
        $data=$request->all();
        $user=$request->cookie('user');
        $common=$data['common'];
        $column=self::COLUMN;
        $menu_id=self::MENU_ID;
        $goods = GoodsManager::getGoodsById($goods_id);
        $goods['attribute']=GoodsManager::getGoodsStandardAttributeByGoodsId($goods_id);
        $goods['f_attribute']=AttributeManager::getAttributeById($goods['f_attribute_id']);
        $channel=MenuManager::getMenuById($goods['menu_id']);
        $channel['parent_channel']=MenuManager::getMenuById($menu_id);
        $goods['details']=GoodsManager::getGoodsDetailByGoodsId($goods_id);
        $goods['other_goodses']=GoodsManager::getStandardListsByComponent($goods['attribute']['id'],$goods['attribute']['component']);
        $comments=CommentManager::getGoodsCommentsByGoodsId($goods['id']);
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
                'service'=>$service,
                'comments'=>$comments
            );
        }
        else{
            $param=array(
                'common'=>$common,
                'column'=>$column,
                'user'=>$user,
                'channel'=>$channel,
                'goods'=>$goods,
                'service'=>$service,
                'comments'=>$comments
            );
        }
        return view('home.machining.detail_standard',$param);
    }

    /*
     * 上传机加工图纸
     */
    public function upload(Request $request){
        $data=$request->all();
        unset($data['common']);
        $return=null;
        $user=$request->cookie('user');
        if($user){
            $drawing=new DrawingModel();
            $data['user_id']=$user['id'];
            $data['content']=implode(",",$data['uploadImages']);;
            $drawing = DrawingManager::setDrawing($drawing,$data);
            $result=$drawing->save();
            if($result){
                $return['result']=true;
                $return['msg']='提交成功，请联系客服进行进一步沟通';
            }
            else{
                $return['result']=false;
                $return['msg']='提交失败';
            }
        }
        else{
            $return['result']=false;
            $return['msg']='提交失败，用户信息已过期或已经被清除，请重新登录';
        }
        return $return;
    }
}