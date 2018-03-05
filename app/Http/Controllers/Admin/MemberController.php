<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/1/23
 * Time: 16:04
 */

namespace App\Http\Controllers\Admin;

use App\Components\MemberManager;
use Illuminate\Http\Request;

class MemberController
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
        $members = MemberManager::getUsersByName($search);
        $param=array(
            'admin'=>$admin,
            'datas'=>$members,
        );
        return view('admin.member.index', $param);
    }

    //查看会员详情
    public function edit(Request $request){
        $data = $request->all();
        $admin = $request->session()->get('admin');
        $member=MemberManager::getUserInfoByIdWithNotToken($data['id']);
        $param=array(
            'admin'=>$admin,
            'data'=>$member,
        );
        return view('admin.member.edit', $param);
    }
}