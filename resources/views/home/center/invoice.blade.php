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
                    <li class="col-xs-12 col-sm-2 background-detail">增值税专用发票</li>
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
                                        <input type="text" name="title" id="title" class="form-control" placeholder="请输入单位名称">
                                    </div>
                                </div>
                                <div class="row position-relative margin-top-20">
                                    <div class="col-xs-6 col-sm-4 text-right"><i>*</i> 纳 税 人 识 别 码：</div>
                                    <div class="col-xs-6 col-sm-8">
                                        <input type="text" name="credit" id="credit" class="form-control" placeholder="请输入纳税人识别码">
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
                                        <button type="button" class="btn btn-primary margin-right-10"> 非 三 证 合 一 企 业 </button>
                                        <button type="button" class="btn btn-primary"> 三 证 合 一 企 业 </button>
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
                                        <input type="text" name="special_phonenum" id="special_phonenum" class="form-control" placeholder="请输入收票人电话">
                                    </div>
                                </div>
                                <div class="row position-relative margin-top-20">
                                    <div class="col-xs-6 col-sm-4 text-right"><i>*</i> 收 票 人 地 址：</div>
                                    <div class="col-xs-6 col-sm-8">
                                        <input type="text" name="address" id="address" class="form-control" placeholder="请输入收票人地址">
                                    </div>
                                </div>
                                {{--<div class="row position-relative margin-top-20">--}}
                                    {{--<div class="col-xs-6 col-sm-4 text-right"></div>--}}
                                    {{--<div class="col-xs-6 col-sm-8">--}}
                                        {{--<input type="checkbox" name="status" id="status" value="1"> 设为默认发票--}}
                                    {{--</div>--}}
                                {{--</div>--}}
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
                    <div class="line-height-40 text-center">
                        <div class="col-xs-1 col-sm-1 background-detail style-ellipsis-1">类型</div>
                        <div class="col-xs-2 col-sm-2 background-detail style-ellipsis-1">收票人姓名</div>
                        <div class="col-xs-3 col-sm-3 background-detail style-ellipsis-1">收票人电话</div>
                        <div class="col-xs-3 col-sm-3 background-detail style-ellipsis-1">收票人地址</div>
                        <div class="col-xs-3 col-sm-3 background-detail style-ellipsis-1">操作</div>
                    </div>
                    @foreach($invoices as $invoice)
                        @if($invoice['type']==0)
                            <div class="line-height-40" id="row_{{$invoice['id']}}">
                                <div class="col-xs-1 col-sm-1 text-center style-ellipsis-1 border-bottom-attribute">普通</div>
                                <div class="col-xs-2 col-sm-2 text-center style-ellipsis-1 border-bottom-attribute">{{$invoice['name']}}</div>
                                <div class="col-xs-3 col-sm-3 style-ellipsis-1 border-bottom-attribute">{{$invoice['phonenum']}}</div>
                                <div class="col-xs-3 col-sm-3 style-ellipsis-1 border-bottom-attribute">{{$invoice['address']}}</div>
                                <div class="col-xs-3 col-sm-3 text-center style-ellipsis-1 border-bottom-attribute">
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
                                </div>
                            </div>
                            <!-- Modal -->
                            <div class="modal fade" id="invoiceModel_{{$invoice['id']}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                            <h4>发票详情</h4>
                                        </div>
                                        <div class="modal-body">
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
                            <div class="line-height-40" id="row_{{$invoice['id']}}">
                                <div class="col-xs-1 col-sm-1 text-center style-ellipsis-1 border-bottom-attribute">专用</div>
                                <div class="col-xs-2 col-sm-2 text-center style-ellipsis-1 border-bottom-attribute">{{$invoice['name']}}</div>
                                <div class="col-xs-3 col-sm-3 style-ellipsis-1 border-bottom-attribute">{{$invoice['phonenum']}}</div>
                                <div class="col-xs-3 col-sm-3 style-ellipsis-1 border-bottom-attribute">{{$invoice['address']}}</div>
                                <div class="col-xs-3 col-sm-3 text-center style-ellipsis-1 border-bottom-attribute">
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
                                </div>
                            </div>
                            <!-- Modal -->
                            <div class="modal fade" id="invoiceModel_{{$invoice['id']}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                            <h4>发票详情</h4>
                                        </div>
                                        <div class="modal-body">
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
                        @endif
                    @endforeach
                    @if(count($invoices)==0)
                        <div class="margin-top-20 margin-right-10 margin-left-10 text-center">
                            <img src="{{ URL::asset('img/nothing.png') }}"  />
                        </div>
                        <div class="margin-top-20 text-center index-font">
                            还没有增值税专用发票，快添加一个吧！
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
                name:{
                    required:true,
                },
                phonenum:{
                    required:true,
                },
                address:{
                    required:true,
                },
            },
            onkeyup: false,
            focusCleanup: false,
            success: "valid",
            submitHandler: function (form) {
                var phonenum=$('#phonenum').val();
                if(isPhone(phonenum)){
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
                    layer.msg('请填写正确的电话号码', {icon: 2, time: 2000});
                }
            }

        });
        $("#form-center-invoice-special-edit").validate({
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
                company_address:{
                    required:true,
                },
                company_tel:{
                    required:true,
                },
                bank:{
                    required:true,
                },
                number:{
                    required:true,
                },
                name:{
                    required:true,
                },
                special_phonenum:{
                    required:true,
                },
                address:{
                    required:true,
                },
            },
            onkeyup: false,
            focusCleanup: false,
            success: "valid",
            submitHandler: function (form) {
                var company_tel=$('#company_tel').val();
                var special_phonenum=$('#special_phonenum').val();
                if(isPhone(company_tel)){
                    if(isPhone(special_phonenum)){
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
                        layer.msg('请填写正确的电话号码', {icon: 2, time: 2000});
                    }
                }
                else{
                    layer.msg('请正确填写注册电话', {icon: 2, time: 2000});
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
</script>
@endsection