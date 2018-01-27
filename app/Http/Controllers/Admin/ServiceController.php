<?php
/**
 * Created by PhpStorm.
 * User: Serviceistrator
 * Date: 2018/1/27
 * Time: 15:09
 */

namespace App\Http\Controllers\Admin;

use App\Components\ServiceManager;
use App\Models\ServiceModel;
use Illuminate\Http\Request;

class ServiceController
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
        $services = ServiceManager::getAllServiceLists($search);
        $param=array(
            'admin'=>$admin,
            'datas'=>$services
        );
        return view('admin.service.index', $param);
    }

    //新建或编辑客服-get
    public function edit(Request $request)
    {
        $data = $request->all();
        $admin = $request->session()->get('admin');
        if (array_key_exists('id', $data)) {
            $service = ServiceManager::getServiceById($data['id']);
        }
        else{
            $service = new ServiceModel();
        }
        $param=array(
            'admin'=>$admin,
            'data'=>$service
        );
        return view('admin.service.edit', $param);
    }

    //新建或编辑客服-post
    public function editDo(Request $request)
    {
        $data = $request->all();
        $admin = $request->session()->get('admin');
        $return=null;
        if(empty($data['id'])){
            $service=new ServiceModel();
        }
        else{
            $service = ServiceManager::getServiceById($data['id']);
        }
        $service = ServiceManager::setService($service,$data);
        $result=$service->save();
        if($result){
            $return['result']=true;
            $return['msg']='编辑客服成功';
        }
        else{
            $return['result']=false;
            $return['msg']='编辑客服失败';
        }
        return $return;
    }
}