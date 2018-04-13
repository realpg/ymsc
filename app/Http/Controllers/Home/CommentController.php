<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/4/10
 * Time: 16:22
 */

namespace App\Http\Controllers\Home;


class CommentController
{
    /*
     * 编辑评价
     */
    public function editDo(Request $request){
        $data=$request->all();
        $user=$request->cookie('user');
        $return=null;
        if($user){
            $user=MemberManager::getUserInfoByIdWithNotToken($user['id']);
            if(array_key_exists('goods_id',$data)&&array_key_exists('content',$data)){
//                $order=OrderManager::getOrderById($data['id']);
//                if($order['status']==2&&empty($order['logistics_company'])&&empty($order['logistics_no'])){
//                    $data['status']=4;
//                    $invoice=OrderManager::setOrder($order,$data);
//                    $result=$invoice->save();
//                    if($result){
//                        $return['result']=true;
//                        $return['msg']='申请退款成功，等待管理人员进行操作';
//                    }
//                    else{
//                        $return['result']=false;
//                        $return['msg']='申请退款失败';
//                    }
//                }
//                else{
//                    $return['result']=false;
//                    $return['msg']='非法操作';
//                }
                return $data;
            }
            else{
                $return['result']=false;
                $return['msg']='缺少参数';
            }
        }
        else{
            $return['result']=false;
            $return['msg']='评价失败，用户信息已过期或已经被清除，请重新登录';
        }
        return $return;
    }
}