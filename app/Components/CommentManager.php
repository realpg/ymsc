<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/12/23
 * Time: 9:08
 */

namespace App\Components;

use App\Models\CommentConsent;
use App\Models\CommentImage;
use App\Models\CommentModel;
use App\Models\CommentReplie;

class CommentManager
{

    /*
     * 获取产品的评论的总数
     *
     * by zm
     *
     * 2017-12-22
     *
     */
    public static function getGoodsCommentListsCount($data=null){
        if($data){
            $where=array(
                'goods_id'=>$data['goods_id'],
                'status'=>1
            );
            $count=CommentModel::where($where)->count();
        }
        else{
            $count=CommentModel::where('status',1)->count();
        }
        return $count;
    }

    /*
     * 配置添加评论的参数
     *
     * By zm
     *
     * 2017-12-24
     *
     */
    public static function setComment($comment,$data){
        if (array_key_exists('user_id', $data)) {
            $comment->user_id = array_get($data, 'user_id');
        }
        if (array_key_exists('content', $data)) {
            $comment->content = array_get($data, 'content');
        }
        if (array_key_exists('status', $data)) {
            $comment->status = array_get($data, 'status');
        }
        if (array_key_exists('goods_id', $data)) {
            $comment->goods_id = array_get($data, 'goods_id');
        }
        return $comment;
    }

    /*
     * 根据id获取评论信息
     *
     * By zm
     *
     * 2017-12-24
     */
    public static function getCommentById($id){
        $comment=CommentModel::where('id',$id)->get();
        return $comment;
    }

    /*
     * 获取所有评论详情
     *
     * by zm
     *
     * 2018-01-24
     *
     */
    public static function getAllCommentLists($search,$status){
        if($status==''){
            $comments=CommentModel::where('content','like','%'.$search.'%')->orderBy('id','desc')->get();
        }
        else{
            $comments=CommentModel::where('content','like','%'.$search.'%')->where('status',$status)->orderBy('id','desc')->get();
        }
        foreach ($comments as $comment){
            //获取评论用户信息
            $comment['user_id']=MemberManager::getUserInfoByIdWithNotToken($comment['user_id']);
            //获取产品信息
            $comment['goods_id']=GoodsManager::getGoodsById($comment['goods_id']);
        }
        return $comments;
    }

    /*
     * 根据id评论详情
     *
     * by zm
     *
     * 2018-01-24
     *
     */
    public static function getAllCommentDetailById($data){
        $comment=CommentModel::find($data['id']);
        $goods_id=$comment['goods_id'];
        $comment['goods']=GoodsManager::getGoodsById($goods_id);
        $comment['user']=MemberManager::getUserInfoByIdWithNotToken($comment['user_id']);
        return $comment;
    }

    /*
     * 根据id审核评论
     *
     * by zm
     *
     * 2018-01-24
     *
     */
    public static function examineCommentStatus($data){
        $comment=CommentModel::find($data['id']);
        $comment=self::setComment($comment,$data);
        $result=$comment->save();
        return $result;
    }
}