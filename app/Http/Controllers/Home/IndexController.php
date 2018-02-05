<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/2/1
 * Time: 14:15
 */

namespace app\Http\Controllers\Home;

use App\Components\HomeManager;
use App\Components\LeagueManager;
use App\Components\MenuManager;
use App\Http\Controllers\Controller;
use App\Models\LeagueModel;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    /*
     * 首页
     */
    public function index(Request $request){
        $data=$request->all();
        $common=$data['common'];
        $column='index';
        $menus=MenuManager::getClassAMenuLists();
        $param=array(
            'common'=>$common,
            'menus'=>$menus,
            'column'=>$column
        );
        return view('home.index.index',$param);
    }
    /*
     * 合作与服务
     */
    public function league(Request $request){
        $data=$request->all();
        $common=$data['common'];
        $column='league';
        $menus=MenuManager::getClassAMenuLists();
        $param=array(
            'common'=>$common,
            'menus'=>$menus,
            'column'=>$column
        );
        return view('home.index.league',$param);
    }
    /*
     * 合作与服务报名
     */
    public function leagueSignUp (Request $request){
        $data=$request->all();
        unset($data['common']);
        $data = $request->all();
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
        $common=$data['common'];
        $column='about';
        $menus=MenuManager::getClassAMenuLists();
        $param=array(
            'common'=>$common,
            'menus'=>$menus,
            'column'=>$column
        );
        return view('home.index.about',$param);
    }
}