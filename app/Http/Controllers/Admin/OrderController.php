<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/3/15
 * Time: 18:38
 */

namespace App\Http\Controllers\Admin;

use App\Components\AddressManager;
use App\Components\InvoiceManager;
use App\Components\OrderManager;
use App\Components\SuborderManager;
use Illuminate\Http\Request;

class OrderController
{
    //首页
    public function index(Request $request)
    {
        $data = $request->all();
        $admin = $request->session()->get('admin');
        if(array_key_exists('search',$data)){
            $search=$data['search'];
        }
        else{
            $search='';
        }
        $orders = OrderManager::getOrdersBySearch($search);
        $param=array(
            'admin'=>$admin,
            'datas'=>$orders,
        );
        return view('admin.order.index', $param);
    }

    //查看订单详情
    public function edit(Request $request){
        $data = $request->all();
        $admin = $request->session()->get('admin');
        $order=OrderManager::getOrderById($data['id']);
        $order['address']=AddressManager::getAddressById($order['address_id']);
        $order['invoice']=InvoiceManager::getInvoiceById($order['invoice_id']);
        $order['suborders']=SuborderManager::getSubordersByTradeNo($order['trade_no']);
        $param=array(
            'admin'=>$admin,
            'data'=>$order,
        );
        return view('admin.order.edit', $param);
    }

    //编辑物流信息信息
    public function logisticsDo(Request $request){
        $data = $request->all();
        $admin = $request->session()->get('admin');
        $return=null;
        if(array_key_exists('id', $data)){
            $order = OrderManager::getOrderById($data['id']);
            if($order['status']==2||$order['status']==6){
                $data['status']=2;
                $order = OrderManager::setOrder($order,$data);
                $result=$order->save();
                if($result){
                    $return['result']=true;
                    $return['msg']='编辑物流信息成功';
                }
                else{
                    $return['result']=false;
                    $return['msg']='编辑物流信息失败';
                }
            }
            else{
                $return['result']=false;
                $return['msg']='此状态下无法编辑物流信息！只有在客户付款成功或退款失败的时候才可以进行物流提交！';
            }
        }
        else{
            $param=array(
                'msg'=>'合规校验失败，缺少参数'
            );
            return view('admin.index.error500', $param);
        }
        return $return;
    }
}