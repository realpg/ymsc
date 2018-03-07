<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/3/7
 * Time: 9:29
 */

namespace App\Http\Controllers\Home;

use App\Components\CartManager;
use App\Components\MemberManager;
use App\Models\CartModel;
use Illuminate\Http\Request;

class CartController
{
    /*
     * 购物车页面
     */
    public function index(Request $request){
        $data=$request->all();
        $user=$request->cookie('user');
        $common=$data['common'];
        if($user){
            $user=MemberManager::getUserInfoByIdWithNotToken($user['id']);
            $column='cart';
            $param=array(
                'common'=>$common,
                'column'=>$column,
                'user'=>$user,
            );
            return view('home.cart.index',$param);
        }
        else{
            return redirect('signIn');
        }
    }

    /*
     * 编辑购物车
     */
    public function editDo(Request $request){
        $data=$request->all();
        $user=$request->cookie('user');
        $return=null;
        if($user){
            if(array_key_exists('id',$data)){
                $cart=CartManager::getCartInfoById($data['id']);
            }
            else{
                //判断购物车中是否有此商品
                $cart=CartManager::getCartInfoByGoodsIdAndUserId($data['goods_id'],$user['id']);
                if($cart){
                    $data['count']=$data['count']+$cart['count'];
                }
                else{
                    $cart=new CartModel();
                }
            }
            $data['user_id']=$user['id'];
            $cart=CartManager::setCart($cart,$data);
            $result=$cart->save();
            if($result){
                $return['result']=true;
                $return['msg']='添加购物车成功';
            }
            else{
                $return['result']=false;
                $return['msg']='添加购物车失败';
            }
        }
        else{
            $return['result']=false;
            $return['msg']='请先登录';
        }
        return $return;
    }
}