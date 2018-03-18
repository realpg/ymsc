<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/1/13
 * Time: 17:00
 */

namespace App\Http\Controllers\Admin;
use App\Components\AdviceManager;
use App\Components\DrawingManager;
use App\Components\LeagueManager;
use App\Components\SearchingManager;
use App\Http\Controllers\ApiResponse;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Components\RequestValidator;

class IndexController
{
    //首页
    public function index(Request $request)
    {
        $admin = $request->session()->get('admin');
        $leagues=LeagueManager::getLeaguesByStatus(0);
        $advices=AdviceManager::getAdvicesByStatus(0);
        $searchings=SearchingManager::getSearchingsByStatus(0);
        $drawings=DrawingManager::getDrawingsByStatus(0);
        $data=array(
            'admin'=>$admin,
            'leagues'=>$leagues,
            'advices'=>$advices,
            'searchings'=>$searchings,
            'drawings'=>$drawings,
        );
        return view('admin.index.index', $data);
    }
    //错误页面
    public function error(Request $request)
    {
        $data = $request->all();
        return view('admin.index.error500', $data);
    }
    //欢迎页
    public function welcome(Request $request)
    {
        return view('admin.index.welcome');
    }
}