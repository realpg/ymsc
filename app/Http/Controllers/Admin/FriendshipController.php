<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/3/18
 * Time: 15:52
 */

namespace App\Http\Controllers\Admin;

use App\Components\FriendshipManager;
use App\Components\QNManager;
use App\Models\FriendshipModel;
use Illuminate\Http\Request;

class FriendshipController
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
        $friendships = FriendshipManager::getAllFriendshipLists($search);
        $param=array(
            'admin'=>$admin,
            'datas'=>$friendships
        );
        return view('admin.friendship.index', $param);
    }
    //删除
    public function del(Request $request)
    {
        $data=$request->all();
        if(array_key_exists('id',$data)){
            $id=$data['id'];
            if (is_numeric($id) !== true) {
                $return['result']=false;
                $return['msg']='合规校验失败，参数类型不正确';
            }
            else{
                $friendship = FriendshipModel::find($id);
                $return=null;
                $result=$friendship->delete();
                if($result){
                    $return['result']=true;
                    $return['msg']='删除成功';
                }
                else{
                    $return['result']=false;
                    $return['msg']='删除失败';
                }
            }
        }
        else{
            $return['result']=false;
            $return['msg']='合规校验失败，缺少参数';
        }
        return $return;
    }
    //创建或编辑Friendship
    public function edit(Request $request){
        $data = $request->all();
        $admin = $request->session()->get('admin');
        if (array_key_exists('id', $data)) {
            $friendship = FriendshipManager::getFriendshipById($data['id']);
        }
        else{
            $friendship=new FriendshipModel();
        }
        //生成七牛token
        $upload_token = QNManager::uploadToken();
        $param=array(
            'admin'=>$admin,
            'data'=>$friendship,
            'upload_token'=>$upload_token
        );
        return view('admin.friendship.edit', $param);
    }
    //创建或编辑Friendship执行
    public function editDo(Request $request){
        $data = $request->all();
        $admin = $request->session()->get('admin');
        $return=null;
        if(empty($data['picture'])){
            $return['result']=false;
            $return['msg']='编辑失败,请上传图片';
        }
        else{
            if(empty($data['id'])){
                $friendship=new FriendshipModel();
            }
            else{
                $friendship = FriendshipManager::getFriendshipById($data['id']);
            }
            $friendship = FriendshipManager::setFriendship($friendship,$data);
            $result=$friendship->save();
            if($result){
                $return['result']=true;
                $return['msg']='编辑成功';
            }
            else{
                $return['result']=false;
                $return['msg']='编辑失败';
            }
        }
        return $return;
    }
}