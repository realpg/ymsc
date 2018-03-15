<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/3/15
 * Time: 18:38
 */

namespace App\Http\Controllers\Admin;

use App\Components\OrderManager;
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
        $param=array(
            'admin'=>$admin,
            'data'=>$order,
        );
        return view('admin.order.edit', $param);
    }
}