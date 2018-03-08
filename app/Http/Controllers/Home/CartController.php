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
            //购物车信息
            $carts = CartManager::getCartsByUserId($user['id']);
            $column='cart';
            $progress=1;
            $param=array(
                'common'=>$common,
                'column'=>$column,
                'user'=>$user,
                'carts'=>$carts,
                'progress'=>$progress
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

    /*
     * 删除购物车
     */
    public function del(Request $request){
        $data=$request->all();
        $user=$request->cookie('user');
        $return=null;
        if($user){
            if(array_key_exists('id',$data)){
                $id=$data['id'];
                if (is_numeric($id) !== true) {
                    $return['result']=false;
                    $return['msg']='合规校验失败，参数类型不正确';
                }
                else{
                    $cart = CartModel::find($id);
                    $result=$cart->delete();
                    if($result){
                        $return['result']=true;
                        $return['msg']='删除购物车成功';
                    }
                    else{
                        $return['result']=false;
                        $return['msg']='删除购物车失败';
                    }
                }
            }
            else{
                $return['result']=false;
                $return['msg']='缺少参数';
            }
        }
        else{
            $return['result']=false;
            $return['msg']='删除购物车失败，用户信息已过期或已经被清除，请重新登录';
        }
        return $return;
    }

    /*
     * 批量删除购物车
     */
    public function delMore(Request $request)
    {
        $data=$request->all();
        $user=$request->cookie('user');
        $return=null;
        if($user) {
            if (array_key_exists('id_array', $data)) {
                $id_array = explode(',', $data['id_array']);
                $carts = CartManager::getCartByMoreId($id_array);
                $count = 0;
                foreach ($carts as $cart) {
                    $result = $cart->delete();
                    if ($result) {
                        $count++;
                    }
                }
                $return = null;
                if ($count == count($carts)) {
                    $return['result'] = true;
                    $return['msg'] = '删除成功';
                } else {
                    $return['result'] = false;
                    $return['msg'] = '删除失败';
                }
            } else {
                $return['result'] = false;
                $return['msg'] = '合规校验失败，缺少参数';
            }
        }
        else{
            $return['result']=false;
            $return['msg']='删除购物车失败，用户信息已过期或已经被清除，请重新登录';
        }
        return $return;
    }
}