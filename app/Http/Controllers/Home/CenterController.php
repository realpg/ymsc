<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/2/23
 * Time: 17:25
 */

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CenterController extends Controller
{
    public function index(Request $request){
        $data=$request->all();
        $user=$request->cookie('user');
        $common=$data['common'];
        if(empty($user)){
            return redirect('signIn');
        }
        else{
            $column='center';
            $column_child='index';
            $param=array(
                'common'=>$common,
                'column'=>$column,
                'column_child'=>$column_child,
                'user'=>$user
            );
            return view('home.center.index',$param);
        }
    }
}