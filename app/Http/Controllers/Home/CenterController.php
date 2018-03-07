<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/2/23
 * Time: 17:25
 */

namespace App\Http\Controllers\Home;

use App\Components\CartManager;
use App\Components\AddressManager;
use App\Components\InvoiceManager;
use App\Components\MemberManager;
use App\Components\QNManager;
use App\Components\VertifyManager;
use App\Http\Controllers\Controller;
use App\Models\AddressModel;
use App\Models\InvoiceModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;

class CenterController extends Controller
{
    public function index(Request $request){
        $data=$request->all();
        $user=$request->cookie('user');
        $common=$data['common'];
        if($user){
            $user=MemberManager::getUserInfoByIdWithNotToken($user['id']);
            $column='center';
            $column_child='index';
            //生成七牛token
            $upload_token = QNManager::uploadToken();
            //购物车信息
            $carts = CartManager::getCartsByUserId($user['id']);
            $param=array(
                'common'=>$common,
                'column'=>$column,
                'column_child'=>$column_child,
                'user'=>$user,
                'upload_token'=>$upload_token,
                'carts'=>$carts
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
            $user=MemberManager::getUserInfoByIdWithNotToken($user['id']);
            $return=null;
            $member=MemberManager::setUser($user,$data);
            $result=$member->save();
            if($result){
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
            $return['msg']='编辑个人信息失败，用户信息已过期或已经被清除，请重新登录';
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
            $user=MemberManager::getUserInfoByIdWithNotToken($user['id']);
            $column='center';
            $column_child='index';
            //购物车信息
            $carts = CartManager::getCartsByUserId($user['id']);
            $param=array(
                'common'=>$common,
                'column'=>$column,
                'column_child'=>$column_child,
                'user'=>$user,
                'carts'=>$carts
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
            $user=MemberManager::getUserInfoByIdWithNotToken($user['id']);
            $column='center';
            $column_child='index';
            //购物车信息
            $carts = CartManager::getCartsByUserId($user['id']);
            $param=array(
                'common'=>$common,
                'column'=>$column,
                'column_child'=>$column_child,
                'user'=>$user,
                'carts'=>$carts
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
            $user=MemberManager::getUserInfoByIdWithNotToken($user['id']);
            $column='center';
            $column_child='index';
            //购物车信息
            $carts = CartManager::getCartsByUserId($user['id']);
            $param=array(
                'common'=>$common,
                'column'=>$column,
                'column_child'=>$column_child,
                'user'=>$user,
                'carts'=>$carts
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
            $user=MemberManager::getUserInfoByIdWithNotToken($user['id']);
            $column='center';
            $column_child='index';
            //购物车信息
            $carts = CartManager::getCartsByUserId($user['id']);
            $param=array(
                'common'=>$common,
                'column'=>$column,
                'column_child'=>$column_child,
                'user'=>$user,
                'carts'=>$carts
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
        if($user){
            $user=MemberManager::getUserInfoByIdWithNotToken($user['id']);
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
        }
        else{
            $return['result']=false;
            $return['msg']='验证失败，用户信息已过期或已经被清除，请重新登录';
        }
        return $return;
    }
    /*
     * 修改绑定的手机号或邮箱
     */
    public function editDo(Request $request){
        $data=$request->all();
        $user=$request->cookie('user');
        if($user){
            $user=MemberManager::getUserInfoByIdWithNotToken($user['id']);
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
        }
        else{
            $return['result']=false;
            $return['msg']='绑定失败，用户信息已过期或已经被清除，请重新登录';
        }
        return $return;
    }
    /*
     * 管理地址
     */
    public function address(Request $request){
        $data=$request->all();
        $user=$request->cookie('user');
        $common=$data['common'];
        $addresses=AddressManager::getAddressListsByUserId($user['id']);
        if($user){
            $user=MemberManager::getUserInfoByIdWithNotToken($user['id']);
            $column='center';
            $column_child='address';
            //购物车信息
            $carts = CartManager::getCartsByUserId($user['id']);
            $param=array(
                'common'=>$common,
                'column'=>$column,
                'column_child'=>$column_child,
                'user'=>$user,
                'addresses'=>$addresses,
                'carts'=>$carts
            );
            return view('home.center.address',$param);
        }
        else{
            return redirect('signIn');
        }
    }
    /*
     * 编辑管理地址
     */
    public function addressDo(Request $request){
        $data=$request->all();
        $user=$request->cookie('user');
        $return=null;
        if($user){
            $user=MemberManager::getUserInfoByIdWithNotToken($user['id']);
            if(array_key_exists('id',$data)){
                $address=AddressManager::getAddressById($data['id']);
            }
            else{
                $data['user_id']=$user['id'];
                $data['province']=$data['address_province'];
                $data['city']=$data['address_city'];
                $data['town']=$data['address_town'];
                $data['detail']=$data['address_detail'];
                $address=new AddressModel();
            }
            $address=AddressManager::setAddress($address,$data);
            $result=$address->save();
            if($result){
                //如果新添加的地址设置成了默认地址，就取消之前的默认地址
                if($address['status']==1){
                    $default_addresses=AddressManager::getAddressByUserIdAndAddressId($user['id'],$address['id']);
                    foreach ($default_addresses as $default_addresse){
                        $default_address_id=$default_addresse['id'];
                        $default_address=AddressManager::getAddressById($default_address_id);
                        $data_default['id']=$default_address_id;
                        $data_default['status']=0;
                        $default_address=AddressManager::setAddress($default_address,$data_default);
                        $default_address->save();
                    }
                }
                $return['result']=true;
                $return['msg']='编辑地址成功';
            }
            else{
                $return['result']=false;
                $return['msg']='编辑地址失败';
            }
        }
        else{
            $return['result']=false;
            $return['msg']='编辑地址失败，用户信息已过期或已经被清除，请重新登录';
        }
        return $return;
    }
    /*
     * 删除地址
     */
    public function addressDel(Request $request){
        $data=$request->all();
        $user=$request->cookie('user');
        $return=null;
        if($user){
            $user=MemberManager::getUserInfoByIdWithNotToken($user['id']);
            if(array_key_exists('id',$data)){
                $address=AddressManager::getAddressById($data['id']);
//                $data['user_id']=$user['id'];
                $data['delete']=1;
                $address=AddressManager::setAddress($address,$data);
                $result=$address->save();
                if($result){
                    $return['result']=true;
                    $return['msg']='删除地址成功';
                }
                else{
                    $return['result']=false;
                    $return['msg']='删除地址失败';
                }
            }
            else{
                $return['result']=false;
                $return['msg']='缺少参数';
            }
        }
        else{
            $return['result']=false;
            $return['msg']='删除地址失败，用户信息已过期或已经被清除，请重新登录';
        }
        return $return;
    }
    /*
     * 设置默认地址
     */
    public function addressDefault(Request $request){
        $data=$request->all();
        $user=$request->cookie('user');
        $return=null;
        if($user){
            $user=MemberManager::getUserInfoByIdWithNotToken($user['id']);
            if(array_key_exists('id',$data)){
                $address=AddressManager::getAddressById($data['id']);
                $data['status']=1;
                $address=AddressManager::setAddress($address,$data);
                $result=$address->save();
                if($result){
                    $default_addresses=AddressManager::getAddressByUserIdAndAddressId($user['id'],$data['id']);
                    foreach ($default_addresses as $default_addresse){
                        $default_address_id=$default_addresse['id'];
                        $default_address=AddressManager::getAddressById($default_address_id);
                        $data_default['id']=$default_address_id;
                        $data_default['status']=0;
                        $default_address=AddressManager::setAddress($default_address,$data_default);
                        $default_address->save();
                    }
                    $return['result']=true;
                    $return['msg']='设置默认地址成功';
                }
                else{
                    $return['result']=false;
                    $return['msg']='设置默认地址失败';
                }
            }
            else{
                $return['result']=false;
                $return['msg']='缺少参数';
            }
        }
        else{
            $return['result']=false;
            $return['msg']='设置默认地址失败，用户信息已过期或已经被清除，请重新登录';
        }
        return $return;
    }
    /*
     * 管理发票
     */
    public function invoice(Request $request){
        $data=$request->all();
        $user=$request->cookie('user');
        $common=$data['common'];
        $invoices=InvoiceManager::getInvoiceListsByUserId($user['id']);
        //生成七牛token
        $upload_token = QNManager::uploadToken();
        if($user){
            $user=MemberManager::getUserInfoByIdWithNotToken($user['id']);
            $column='center';
            $column_child='invoice';
            //购物车信息
            $carts = CartManager::getCartsByUserId($user['id']);
            $param=array(
                'common'=>$common,
                'column'=>$column,
                'column_child'=>$column_child,
                'user'=>$user,
                'invoices'=>$invoices,
                'upload_token'=>$upload_token,
                'carts'=>$carts
            );
            return view('home.center.invoice',$param);
        }
        else{
            return redirect('signIn');
        }
    }
    /*
     * 编辑管理发票
     */
    public function invoiceDo(Request $request){
        $data=$request->all();
        $user=$request->cookie('user');
        $return=null;
        if($user){
            $user=MemberManager::getUserInfoByIdWithNotToken($user['id']);
            if(array_key_exists('id',$data)){
                $invoice=InvoiceManager::getInvoiceById($data['id']);
            }
            else{
                $data['user_id']=$user['id'];
                if($data['type']=='editOrdinaryInvoice'){
                    $data['type']=0;
                    $invoice=new InvoiceModel();
                }
                else if($data['type']=='editSpecialInvoice'){
                    $data['type']=1;
                    $data['phonenum']=$data['special_phonenum'];
                    if($data['licence']==1){
                        unset($data['business_license']);
                        unset($data['account_opening_permit']);
                        unset($data['tax_registration_certificate']);
                        $data['business_license']=$data['business_license_new'];
                    }
                    $invoice=new InvoiceModel();
                }
                else{
                    $return['result']=false;
                    $return['msg']='非法操作';
                    return $return;
                }
            }
            $invoice=InvoiceManager::setInvoice($invoice,$data);
            $result=$invoice->save();
            if($result){
                //如果新添加的地址设置成了默认地址，就取消之前的默认地址
                if($invoice['status']==1){
                    $default_invoices=InvoiceManager::getInvoiceByUserIdAndInvoiceId($user['id'],$invoice['id']);
                    foreach ($default_invoices as $default_invoice){
                        $default_invoice_id=$default_invoice['id'];
                        $default_invoice=InvoiceManager::getInvoiceById($default_invoice_id);
                        $data_default['id']=$default_invoice_id;
                        $data_default['status']=0;
                        $default_invoice=AddressManager::setAddress($default_invoice,$data_default);
                        $default_invoice->save();
                    }
                }
                $return['result']=true;
                $return['msg']='编辑发票成功';
            }
            else{
                $return['result']=false;
                $return['msg']='编辑发票失败';
            }
        }
        else{
            $return['result']=false;
            $return['msg']='编辑发票失败，用户信息已过期或已经被清除，请重新登录';
        }
        return $return;
    }
    /*
     * 删除发票
     */
    public function invoiceDel(Request $request){
        $data=$request->all();
        $user=$request->cookie('user');
        $return=null;
        if($user){
            $user=MemberManager::getUserInfoByIdWithNotToken($user['id']);
            if(array_key_exists('id',$data)){
                $invoice=InvoiceManager::getInvoiceById($data['id']);
                $data['delete']=1;
                $invoice=InvoiceManager::setInvoice($invoice,$data);
                $result=$invoice->save();
                if($result){
                    $return['result']=true;
                    $return['msg']='删除发票成功';
                }
                else{
                    $return['result']=false;
                    $return['msg']='删除发票失败';
                }
            }
            else{
                $return['result']=false;
                $return['msg']='缺少参数';
            }
        }
        else{
            $return['result']=false;
            $return['msg']='删除发票失败，用户信息已过期或已经被清除，请重新登录';
        }
        return $return;
    }
    /*
     * 设置默认地址
     */
    public function invoiceDefault(Request $request){
        $data=$request->all();
        $user=$request->cookie('user');
        $return=null;
        if($user){
            $user=MemberManager::getUserInfoByIdWithNotToken($user['id']);
            if(array_key_exists('id',$data)){
                $invoice=InvoiceManager::getInvoiceById($data['id']);
                $data['status']=1;
                $invoice=InvoiceManager::setInvoice($invoice,$data);
                $result=$invoice->save();
                if($result){
                    $default_invoices=InvoiceManager::getInvoiceByUserIdAndInvoiceId($user['id'],$data['id']);
                    foreach ($default_invoices as $default_invoice){
                        $default_invoice_id=$default_invoice['id'];
                        $default_invoice=InvoiceManager::getInvoiceById($default_invoice_id);
                        $data_default['id']=$default_invoice_id;
                        $data_default['status']=0;
                        $default_invoice=AddressManager::setAddress($default_invoice,$data_default);
                        $default_invoice->save();
                    }
                    $return['result']=true;
                    $return['msg']='设置默认地址成功';
                }
                else{
                    $return['result']=false;
                    $return['msg']='设置默认地址失败';
                }
            }
            else{
                $return['result']=false;
                $return['msg']='缺少参数';
            }
        }
        else{
            $return['result']=false;
            $return['msg']='设置默认地址失败，用户信息已过期或已经被清除，请重新登录';
        }
        return $return;
    }
}