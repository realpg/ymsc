<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/2/2
 * Time: 13:14
 */

namespace app\Http\Controllers\Home;

use App\Components\VertifyManager;
use App\Http\Controllers\ApiResponse;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
//引用对应的命名空间
use Gregwar\Captcha\CaptchaBuilder;
use Session;

class CodeController extends Controller
{
    //生成图片验证码
    public function captcha(Request $request)
    {
        $data=$request->all();
        $builder = new CaptchaBuilder();
        $builder->build(150,36);
        $phrase = $builder->getPhrase();
        //把内容存入session
        Session::flash('verificationCode', $phrase); //存储验证码
        ob_clean(); //清除缓存
//        //直接显示
//        return response($builder->output())->header('Content-type','image/jpeg'); //把验证码数据以jpeg图片的格式输出
        //生成图片
        header('Content-Type: image/jpeg');
        $builder->output();
    }

    /*
    * 下发验证码
    *
    * By TerryQi
    *
    * 2017-11-28
    *
    */
    public function sendVertifyCode(Request $request)
    {
        $data=$request->all();
        $return=null;
        if(array_key_exists('phonenum',$data)){
            if(empty($data['phonenum'])){
                $return['result']=false;
                $return['msg']='请填写手机号码';
            }
            else{
                $result = VertifyManager::sendVertify($data['phonenum']);
                if($result){
                    $return['result']=true;
                    $return['msg']='验证码发送成功，请注意查收';
                }
                else{
                    $return['result']=false;
                    $return['msg']='验证码发送失败';
                }
            }
        }
        else{
            $return['result']=false;
            $return['msg']='请填写手机号码';
        }
        return $return;
    }
}