@extends('home.layouts.base')

@section('content')
<div id="main-body">
    <div class="style-home-nav-station"></div>
    <div class="container margin-top-20 margin-bottom-20">
        @include('home.layouts.center')
        <div class="col-xs-12 col-sm-10 border-center-menu padding-top-10 padding-bottom-10  line-height-34 center-invoice" id="center-content">
            <div class="member-nav">
                <span class="font-size-16"><b>发票管理</b></span>
            </div>
            <div class="margin-bottom-20 margin-top-20">
                <ul class="line-height-40 border-bottom-navy-blue common-text-align-center row margin-left-0 margin-right-0" id="tab">
                    <li class="tab_active col-xs-12 col-sm-2 background-detail ">增值税普通发票</li>
                    {{--<li class="col-xs-12 col-sm-2 background-detail">增值税专用发票</li>--}}
                </ul>
                <ul class="tab_content">
                    <li style="display: block;">
                        <div class="row">
                            <form method="post" id="form-center-invoice-ordinary-edit">
                                {{ csrf_field() }}
                                <input type="hidden" name="type" id="type" value="editOrdinaryInvoice" class="form-control" />
                                <div class="col-xs-12 col-sm-8">
                                    <div class="row position-relative margin-top-20">
                                        <div class="col-xs-6 col-sm-4 text-right"><i>*</i> 发 票 抬 头：</div>
                                        <div class="col-xs-6 col-sm-8">
                                            <input type="text" name="title" id="title" class="form-control" placeholder="请输入发票抬头">
                                        </div>
                                    </div>
                                    <div class="row position-relative margin-top-20">
                                        <div class="col-xs-6 col-sm-4 text-right"><i>*</i> 税 号 / 信 用 代 码：</div>
                                        <div class="col-xs-6 col-sm-8">
                                            <input type="text" name="credit" id="credit" class="form-control" placeholder="请输入税号/信用代码">
                                        </div>
                                    </div>
                                    <div class="row position-relative margin-top-20">
                                        <div class="col-xs-6 col-sm-4 text-right"><i>*</i> 收 票 人 姓 名：</div>
                                        <div class="col-xs-6 col-sm-8">
                                            <input type="text" name="name" id="name" class="form-control" placeholder="请输入收票人姓名">
                                        </div>
                                    </div>
                                    <div class="row position-relative margin-top-20">
                                        <div class="col-xs-6 col-sm-4 text-right"><i>*</i> 收 票 人 电 话：</div>
                                        <div class="col-xs-6 col-sm-8">
                                            <input type="text" name="phonenum" id="phonenum" class="form-control" placeholder="请输入收票人电话">
                                        </div>
                                    </div>
                                    <div class="row position-relative margin-top-20">
                                        <div class="col-xs-6 col-sm-4 text-right"><i>*</i> 收 票 人 地 址：</div>
                                        <div class="col-xs-6 col-sm-8">
                                            <input type="text" name="address" id="address" class="form-control" placeholder="请输入收票人地址">
                                        </div>
                                    </div>
                                    <div class="row position-relative margin-top-20">
                                        <div class="col-xs-6 col-sm-4 text-right"></div>
                                        <div class="col-xs-6 col-sm-8">
                                            <input type="checkbox" name="status" id="status" value="1"> 设为默认发票
                                        </div>
                                    </div>
                                    <div class="row position-relative margin-top-20 margin-bottom-20">
                                        <div class="col-xs-2 col-sm-4 text-right"></div>
                                        <div class="col-xs-10 col-sm-8">
                                            <button type="submint" class="btn btn-info border-radius-0 margin-right-10">确 认 添 加</button>
                                            <button type="reset" class="btn btn-default border-radius-0">取 消</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </li>
                    <li>
                        <div class="row">
                            <form method="post" id="form-center-invoice-special-edit">
                            {{ csrf_field() }}
                            <input type="hidden" name="type" id="type" value="editSpecialInvoice" class="form-control" />
                            <div class="col-xs-12 col-sm-8">
                                <div class="row position-relative margin-top-20">
                                    <div class="col-xs-6 col-sm-4 text-right"><i>*</i> 单 位 名 称：</div>
                                    <div class="col-xs-6 col-sm-8">
                                        <input type="text" name="special_title" id="special_title" class="form-control" placeholder="请输入单位名称">
                                    </div>
                                </div>
                                <div class="row position-relative margin-top-20">
                                    <div class="col-xs-6 col-sm-4 text-right"><i>*</i> 纳 税 人 识 别 码：</div>
                                    <div class="col-xs-6 col-sm-8">
                                        <input type="text" name="special_credit" id="special_credit" class="form-control" placeholder="请输入纳税人识别码">
                                    </div>
                                </div>
                                <div class="row position-relative margin-top-20">
                                    <div class="col-xs-6 col-sm-4 text-right"><i>*</i> 注 册 地 址：</div>
                                    <div class="col-xs-6 col-sm-8">
                                        <input type="text" name="company_address" id="company_address" class="form-control" placeholder="请输入注册地址">
                                    </div>
                                </div>
                                <div class="row position-relative margin-top-20">
                                    <div class="col-xs-6 col-sm-4 text-right"><i>*</i> 注 册 电 话：</div>
                                    <div class="col-xs-6 col-sm-8">
                                        <input type="text" name="company_tel" id="company_tel" class="form-control" placeholder="请输入注册电话">
                                    </div>
                                </div>
                                <div class="row position-relative margin-top-20">
                                    <div class="col-xs-6 col-sm-4 text-right"><i>*</i> 开 户 银 行：</div>
                                    <div class="col-xs-6 col-sm-8">
                                        <input type="text" name="bank" id="bank" class="form-control" placeholder="请输入开户银行">
                                    </div>
                                </div>
                                <div class="row position-relative margin-top-20">
                                    <div class="col-xs-6 col-sm-4 text-right"><i>*</i> 银 行 账 号：</div>
                                    <div class="col-xs-6 col-sm-8">
                                        <input type="text" name="number" id="number" class="form-control" placeholder="请输入银行账号">
                                    </div>
                                </div>
                                <div class="row position-relative margin-top-20">
                                    <div class="col-xs-6 col-sm-4 text-right"><i>*</i> 公 司 证 照：</div>
                                    <div class="col-xs-6 col-sm-8">
                                        <input type="hidden" name="licence" id="licence" value="0" />
                                        <button type="button" class="btn btn-primary margin-right-10 width-40" onclick="changeLicence(0)"> 非 三 证 合 一 企 业 </button>
                                        <button type="button" class="btn btn-primary width-40" onclick="changeLicence(1)"> 三 证 合 一 企 业 </button>
                                    </div>
                                </div>
                                <div class="row position-relative margin-top-20" id="container">
                                    <div class="col-xs-6 col-sm-4 text-right"></div>
                                    <div class="col-xs-6 col-sm-8">
                                        <div class="row height-150 text-center" id="invoiceModel_old">
                                            <div class="col-xs-12 col-sm-4">
                                                <img src="{{URL::asset('img/add_picture.png')}}" id="old_license" class="width-100 height-150" />
                                                <input type="hidden" name="business_license" id="business_license" />
                                                <p>营业执照</p>
                                            </div>
                                            <div class="col-xs-12 col-sm-4">
                                                <img src="{{URL::asset('img/add_picture.png')}}" id="old_permit" class="width-100 height-150" />
                                                <input type="hidden" name="account_opening_permit" id="account_opening_permit" />
                                                <p>开户许可证</p>
                                            </div>
                                            <div class="col-xs-12 col-sm-4">
                                                <img src="{{URL::asset('img/add_picture.png')}}" id="old_certificate" class="width-100 height-150" />
                                                <input type="hidden" name="tax_registration_certificate" id="tax_registration_certificate" />
                                                <p>税务登记证</p>
                                            </div>
                                        </div>
                                        <div class="row height-150 text-center" id="invoiceModel_new" hidden>
                                            <div class="col-xs-12 col-sm-4 col-md-offset-4">
                                                <img src="{{URL::asset('img/add_picture.png')}}" id="new_license" class="width-100 height-150" />
                                                <input type="hidden" name="business_license_new" id="business_license_new" />
                                                <p>营业执照</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row position-relative margin-top-20">
                                    <div class="col-xs-6 col-sm-4 text-right"><i>*</i> 收 票 人 姓 名：</div>
                                    <div class="col-xs-6 col-sm-8">
                                        <input type="text" name="special_name" id="special_name" class="form-control" placeholder="请输入收票人姓名">
                                    </div>
                                </div>
                                <div class="row position-relative margin-top-20">
                                    <div class="col-xs-6 col-sm-4 text-right"><i>*</i> 收 票 人 电 话：</div>
                                    <div class="col-xs-6 col-sm-8">
                                        <input type="text" name="special_phonenum" id="special_phonenum" class="form-control" placeholder="请输入收票人电话">
                                    </div>
                                </div>
                                <div class="row position-relative margin-top-20">
                                    <div class="col-xs-6 col-sm-4 text-right"><i>*</i> 收 票 人 地 址：</div>
                                    <div class="col-xs-6 col-sm-8">
                                        <input type="text" name="special_address" id="special_address" class="form-control" placeholder="请输入收票人地址">
                                    </div>
                                </div>
                                <div class="row position-relative margin-top-20 margin-bottom-20">
                                    <div class="col-xs-2 col-sm-4 text-right"></div>
                                    <div class="col-xs-10 col-sm-8">
                                        <button type="submint" class="btn btn-info border-radius-0 margin-right-10">提 交 审 核</button>
                                        <button type="reset" class="btn btn-default border-radius-0">取 消</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                        </div>
                    </li>
                </ul>
            </div>
            <div class="margin-bottom-20">
                <div class="row margin-bottom-20 padding-left-20 padding-right-20">
                    <div class="table-responsive">
                        <table class="table border-0">
                            <tr>
                                <td class="background-detail style-ellipsis-1 line-height-40 text-center">类型</td>
                                <td class="background-detail style-ellipsis-1 line-height-40 text-center">收票人姓名</td>
                                <td class="background-detail style-ellipsis-1 line-height-40 text-center">收票人电话</td>
                                <td class="background-detail style-ellipsis-1 line-height-40 text-center">收票人地址</td>
                                <td class="background-detail style-ellipsis-1 line-height-40 text-center">操作</td>
                            </tr>
                            @foreach($invoices as $invoice)
                                @if($invoice['type']==0)
                                    <tr class="line-height-40" id="row_{{$invoice['id']}}">
                                        <td class="text-center style-ellipsis-1 border-bottom-attribute">普通</td>
                                        <td class="text-center style-ellipsis-1 border-bottom-attribute">{{$invoice['name']}}</td>
                                        <td class="text-center style-ellipsis-1 border-bottom-attribute">{{$invoice['phonenum']}}</td>
                                        <td class="text-center style-ellipsis-1 border-bottom-attribute">{{$invoice['address']}}</td>
                                        <td class="text-center style-ellipsis-1 border-bottom-attribute">
                                            <a href="" data-toggle="modal" data-target="#invoiceModel_{{$invoice['id']}}" >
                                                <span class="text-blue padding-left-5 padding-right-5">详 情</span>
                                            </a>
                                            <a href="javascript:" onclick="invoice_del(this,'{{$invoice['id']}}')">
                                                <span class="text-blue padding-left-5 padding-right-5">删 除</span>
                                            </a>
                                            @if($invoice['status'])
                                                <span class="label label-danger padding-left-5 padding-right-5">默 认 发 票 </span>
                                            @else
                                                <a href="javascript:" onclick="invoice_default(this,'{{$invoice['id']}}')">
                                                    <span class="text-blue">设 置 默 认</span>
                                                </a>
                                            @endif
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
                                    <tr class="line-height-40" id="row_{{$invoice['id']}}">
                                        <td class="text-center style-ellipsis-1 border-bottom-attribute">专用</td>
                                        <td class="text-center style-ellipsis-1 border-bottom-attribute">{{$invoice['name']}}</td>
                                        <td class="text-center style-ellipsis-1 border-bottom-attribute">{{$invoice['phonenum']}}</td>
                                        <td class="text-center style-ellipsis-1 border-bottom-attribute">{{$invoice['address']}}</td>
                                        <td class="text-center style-ellipsis-1 border-bottom-attribute">
                                            <a href="" data-toggle="modal" data-target="#invoiceModel_{{$invoice['id']}}" >
                                                <span class="text-blue padding-left-5 padding-right-5">详 情</span>
                                            </a>
                                            <a href="javascript:" onclick="invoice_del(this,'{{$invoice['id']}}')">
                                                <span class="text-blue padding-left-5 padding-right-5">删 除</span>
                                            </a>
                                            @if($invoice['examine']==0)
                                                <span class="label label-primary">审 核 中</span>
                                            @elseif($invoice['examine']==1)
                                                @if($invoice['status'])
                                                    <span class="label label-danger padding-left-5 padding-right-5">默 认 发 票 </span>
                                                @else
                                                    <a href="javascript:" onclick="invoice_default(this,'{{$invoice['id']}}')">
                                                        <span class="text-blue">设 置 默 认</span>
                                                    </a>
                                                @endif
                                            @else
                                                <span class="label label-default">未 通 过</span>
                                            @endif
                                            <span id="span_{{$invoice['id']}}"></span>
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
                                                        <div class="col-xs-6 col-sm-4 text-right">公 司 证 照：</div>
                                                        <div class="col-xs-6 col-sm-8">
                                                            @if($invoice['licence']==0)
                                                                <div class="row height-150 text-center">
                                                                    <div class="col-xs-12 col-sm-4">
                                                                        <img src="{{$invoice['business_license']}}" class="width-100 height-150" />
                                                                        <p>营业执照</p>
                                                                    </div>
                                                                    <div class="col-xs-12 col-sm-4">
                                                                        <img src="{{$invoice['account_opening_permit']}}" class="width-100 height-150" />
                                                                        <p>开户许可证</p>
                                                                    </div>
                                                                    <div class="col-xs-12 col-sm-4">
                                                                        <img src="{{$invoice['tax_registration_certificate']}}" class="width-100 height-150" />
                                                                        <p>税务登记证</p>
                                                                    </div>
                                                                </div>
                                                            @else
                                                                <div class="row height-150 text-center">
                                                                    <div class="col-xs-12 col-sm-4">
                                                                        <img src="{{$invoice['business_license']}}" class="width-100 height-150" />
                                                                        <p>营业执照</p>
                                                                    </div>
                                                                </div>
                                                            @endif
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
                            @endforeach
                        </table>
                    </div>
                    @if(count($invoices)==0)
                        <div class="margin-top-20 margin-right-10 margin-left-10 text-center">
                            <img src="{{ URL::asset('img/nothing.png') }}"  />
                        </div>
                        <div class="margin-top-20 text-center index-font">
                            还没有设置发票，快添加一个吧！
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
<script type="text/javascript" src="{{ URL::asset('/js/swiper-3.4.0.jquery.min.js') }}"></script>
<script type="text/javascript">
    $(function () {
        //获取七牛token
        initQNUploader();
        $('#tab').find('li').click(function(){
            var index = $(this).index();
            $(this).addClass('tab_active').siblings().removeClass('tab_active');
            $('.tab_content').find('li').eq(index).show().siblings().hide();
        })
        $("#form-center-invoice-ordinary-edit").validate({
            onkeyup: false,
            focusCleanup: false,
            success: "valid",
            submitHandler: function (form) {
                var type=$('#type').val();
                var title=$('#title').val();
                var credit=$('#credit').val();
                var name=$('#name').val();
                var phonenum=$('#phonenum').val();
                var address=$('#address').val();
                if(!type){
                    layer.msg('缺少参数', {icon: 2, time: 2000});
                }
                else if(!title){
                    layer.msg('请输入发票抬头', {icon: 2, time: 2000});
                    $('#title').focus();
                }
                else if(!credit){
                    layer.msg('请输入税号/信用代码', {icon: 2, time: 2000});
                    $('#credit').focus();
                }
                else if(!name){
                    layer.msg('请输入收票人姓名', {icon: 2, time: 2000});
                    $('#name').focus();
                }
                else if(!isPhone(phonenum)){
                    layer.msg('请输入正确的收票人电话', {icon: 2, time: 2000});
                    $('#phonenum').focus();
                }
                else if(!address){
                    layer.msg('请输入收票人地址', {icon: 2, time: 2000});
                    $('#address').focus();
                }
                else{
                    $(form).ajaxSubmit({
                        type: 'POST',
                        url: "{{ URL::asset('center/invoice')}}",
                        success: function (ret) {
                            // console.log(JSON.stringify(ret));
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
            }

        });
        $("#form-center-invoice-special-edit").validate({
            onkeyup: false,
            focusCleanup: false,
            success: "valid",
            submitHandler: function (form) {
                var type = $('#type').val();
                var special_title = $('#special_title').val();
                var special_credit = $('#special_credit').val();
                var company_address = $('#company_address').val();
                var company_tel = $('#company_tel').val();
                var bank = $('#bank').val();
                var number = $('#number').val();
                var special_name = $('#special_name').val();
                var special_phonenum = $('#special_phonenum').val();
                var special_address = $('#special_address').val();
                var licence = $('#licence').val();
                var business_license=$('#business_license').val();
                var account_opening_permit=$('#account_opening_permit').val();
                var tax_registration_certificate=$('#tax_registration_certificate').val();
                if (!type) {
                    layer.msg('缺少参数', {icon: 2, time: 2000});
                }
                else if (!special_title) {
                    layer.msg('请输入单位名称', {icon: 2, time: 2000});
                    $('#special_title').focus();
                }
                else if (!special_credit) {
                    layer.msg('请输入纳税人识别码', {icon: 2, time: 2000});
                    $('#special_credit').focus();
                }
                else if (!company_address) {
                    layer.msg('请输入注册地址', {icon: 2, time: 2000});
                    $('#company_address').focus();
                }
                else if (!isPhone(company_tel)) {
                    layer.msg('请输入正确的注册电话', {icon: 2, time: 2000});
                    $('#company_tel').focus();
                }
                else if (!bank) {
                    layer.msg('请输入开户银行', {icon: 2, time: 2000});
                    $('#bank').focus();
                }
                else if (!number) {
                    layer.msg('请输入银行账号', {icon: 2, time: 2000});
                    $('#number').focus();
                }
                else if (!special_name) {
                    layer.msg('请输入收票人姓名', {icon: 2, time: 2000});
                    $('#special_name').focus();
                }
                else if (!isPhone(special_phonenum)) {
                    layer.msg('请输入正确的收票人电话', {icon: 2, time: 2000});
                    $('#special_phonenum').focus();
                }
                else if (!special_address) {
                    layer.msg('请输入收票人地址', {icon: 2, time: 2000});
                    $('#special_address').focus();
                }
                else {
                    if((!business_license||!account_opening_permit||!tax_registration_certificate)&&licence==0){
                        layer.msg('请上传三证', {icon: 2, time: 2000});
                    }
                    else if(!business_license&&licence==1){
                        layer.msg('请上传三证合一的营业执照', {icon: 2, time: 2000});
                    }
                    else{
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
                }
            }
        });
    });
    //删除
    function invoice_del(obj,id){
        layer.confirm('确认要删除吗？',function(index){
            //进行后台删除
            var param = {
                id: id,
                _token: "{{ csrf_token() }}"
            }
            delInvoice('{{URL::asset('')}}', param, function (ret) {
                if (ret.result == true) {
                    layer.msg(ret.msg, {icon: 1, time: 1000});
                    // window.location.reload()
                    $('#row_'+id).remove();
                } else {
                    layer.msg(ret.msg, {icon: 2, time: 1000})
                }
            })
        });
    }
    //设置默认
    function invoice_default(obj,id){
        var param = {
            id: id,
            _token: "{{ csrf_token() }}"
        }
        defaultInvoice('{{URL::asset('')}}', param, function (ret) {
            if (ret.result == true) {
                layer.msg(ret.msg, {icon: 1, time: 1000});
                window.location.reload()
            } else {
                layer.msg(ret.msg, {icon: 2, time: 1000})
            }
        })
    }
    //初始化七牛上传模块
    function initQNUploader() {
        var uploader = Qiniu.uploader({
            runtimes: 'html5,flash,html4',      // 上传模式，依次退化
            browse_button: 'imagePrv',         // 上传选择的点选按钮，必需
            container: 'container',//上传按钮的上级元素ID
            // 在初始化时，uptoken，uptoken_url，uptoken_func三个参数中必须有一个被设置
            // 切如果提供了多个，其优先级为uptoken > uptoken_url > uptoken_func
            // 其中uptoken是直接提供上传凭证，uptoken_url是提供了获取上传凭证的地址，如果需要定制获取uptoken的过程则可以设置uptoken_func
            uptoken: "{{$upload_token}}", // uptoken是上传凭证，由其他程序生成
            // uptoken_url: '/uptoken',         // Ajax请求uptoken的Url，强烈建议设置（服务端提供）
            // uptoken_func: function(file){    // 在需要获取uptoken时，该方法会被调用
            //    // do something
            //    return uptoken;
            // },
            get_new_uptoken: false,             // 设置上传文件的时候是否每次都重新获取新的uptoken
            // downtoken_url: '/downtoken',
            // Ajax请求downToken的Url，私有空间时使用，JS-SDK将向该地址POST文件的key和domain，服务端返回的JSON必须包含url字段，url值为该文件的下载地址
            unique_names: true,              // 默认false，key为文件名。若开启该选项，JS-SDK会为每个文件自动生成key（文件名）
            // save_key: true,                  // 默认false。若在服务端生成uptoken的上传策略中指定了sava_key，则开启，SDK在前端将不对key进行任何处理
            domain: 'http://dsyy.isart.me/',     // bucket域名，下载资源时用到，必需
            max_file_size: '100mb',             // 最大文件体积限制
            flash_swf_url: 'path/of/plupload/Moxie.swf',  //引入flash，相对路径
            max_retries: 3,                     // 上传失败最大重试次数
            dragdrop: true,                     // 开启可拖曳上传
            drop_element: 'container',          // 拖曳上传区域元素的ID，拖曳文件或文件夹后可触发上传
            chunk_size: '4mb',                  // 分块上传时，每块的体积
            auto_start: true,                   // 选择文件后自动上传，若关闭需要自己绑定事件触发上传
            //x_vars : {
            //    查看自定义变量
            //    'time' : function(up,file) {
            //        var time = (new Date()).getTime();
            // do something with 'time'
            //        return time;
            //    },
            //    'size' : function(up,file) {
            //        var size = file.size;
            // do something with 'size'
            //        return size;
            //    }
            //},
            init: {
                'FilesAdded': function (up, files) {
                    plupload.each(files, function (file) {
                        // 文件添加进队列后，处理相关的事情
//                                            alert(alert(JSON.stringify(file)));
                    });
                },
                'BeforeUpload': function (up, file) {
                    // 每个文件上传前，处理相关的事情
//                        console.log("BeforeUpload up:" + up + " file:" + JSON.stringify(file));
                },
                'UploadProgress': function (up, file) {
                    // 每个文件上传时，处理相关的事情
//                        console.log("UploadProgress up:" + up + " file:" + JSON.stringify(file));
                },
                'FileUploaded': function (up, file, info) {
                    // 每个文件上传成功后，处理相关的事情
                    // 其中info是文件上传成功后，服务端返回的json，形式如：
                    // {
                    //    "hash": "Fh8xVqod2MQ1mocfI4S4KpRL6D98",
                    //    "key": "gogopher.jpg"
                    //  }
//                        console.log(JSON.stringify(info));
                    var domain = up.getOption('domain');
                    var res = JSON.parse(info);
                    //获取上传成功后的文件的Url
                    var sourceLink = domain + res.key;
                    $("#avatar").val(sourceLink);
                    $("#imagePrv").attr('src', qiniuUrlTool(sourceLink, "head_icon"));
                    // console.log($("#pickfiles").attr('src'));
                },
                'Error': function (up, err, errTip) {
                    //上传出错时，处理相关的事情
                    console.log(err + errTip);
                },
                'UploadComplete': function () {
                    //队列文件处理完毕后，处理相关的事情
                },
                'Key': function (up, file) {
                    // 若想在前端对每个文件的key进行个性化处理，可以配置该函数
                    // 该配置必须要在unique_names: false，save_key: false时才生效

                    var key = "";
                    // do something with key here
                    return key
                }
            }
        });
        var uploader_old_license = Qiniu.uploader({
            runtimes: 'html5,flash,html4',      // 上传模式，依次退化
            browse_button: 'old_license',         // 上传选择的点选按钮，必需
            container: 'container',//上传按钮的上级元素ID
            // 在初始化时，uptoken，uptoken_url，uptoken_func三个参数中必须有一个被设置
            // 切如果提供了多个，其优先级为uptoken > uptoken_url > uptoken_func
            // 其中uptoken是直接提供上传凭证，uptoken_url是提供了获取上传凭证的地址，如果需要定制获取uptoken的过程则可以设置uptoken_func
            uptoken: "{{$upload_token}}", // uptoken是上传凭证，由其他程序生成
            // uptoken_url: '/uptoken',         // Ajax请求uptoken的Url，强烈建议设置（服务端提供）
            // uptoken_func: function(file){    // 在需要获取uptoken时，该方法会被调用
            //    // do something
            //    return uptoken;
            // },
            get_new_uptoken: false,             // 设置上传文件的时候是否每次都重新获取新的uptoken
            // downtoken_url: '/downtoken',
            // Ajax请求downToken的Url，私有空间时使用，JS-SDK将向该地址POST文件的key和domain，服务端返回的JSON必须包含url字段，url值为该文件的下载地址
            unique_names: true,              // 默认false，key为文件名。若开启该选项，JS-SDK会为每个文件自动生成key（文件名）
            // save_key: true,                  // 默认false。若在服务端生成uptoken的上传策略中指定了sava_key，则开启，SDK在前端将不对key进行任何处理
            domain: 'http://dsyy.isart.me/',     // bucket域名，下载资源时用到，必需
            max_file_size: '100mb',             // 最大文件体积限制
            flash_swf_url: 'path/of/plupload/Moxie.swf',  //引入flash，相对路径
            max_retries: 3,                     // 上传失败最大重试次数
            dragdrop: true,                     // 开启可拖曳上传
            drop_element: 'container',          // 拖曳上传区域元素的ID，拖曳文件或文件夹后可触发上传
            chunk_size: '4mb',                  // 分块上传时，每块的体积
            auto_start: true,                   // 选择文件后自动上传，若关闭需要自己绑定事件触发上传
            //x_vars : {
            //    查看自定义变量
            //    'time' : function(up,file) {
            //        var time = (new Date()).getTime();
            // do something with 'time'
            //        return time;
            //    },
            //    'size' : function(up,file) {
            //        var size = file.size;
            // do something with 'size'
            //        return size;
            //    }
            //},
            init: {
                'FilesAdded': function (up, files) {
                    plupload.each(files, function (file) {
                        // 文件添加进队列后，处理相关的事情
//                                            alert(alert(JSON.stringify(file)));
                    });
                },
                'BeforeUpload': function (up, file) {
                    // 每个文件上传前，处理相关的事情
//                        console.log("BeforeUpload up:" + up + " file:" + JSON.stringify(file));
                },
                'UploadProgress': function (up, file) {
                    // 每个文件上传时，处理相关的事情
//                        console.log("UploadProgress up:" + up + " file:" + JSON.stringify(file));
                },
                'FileUploaded': function (up, file, info) {
                    // 每个文件上传成功后，处理相关的事情
                    // 其中info是文件上传成功后，服务端返回的json，形式如：
                    // {
                    //    "hash": "Fh8xVqod2MQ1mocfI4S4KpRL6D98",
                    //    "key": "gogopher.jpg"
                    //  }
//                        console.log(JSON.stringify(info));
                    var domain = up.getOption('domain');
                    var res = JSON.parse(info);
                    //获取上传成功后的文件的Url
                    var sourceLink = domain + res.key;
                    $("#business_license").val(sourceLink);
                    $("#old_license").attr('src', qiniuUrlTool(sourceLink, "head_icon"));
                    // console.log($("#pickfiles").attr('src'));
                },
                'Error': function (up, err, errTip) {
                    //上传出错时，处理相关的事情
                    console.log(err + errTip);
                },
                'UploadComplete': function () {
                    //队列文件处理完毕后，处理相关的事情
                },
                'Key': function (up, file) {
                    // 若想在前端对每个文件的key进行个性化处理，可以配置该函数
                    // 该配置必须要在unique_names: false，save_key: false时才生效

                    var key = "";
                    // do something with key here
                    return key
                }
            }
        });
        var uploader_old_permit = Qiniu.uploader({
            runtimes: 'html5,flash,html4',      // 上传模式，依次退化
            browse_button: 'old_permit',         // 上传选择的点选按钮，必需
            container: 'container',//上传按钮的上级元素ID
            // 在初始化时，uptoken，uptoken_url，uptoken_func三个参数中必须有一个被设置
            // 切如果提供了多个，其优先级为uptoken > uptoken_url > uptoken_func
            // 其中uptoken是直接提供上传凭证，uptoken_url是提供了获取上传凭证的地址，如果需要定制获取uptoken的过程则可以设置uptoken_func
            uptoken: "{{$upload_token}}", // uptoken是上传凭证，由其他程序生成
            // uptoken_url: '/uptoken',         // Ajax请求uptoken的Url，强烈建议设置（服务端提供）
            // uptoken_func: function(file){    // 在需要获取uptoken时，该方法会被调用
            //    // do something
            //    return uptoken;
            // },
            get_new_uptoken: false,             // 设置上传文件的时候是否每次都重新获取新的uptoken
            // downtoken_url: '/downtoken',
            // Ajax请求downToken的Url，私有空间时使用，JS-SDK将向该地址POST文件的key和domain，服务端返回的JSON必须包含url字段，url值为该文件的下载地址
            unique_names: true,              // 默认false，key为文件名。若开启该选项，JS-SDK会为每个文件自动生成key（文件名）
            // save_key: true,                  // 默认false。若在服务端生成uptoken的上传策略中指定了sava_key，则开启，SDK在前端将不对key进行任何处理
            domain: 'http://dsyy.isart.me/',     // bucket域名，下载资源时用到，必需
            max_file_size: '100mb',             // 最大文件体积限制
            flash_swf_url: 'path/of/plupload/Moxie.swf',  //引入flash，相对路径
            max_retries: 3,                     // 上传失败最大重试次数
            dragdrop: true,                     // 开启可拖曳上传
            drop_element: 'container',          // 拖曳上传区域元素的ID，拖曳文件或文件夹后可触发上传
            chunk_size: '4mb',                  // 分块上传时，每块的体积
            auto_start: true,                   // 选择文件后自动上传，若关闭需要自己绑定事件触发上传
            //x_vars : {
            //    查看自定义变量
            //    'time' : function(up,file) {
            //        var time = (new Date()).getTime();
            // do something with 'time'
            //        return time;
            //    },
            //    'size' : function(up,file) {
            //        var size = file.size;
            // do something with 'size'
            //        return size;
            //    }
            //},
            init: {
                'FilesAdded': function (up, files) {
                    plupload.each(files, function (file) {
                        // 文件添加进队列后，处理相关的事情
//                                            alert(alert(JSON.stringify(file)));
                    });
                },
                'BeforeUpload': function (up, file) {
                    // 每个文件上传前，处理相关的事情
//                        console.log("BeforeUpload up:" + up + " file:" + JSON.stringify(file));
                },
                'UploadProgress': function (up, file) {
                    // 每个文件上传时，处理相关的事情
//                        console.log("UploadProgress up:" + up + " file:" + JSON.stringify(file));
                },
                'FileUploaded': function (up, file, info) {
                    // 每个文件上传成功后，处理相关的事情
                    // 其中info是文件上传成功后，服务端返回的json，形式如：
                    // {
                    //    "hash": "Fh8xVqod2MQ1mocfI4S4KpRL6D98",
                    //    "key": "gogopher.jpg"
                    //  }
//                        console.log(JSON.stringify(info));
                    var domain = up.getOption('domain');
                    var res = JSON.parse(info);
                    //获取上传成功后的文件的Url
                    var sourceLink = domain + res.key;
                    $("#account_opening_permit").val(sourceLink);
                    $("#old_permit").attr('src', qiniuUrlTool(sourceLink, "head_icon"));
                    // console.log($("#pickfiles").attr('src'));
                },
                'Error': function (up, err, errTip) {
                    //上传出错时，处理相关的事情
                    console.log(err + errTip);
                },
                'UploadComplete': function () {
                    //队列文件处理完毕后，处理相关的事情
                },
                'Key': function (up, file) {
                    // 若想在前端对每个文件的key进行个性化处理，可以配置该函数
                    // 该配置必须要在unique_names: false，save_key: false时才生效

                    var key = "";
                    // do something with key here
                    return key
                }
            }
        });
        var uploader_old_certificate = Qiniu.uploader({
            runtimes: 'html5,flash,html4',      // 上传模式，依次退化
            browse_button: 'old_certificate',         // 上传选择的点选按钮，必需
            container: 'container',//上传按钮的上级元素ID
            // 在初始化时，uptoken，uptoken_url，uptoken_func三个参数中必须有一个被设置
            // 切如果提供了多个，其优先级为uptoken > uptoken_url > uptoken_func
            // 其中uptoken是直接提供上传凭证，uptoken_url是提供了获取上传凭证的地址，如果需要定制获取uptoken的过程则可以设置uptoken_func
            uptoken: "{{$upload_token}}", // uptoken是上传凭证，由其他程序生成
            // uptoken_url: '/uptoken',         // Ajax请求uptoken的Url，强烈建议设置（服务端提供）
            // uptoken_func: function(file){    // 在需要获取uptoken时，该方法会被调用
            //    // do something
            //    return uptoken;
            // },
            get_new_uptoken: false,             // 设置上传文件的时候是否每次都重新获取新的uptoken
            // downtoken_url: '/downtoken',
            // Ajax请求downToken的Url，私有空间时使用，JS-SDK将向该地址POST文件的key和domain，服务端返回的JSON必须包含url字段，url值为该文件的下载地址
            unique_names: true,              // 默认false，key为文件名。若开启该选项，JS-SDK会为每个文件自动生成key（文件名）
            // save_key: true,                  // 默认false。若在服务端生成uptoken的上传策略中指定了sava_key，则开启，SDK在前端将不对key进行任何处理
            domain: 'http://dsyy.isart.me/',     // bucket域名，下载资源时用到，必需
            max_file_size: '100mb',             // 最大文件体积限制
            flash_swf_url: 'path/of/plupload/Moxie.swf',  //引入flash，相对路径
            max_retries: 3,                     // 上传失败最大重试次数
            dragdrop: true,                     // 开启可拖曳上传
            drop_element: 'container',          // 拖曳上传区域元素的ID，拖曳文件或文件夹后可触发上传
            chunk_size: '4mb',                  // 分块上传时，每块的体积
            auto_start: true,                   // 选择文件后自动上传，若关闭需要自己绑定事件触发上传
            //x_vars : {
            //    查看自定义变量
            //    'time' : function(up,file) {
            //        var time = (new Date()).getTime();
            // do something with 'time'
            //        return time;
            //    },
            //    'size' : function(up,file) {
            //        var size = file.size;
            // do something with 'size'
            //        return size;
            //    }
            //},
            init: {
                'FilesAdded': function (up, files) {
                    plupload.each(files, function (file) {
                        // 文件添加进队列后，处理相关的事情
//                                            alert(alert(JSON.stringify(file)));
                    });
                },
                'BeforeUpload': function (up, file) {
                    // 每个文件上传前，处理相关的事情
//                        console.log("BeforeUpload up:" + up + " file:" + JSON.stringify(file));
                },
                'UploadProgress': function (up, file) {
                    // 每个文件上传时，处理相关的事情
//                        console.log("UploadProgress up:" + up + " file:" + JSON.stringify(file));
                },
                'FileUploaded': function (up, file, info) {
                    // 每个文件上传成功后，处理相关的事情
                    // 其中info是文件上传成功后，服务端返回的json，形式如：
                    // {
                    //    "hash": "Fh8xVqod2MQ1mocfI4S4KpRL6D98",
                    //    "key": "gogopher.jpg"
                    //  }
//                        console.log(JSON.stringify(info));
                    var domain = up.getOption('domain');
                    var res = JSON.parse(info);
                    //获取上传成功后的文件的Url
                    var sourceLink = domain + res.key;
                    $("#tax_registration_certificate").val(sourceLink);
                    $("#old_certificate").attr('src', qiniuUrlTool(sourceLink, "head_icon"));
                    // console.log($("#pickfiles").attr('src'));
                },
                'Error': function (up, err, errTip) {
                    //上传出错时，处理相关的事情
                    console.log(err + errTip);
                },
                'UploadComplete': function () {
                    //队列文件处理完毕后，处理相关的事情
                },
                'Key': function (up, file) {
                    // 若想在前端对每个文件的key进行个性化处理，可以配置该函数
                    // 该配置必须要在unique_names: false，save_key: false时才生效

                    var key = "";
                    // do something with key here
                    return key
                }
            }
        });
        var uploader_new_license = Qiniu.uploader({
            runtimes: 'html5,flash,html4',      // 上传模式，依次退化
            browse_button: 'new_license',         // 上传选择的点选按钮，必需
            container: 'container',//上传按钮的上级元素ID
            // 在初始化时，uptoken，uptoken_url，uptoken_func三个参数中必须有一个被设置
            // 切如果提供了多个，其优先级为uptoken > uptoken_url > uptoken_func
            // 其中uptoken是直接提供上传凭证，uptoken_url是提供了获取上传凭证的地址，如果需要定制获取uptoken的过程则可以设置uptoken_func
            uptoken: "{{$upload_token}}", // uptoken是上传凭证，由其他程序生成
            // uptoken_url: '/uptoken',         // Ajax请求uptoken的Url，强烈建议设置（服务端提供）
            // uptoken_func: function(file){    // 在需要获取uptoken时，该方法会被调用
            //    // do something
            //    return uptoken;
            // },
            get_new_uptoken: false,             // 设置上传文件的时候是否每次都重新获取新的uptoken
            // downtoken_url: '/downtoken',
            // Ajax请求downToken的Url，私有空间时使用，JS-SDK将向该地址POST文件的key和domain，服务端返回的JSON必须包含url字段，url值为该文件的下载地址
            unique_names: true,              // 默认false，key为文件名。若开启该选项，JS-SDK会为每个文件自动生成key（文件名）
            // save_key: true,                  // 默认false。若在服务端生成uptoken的上传策略中指定了sava_key，则开启，SDK在前端将不对key进行任何处理
            domain: 'http://dsyy.isart.me/',     // bucket域名，下载资源时用到，必需
            max_file_size: '100mb',             // 最大文件体积限制
            flash_swf_url: 'path/of/plupload/Moxie.swf',  //引入flash，相对路径
            max_retries: 3,                     // 上传失败最大重试次数
            dragdrop: true,                     // 开启可拖曳上传
            drop_element: 'container',          // 拖曳上传区域元素的ID，拖曳文件或文件夹后可触发上传
            chunk_size: '4mb',                  // 分块上传时，每块的体积
            auto_start: true,                   // 选择文件后自动上传，若关闭需要自己绑定事件触发上传
            //x_vars : {
            //    查看自定义变量
            //    'time' : function(up,file) {
            //        var time = (new Date()).getTime();
            // do something with 'time'
            //        return time;
            //    },
            //    'size' : function(up,file) {
            //        var size = file.size;
            // do something with 'size'
            //        return size;
            //    }
            //},
            init: {
                'FilesAdded': function (up, files) {
                    plupload.each(files, function (file) {
                        // 文件添加进队列后，处理相关的事情
//                                            alert(alert(JSON.stringify(file)));
                    });
                },
                'BeforeUpload': function (up, file) {
                    // 每个文件上传前，处理相关的事情
//                        console.log("BeforeUpload up:" + up + " file:" + JSON.stringify(file));
                },
                'UploadProgress': function (up, file) {
                    // 每个文件上传时，处理相关的事情
//                        console.log("UploadProgress up:" + up + " file:" + JSON.stringify(file));
                },
                'FileUploaded': function (up, file, info) {
                    // 每个文件上传成功后，处理相关的事情
                    // 其中info是文件上传成功后，服务端返回的json，形式如：
                    // {
                    //    "hash": "Fh8xVqod2MQ1mocfI4S4KpRL6D98",
                    //    "key": "gogopher.jpg"
                    //  }
//                        console.log(JSON.stringify(info));
                    var domain = up.getOption('domain');
                    var res = JSON.parse(info);
                    //获取上传成功后的文件的Url
                    var sourceLink = domain + res.key;
                    $("#business_license_new").val(sourceLink);
                    $("#new_license").attr('src', qiniuUrlTool(sourceLink, "head_icon"));
                    // console.log($("#pickfiles").attr('src'));
                },
                'Error': function (up, err, errTip) {
                    //上传出错时，处理相关的事情
                    console.log(err + errTip);
                },
                'UploadComplete': function () {
                    //队列文件处理完毕后，处理相关的事情
                },
                'Key': function (up, file) {
                    // 若想在前端对每个文件的key进行个性化处理，可以配置该函数
                    // 该配置必须要在unique_names: false，save_key: false时才生效

                    var key = "";
                    // do something with key here
                    return key
                }
            }
        });
    }

    function changeLicence(licence){
        $('#business_license').val('')
        $('#account_opening_permit').val('')
        $('#tax_registration_certificate').val('')
        $('#business_license_new').val('')
        $('#old_license').css("src","{{URL::asset('img/add_picture.png')}}");
        $('#old_permit').css("src","{{URL::asset('img/add_picture.png')}}");
        $('#old_certificate').css("src","{{URL::asset('img/add_picture.png')}}");
        $('#new_license').css("src","{{URL::asset('img/add_picture.png')}}");
        if(licence==0){
            $('#licence').val(0);
            $('#invoiceModel_old').show();
            $('#invoiceModel_new').hide();
        }
        else{
            $('#licence').val(1);
            $('#invoiceModel_new').show();
            $('#invoiceModel_old').hide();
        }
    }
</script>
@endsection