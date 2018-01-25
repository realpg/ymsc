<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/1/19
 * Time: 14:35
 */

namespace App\Http\Controllers\Admin;

use App\Components\BannerManager;
use App\Components\QNManager;
use App\Models\Banner;
use App\Models\BannerDetail;
use Illuminate\Http\Request;

class BannerController
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
        $datas = BannerManager::getAllBannerLists($search);
        $param=array(
            'admin'=>$admin,
            'datas'=>$datas
        );
        return view('admin.banner.index', $param);
    }
    //删除
    public function del(Request $request, $id)
    {
        if (is_numeric($id) !== true) {
            return redirect()->action('\App\Http\Controllers\Admin\IndexController@error', ['msg' => '合规校验失败，请检查参数管理员id$id']);
        }
        $banner = Banner::find($id);
        $return=null;
        $result=$banner->delete();
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
    //添加Banner
    public function add(Request $request){
        $data = $request->all();
        $admin = $request->session()->get('admin');
        $banner=new Banner();
        if (array_key_exists('id', $data)) {
            $banner = BannerManager::getBannerById($data['id']);
        }
        //生成七牛token
        $upload_token = QNManager::uploadToken();
        $param=array(
            'admin'=>$admin,
            'data'=>$banner,
            'upload_token'=>$upload_token
        );
        return view('admin.banner.add', $param);
    }
    //添加Banner执行
    public function addDo(Request $request){
        $data = $request->all();
        $admin = $request->session()->get('admin');
        $return=null;
        if(empty($data['id'])){
            $banner=new Banner();
        }
        else{
            $banner = BannerManager::getBannerById($data['id']);
        }
        $banner = BannerManager::setBanner($banner,$data);
        $result=$banner->save();
        if($result){
            $return['result']=true;
            $return['msg']='添加Banner成功';
        }
        else{
            $return['result']=false;
            $return['msg']='添加Banner失败';
        }
        return $return;
    }
    //编辑Banner
    public function edit(Request $request){
        $data = $request->all();
        $admin = $request->session()->get('admin');
        $banner=new Banner();
        if (array_key_exists('id', $data)) {
            $banner = BannerManager::getBannerById($data['id']);
            if($banner['type']==0){
                $banner_details=BannerDetail::where('banner_id',$data['id'])->orderBy('sort','asc')->get();
                $banner['details']=$banner_details;
            }
        }
        //生成七牛token
        $upload_token = QNManager::uploadToken();
        $param=array(
            'admin'=>$admin,
            'data'=>$banner,
            'upload_token'=>$upload_token
        );
        return view('admin.banner.edit', $param);
    }
    //编辑Banner执行
    public function editDo(Request $request){
        $data = $request->all();
        $admin = $request->session()->get('admin');
        $return=null;
        if(empty($data['id'])){
            $banner=new Banner();
        }
        else{
            $banner = BannerManager::getBannerById($data['id']);
        }
        $banner = BannerManager::setBanner($banner,$data);
        $result=$banner->save();

        if($result){
            $return['result']=true;
            $return['msg']='编辑Banner成功';
        }
        else{
            $return['result']=false;
            $return['msg']='编辑Banner失败';
        }
        return $return;
    }
    //删除Banner详情
    public function delDetail(Request $request, $id)
    {
        if (is_numeric($id) !== true) {
            return redirect()->action('\App\Http\Controllers\Admin\IndexController@error', ['msg' => '合规校验失败，请检查参数管理员id$id']);
        }
        $banner_detail = BannerDetail::find($id);
        $return=null;
        $result=$banner_detail->delete();
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
    //编辑Banner详情执行
    public function editDoDetail(Request $request){
        $data = $request->all();
        $admin = $request->session()->get('admin');
        $return=null;
        if(array_key_exists('id', $data)){
            $banner_detail = BannerManager::getBannerDetailById($data['id']);
        }
        else{
            $banner_detail=new BannerDetail();
        }
        $banner_detail = BannerManager::setBannerDetail($banner_detail,$data);
        $result=$banner_detail->save();
        if($result){
            $return['result']=true;
            $return['msg']='编辑Banner详情成功';
        }
        else{
            $return['result']=false;
            $return['msg']='编辑Banner详情失败';
        }
        return $return;
    }
}