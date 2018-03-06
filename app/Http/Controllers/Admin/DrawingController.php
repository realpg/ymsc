<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/3/6
 * Time: 15:33
 */

namespace App\Http\Controllers\Admin;

use App\Components\DrawingManager;
use App\Components\MemberManager;
use App\Models\DrawingModel;
use Illuminate\Http\Request;

class DrawingController
{
    //首页
    public function index(Request $request)
    {
        $data = $request->all();
        $admin = $request->session()->get('admin');
        if(!array_key_exists('search',$data)){
            $data['search']="";
        }
        $drawings = DrawingManager::getAllDrawingLists($data['search']);
        $param=array(
            'admin'=>$admin,
            'datas'=>$drawings
        );
        return view('admin.drawing.index', $param);
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
                $drawing = DrawingModel::find($id);
                $return=null;
                $result=$drawing->delete();
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
    //批量删除
    public function delMore(Request $request)
    {
        $data=$request->all();
        if(array_key_exists('id_array',$data)){
            $id_array=explode(',',$data['id_array']);
            $drawings = DrawingManager::getDrawingByMoreId($id_array);
            $count=0;
            foreach ($drawings as $drawing){
                $result=$drawing->delete();
                if($result){
                    $count++;
                }
            }
            $return=null;
            if($count==count($drawings)){
                $return['result']=true;
                $return['msg']='删除成功';
            }
            else{
                $return['result']=false;
                $return['msg']='删除失败';
            }
        }
        else{
            $return['result']=false;
            $return['msg']='合规校验失败，缺少参数';
        }
        return $return;
    }
    //查看详情
    public function edit(Request $request)
    {
        $data = $request->all();
        if(array_key_exists('id',$data)){
            $admin = $request->session()->get('admin');
            $drawing = DrawingManager::getDrawingById($data['id']);
            $drawing['user']=MemberManager::getUserInfoByIdWithNotToken($drawing['user_id']);
            if($drawing){
                if($drawing['content']){
                    $drawing['content']=explode(",",$drawing['content']);
                }
            }
            $param=array(
                'admin'=>$admin,
                'data'=>$drawing
            );
            return view('admin.drawing.edit', $param);
        }
        else{
            $param=array(
                'msg'=>'合规校验失败，缺少参数'
            );
            return view('admin.index.error500', $param);
        }
    }
    //标记已联系
    public function editDo(Request $request)
    {
        $data = $request->all();
        $return['result']=false;
        if(array_key_exists('id',$data)){
            $admin = $request->session()->get('admin');
            $return=null;
            $drawing = DrawingManager::getDrawingById($data['id']);
            $drawing=DrawingManager::setDrawing($drawing,$data);
            $result=$drawing->save();
            if($result){
                $return['result']=true;
                $return['msg']='操作成功';
            }
            else{
                $return['result']=false;
                $return['msg']='操作失败';
            }
        }
        else{
            $return['result']=false;
            $return['msg']='合规校验失败，缺少参数';
        }
        return $return;
    }
}