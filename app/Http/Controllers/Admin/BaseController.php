<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/1/26
 * Time: 13:09
 */

namespace App\Http\Controllers\Admin;

use App\Components\BaseManager;
use App\Components\QNManager;
use Illuminate\Http\Request;

class BaseController
{
    //编辑网站基本设置
    public function edit(Request $request){
        $admin = $request->session()->get('admin');
        $base = BaseManager::getBaseInfo();
        //生成七牛token
        $upload_token = QNManager::uploadToken();
        $param=array(
            'admin'=>$admin,
            'data'=>$base,
            'upload_token'=>$upload_token
        );
        return view('admin.base.edit', $param);
    }
    //编辑网站基本设置执行
    public function baseInfoDo(Request $request){
        $data = $request->all();
        $admin = $request->session()->get('admin');
        $return=null;
        $base = BaseManager::getBaseInfo();
        $base = BaseManager::setBase($base,$data);
        $result=$base->save();
        if($result){
            $return['result']=true;
            $return['msg']='编辑网站基本信息成功';
        }
        else{
            $return['result']=false;
            $return['msg']='编辑网站基本信息失败';
        }
        return $return;
    }
    //编辑关于我们
    public function baseAboutDo(Request $request){
        $data = $request->all();
        $admin = $request->session()->get('admin');
        $return=null;
        $base = BaseManager::getBaseInfo();
        $base = BaseManager::setBase($base,$data);
        $result=$base->save();
        if($result){
            $return['result']=true;
            $return['msg']='编辑关于我们成功';
        }
        else{
            $return['result']=false;
            $return['msg']='编辑关于我们失败';
        }
        return $return;
    }
    //编辑SEO
    public function baseSeoDo(Request $request){
        $data = $request->all();
        $admin = $request->session()->get('admin');
        $return=null;
        $base = BaseManager::getBaseInfo();
        $base = BaseManager::setBase($base,$data);
        $result=$base->save();
        if($result){
            $return['result']=true;
            $return['msg']='编辑SEO成功';
        }
        else{
            $return['result']=false;
            $return['msg']='编辑SEO失败';
        }
        return $return;
    }
    //编辑系统设置
    public function baseSettingDo(Request $request){
        $data = $request->all();
        $admin = $request->session()->get('admin');
        $return=null;
        $base = BaseManager::getBaseInfo();
        $base = BaseManager::setBase($base,$data);
        $result=$base->save();
        if($result){
            $return['result']=true;
            $return['msg']='编辑系统设置成功';
        }
        else{
            $return['result']=false;
            $return['msg']='编辑系统设置失败';
        }
        return $return;
    }
}