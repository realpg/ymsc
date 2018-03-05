<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/3/5
 * Time: 15:03
 */

namespace App\Http\Controllers\Admin;

use App\Components\InvoiceManager;
use Illuminate\Http\Request;

class InvoiceController
{
    //首页
    public function index(Request $request)
    {
        $data = $request->all();
        $admin = $request->session()->get('admin');
        if(!array_key_exists('search',$data)){
            $data['search']="";
        }
        $invoices = InvoiceManager::getSpecialInvoiceListsBySearch($data['search']);
        $param=array(
            'admin'=>$admin,
            'datas'=>$invoices
        );
        return view('admin.invoice.index', $param);
    }
    //查看详情
    public function edit(Request $request)
    {
        $data = $request->all();
        if(array_key_exists('id',$data)){
            $admin = $request->session()->get('admin');
            $invoice = InvoiceManager::getInvoiceById($data['id']);
            $param=array(
                'admin'=>$admin,
                'data'=>$invoice
            );
            return view('admin.invoice.edit', $param);
        }
        else{
            $param=array(
                'msg'=>'合规校验失败，缺少参数'
            );
            return view('admin.index.error500', $param);
        }
    }
    //审核
    public function examine(Request $request)
    {
        $data = $request->all();
        if(array_key_exists('id',$data)){
            $admin = $request->session()->get('admin');
            $return=null;
            $invoice = InvoiceManager::getInvoiceById($data['id']);
            $invoice=InvoiceManager::setInvoice($invoice,$data);
            $result=$invoice->save();
            if($result){
                $return['result']=true;
                $return['msg']='审核成功';
            }
            else{
                $return['result']=false;
                $return['msg']='审核失败';
            }
        }
        else{
            $return['result']=false;
            $return['msg']='合规校验失败，缺少参数';
        }
        return $return;
    }
}