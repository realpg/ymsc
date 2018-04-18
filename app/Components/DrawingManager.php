<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/3/6
 * Time: 15:09
 */

namespace app\Components;

use App\Models\DrawingModel;

class DrawingManager
{
    const PAGINATE_ADMIN=10;  //后台的分页数目
    /*
     * 配置图纸参数
     *
     * By zm
     *
     * 2018-03-06
     */
    public static function setDrawing($drawing, $data)
    {
        if (array_key_exists('user_id', $data)) {
            $drawing->user_id = array_get($data, 'user_id');
        }
        if (array_key_exists('content', $data)) {
            $drawing->content = array_get($data, 'content');
        }
        if (array_key_exists('status', $data)) {
            $drawing->status = array_get($data, 'status');
        }
        if (array_key_exists('remarks', $data)) {
            $drawing->remarks = array_get($data, 'remarks');
        }
        return $drawing;
    }

    /*
     * 根据id获取图纸信息
     *
     * By zm
     *
     * 2018-03-06
     */
    public static function getDrawingById($id)
    {
        $drawing = DrawingModel::find($id);
        return $drawing;
    }

    /*
     * whereIn查找信息
     *
     * By zm
     *
     * 2018-03-06
     *
     */
    public static function getDrawingByMoreId($data){
        $drawings=DrawingModel::whereIn('id',$data)->get();
        return $drawings;
    }

    /*
     * 查找图纸（未分页）
     *
     * By zm
     *
     * 2018-03-06
     */
    public static function getAllDrawingListsWithPage($search,$status)
    {
        $paginate=self::PAGINATE_ADMIN;
        $get=array(
            'drawing_info.id as id',
            'user_info.nick_name as nick_name',
            'user_info.phonenum as phonenum',
            'user_info.email as email',
            'user_info.nick_name as nick_name',
            'drawing_info.status as status',
            'drawing_info.remarks as remarks',
            'drawing_info.updated_at as updated_at',
        );
        if($status==""){
            $drawings = DrawingModel::join('user_info','user_info.id','=','drawing_info.user_id')
                ->where(function($drawings) use ($search){
                    $drawings->where('user_info.nick_name','like','%'.$search.'%')
                        ->orwhere('user_info.phonenum','like','%'.$search.'%')
                        ->orwhere('user_info.email','like','%'.$search.'%');
                })
                ->orderBy('drawing_info.status','asc')
                ->paginate($paginate,$get);
        }
        else{
            $drawings = DrawingModel::join('user_info','user_info.id','=','drawing_info.user_id')
                ->where(function($drawings) use ($search){
                    $drawings->where('user_info.nick_name','like','%'.$search.'%')
                        ->orwhere('user_info.phonenum','like','%'.$search.'%')
                        ->orwhere('user_info.email','like','%'.$search.'%');
                })
                ->where('status',$status)
                ->orderBy('drawing_info.status','asc')
                ->paginate($paginate,$get);
        }
        return $drawings;
    }

    /*
     * 查找图纸（有分页）
     *
     * By zm
     *
     * 2018-03-06
     */
    public static function getAllDrawingLists($search)
    {
        $get=array(
            'drawing_info.id as id',
            'user_info.nick_name as nick_name',
            'user_info.phonenum as phonenum',
            'user_info.email as email',
            'user_info.nick_name as nick_name',
            'drawing_info.status as status',
            'drawing_info.remarks as remarks',
            'drawing_info.updated_at as updated_at',
        );
        $drawings = DrawingModel::join('user_info','user_info.id','=','drawing_info.user_id')
            ->where(function($drawings) use ($search){
                $drawings->where('user_info.nick_name','like','%'.$search.'%')
                    ->orwhere('user_info.phonenum','like','%'.$search.'%')
                    ->orwhere('user_info.email','like','%'.$search.'%');
            })
            ->orderBy('drawing_info.status','asc')
            ->get($get);
        return $drawings;
    }

    /*
     * 根据状态查找信息
     *
     * By zm
     *
     * 2018-03-18
     *
     */
    public static function getDrawingsByStatus($status){
        $drawings=DrawingModel::where('status',$status)->get();
        return $drawings;
    }
}