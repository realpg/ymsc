<?php
/**
 * 首页控制器
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/4/20 0020
 * Time: 20:15
 */

namespace App\Http\Controllers\Admin;

use App\Components\AdminManager;
use App\Components\UserManager;
use App\Http\Controllers\ApiResponse;
use App\Models\User;
use Illuminate\Http\Request;
use App\Libs\ServerUtils;
use App\Components\RequestValidator;
use Illuminate\Support\Facades\Redirect;


class AdminController
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
        $datas = UserManager::getAllAdminByName($search);
        $param=array(
            'admin'=>$admin,
            'datas'=>$datas
        );
        return view('admin.admin.index', $param);
    }


    //删除管理员
    public function del(Request $request, $id)
    {
        if (is_numeric($id) !== true) {
            return redirect()->action('\App\Http\Controllers\Admin\IndexController@error', ['msg' => '合规校验失败，请检查参数管理员id$id']);
        }
        $admin_info = User::find($id);
        $return=null;
        //非根管理员
        if ($admin_info['admin'] == '0') {
            $result=$admin_info->delete();
            if($result){
                $return['result']=true;
                $return['msg']='删除成功';
            }
            else{
                $return['result']=false;
                $return['msg']='删除失败，高级管理员无法删除';
            }
        }
        else{
            $return['result']=false;
            $return['msg']='删除失败';
        }
        return $return;
    }


    //新建或编辑管理员-get
    public function edit(Request $request)
    {
        $data = $request->all();
        $admin_info = new User();
        if (array_key_exists('id', $data)) {
            $admin_info = UserManager::getUserInfoById($data['id']);
        }
        $admin = $request->session()->get('admin');
        //只有根管理员有修改权限
        if (($admin['type'] == '2')&&($admin['admin'] == '1')) {
//        //生成七牛token
//        $upload_token = QNManager::uploadToken();
            $param=array(
                'admin'=>$admin,
                'data'=>$admin_info
            );
            return view('admin.admin.edit', $param);
        }
        else{
            return redirect()->action('\App\Http\Controllers\Admin\IndexController@error', ['msg' => '合规校验失败，只有管理员有修改权限']);
        }
    }

    //新建或编辑管理员-post
    public function editDo(Request $request)
    {
        $data = $request->all();
//        var_dump($data);
        $return=null;
        //存在id是保存
        if (empty($data['id'])) {
            $admin_info = new User();
            //如果不存在id代表新建，则默认设置密码
            $data['password']='afdd0b4ad2ec172c586e2150770fbf9e';  //Aa123456
            $data['type']=2;
            //查询电话号码是否唯一
            $admin_chenck=UserManager::getUserInfoByTel($data['phonenum']);
            if($admin_chenck){
                $return['result']=false;
                $return['msg']='添加管理员失败,此电话号码已被注册';
            }
            else{
                $admin_info = AdminManager::setAdmin($admin_info, $data);
                $result=$admin_info->save();
                if($result){
                    $return['result']=true;
                    $return['msg']='添加管理员成功';
                }
                else{
                    $return['result']=false;
                    $return['msg']='添加管理员失败';
                }
            }
        }
        else{
            $admin_info = UserManager::getUserInfoById($data['id']);
            //查询电话号码是否唯一
            $result=AdminManager::getAdminByTel($data['phonenum']);
            if($data['phonenum']!=$admin_info['phonenum']&&$result){
                $return['result']=false;
                $return['msg']='编辑管理员失败,此电话号码已被注册';
            }
            else{
                $admin_info = AdminManager::setAdmin($admin_info, $data);
                $result=$admin_info->save();
                if($result){
                    $return['result']=true;
                    $return['msg']='编辑管理员成功';
                }
                else{
                    $return['result']=false;
                    $return['msg']='编辑管理员失败';
                }
            }
        }
        return $return;
    }

    //新建或编辑自己的信息-get
    public function editMySelf(Request $request)
    {
        $admin = $request->session()->get('admin');
        $admin_info = AdminManager::getAdminInfoById($admin['id']);
        $param=array(
            'data'=>$admin_info
        );
        return view('admin.admin.editMySelf', $param);
    }

    //新建或编辑自己的信息-post
    public function editMySelfDo(Request $request)
    {
        $data = $request->all();
        $return=null;
        if(empty($data['password'])){
            $admin_info=AdminManager::getAdminInfoById($data['id']);
            unset($data['password']);
            unset($data['new_password']);
            unset($data['confirm_password']);
            //查询电话号码是否唯一
            if($data['phonenum']!=$admin_info['phonenum']){
                $result=AdminManager::getAdminByTel($admin_info['phonenum']);
                if($result){
                    $return['result']=false;
                    $return['msg']='个人基本信息修改失败,此电话号码已被注册';
                    return $return;
                }
            }
            $admin_info = AdminManager::setAdmin($admin_info, $data);
            $result=$admin_info->save();
            if($result){
                $request->session()->put('admin', $admin_info);//写入session
                $return['result']=true;
                $return['msg']='个人基本信息修改成功';
            }
            else{
                $return['result']=false;
                $return['msg']='个人基本信息修改失败';
            }
        }
        else{
            $admin_info=AdminManager::getAdminAllInfoById($data['id']);
            if($data['password']!= $admin_info['password']){
                $return['result']=false;
                $return['msg']='密码修改失败，原密码输入错误';
            }
            else{
                $data['password']=$data['new_password'];
                unset($data['new_password']);
                unset($data['confirm_password']);
                $admin = AdminManager::setAdmin($admin_info, $data);
                $result=$admin->save();
                if($result){
                    $return['result']=true;
                    $return['msg']='密码修改成功，请重新登录';
                }
                else{
                    $return['result']=false;
                    $return['msg']='密码修改失败';
                }
            }
        }

        return $return;
    }
}