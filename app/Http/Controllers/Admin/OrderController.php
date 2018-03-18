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
use App\Components\Utils;
use Illuminate\Http\Request;

class OrderController
{
    //首页
    public function index(Request $request)
    {
        $data = $request->all();
        $admin = $request->session()->get('admin');
        if(array_key_exists('status',$data)){
            $status=$data['status'];
        }
        else{
            $status='';
        }
        if(array_key_exists('logistics',$data)){
            $logistics=$data['logistics'];
        }
        else{
            $logistics='';
        }
        if(array_key_exists('search',$data)){
            $search=$data['search'];
        }
        else{
            $search='';
        }
        $orders = OrderManager::getOrdersBySearch($status,$logistics,$search);
        $param=array(
            'admin'=>$admin,
            'datas'=>$orders,
            'status'=>$status,
            'logistics'=>$logistics
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
        $order['expressComs']=self::getExpressComs();
        $order['expressComs']=$order['expressComs']['ret']['result'];
        if($order['logistics_company']&&$order['logistics_no']){
            $order['logistics']=self::getlogisticsInfoByNo($order['logistics_company'],$order['logistics_no']);
        }
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

    /*
     * 获取物流信息
     */
    public function getlogisticsInfoByNo($com, $no){
        $param = array(
            'pro_code' => Utils::PRO_CODE,       //项目pro_code应该统一管理，建议在Utils中定义一个通用变量
            'com' => $com,//物流公司编号
            'no' => $no,//物流单号
        );
        $result = Utils::curl('http://common.isart.me/api/common/express/getByNo', $param, true);   //访问接口
        if($result){
            $result = json_decode($result, true);   //因为返回的已经是json数据，为了适配makeResponse方法，所以进行json转数组操作
        }
        return $result;
    }

    //点击退款成功
    public function refundSuccessDo(Request $request){
        $data = $request->all();
        $admin = $request->session()->get('admin');
        $return=null;
        if(array_key_exists('id', $data)){
            $order = OrderManager::getOrderById($data['id']);
            if($order['status']==4&&empty($order['logistics_company'])&&empty($order['logistics_no'])){
                $data['status']=5;
                $order = OrderManager::setOrder($order,$data);
                $result=$order->save();
                if($result){
                    $return['result']=true;
                    $return['msg']='修改退款状态成功';
                }
                else{
                    $return['result']=false;
                    $return['msg']='修改退款状态失败';
                }
            }
            else{
                $return['result']=false;
                $return['msg']='此状态下无法修改退款状态！只有在客户付款成功并且没有发货前可以修改！';
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

    //点击退款失败
    public function refundFailDo(Request $request){
        $data = $request->all();
        $admin = $request->session()->get('admin');
        $return=null;
        if(array_key_exists('id', $data)){
            $order = OrderManager::getOrderById($data['id']);
            if($order['status']==4&&empty($order['logistics_company'])&&empty($order['logistics_no'])){
                $data['status']=6;
                $order = OrderManager::setOrder($order,$data);
                $result=$order->save();
                if($result){
                    $return['result']=true;
                    $return['msg']='修改退款状态成功';
                }
                else{
                    $return['result']=false;
                    $return['msg']='修改退款状态失败';
                }
            }
            else{
                $return['result']=false;
                $return['msg']='此状态下无法修改退款状态！只有在客户付款成功并且没有发货前可以修改！';
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

    //获取快递公司列表及编码
    public function getExpressComs(){
        $param = array(
            'pro_code' => Utils::PRO_CODE,       //项目pro_code应该统一管理，建议在Utils中定义一个通用变量
        );
        $result = Utils::curl('http://common.isart.me/api/common/express/getExpressComs', $param, true);   //访问接口
        if($result){
            $result = json_decode($result, true);   //因为返回的已经是json数据，为了适配makeResponse方法，所以进行json转数组操作
        }
        return $result;
    }
}