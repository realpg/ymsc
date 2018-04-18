<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/1/24
 * Time: 10:02
 */

namespace App\Http\Controllers\Admin;

use App\Components\CommentManager;
use App\Models\CommentModel;
use Illuminate\Http\Request;

class CommentController
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
        if(array_key_exists('status',$data)){
            $status=$data['status'];
        }
        else{
            $status='';
        }
//        $comments = CommentManager::getAllCommentLists($search,$status);  //无分页
        $comments = CommentManager::getAllCommentListsWithPage($search,$status);  //有分页
        $param=array(
            'admin'=>$admin,
            'datas'=>$comments,
            'search'=>$search,
            'status'=>$status
        );
        return view('admin.comment.index', $param);
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
                $comment = CommentModel::find($id);
                $return=null;
                $result=$comment->delete();
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
    //查看评论详情
    public function edit(Request $request)
    {
        $data = $request->all();
        $admin = $request->session()->get('admin');
        $comment = CommentManager::getAllCommentDetailById($data);
        $param=array(
            'admin'=>$admin,
            'data'=>$comment
        );
        return view('admin.comment.edit', $param);
    }
    //审核评论
    public function examine(Request $request)
    {
        $data = $request->all();
        if(array_key_exists('id',$data)&&array_key_exists('status',$data)){
            $admin = $request->session()->get('admin');
            $return=null;
            $comment = CommentManager::examineCommentStatus($data);
            if($comment){
                $return['result']=true;
                $return['msg']='审核状态修改成功';
            }
            else{
                $return['result']=false;
                $return['msg']='审核状态修改失败';
            }
        }
        else{
            $return['result']=false;
            $return['msg']='审核状态修改失败，缺少参数';
        }
        return $return;
    }
}