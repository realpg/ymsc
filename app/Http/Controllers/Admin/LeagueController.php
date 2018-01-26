<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/1/26
 * Time: 16:47
 */

namespace App\Http\Controllers\Admin;

use App\Components\LeagueManager;
use App\Models\LeagueModel;
use Illuminate\Http\Request;

class LeagueController
{
    //首页
    public function index(Request $request)
    {
        $data = $request->all();
        $admin = $request->session()->get('admin');
        if(!array_key_exists('search',$data)){
            $data['search']="";
        }
        $leagues = LeagueManager::getAllLeagueLists($data['search']);
        $param=array(
            'admin'=>$admin,
            'datas'=>$leagues
        );
        return view('admin.league.index', $param);
    }
    //删除
    public function del(Request $request, $id)
    {
        if (is_numeric($id) !== true) {
            return redirect()->action('\App\Http\Controllers\Admin\IndexController@error', ['msg' => '合规校验失败，请检查参数管理员id$id']);
        }
        $league = LeagueModel::find($id);
        $return=null;
        $result=$league->delete();
        if($result){
            $return['result']=true;
            $return['msg']='删除成功';
        }
        else{
            $return['result']=false;
            $return['msg']='删除失败';
        }
        return $return;
    }
    //查看评论详情
    public function edit(Request $request)
    {
        $data = $request->all();
        if(array_key_exists('id',$data)){
            $admin = $request->session()->get('admin');
            $league = LeagueManager::getLeagueInfoById($data['id']);
            $param=array(
                'admin'=>$admin,
                'data'=>$league
            );
            return view('admin.league.edit', $param);
        }
        else{
            return redirect()->action('\App\Http\Controllers\Admin\IndexController@error', ['msg' => '非法访问']);
        }
    }
    //标记已联系
    public function stamp(Request $request)
    {
        $data = $request->all();
        if(array_key_exists('id',$data)){
            $admin = $request->session()->get('admin');
            $return=null;
            $league = LeagueManager::stampLeagueInfoStatus($data);
            if($league){
                $return['result']=true;
                $return['msg']='标记成功';
            }
            else{
                $return['result']=false;
                $return['msg']='标记失败';
            }
            return $return;
        }
        else{
            return redirect()->action('\App\Http\Controllers\Admin\IndexController@error', ['msg' => '非法访问']);
        }
    }
}