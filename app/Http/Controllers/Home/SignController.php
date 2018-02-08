<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/2/2
 * Time: 9:43
 */

namespace app\Http\Controllers\Home;

use App\Components\MenuManager;
use App\Components\MemberManager;
use App\Components\VertifyManager;
use App\Http\Controllers\Controller;
use App\Models\UserModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;

class SignController extends Controller
{
    /*
     * 注册
     */
    public function signUp(Request $request){
        $data=$request->all();
        $user=$request->cookie('user');
        $common=$data['common'];
        $column='signUp';
        $menus=MenuManager::getClassAMenuLists();
        $param=array(
            'common'=>$common,
            'menus'=>$menus,
            'column'=>$column,
            'user'=>$user
        );
        if(array_key_exists('type',$data)){
            $type=$data['type'];
        }
        else{
            $type=0;
        }
        if($type==1){
            return view('home.sign.signUpByEmail',$param);
        }
        else{
            return view('home.sign.signUpByPhonenum',$param);
        }
    }

    /*
     * 执行注册
     */
    public function signUpDo(Request $request){
        $data=$request->all();
        $user=$request->cookie('user');
        $return=null;
        if(array_key_exists('type',$data)){
            $check_return=self::checkParam($data,$data['type']);
            if($check_return['result']){
                unset($data['common']);
                unset($data['agree']);
                $data['nick_name']='未命名';
                //判断此用户是否注册过
                if(array_key_exists('phonenum',$data)){
                    $vertify_result = VertifyManager::judgeVertifyCode($data['phonenum'], $data['verificationCode']);
                    if (!$vertify_result) {
                        $return['result']=false;
                        $return['msg']='验证码错误';
                    }
                    else {
                        unset($data['verificationCode']);
                        $user=MemberManager::getUserInfoByPhonenum($data['phonenum']);
                        if($user){
                            $return['result']=false;
                            $return['msg']='此用户已注册';
                        }
                        else{
                            //创建用户信息
                            $user = new UserModel();
                            $user = MemberManager::setUser($user, $data);
                            $user->token = MemberManager::getGUID();
                            $result=$user->save();
                            if($result){
                                $return['result']=true;
                                $return['msg']='注册成功';
                            }
                            else{
                                $return['result']=false;
                                $return['msg']='注册失败';
                            }
                        }
                    }
                }
                else if(array_key_exists('email',$data)){
                    $vertify_result = VertifyManager::judgeVertifyCodeByEmail($data['email'], $data['verificationCode']);
                    if(!$vertify_result){
                        $return['result']=false;
                        $return['msg']='验证码错误';
                    }
                    else{
                        unset($data['verificationCode']);
                        $user=MemberManager::getUserInfoByEmail($data['email']);
                        if($user){
                            $return['result']=false;
                            $return['msg']='此用户已注册';
                        }
                        else{
                            //创建用户信息
                            $user = new UserModel();
                            $user = MemberManager::setUser($user, $data);
                            $user->token = MemberManager::getGUID();
                            $result=$user->save();
                            if($result){
                                $return['result']=true;
                                $return['msg']='注册成功';
                            }
                            else{
                                $return['result']=false;
                                $return['msg']='注册失败';
                            }
                        }
                    }
                }
                else{
                    $return['result']=false;
                    $return['msg']='非法操作';
                }
            }
            else{
                $return=$check_return;
            }
        }
        else{
            $return['result']=false;
            $return['msg']='缺少参数';
        }
        return $return;
    }

    /*
     * 登录
     */
    public function signIn(Request $request){
        $data=$request->all();
        $user=$request->cookie('user');
        $common=$data['common'];
        $column='signIn';
        $menus=MenuManager::getClassAMenuLists();
        $param=array(
            'common'=>$common,
            'menus'=>$menus,
            'column'=>$column,
            'user'=>$user
        );
//        if(array_key_exists('type',$data)){
//            $type=$data['type'];
//        }
//        else{
//            $type=0;
//        }
//        if($type==1){
//            return view('home.sign.signInByWechat',$param);
//        }
//        else{
            return view('home.sign.signIn',$param);
//        }
    }

    /*
     * 执行登录
     */
    public function signInDo(Request $request){
        $data=$request->all();

        $return=null;
        $check_return=self::checkParam($data,'signIn');
        if($check_return['result']){
            $verificationCode=$request->session()->get('verificationCode');
            if ($verificationCode!=$data['verificationCode']) {
                $return['result']=false;
                $return['msg']='验证码错误';
            }
            else{
                unset($data['common']);
                $user=MemberManager::login($data);
                if($user){
                    unset($user['password']);
                    unset($user['token']);
                    Cookie::queue('user', $user, 10);

                    $return['result']=true;
                    $return['msg']='登录成功';
                }
                else{
                    $return['result']=false;
                    $return['msg']='登录失败，密码不正确';
                }
            }
        }
        else{
            $return=$check_return;
        }
        return $return;
    }

    /*
     * 修改密码
     */
    public function reset(Request $request){
        $data=$request->all();
        $user=$request->cookie('user');
        $common=$data['common'];
        $column='signIn';
        $menus=MenuManager::getClassAMenuLists();
        $param=array(
            'common'=>$common,
            'menus'=>$menus,
            'column'=>$column,
            'user'=>$user
        );
        if(array_key_exists('type',$data)){
            $type=$data['type'];
        }
        else{
            $type=0;
        }
        if($type==1){
            return view('home.sign.resetByEmail',$param);
        }
        else{
            return view('home.sign.resetByPhonenum',$param);
        }
    }

    /*
     * 执行修改密码
     */
    public function resetDo(Request $request){
        $data=$request->all();
        $return=null;
        if(array_key_exists('type',$data)){
            $check_return=self::checkParam($data,$data['type']);
            if($check_return['result']){
                unset($data['common']);
                unset($data['agree']);
                if(array_key_exists('phonenum',$data)){
                    $vertify_result = VertifyManager::judgeVertifyCode($data['phonenum'], $data['verificationCode']);
                    if (!$vertify_result) {
                        $return['result']=false;
                        $return['msg']='验证码错误';
                    }
                    else {
                        unset($data['verificationCode']);
                        $user=MemberManager::getUserInfoByPhonenum($data['phonenum']);
                        if($user){
                            $user = MemberManager::setUser($user, $data);
                            $result=$user->save();
                            if($result){
                                $return['result']=true;
                                $return['msg']='修改密码成功，请重新登录';
                            }
                            else{
                                $return['result']=false;
                                $return['msg']='修改密码失败';
                            }
                        }
                        else{
                            $return['result']=false;
                            $return['msg']='没有找到此用户';
                        }
                    }
                }
                else if(array_key_exists('email',$data)){
                    $vertify_result = VertifyManager::judgeVertifyCodeByEmail($data['email'], $data['verificationCode']);
                    if (!$vertify_result) {
                        $return['result']=false;
                        $return['msg']='验证码错误';
                    }
                    else {
                        $user=MemberManager::getUserInfoByEmail($data['email']);
                        if($user){
                            unset($data['verificationCode']);
                            $user = MemberManager::setUser($user, $data);
                            $result=$user->save();
                            if($result){
                                $return['result']=true;
                                $return['msg']='修改密码成功，请重新登录';
                            }
                            else{
                                $return['result']=false;
                                $return['msg']='修改密码失败';
                            }
                        }
                        else{
                            $return['result']=false;
                            $return['msg']='没有找到此用户';
                        }
                    }
                }
                else{
                    $return['result']=false;
                    $return['msg']='非法操作';
                }
            }
            else{
                $return=$check_return;
            }
        }
        else{
            $return['result']=false;
            $return['msg']='缺少参数';
        }
        return $return;
    }

    /*
     * 参数验证
     */
    public function checkParam($data,$type){
        $return=null;
        $tel = "/^1[34578]\d{9}$/";  //手机
        $email="/\w+([-+.']\w+)*@\w+([-.]\w+)*\.\w+([-.]\w+)*/"; //邮箱
        if($type=='signUpByPhonenum'||$type=='resetByPhonenum'){
            if(!array_key_exists('phonenum',$data)){
                $return['result']=false;
                $return['msg']='请填写手机号';
            }
            else if(!array_key_exists('password',$data)){
                $return['result']=false;
                $return['msg']='请填写密码';
            }
            else if(!array_key_exists('verificationCode',$data)){
                $return['result']=false;
                $return['msg']='请填写验证码';
            }
            else if(!preg_match($tel , $data['phonenum'])){
                $return['result']=false;
                $return['msg']='请填写正确的手机号';
            }
            else{
                $return['result']=true;
                $return['msg']='参数校验成功';
            }
        }
        else if($type=='signUpByEmail'||$type=='resetByEmail'){
            if(!array_key_exists('email',$data)){
                $return['result']=false;
                $return['msg']='请填写邮箱';
            }
            else if(!array_key_exists('password',$data)){
                $return['result']=false;
                $return['msg']='请填写密码';
            }
            else if(!array_key_exists('verificationCode',$data)){
                $return['result']=false;
                $return['msg']='请填写验证码';
            }
            else if(!preg_match($email , $data['email'])){
                $return['result']=false;
                $return['msg']='请填写正确的邮箱';
            }
            else{
                $return['result']=true;
                $return['msg']='参数校验成功';
            }
        }
        else if($type=='signIn'){
            if(!array_key_exists('phonenum',$data)){
                $return['result']=false;
                $return['msg']='请填写手机号';
            }
            else if(!array_key_exists('password',$data)){
                $return['result']=false;
                $return['msg']='请填写密码';
            }
            else if(!array_key_exists('verificationCode',$data)){
                $return['result']=false;
                $return['msg']='请填写验证码';
            }
            else{
                $return['result']=true;
                $return['msg']='参数校验成功';
            }
        }
        return $return;
    }
}