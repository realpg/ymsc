<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/1/27
 * Time: 14:32
 */

namespace App\Http\Controllers\Admin;

use App\Components\SearchingManager;
use App\Models\SearchingModel;
use Illuminate\Http\Request;

class SearchingController
{
    //首页
    public function index(Request $request)
    {
        $data = $request->all();
        $admin = $request->session()->get('admin');
        if(!array_key_exists('status',$data)){
            $data['status']="";
        }
        if(!array_key_exists('search',$data)){
            $data['search']="";
        }
//        $searchings = SearchingManager::getAllSearchingLists($data['search']);  //无分页
        $searchings = SearchingManager::getAllSearchingListsWithPage($data['search'],$data['status']);  //有分页
        $param=array(
            'admin'=>$admin,
            'datas'=>$searchings,
            'search'=>$data['search'],
            'status'=>$data['status']
        );
        return view('admin.searching.index', $param);
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
                $searching = SearchingModel::find($id);
                $return=null;
                $result=$searching->delete();
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
            $searchings = SearchingManager::getSearchingByMoreId($id_array);
            $count=0;
            foreach ($searchings as $searching){
                $result=$searching->delete();
                if($result){
                    $count++;
                }
            }
            $return=null;
            if($count==count($searchings)){
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
            $searching = SearchingManager::getSearchingInfoById($data['id']);
            $param=array(
                'admin'=>$admin,
                'data'=>$searching
            );
            return view('admin.searching.edit', $param);
        }
        else{
            $param=array(
                'msg'=>'合规校验失败，缺少参数'
            );
            return view('admin.index.error500', $param);
        }
    }
    //标记已联系
    public function stamp(Request $request)
    {
        $data = $request->all();
        if(array_key_exists('id',$data)){
            $admin = $request->session()->get('admin');
            $return=null;
            $searching = SearchingManager::stampSearchingInfoStatus($data);
            if($searching){
                $return['result']=true;
                $return['msg']='标记成功';
            }
            else{
                $return['result']=false;
                $return['msg']='标记失败';
            }
        }
        else{
            $return['result']=false;
            $return['msg']='合规校验失败，缺少参数';
        }
        return $return;
    }
}