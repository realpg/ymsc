<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/2/1
 * Time: 14:15
 */

namespace App\Http\Controllers\Home;

use App\Components\AdviceManager;
use App\Components\CartManager;
use App\Components\GoodsManager;
use App\Components\HomeManager;
use App\Components\LeagueManager;
use App\Components\MenuManager;
use App\Components\SearchingManager;
use App\Components\WordManager;
use App\Http\Controllers\Controller;
use App\Models\AdviceModel;
use App\Models\LeagueModel;
use App\Models\SearchingModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Response;

class IndexController extends Controller
{
    /*
     * 首页
     */
    public function index(Request $request){
        $data=$request->all();
        $user=$request->cookie('user');
        $common=$data['common'];
        $column='index';
        $menus=MenuManager::getClassAMenuLists();
        $words=WordManager::getAllWordsForIndex();
        if($user){
            $carts=CartManager::getCartsByUserId($user['id']);
            $param=array(
                'common'=>$common,
                'menus'=>$menus,
                'column'=>$column,
                'user'=>$user,
                'words'=>$words,
                'carts'=>$carts
            );
        }
        else{
            $param=array(
                'common'=>$common,
                'menus'=>$menus,
                'column'=>$column,
                'user'=>$user,
                'words'=>$words
            );
        }
        return view('home.index.index',$param);
    }
    /*
     * 合作与服务
     */
    public function league(Request $request){
        $data=$request->all();
        $user=$request->cookie('user');
        $common=$data['common'];
        $column='league';
        $menus=MenuManager::getClassAMenuLists();
        if($user) {
            $carts = CartManager::getCartsByUserId($user['id']);
            $param=array(
                'common'=>$common,
                'menus'=>$menus,
                'column'=>$column,
                'user'=>$user,
                'carts'=>$carts
            );
        }
        else{
            $param=array(
                'common'=>$common,
                'menus'=>$menus,
                'column'=>$column,
                'user'=>$user
            );
        }
        return view('home.index.league',$param);
    }
    /*
     * 合作与服务报名
     */
    public function leagueSignUp (Request $request){
        $data=$request->all();
        unset($data['common']);
        $return=null;
        $league=new LeagueModel();
        $league = LeagueManager::setLeague($league,$data);
        $result=$league->save();
        if($result){
            $return['result']=true;
            $return['msg']='提交成功，等待相关人员与您联系';
        }
        else{
            $return['result']=false;
            $return['msg']='提交失败';
        }
        return $return;
    }
    /*
     * 关于我们
     */
    public function about(Request $request){
        $data=$request->all();
        $user=$request->cookie('user');
        $common=$data['common'];
        $column='about';
        $menus=MenuManager::getClassAMenuLists();
        if($user) {
            $carts = CartManager::getCartsByUserId($user['id']);
            $param=array(
                'common'=>$common,
                'menus'=>$menus,
                'column'=>$column,
                'user'=>$user,
                'carts'=>$carts
            );
        }
        else{
            $param=array(
                'common'=>$common,
                'menus'=>$menus,
                'column'=>$column,
                'user'=>$user
            );
        }
        return view('home.index.about',$param);
    }
    /*
     * 提交意见反馈
     */
    public function advice(Request $request){
        $data=$request->all();
        unset($data['common']);
        $return=null;
        if(!array_key_exists('advice_type',$data)){
            $return['result']=false;
            $return['msg']='提交失败，请选择咨询类型';
        }
        else if(!array_key_exists('advice_content',$data)){
            $return['result']=false;
            $return['msg']='提交失败，请填写问题描述';
        }
        else if(!array_key_exists('advice_phonenum',$data)){
            $return['result']=false;
            $return['msg']='提交失败，请填写联系电话';
        }
        else if(!array_key_exists('advice_name',$data)){
            $return['result']=false;
            $return['msg']='提交失败，请填写联系人';
        }
        else{
            $data_advice=array(
                'type'=>$data['advice_type'],
                'content'=>$data['advice_content'],
                'phonenum'=>$data['advice_phonenum'],
                'name'=>$data['advice_name']
            );
            $advice=new AdviceModel();
            $advice=AdviceManager::setAdvice($advice,$data_advice);
            $result=$advice->save();
            if($result){
                $return['result']=true;
                $return['msg']='提交成功';
            }
            else{
                $return['result']=false;
                $return['msg']='提交失败';
            }
        }
        return $return;
    }
    /*
     * 提交帮你找货
     */
    public function searching(Request $request){
        $data=$request->all();
        unset($data['common']);
        $return=null;
        if(!array_key_exists('searching_goods',$data)){
            $return['result']=false;
            $return['msg']='提交失败，请填写需要采购的商品';
        }
        else if(!array_key_exists('searching_count',$data)){
            $return['result']=false;
            $return['msg']='提交失败，请填写采购数量';
        }
        else if(!array_key_exists('searching_unit',$data)){
            $return['result']=false;
            $return['msg']='提交失败，请填写单位';
        }
        else if(!array_key_exists('searching_phonenum',$data)){
            $return['result']=false;
            $return['msg']='提交失败，请填写联系电话';
        }
        else if(!array_key_exists('searching_time',$data)){
            $return['result']=false;
            $return['msg']='提交失败，请选择时效';
        }
        else if(!array_key_exists('searching_province',$data)){
            $return['result']=false;
            $return['msg']='提交失败，请选择省';
        }
        else if(!array_key_exists('searching_city',$data)){
            $return['result']=false;
            $return['msg']='提交失败，请选择市';
        }
        else if(!array_key_exists('searching_address',$data)){
            $return['result']=false;
            $return['msg']='提交失败，请填写公司/单位';
        }
        else{
            $data_searching=array(
                'goods'=>$data['searching_goods'],
                'count'=>$data['searching_count'],
                'unit'=>$data['searching_unit'],
                'purity'=>$data['searching_purity'],
                'name'=>$data['searching_name'],
                'phonenum'=>$data['searching_phonenum'],
                'time'=>$data['searching_time'],
                'province'=>$data['searching_province'],
                'city'=>$data['searching_city'],
                'address'=>$data['searching_address'],
                'content'=>$data['searching_content'],
            );
            $searching=new SearchingModel();
            $searching=SearchingManager::setSearching($searching,$data_searching);
            $result=$searching->save();
            if($result){
                $return['result']=true;
                $return['msg']='提交成功';
            }
            else{
                $return['result']=false;
                $return['msg']='提交失败';
            }
        }
        return $return;
    }
    /*
     * 搜索商品
     */
    public function search(Request $request){
        $data=$request->all();
        $user=$request->cookie('user');
        $column='index';
        $common=$data['common'];
        $search=$data['search'];
        $goodses=GoodsManager::getGoodsesByName($search);
        $menus=MenuManager::getClassAMenuListswhichCanShow();
        if($user) {
            $carts = CartManager::getCartsByUserId($user['id']);
            $param=array(
                'common'=>$common,
                'column'=>$column,
                'user'=>$user,
                'goodses'=>$goodses,
                'menus'=>$menus,
                'carts'=>$carts
            );
        }
        else{
            $param=array(
                'common'=>$common,
                'column'=>$column,
                'user'=>$user,
                'goodses'=>$goodses,
                'menus'=>$menus
            );
        }
        return view('home.index.search',$param);
    }
}