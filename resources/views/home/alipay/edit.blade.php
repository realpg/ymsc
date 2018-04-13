@extends('home.layouts.base')
@section('content')
    <div id="main-body">
        <div class="style-home-nav-station"></div>
        @include('home.layouts.payProgress')
        <div class="container margin-top-20">
            @if(count($order['suborders'])>0)
                <h4>核对并填写订单信息</h4>
                <div class="border-detail padding-20">
                    <div>
                        <div class="border-callout-info padding-left-10">
                            <h4>收货人信息</h4>
                        </div>
                        <div class="row margin-bottom-20 padding-left-20 padding-right-20 border-bottom-detail center-address">
                            @if(count($addresses)==0)
                                <form method="post" id="form-center-address-edit">
                                    {{ csrf_field() }}
                                    <div class="col-xs-12 col-sm-8">
                                        <div class="row position-relative margin-top-20">
                                            <div class="col-xs-6 col-sm-3 text-right"><i>*</i> 收 货 人：</div>
                                            <div class="col-xs-6 col-sm-8">
                                                <input type="text" name="name" id="name" class="form-control" placeholder="请输入收货人">
                                            </div>
                                        </div>
                                        <div class="row position-relative margin-top-20">
                                            <div class="col-xs-6 col-sm-3 text-right"><i>*</i> 所 在 地 区：</div>
                                            <div class="col-xs-12 col-sm-8">
                                                <div class="col-xs-4 col-sm-4 padding-left-0">
                                                    <select name="address_province" id="address_province"  class="form-control">
                                                        <option value="">请选择</option>
                                                    </select>
                                                </div>
                                                <div class=" col-xs-4 col-sm-4 padding-left-0">
                                                    <select name="address_city" id="address_city"  class="form-control">
                                                        <option value="">请选择</option>
                                                    </select>
                                                </div>
                                                <div class=" col-xs-4 col-sm-4 padding-left-0">
                                                    <select name="address_town" id="address_town"  class="form-control">
                                                        <option value="">请选择</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row position-relative margin-top-20">
                                            <div class="col-xs-6 col-sm-3 text-right"><i>*</i> 详 细 地 址：</div>
                                            <div class="col-xs-6 col-sm-8">
                                                <input type="text" name="address_detail" id="address_detail" class="form-control" placeholder="请输入详细地址">
                                            </div>
                                        </div>
                                        <div class="row position-relative margin-top-20">
                                            <div class="col-xs-6 col-sm-3 text-right"><i>*</i> 手 机 号 码：</div>
                                            <div class="col-xs-6 col-sm-8">
                                                <input type="text" name="phonenum" id="phonenum" class="form-control" placeholder="请输入手机号码">
                                            </div>
                                        </div>
                                        <div class="row position-relative margin-top-20">
                                            <div class="col-xs-6 col-sm-3 text-right">固 定 电 话：</div>
                                            <div class="col-xs-6 col-sm-8">
                                                <input type="text" name="phone" id="phone" class="form-control" placeholder="请输入固定电话">
                                            </div>
                                        </div>
                                        <div class="row position-relative margin-top-20">
                                            <div class="col-xs-6 col-sm-3 text-right">邮 编：</div>
                                            <div class="col-xs-6 col-sm-8">
                                                <input type="text" name="code" id="code" class="form-control" placeholder="请输入邮编">
                                            </div>
                                        </div>
                                        <div class="row position-relative margin-top-20">
                                            <div class="col-xs-6 col-sm-3 text-right"></div>
                                            <div class="col-xs-6 col-sm-8">
                                                <input type="hidden" name="status" id="status" value="1" />
                                            </div>
                                        </div>
                                        <div class="row position-relative margin-top-20 margin-bottom-20">
                                            <div class="col-xs-2 col-sm-3 text-right"></div>
                                            <div class="col-xs-10 col-sm-8">
                                                <button type="submint" class="btn btn-info border-radius-0 margin-right-10">确 认 添 加</button>
                                                <button type="reset" class="btn btn-default border-radius-0">取 消</button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            @else
                                <div class="table-responsive">
                                    <table class="table border-0">
                                        <tr class="line-height-40 text-center">
                                            <td class="background-detail style-ellipsis-1">选择</td>
                                            <td class="background-detail style-ellipsis-1">收货人</td>
                                            <td class="background-detail style-ellipsis-1">地址</td>
                                            <td class="background-detail style-ellipsis-1">状态</td>
                                            <td class="background-detail style-ellipsis-1">详情</td>
                                        </tr>
                                        @foreach($addresses as $address)
                                            <tr class="line-height-40">
                                                <td class="text-center style-ellipsis-1 border-bottom-attribute">
                                                    <input type="radio" name="address_id" value="{{$address['id']}}" {{$address['status']==1?'checked':''}} />
                                                </td>
                                                <td class="text-center style-ellipsis-1 border-bottom-attribute">{{$address['name']}}</td>
                                                <td class="text-center style-ellipsis-1 border-bottom-attribute">
                                                    {{$address['province']}} {{$address['city']}} {{$address['town']}}  {{$address['detail']}}
                                                </td>
                                                <td class="text-center style-ellipsis-1 border-bottom-attribute">
                                                    @if($address['status'])
                                                        <span class="label label-danger padding-left-5 padding-right-5">默 认 地 址</span>
                                                    @endif
                                                </td>
                                                <td class="text-center style-ellipsis-1 border-bottom-attribute">
                                                    <a href="" data-toggle="modal" data-target="#addressModel_{{$address['id']}}" >
                                                        <span class="text-blue padding-left-5 padding-right-5">详 情</span>
                                                    </a>
                                                </td>
                                            </tr>
                                            <!-- Modal -->
                                            <div class="modal fade" id="addressModel_{{$address['id']}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                            <h4>地址详情</h4>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div class="row position-relative margin-top-20">
                                                                <div class="col-xs-6 col-sm-3 text-right">收 货 人：</div>
                                                                <div class="col-xs-6 col-sm-8">
                                                                    {{$address['name']}}
                                                                </div>
                                                            </div>
                                                            <div class="row position-relative margin-top-20">
                                                                <div class="col-xs-6 col-sm-3 text-right">收 货 地 址：</div>
                                                                <div class="col-xs-6 col-sm-8">
                                                                    {{$address['province']}} {{$address['city']}} {{$address['town']}}  {{$address['detail']}}
                                                                </div>
                                                            </div>
                                                            @if($address['phonenum'])
                                                                <div class="row position-relative margin-top-20">
                                                                    <div class="col-xs-6 col-sm-3 text-right">手 机 号 码：</div>
                                                                    <div class="col-xs-6 col-sm-8">
                                                                        {{$address['phonenum']}}
                                                                    </div>
                                                                </div>
                                                            @endif
                                                            @if($address['phone'])
                                                                <div class="row position-relative margin-top-20">
                                                                    <div class="col-xs-6 col-sm-3 text-right">固 定 电 话：</div>
                                                                    <div class="col-xs-6 col-sm-8">
                                                                        {{$address['phone']}}
                                                                    </div>
                                                                </div>
                                                            @endif
                                                            @if($address['code'])
                                                                <div class="row position-relative margin-top-20">
                                                                    <div class="col-xs-6 col-sm-3 text-right">邮 编：</div>
                                                                    <div class="col-xs-6 col-sm-8">
                                                                        {{$address['code']}}
                                                                    </div>
                                                                </div>
                                                            @endif
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </table>
                                </div>
                            @endif
                        </div>
                    </div>
                    @if(count($invoices)>0)
                        <div>
                            <div class="border-callout-info padding-left-10">
                                <h4>发票信息</h4>
                            </div>
                            <div class="row margin-bottom-20 padding-left-20 padding-right-20 border-bottom-detail center-address">
                                <div class="row margin-bottom-20 padding-left-20 padding-right-20">
                                        <div class="table-responsive">
                                            <table class="table border-0">
                                                <tr>
                                                    <td class="background-detail style-ellipsis-1 line-height-40 text-center">选择</td>
                                                    {{--<td class="background-detail style-ellipsis-1 line-height-40 text-center">类型</td>--}}
                                                    <td class="background-detail style-ellipsis-1 line-height-40 text-center">收票人姓名</td>
                                                    <td class="background-detail style-ellipsis-1 line-height-40 text-center">收票人电话</td>
                                                    <td class="background-detail style-ellipsis-1 line-height-40 text-center">收票人地址</td>
                                                    <td class="background-detail style-ellipsis-1 line-height-40 text-center">状态</td>
                                                    <td class="background-detail style-ellipsis-1 line-height-40 text-center">详情</td>
                                                </tr>
                                                @foreach($invoices as $invoice)
                                                    @if($invoice['type']==0)
                                                        <tr class="line-height-40" id="row_{{$invoice['id']}}">
                                                            <td class="text-center style-ellipsis-1 border-bottom-attribute">
                                                                <input type="radio" name="invoice_id" value="{{$invoice['id']}}" {{$invoice['status']==1?'checked':''}} />
                                                            </td>
                                                            {{--<td class="text-center style-ellipsis-1 border-bottom-attribute">普通</td>--}}
                                                            <td class="text-center style-ellipsis-1 border-bottom-attribute">{{$invoice['name']}}</td>
                                                            <td class="text-center style-ellipsis-1 border-bottom-attribute">{{$invoice['phonenum']}}</td>
                                                            <td class="text-center style-ellipsis-1 border-bottom-attribute">
                                                                {{$invoice['address']}}
                                                            </td>
                                                            <td class="text-center style-ellipsis-1 border-bottom-attribute">
                                                                @if($invoice['status'])
                                                                    <span class="label label-danger padding-left-5 padding-right-5">默 认 发 票 </span>
                                                                @endif
                                                            </td>
                                                            <td class="text-center style-ellipsis-1 border-bottom-attribute">
                                                                <a href="" data-toggle="modal" data-target="#invoiceModel_{{$invoice['id']}}" >
                                                                    <span class="text-blue padding-left-5 padding-right-5">详 情</span>
                                                                </a>
                                                            </td>
                                                        </tr>
                                                        <!-- Modal -->
                                                        <div class="modal fade" id="invoiceModel_{{$invoice['id']}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                                                            <div class="modal-dialog" role="document">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                                        <h4>发票详情</h4>
                                                                    </div>
                                                                    <div class="modal-body max-height-modal overflow-y-scroll">
                                                                        <div class="row position-relative margin-top-20">
                                                                            <div class="col-xs-6 col-sm-4 text-right">发 票 抬 头：</div>
                                                                            <div class="col-xs-6 col-sm-8">
                                                                                {{$invoice['title']}}
                                                                            </div>
                                                                        </div>
                                                                        <div class="row position-relative margin-top-20">
                                                                            <div class="col-xs-6 col-sm-4 text-right">税 号 / 信 用 代 码：</div>
                                                                            <div class="col-xs-6 col-sm-8">
                                                                                {{$invoice['credit']}}
                                                                            </div>
                                                                        </div>
                                                                        <div class="row position-relative margin-top-20">
                                                                            <div class="col-xs-6 col-sm-4 text-right">收 票 人 姓 名：</div>
                                                                            <div class="col-xs-6 col-sm-8">
                                                                                {{$invoice['name']}}
                                                                            </div>
                                                                        </div>
                                                                        <div class="row position-relative margin-top-20">
                                                                            <div class="col-xs-6 col-sm-4 text-right">收 票 人 电 话：</div>
                                                                            <div class="col-xs-6 col-sm-8">
                                                                                {{$invoice['phonenum']}}
                                                                            </div>
                                                                        </div>
                                                                        <div class="row position-relative margin-top-20">
                                                                            <div class="col-xs-6 col-sm-4 text-right">收 票 人 地 址：</div>
                                                                            <div class="col-xs-6 col-sm-8">
                                                                                {{$invoice['address']}}
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @elseif($invoice['type']==1)
                                                        @if($invoice['examine']==1)
                                                            <tr class="line-height-40" id="row_{{$invoice['id']}}">
                                                                <td class="text-center style-ellipsis-1 border-bottom-attribute">
                                                                    <input type="radio" name="invoice_id" value="{{$invoice['id']}}" {{$invoice['status']==1?'checked':''}} />
                                                                </td>
                                                                {{--<td class="text-center style-ellipsis-1 border-bottom-attribute">专用</td>--}}
                                                                <td class="text-center style-ellipsis-1 border-bottom-attribute">{{$invoice['name']}}</td>
                                                                <td class="text-center style-ellipsis-1 border-bottom-attribute">{{$invoice['phonenum']}}</td>
                                                                <td class="text-center style-ellipsis-1 border-bottom-attribute">
                                                                    {{$invoice['address']}}
                                                                </td>
                                                                <td class="text-center style-ellipsis-1 border-bottom-attribute">
                                                                    @if($invoice['status'])
                                                                        <span class="label label-danger padding-left-5 padding-right-5">默 认 发 票 </span>
                                                                    @endif
                                                                </td>
                                                                <td class="text-center style-ellipsis-1 border-bottom-attribute">
                                                                    <a href="" data-toggle="modal" data-target="#invoiceModel_{{$invoice['id']}}" >
                                                                        <span class="text-blue padding-left-5 padding-right-5">详 情</span>
                                                                    </a>
                                                                </td>
                                                            </tr>
                                                            <!-- Modal -->
                                                            <div class="modal fade" id="invoiceModel_{{$invoice['id']}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                                                                <div class="modal-dialog" role="document">
                                                                    <div class="modal-content">
                                                                        <div class="modal-header">
                                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                                            <h4>发票详情</h4>
                                                                        </div>
                                                                        <div class="modal-body max-height-modal overflow-y-scroll">
                                                                            <div class="row position-relative margin-top-20">
                                                                                <div class="col-xs-6 col-sm-4 text-right">单 位 名 称：</div>
                                                                                <div class="col-xs-6 col-sm-8">
                                                                                    {{$invoice['title']}}
                                                                                </div>
                                                                            </div>
                                                                            <div class="row position-relative margin-top-20">
                                                                                <div class="col-xs-6 col-sm-4 text-right">纳 税 人 识 别 码：</div>
                                                                                <div class="col-xs-6 col-sm-8">
                                                                                    {{$invoice['credit']}}
                                                                                </div>
                                                                            </div>
                                                                            <div class="row position-relative margin-top-20">
                                                                                <div class="col-xs-6 col-sm-4 text-right">注 册 地 址：</div>
                                                                                <div class="col-xs-6 col-sm-8">
                                                                                    {{$invoice['company_address']}}
                                                                                </div>
                                                                            </div>
                                                                            <div class="row position-relative margin-top-20">
                                                                                <div class="col-xs-6 col-sm-4 text-right">注 册 电 话：</div>
                                                                                <div class="col-xs-6 col-sm-8">
                                                                                    {{$invoice['company_tel']}}
                                                                                </div>
                                                                            </div>
                                                                            <div class="row position-relative margin-top-20">
                                                                                <div class="col-xs-6 col-sm-4 text-right">开 户 银 行：</div>
                                                                                <div class="col-xs-6 col-sm-8">
                                                                                    {{$invoice['bank']}}
                                                                                </div>
                                                                            </div>
                                                                            <div class="row position-relative margin-top-20">
                                                                                <div class="col-xs-6 col-sm-4 text-right">银 行 账 号：</div>
                                                                                <div class="col-xs-6 col-sm-8">
                                                                                    {{$invoice['number']}}
                                                                                </div>
                                                                            </div>
                                                                            <div class="row position-relative margin-top-20">
                                                                                <div class="col-xs-6 col-sm-4 text-right">收 票 人 姓 名：</div>
                                                                                <div class="col-xs-6 col-sm-8">
                                                                                    {{$invoice['name']}}
                                                                                </div>
                                                                            </div>
                                                                            <div class="row position-relative margin-top-20">
                                                                                <div class="col-xs-6 col-sm-4 text-right">收 票 人 电 话：</div>
                                                                                <div class="col-xs-6 col-sm-8">
                                                                                    {{$invoice['phonenum']}}
                                                                                </div>
                                                                            </div>
                                                                            <div class="row position-relative margin-top-20">
                                                                                <div class="col-xs-6 col-sm-4 text-right">收 票 人 地 址：</div>
                                                                                <div class="col-xs-6 col-sm-8">
                                                                                    {{$invoice['address']}}
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="modal-footer">
                                                                            <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        @endif
                                                    @endif
                                                @endforeach
                                                <tr class="line-height-40" id="row_{{$invoice['id']}}">
                                                    <td class="text-center style-ellipsis-1 border-bottom-attribute">
                                                        <input type="radio" name="invoice_id" value="" />
                                                    </td>
                                                    {{--<td class="text-center style-ellipsis-1 border-bottom-attribute"></td>--}}
                                                    <td class="text-center style-ellipsis-1 border-bottom-attribute">不开发票</td>
                                                    <td class="text-center style-ellipsis-1 border-bottom-attribute"></td>
                                                    <td class="text-center style-ellipsis-1 border-bottom-attribute"></td>
                                                    <td class="text-center style-ellipsis-1 border-bottom-attribute"></td>
                                                    <td class="text-center style-ellipsis-1 border-bottom-attribute"></td>
                                                </tr>
                                            </table>
                                        </div>
                                    </div>
                            </div>
                        </div>
                    @else
                        {{--<div>--}}
                            {{--<div class="border-callout-info padding-left-10">--}}
                                {{--<h4>发票信息</h4>--}}
                            {{--</div>--}}
                            {{--<div class="row margin-bottom-20 padding-left-20 padding-right-20 border-bottom-detail center-address">--}}
                                {{--<ul class="line-height-40 border-bottom-navy-blue common-text-align-center row margin-left-0 margin-right-0" id="tab">--}}
                                    {{--<li class="tab_active col-xs-12 col-sm-2 background-detail ">增值税普通发票</li>--}}
                                    {{--<li class="col-xs-12 col-sm-2 background-detail">增值税专用发票</li>--}}
                                {{--</ul>--}}
                                {{--<ul class="tab_content">--}}
                                    {{--<li style="display: block;">--}}
                                        {{--<div class="row">--}}
                                            {{--<form method="post" id="form-center-invoice-ordinary-edit">--}}
                                                {{--{{ csrf_field() }}--}}
                                                {{--<input type="hidden" name="type" id="type" value="editOrdinaryInvoice" class="form-control" />--}}
                                                {{--<div class="col-xs-12 col-sm-8">--}}
                                                    {{--<div class="row position-relative margin-top-20">--}}
                                                        {{--<div class="col-xs-6 col-sm-4 text-right"><i>*</i> 发 票 抬 头：</div>--}}
                                                        {{--<div class="col-xs-6 col-sm-8">--}}
                                                            {{--<input type="text" name="title" id="title" class="form-control" placeholder="请输入发票抬头">--}}
                                                        {{--</div>--}}
                                                    {{--</div>--}}
                                                    {{--<div class="row position-relative margin-top-20">--}}
                                                        {{--<div class="col-xs-6 col-sm-4 text-right"><i>*</i> 税 号 / 信 用 代 码：</div>--}}
                                                        {{--<div class="col-xs-6 col-sm-8">--}}
                                                            {{--<input type="text" name="credit" id="credit" class="form-control" placeholder="请输入税号/信用代码">--}}
                                                        {{--</div>--}}
                                                    {{--</div>--}}
                                                    {{--<div class="row position-relative margin-top-20">--}}
                                                        {{--<div class="col-xs-6 col-sm-4 text-right"><i>*</i> 收 票 人 姓 名：</div>--}}
                                                        {{--<div class="col-xs-6 col-sm-8">--}}
                                                            {{--<input type="text" name="name" id="invoice_name" class="form-control" placeholder="请输入收票人姓名">--}}
                                                        {{--</div>--}}
                                                    {{--</div>--}}
                                                    {{--<div class="row position-relative margin-top-20">--}}
                                                        {{--<div class="col-xs-6 col-sm-4 text-right"><i>*</i> 收 票 人 电 话：</div>--}}
                                                        {{--<div class="col-xs-6 col-sm-8">--}}
                                                            {{--<input type="text" name="phonenum" id="invoice_phonenum" class="form-control" placeholder="请输入收票人电话">--}}
                                                        {{--</div>--}}
                                                    {{--</div>--}}
                                                    {{--<div class="row position-relative margin-top-20">--}}
                                                        {{--<div class="col-xs-6 col-sm-4 text-right"><i>*</i> 收 票 人 地 址：</div>--}}
                                                        {{--<div class="col-xs-6 col-sm-8">--}}
                                                            {{--<input type="text" name="address" id="invoice_address" class="form-control" placeholder="请输入收票人地址">--}}
                                                        {{--</div>--}}
                                                    {{--</div>--}}
                                                    {{--<div class="row position-relative margin-top-20">--}}
                                                        {{--<div class="col-xs-6 col-sm-4 text-right"></div>--}}
                                                        {{--<div class="col-xs-6 col-sm-8">--}}
                                                            {{--<input type="hidden" name="status" id="status" value="1" readonly />--}}
                                                        {{--</div>--}}
                                                    {{--</div>--}}
                                                    {{--<div class="row position-relative margin-top-20 margin-bottom-20">--}}
                                                        {{--<div class="col-xs-2 col-sm-4 text-right"></div>--}}
                                                        {{--<div class="col-xs-10 col-sm-8">--}}
                                                            {{--<button type="submint" class="btn btn-info border-radius-0 margin-right-10">确 认 添 加</button>--}}
                                                            {{--<button type="reset" class="btn btn-default border-radius-0">取 消</button>--}}
                                                        {{--</div>--}}
                                                    {{--</div>--}}
                                                {{--</div>--}}
                                            {{--</form>--}}
                                        {{--</div>--}}
                                    {{--</li>--}}
                                    {{--<li>--}}
                                        {{--<div class="row">--}}
                                            {{--<div class="margin-top-20 margin-right-10 margin-left-10 text-center">--}}
                                                {{--<img src="{{ URL::asset('img/nothing.png') }}"  />--}}
                                            {{--</div>--}}
                                            {{--<div class="margin-top-20 text-center text-left index-font line-height-40">--}}
                                                {{--由于增值税专用发票需要进过平台审核通过后才可以使用，所以不能在此及时添加并使用。<br />--}}
                                                {{--请在我的优迈->发票管理（或<a href='{{URL::asset('center/invoice')}}'><span class="text-blue">点击此链接</span></a>）中对增值税专用发票进行设置，经审核通过后再使用。--}}
                                            {{--</div>--}}
                                        {{--</div>--}}
                                    {{--</li>--}}
                                {{--</ul>--}}
                            {{--</div>--}}
                        {{--</div>--}}
                    @endif
                    <div>
                        <div class="border-callout-info padding-left-10">
                            <h4>支付方式</h4>
                        </div>
                        <input type="hidden" id="pay_type" value="wx" />
                        <div class="row margin-bottom-20 padding-left-20 padding-right-20 border-bottom-detail">
                            <div class="col-xs-12 col-sm-2">
                                <a href="javascript:" onclick="switchPaymentMethod('wx')">
                                    <div class="margin-top-10 margin-bottom-10 margin-right-10 padding-10 border-box border-box-active height-50" style="text-align: center;" id="wx">
                                        <img src="{{URL::asset('img/wechat.png')}}" class="height-100" />
                                    </div>
                                </a>
                            </div>
                            <div class="col-xs-12 col-sm-2">
                                <a href="javascript:" onclick="switchPaymentMethod('ali')">
                                    <div class="margin-top-10 margin-bottom-10 margin-right-10 padding-10 border-box height-50" style="text-align: center;" id="ali">
                                        <img src="{{URL::asset('img/alipay.png')}}" class="height-100" />
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <div class="border-callout-info padding-left-10">
                            <h4>商品清单</h4>
                        </div>
                        订单号：<span id="trade_no">{{$order['trade_no']}}</span>
                        <table class="table border-0">
                            <tr class="line-height-40 text-center">
                                <td class="background-detail">图片</td>
                                <td class="background-detail">商品</td>
                                <td class="background-detail">单价（元）</td>
                                <td class="background-detail">商品单位</td>
                                <td class="background-detail">数量</td>
                                <td class="background-detail">小计（元）</td>
                            </tr>
                            @foreach($order['suborders'] as $k=>$suborder)
                                <tr class="text-center background-light">
                                    <td class="border-bottom-attribute"  style="display:table-cell;vertical-align:middle;">
                                        @if($suborder['goods_menu']['menu_id']==1)
                                            <a href="{{URL::asset($suborder['goods_column'].'/detail/'.$suborder['goods_info']['id'])}}">
                                        @elseif($suborder['goods_menu']['menu_id']==2)
                                            <a href="{{URL::asset($suborder['goods_column'].'/detail/'.$suborder['goods_info']['id'])}}">
                                        @elseif($suborder['goods_menu']['menu_id']==3)
                                            @if($suborder['goods_type']==0)
                                            <a href="{{URL::asset($suborder['goods_column'].'/detail/machining/'.$suborder['goods_info']['id'])}}">
                                            @else
                                            <a href="{{URL::asset($suborder['goods_column'].'/detail/standard/'.$suborder['goods_info']['id'])}}">
                                            @endif
                                        @endif
                                            <img src="{{$suborder['goods_picture']}}" alt="{{$suborder['goods_name']}}" class="width-50px height-50" />
                                            @if($suborder['goods_menu']['menu_id']==1||$suborder['goods_menu']['menu_id']==2||$suborder['goods_menu']['menu_id']==3)
                                        </a>
                                        @endif
                                    </td>
                                    <td class="border-bottom-attribute width-250 text-left" style="display:table-cell;vertical-align:middle;">
                                        @if($suborder['goods_menu']['menu_id']==1)
                                            <a href="{{URL::asset($suborder['goods_column'].'/detail/'.$suborder['goods_info']['id'])}}">
                                        @elseif($suborder['goods_menu']['menu_id']==2)
                                            <a href="{{URL::asset($suborder['goods_column'].'/detail/'.$suborder['goods_info']['id'])}}">
                                        @elseif($suborder['goods_menu']['menu_id']==3)
                                            @if($suborder['goods_type']==0)
                                            <a href="{{URL::asset($suborder['goods_column'].'/detail/machining/'.$suborder['goods_info']['id'])}}">
                                            @else
                                            <a href="{{URL::asset($suborder['goods_column'].'/detail/standard/'.$suborder['goods_info']['id'])}}">
                                            @endif
                                        @endif
                                                商品货号：{{$suborder['goods_number']}}<br />
                                                商品名称：{{$suborder['goods_name']}}
                                        @if($suborder['goods_menu']['menu_id']==1||$suborder['goods_menu']['menu_id']==2||$suborder['goods_menu']['menu_id']==3)
                                            </a>
                                        @endif
                                    </td>
                                    <td class="border-bottom-attribute" style="display:table-cell;vertical-align:middle;" id="price_{{$suborder['id']}}">{{$suborder['total_fee']/100}}</td>
                                    <td class="border-bottom-attribute" style="display:table-cell;vertical-align:middle;">{{$suborder['goods_unit']}}</td>
                                    <td class="border-bottom-attribute" style="display:table-cell;vertical-align:middle;">{{$suborder['count']}}</td>
                                    <td class="border-bottom-attribute text-red" style="display:table-cell;vertical-align:middle;" id="total_{{$suborder['id']}}">{{$suborder['total_fee']/100*$suborder['count']}}</td>
                                </tr>
                            @endforeach
                        </table>
                        <div>
                            <textarea name="content" id="content" class="form-control" rows="3" style="resize: none;" placeholder="请填写备注">{{$order['content']}}</textarea>
                        </div>
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table border-detail margin-top-20 margin-bottom-20">
                        <tr class="line-height-40 text-center">
                            <td class="text-left text-blue width-250" style="display:table-cell;vertical-align:middle;border:0px;">
                                <a href="{{URL::asset('cart')}}"  >
                                    < 返回购物车
                                </a>
                            </td>
                            <td class="text-right width-250" style="display:table-cell;vertical-align:middle;border:0px;">
                               共<span class="text-red">{{$order['count']}}</span>件商品
                            </td>
                            <td class="text-right width-250" style="display:table-cell;vertical-align:middle;border:0px;">
                                总价（包含<span class="text-red">￥10.00</span> 邮费）
                            </td>
                            <td class="text-center width-150 text-red" style="display:table-cell;vertical-align:middle;border:0px;">
                                ￥<span id="total_all">{{$order['total_fee']/100}}</span>
                            </td>
                            <td class="width-110 text-white background-blue cart-settlement" style="display:table-cell;vertical-align:middle;border:0px;padding:0px;" >
                                <a href="javascript:" onclick="pay()" class="line-height-40">
                                    立即结算
                                </a>
                            </td>
                        </tr>
                    </table>
                </div>
            @else
                <div class="margin-top-20 margin-right-10 margin-left-10 text-center">
                    <img src="{{ URL::asset('img/nothing.png') }}"  />
                </div>
                <div class="margin-top-20 text-center index-font">
                    您还没有需要支付的订单，快去添加一个吧！
                </div>
            @endif
        </div>
    </div>
@endsection

@section('script')
<script type="text/javascript" src="{{ URL::asset('/js/jQueryProvinces/address-select.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('/js/swiper-3.4.0.jquery.min.js') }}"></script>
<script type="text/javascript">
    $(function () {
        $("#form-center-address-edit").validate({
            rules: {
                name:{
                    required:true,
                },
                phonenum:{
                    required:true,
                    maxlength:11,
                    minlength:11,
                },
                address_province:{
                    required:true,
                },
                address_city:{
                    required:true,
                },
                address_town:{
                    required:true,
                },
                address_address:{
                    required:true,
                },
                address_detail:{
                    required:true,
                },
            },
            onkeyup: false,
            focusCleanup: false,
            success: "valid",
            submitHandler: function (form) {
                $(form).ajaxSubmit({
                    type: 'POST',
                    url: "{{ URL::asset('center/address')}}",
                    success: function (ret) {
                        if (ret.result) {
                            layer.msg(ret.msg, {icon: 1, time: 2000});
                            window.location.reload()
                        } else {
                            layer.msg(ret.msg, {icon: 2, time: 2000});
                        }
                    },
                    error: function (XmlHttpRequest, textStatus, errorThrown) {
                        layer.msg('操作失败', {icon: 2, time: 2000});
                        console.log("XmlHttpRequest:" + JSON.stringify(XmlHttpRequest));
                        console.log("textStatus:" + textStatus);
                        console.log("errorThrown:" + errorThrown);
                    }
                });
            }

        });
        $('#tab').find('li').click(function(){
            var index = $(this).index();
            $(this).addClass('tab_active').siblings().removeClass('tab_active');
            $('.tab_content').find('li').eq(index).show().siblings().hide();
        })
        $("#form-center-invoice-ordinary-edit").validate({
            rules: {
                type:{
                    required:true,
                },
                title:{
                    required:true,
                },
                credit:{
                    required:true,
                },
                invoice_name:{
                    required:true,
                },
                invoice_phonenum:{
                    required:true,
                },
                invoice_address:{
                    required:true,
                },
            },
            onkeyup: false,
            focusCleanup: false,
            success: "valid",
            submitHandler: function (form) {
                var name=$('#invoice_name').val();
                var phonenum=$('#invoice_phonenum').val();
                var address=$('#invoice_address').val();
                if(name){
                    if(isPhone(phonenum)){
                        if(address){
                            $(form).ajaxSubmit({
                                type: 'POST',
                                url: "{{ URL::asset('center/invoice')}}",
                                success: function (ret) {
                                    console.log(JSON.stringify(ret));
                                    if (ret.result) {
                                        layer.msg(ret.msg, {icon: 1, time: 2000});
                                        window.location.reload()
                                    } else {
                                        layer.msg(ret.msg, {icon: 2, time: 2000});
                                    }
                                },
                                error: function (XmlHttpRequest, textStatus, errorThrown) {
                                    layer.msg('操作失败', {icon: 2, time: 2000});
                                    console.log("XmlHttpRequest:" + JSON.stringify(XmlHttpRequest));
                                    console.log("textStatus:" + textStatus);
                                    console.log("errorThrown:" + errorThrown);
                                }
                            });
                        }
                        else{
                            layer.msg('请填写收票人地址', {icon: 2, time: 2000});
                        }
                    }
                    else{
                        layer.msg('请填写正确的电话号码', {icon: 2, time: 2000});
                    }
                }
                else{
                    layer.msg('请填写收票人姓名', {icon: 2, time: 2000});
                }
            }

        });
    });
    //结算
    function pay(){
        var address_id=$("input[name='address_id']:checked").val();
        var invoice_id=$("input[name='invoice_id']:checked").val();
        var trade_no=$('#trade_no').text();
        var content=$('#content').val();
        var pay_type=$('#pay_type').val();
        if(pay_type=='wx'){
            var param = {
                address_id: address_id,
                invoice_id:invoice_id,
                trade_no:trade_no,
                content:content,
                _token: "{{ csrf_token() }}"
            }
            payOrder('{{URL::asset('')}}', param, function (ret) {
                console.log('payOrder is : '+JSON.stringify(ret))
                if (ret.result == true) {
                    window.location.href = "{{URL::asset('order/pay/qrcode')}}"+"/"+trade_no;
                } else {
                    layer.msg(ret.msg, {icon: 2, time: 3000})
                }
            })
        }
        else if(pay_type=='ali'){
            {{--var param = {--}}
                {{--address_id: address_id,--}}
                {{--invoice_id:invoice_id,--}}
                {{--trade_no:trade_no,--}}
                {{--content:content,--}}
                {{--_token: "{{ csrf_token() }}"--}}
            {{--}--}}
            {{--payOrderByAli('{{URL::asset('')}}', param, function (ret) {--}}
                {{--$('body').html(console.log('payOrderByAli is : '+JSON.stringify(ret)))--}}
                {{--// console.log('payOrderByAli ret is : '+JSON.stringify(ret))--}}
                {{--if (ret.result == true) {--}}
                    {{--window.location.href = "{{URL::asset('order/pay/qrcode')}}"+"/"+trade_no;--}}
                {{--} else {--}}
                    {{--layer.msg(ret.msg, {icon: 2, time: 3000})--}}
                {{--}--}}
            {{--})--}}

        }
    }

    //切换支付方式
    function switchPaymentMethod(method){
        // if(method=='ali'){
        //     layer.msg('此功能还在开发中...', {icon: 2, time: 3000})
        // }
        // else{
        //     $('.border-box-active').removeClass('border-box-active');
        //     $('#'+method).addClass('border-box-active');
        //     $('#pay_type').val(method)
        // }
        $('.border-box-active').removeClass('border-box-active');
        $('#'+method).addClass('border-box-active');
        $('#pay_type').val(method)
    }
</script>
@endsection