<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/3/1
 * Time: 9:48
 */

namespace App\Components;


use App\Models\InvoiceModel;

class InvoiceManager
{
    const PAGINATE_ADMIN = 10;  //后台分页数目
    /*
         * 配置发票参数
         *
         * By zm
         *
         * 2018-02-25
         *
         */
    public static function setInvoice($invoice, $data){
        if (array_key_exists('type', $data)) {
            $invoice->type = array_get($data, 'type');
        }
        if (array_key_exists('examine', $data)) {
            $invoice->examine = array_get($data, 'examine');
        }
        if (array_key_exists('status', $data)) {
            $invoice->status = array_get($data, 'status');
        }
        if (array_key_exists('user_id', $data)) {
            $invoice->user_id = array_get($data, 'user_id');
        }
        if (array_key_exists('title', $data)) {
            $invoice->title = array_get($data, 'title');
        }
        if (array_key_exists('credit', $data)) {
            $invoice->credit = array_get($data, 'credit');
        }
        if (array_key_exists('name', $data)) {
            $invoice->name = array_get($data, 'name');
        }
        if (array_key_exists('phonenum', $data)) {
            $invoice->phonenum = array_get($data, 'phonenum');
        }
        if (array_key_exists('address', $data)) {
            $invoice->address = array_get($data, 'address');
        }
        if (array_key_exists('company_address', $data)) {
            $invoice->company_address = array_get($data, 'company_address');
        }
        if (array_key_exists('company_tel', $data)) {
            $invoice->company_tel = array_get($data, 'company_tel');
        }
        if (array_key_exists('bank', $data)) {
            $invoice->bank = array_get($data, 'bank');
        }
        if (array_key_exists('number', $data)) {
            $invoice->number = array_get($data, 'number');
        }
        if (array_key_exists('licence', $data)) {
            $invoice->licence = array_get($data, 'licence');
        }
        if (array_key_exists('business_license', $data)) {
            $invoice->business_license = array_get($data, 'business_license');
        }
        if (array_key_exists('account_opening_permit', $data)) {
            $invoice->account_opening_permit = array_get($data, 'account_opening_permit');
        }
        if (array_key_exists('tax_registration_certificate', $data)) {
            $invoice->tax_registration_certificate = array_get($data, 'tax_registration_certificate');
        }
        if (array_key_exists('delete', $data)) {
            $invoice->delete = array_get($data, 'delete');
        }
        return $invoice;
    }

    /*
     * 根据id获取发票
     *
     * By zm
     *
     * 2018-02-25
     *
     */
    public static function getInvoiceById($id){
        $invoice=InvoiceModel::where('id',$id)->first();
        return $invoice;
    }

    /*
     * 根据user_id和invoice_id获取之前的默认发票
     *
     * By zm
     *
     * 2018-02-25
     *
     */
    public static function getInvoiceByUserIdAndInvoiceId($user_id,$invoice_id){
        $invoices=InvoiceModel::where('user_id',$user_id)->where('status',1)->whereNotIn('id',[$invoice_id])->get();
        return $invoices;
    }

    /*
     * 根据user_id获取发票列表
     *
     * By zm
     *
     * 2018-02-25
     *
     */
    public static function getInvoiceListsByUserId($user_id){
        $invoices=InvoiceModel::where('delete',0)->where('user_id',$user_id)->orderBy('id','asc')->get();
        return $invoices;
    }

    /*
     * 模糊查询获取增值税专用发票列表（无分页）
     *
     * By zm
     *
     * 2018-03-05
     *
     */
    public static function getSpecialInvoiceListsBySearch($search){
        $invoices=InvoiceModel::where(function($invoices)use($search){
            $invoices->where('name','like','%'.$search.'%')
                ->where('phonenum','like','%'.$search.'%');
            })->where('type',1)->orderBy('examine','asc')->orderBy('id','asc')->get();
        return $invoices;
    }

    /*
     * 模糊查询获取增值税专用发票列表（有分页）
     *
     * By zm
     *
     * 2018-04-18
     *
     */
    public static function getSpecialInvoiceListsBySearchWithPage($search,$examine){
        //分页数目
        $paginate=self::PAGINATE_ADMIN;
        if($examine==''){
            $invoices=InvoiceModel::where(function($invoices)use($search){
                $invoices->where('name','like','%'.$search.'%')
                    ->where('phonenum','like','%'.$search.'%');
            })->where('type',1)->orderBy('examine','asc')->orderBy('id','asc')->paginate($paginate);
        }
        else{
            $invoices=InvoiceModel::where(function($invoices)use($search){
                $invoices->where('name','like','%'.$search.'%')
                    ->where('phonenum','like','%'.$search.'%');
            })->where('type',1)->where('examine',$examine)->orderBy('examine','asc')->orderBy('id','asc')->paginate($paginate);
        }
        return $invoices;
    }
}