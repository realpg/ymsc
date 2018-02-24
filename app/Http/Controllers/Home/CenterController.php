<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/2/23
 * Time: 17:25
 */

namespace App\Http\Controllers\Home;

use App\Components\MemberManager;
use App\Components\QNManager;
use App\Components\VertifyManager;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;

class CenterController extends Controller
{
    public function index(Request $request){
        $data=$request->all();
        $user=$request->cookie('user');
        $common=$data['common'];
        if($user){
            $column='center';
            $column_child='index';
            //生成七牛token
            $upload_token = QNManager::uploadToken();
            $param=array(
                'common'=>$common,
                'column'=>$column,
                'column_child'=>$column_child,
                'user'=>$user,
                'upload_token'=>$upload_token
            );
            return view('home.center.index',$param);
        }
        else{
            return redirect('signIn');
        }
    }
    /*
     * 编辑基本信息
     */
    public function baseDo(Request $request){
        $data=$request->all();
        $user=$request->cookie('user');
        if($user){
            $return=null;
            $member=MemberManager::setUser($user,$data);
            $result=$member->save();
            if($result){
                Cookie::queue('user', $member);
                $return['result']=true;
                $return['msg']='编辑个人信息成功';
            }
            else{
                $return['result']=false;
                $return['msg']='编辑个人信息失败';
            }
        }
        else{
            $return['result']=false;
            $return['msg']='编辑个人信息失败，请先登录';
        }
        return $return;
    }
    /*
     * 验证原邮箱
     */
    public function checkEmail(Request $request){
        $data=$request->all();
        $user=$request->cookie('user');
        $common=$data['common'];
        if($user){
            $column='center';
            $column_child='index';
            $param=array(
                'common'=>$common,
                'column'=>$column,
                'column_child'=>$column_child,
                'user'=>$user
            );
            return view('home.center.checkEmail',$param);
        }
        else{
            return redirect('signIn');
        }
    }
    /*
     * 修改邮箱
     */
    public function replaceEmail(Request $request){
        $data=$request->all();
        $user=$request->cookie('user');
        $common=$data['common'];
        if($user){
            $column='center';
            $column_child='index';
            $param=array(
                'common'=>$common,
                'column'=>$column,
                'column_child'=>$column_child,
                'user'=>$user
            );
            return view('home.center.replaceEmail',$param);
        }
        else{
            return redirect('signIn');
        }
    }
    /*
     * 验证原手机号
     */
    public function checkPhonenum(Request $request){
        $data=$request->all();
        $user=$request->cookie('user');
        $common=$data['common'];
        if($user){
            $column='center';
            $column_child='index';
            $param=array(
                'common'=>$common,
                'column'=>$column,
                'column_child'=>$column_child,
                'user'=>$user
            );
            return view('home.center.checkPhonenum',$param);
        }
        else{
            return redirect('signIn');
        }
    }
    /*
     * 修改手机号
     */
    public function replacePhonenum(Request $request){
        $data=$request->all();
        $user=$request->cookie('user');
        $common=$data['common'];
        if($user){
            $column='center';
            $column_child='index';
            $param=array(
                'common'=>$common,
                'column'=>$column,
                'column_child'=>$column_child,
                'user'=>$user
            );
            return view('home.center.replacePhonenum',$param);
        }
        else{
            return redirect('signIn');
        }
    }
    /*
     * 修改绑定的手机号或邮箱验证
     */
    public function check(Request $request){
        $data=$request->all();
        $user=$request->cookie('user');
        if(array_key_exists('type',$data)){
            if(array_key_exists('verificationCode',$data)){
                if($data['type']=='checkPhonenum'&&array_key_exists('phonenum',$data)){
                    $vertify_result = VertifyManager::judgeVertifyCode($data['phonenum'], $data['verificationCode']);
                    if($vertify_result){
                        if($user['phonenum']==$data['phonenum']){
                            $return['result']=true;
                            $return['msg']='验证成功';
                        }
                        else{
                            $return['result']=false;
                            $return['msg']='验证失败';
                        }
                    }
                    else{
                        $return['result']=false;
                        $return['msg']='验证码不正确';
                    }
                }
                else if($data['type']=='checkEmail'&&array_key_exists('email',$data)){
                    $vertify_result = VertifyManager::judgeVertifyCodeByEmail($data['email'], $data['verificationCode']);
                    if($vertify_result){
                        if($user['email']==$data['email']){
                            $return['result']=true;
                            $return['msg']='验证成功';
                        }
                        else{
                            $return['result']=false;
                            $return['msg']='验证码不正确';
                        }
                    }
                    else{
                        $return['result']=false;
                        $return['msg']='验证码不正确';
                    }
                }
                else{
                    $return['result']=false;
                    $return['msg']='非法操作';
                }
            }
            else{
                $return['result']=false;
                $return['msg']='缺少参数';
            }
        }
        else{
            $return['result']=false;
            $return['msg']='缺少参数';
        }
        return $return;
    }
    /*
     * 修改绑定的手机号或邮箱
     */
    public function editDo(Request $request){
        $data=$request->all();
        $user=$request->cookie('user');
        if(array_key_exists('type',$data)){
            if(array_key_exists('verificationCode',$data)){
                if($data['type']=='replacePhonenum'&&array_key_exists('phonenum',$data)){
                    $vertify_result = VertifyManager::judgeVertifyCode($data['phonenum'], $data['verificationCode']);
                    if($vertify_result){
                        $check_result=MemberManager::getUserInfoByPhonenum($data['phonenum']);
                        if(!$check_result){
                            unset($data['verificationCode']);
                            $member=MemberManager::setUser($user,$data);
                            $result=$member->save();
                            if($result){
                                Cookie::queue('user', $member);
                                $return['result']=true;
                                $return['msg']='修改成功';
                            }
                            else{
                                $return['result']=false;
                                $return['msg']='修改失败';
                            }
                        }
                        else{
                            $return['result']=false;
                            $return['msg']='该手机号已经注册过，不能重复注册';
                        }
                    }
                    else{
                        $return['result']=false;
                        $return['msg']='验证码不正确';
                    }
                }
                else if($data['type']=='replaceEmail'&&array_key_exists('email',$data)){
                    $vertify_result = VertifyManager::judgeVertifyCodeByEmail($data['email'], $data['verificationCode']);
                    if($vertify_result){
                        $check_result=MemberManager::getUserInfoByEmail($data['email']);
                        if(!$check_result){
                            unset($data['verificationCode']);
                            $member=MemberManager::setUser($user,$data);
                            $result=$member->save();
                            if($result){
                                Cookie::queue('user', $member);
                                $return['result']=true;
                                $return['msg']='修改成功';
                            }
                            else{
                                $return['result']=false;
                                $return['msg']='修改失败';
                            }
                        }
                        else{
                            $return['result']=false;
                            $return['msg']='该邮箱已经注册过，不能重复注册';
                        }
                    }
                    else{
                        $return['result']=false;
                        $return['msg']='验证码不正确';
                    }
                }
                else{
                    $return['result']=false;
                    $return['msg']='非法操作';
                }
            }
            else{
                $return['result']=false;
                $return['msg']='缺少参数';
            }
        }
        else{
            $return['result']=false;
            $return['msg']='缺少参数';
        }
        return $return;
    }
}