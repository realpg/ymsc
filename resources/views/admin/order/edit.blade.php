@extends('admin.layouts.app')

@section('content')
    <style>
        .member-image{
            width:100px;
            height:100px;
            border-radius: 100%;
        }
    </style>
    <div class="page-container">
        <form class="form form-horizontal" method="post" id="form-member-edit">
            {{csrf_field()}}
            <div id="tab-system" class="HuiTab">
                <div class="tabBar clearfix">
                    <span>订单基本信息</span>
                    <span>商品详情</span>
                    @if($data['status']!=1)
                    <span>收货地址</span>
                    <span>发票信息</span>
                    @endif
                </div>
                <div class="tabCon">
                    <div class="row cl">
                        <label class="form-label col-xs-4 col-sm-2">订单号：</label>
                        <div class="formControls col-xs-8 col-sm-9">
                            <input type="text" readonly class="input-text on_click" value="{{ isset($data['trade_no']) ? $data['trade_no'] : '' }}">
                        </div>
                    </div>
                    @if($data['prepay_id'])
                        <div class="row cl">
                            <label class="form-label col-xs-4 col-sm-2">微信预付订单号：</label>
                            <div class="formControls col-xs-8 col-sm-9">
                                <input type="text" readonly class="input-text on_click" value="{{ isset($data['prepay_id']) ? $data['prepay_id'] : '' }}">
                            </div>
                        </div>
                    @endif
                    <div class="row cl">
                        <label class="form-label col-xs-4 col-sm-2">总价（元）：</label>
                        <div class="formControls col-xs-8 col-sm-9">
                            <input type="text" readonly class="input-text on_click" value="{{ isset($data['total_fee']) ? $data['total_fee']/100 : '' }}">
                        </div>
                    </div>
                    <div class="row cl">
                        <label class="form-label col-xs-4 col-sm-2">数量：</label>
                        <div class="formControls col-xs-8 col-sm-9">
                            <input type="text" readonly class="input-text on_click" value="{{ isset($data['count']) ? $data['count'] : '' }}">
                        </div>
                    </div>
                    @if($data['content'])
                        <div class="row cl">
                            <label class="form-label col-xs-4 col-sm-2">备注：</label>
                            <div class="formControls col-xs-8 col-sm-9">
                                <textarea wrap="\n" class="textarea on_click" style="resize:vertical;" dragonfly="true">{{ isset($data['content']) ? $data['content'] : '' }}</textarea>
                            </div>
                        </div>
                    @endif
                    <div class="row cl">
                        <label class="form-label col-xs-4 col-sm-2">订单状态：</label>
                        <div class="formControls col-xs-8 col-sm-9">
                            @if($data['status']==1)
                                <input type="text" readonly class="input-text on_click" value="待支付">
                            @elseif($data['status']==2)
                                <input type="text" readonly class="input-text on_click" value="支付成功">
                            @elseif($data['status']==3)
                                <input type="text" readonly class="input-text on_click" value="交易成功">
                            @elseif($data['status']==4)
                                <input type="text" readonly class="input-text on_click" value="退款中">
                            @elseif($data['status']==4)
                                <input type="text" readonly class="input-text on_click" value="退款失败">
                            @elseif($data['status']==5)
                                <input type="text" readonly class="input-text on_click" value="退款成功">
                            @endif
                        </div>
                    </div>
                    @if($data['pay_at'])
                        <div class="row cl">
                            <label class="form-label col-xs-4 col-sm-2">支付时间：</label>
                            <div class="formControls col-xs-8 col-sm-9">
                                <input type="text" readonly class="input-text on_click" value="{{ isset($data['pay_at']) ? $data['pay_at'] : '' }}">
                            </div>
                        </div>
                    @endif
                </div>
                <div class="tabCon">1</div>
                <div class="tabCon">
                    <div class="row cl">
                        <label class="form-label col-xs-4 col-sm-2">收货人：</label>
                        <div class="formControls col-xs-8 col-sm-9">
                            <input type="text" readonly class="input-text on_click" value="{{ isset($data['address']['name']) ? $data['address']['name'] : '' }}">
                        </div>
                    </div>
                    <div class="row cl">
                        <label class="form-label col-xs-4 col-sm-2">所在地区：</label>
                        <div class="formControls col-xs-8 col-sm-9">
                            <input type="text" readonly class="input-text on_click" value="{{ isset($data['address']['province']) ? $data['address']['province'] : '' }} {{ isset($data['address']['city']) ? $data['address']['city'] : '' }} {{ isset($data['address']['town']) ? $data['address']['town'] : '' }}">
                        </div>
                    </div>
                    <div class="row cl">
                        <label class="form-label col-xs-4 col-sm-2">详细地址：</label>
                        <div class="formControls col-xs-8 col-sm-9">
                            <input type="text" readonly class="input-text on_click" value="{{ isset($data['address']['detail']) ? $data['address']['detail'] : '' }}">
                        </div>
                    </div>
                    <div class="row cl">
                        <label class="form-label col-xs-4 col-sm-2">手机号码：</label>
                        <div class="formControls col-xs-8 col-sm-9">
                            <input type="text" readonly class="input-text on_click" value="{{ isset($data['address']['phonenum']) ? $data['address']['phonenum'] : '' }}">
                        </div>
                    </div>
                    @if($data['address']['phone'])
                        <div class="row cl">
                            <label class="form-label col-xs-4 col-sm-2">固定电话：</label>
                            <div class="formControls col-xs-8 col-sm-9">
                                <input type="text" readonly class="input-text on_click" value="{{ isset($data['address']['phone']) ? $data['address']['phone'] : '' }}">
                            </div>
                        </div>
                    @endif
                    @if($data['address']['code'])
                        <div class="row cl">
                            <label class="form-label col-xs-4 col-sm-2">邮编：</label>
                            <div class="formControls col-xs-8 col-sm-9">
                                <input type="text" readonly class="input-text on_click" value="{{ isset($data['address']['code']) ? $data['address']['code'] : '' }}">
                            </div>
                        </div>
                    @endif
                </div>
                <div class="tabCon">
                    @if($data['invoice']['type']==0)
                        <div class="row cl">
                            <label class="form-label col-xs-4 col-sm-2">发票类型：</label>
                            <div class="formControls col-xs-8 col-sm-9">
                                <input type="text" readonly class="input-text on_click" value="增值税普通发票">
                            </div>
                        </div>
                        <div class="row cl">
                            <label class="form-label col-xs-4 col-sm-2">发票抬头：</label>
                            <div class="formControls col-xs-8 col-sm-9">
                                <input type="text" readonly class="input-text on_click" value="{{ isset($data['invoice']['title']) ? $data['invoice']['title'] : '' }}">
                            </div>
                        </div>
                        <div class="row cl">
                            <label class="form-label col-xs-4 col-sm-2">税号/信用代码：</label>
                            <div class="formControls col-xs-8 col-sm-9">
                                <input type="text" readonly class="input-text on_click" value="{{ isset($data['invoice']['credit']) ? $data['invoice']['credit'] : '' }}">
                            </div>
                        </div>
                        <div class="row cl">
                            <label class="form-label col-xs-4 col-sm-2">收票人姓名：</label>
                            <div class="formControls col-xs-8 col-sm-9">
                                <input type="text" readonly class="input-text on_click" value="{{ isset($data['invoice']['name']) ? $data['invoice']['name'] : '' }}">
                            </div>
                        </div>
                        <div class="row cl">
                            <label class="form-label col-xs-4 col-sm-2">收票人电话：</label>
                            <div class="formControls col-xs-8 col-sm-9">
                                <input type="text" readonly class="input-text on_click" value="{{ isset($data['invoice']['phonenum']) ? $data['invoice']['phonenum'] : '' }}">
                            </div>
                        </div>
                        <div class="row cl">
                            <label class="form-label col-xs-4 col-sm-2">收票人地址：</label>
                            <div class="formControls col-xs-8 col-sm-9">
                                <input type="text" readonly class="input-text on_click" value="{{ isset($data['invoice']['address']) ? $data['invoice']['address'] : '' }}">
                            </div>
                        </div>
                    @else
                        <div class="row cl">
                            <label class="form-label col-xs-4 col-sm-2">发票类型：</label>
                            <div class="formControls col-xs-8 col-sm-9">
                                <input type="text" readonly class="input-text on_click" value="增值税专用发票">
                            </div>
                        </div>
                        <div class="row cl">
                            <label class="form-label col-xs-4 col-sm-2">单位名称：</label>
                            <div class="formControls col-xs-8 col-sm-9">
                                <input type="text" readonly class="input-text on_click" value="{{ isset($data['invoice']['title']) ? $data['invoice']['title'] : '' }}">
                            </div>
                        </div>
                        <div class="row cl">
                            <label class="form-label col-xs-4 col-sm-2">纳税人识别码：</label>
                            <div class="formControls col-xs-8 col-sm-9">
                                <input type="text" readonly class="input-text on_click" value="{{ isset($data['invoice']['credit']) ? $data['invoice']['credit'] : '' }}">
                            </div>
                        </div>
                        <div class="row cl">
                            <label class="form-label col-xs-4 col-sm-2">注册地址：</label>
                            <div class="formControls col-xs-8 col-sm-9">
                                <input type="text" readonly class="input-text on_click" value="{{ isset($data['invoice']['company_address']) ? $data['invoice']['company_address'] : '' }}">
                            </div>
                        </div>
                        <div class="row cl">
                            <label class="form-label col-xs-4 col-sm-2">注册电话：</label>
                            <div class="formControls col-xs-8 col-sm-9">
                                <input type="text" readonly class="input-text on_click" value="{{ isset($data['invoice']['company_tel']) ? $data['invoice']['company_tel'] : '' }}">
                            </div>
                        </div>
                        <div class="row cl">
                            <label class="form-label col-xs-4 col-sm-2">开户银行：</label>
                            <div class="formControls col-xs-8 col-sm-9">
                                <input type="text" readonly class="input-text on_click" value="{{ isset($data['invoice']['bank']) ? $data['invoice']['bank'] : '' }}">
                            </div>
                        </div>
                        <div class="row cl">
                            <label class="form-label col-xs-4 col-sm-2">银行账号：</label>
                            <div class="formControls col-xs-8 col-sm-9">
                                <input type="text" readonly class="input-text on_click" value="{{ isset($data['invoice']['number']) ? $data['invoice']['number'] : '' }}">
                            </div>
                        </div>
                        <div class="row cl">
                            <label class="form-label col-xs-4 col-sm-2">收票人姓名：</label>
                            <div class="formControls col-xs-8 col-sm-9">
                                <input type="text" readonly class="input-text on_click" value="{{ isset($data['invoice']['name']) ? $data['invoice']['name'] : '' }}">
                            </div>
                        </div>
                        <div class="row cl">
                            <label class="form-label col-xs-4 col-sm-2">收票人电话：</label>
                            <div class="formControls col-xs-8 col-sm-9">
                                <input type="text" readonly class="input-text on_click" value="{{ isset($data['invoice']['phonenum']) ? $data['invoice']['phonenum'] : '' }}">
                            </div>
                        </div>
                        <div class="row cl">
                            <label class="form-label col-xs-4 col-sm-2">收票人地址：</label>
                            <div class="formControls col-xs-8 col-sm-9">
                                <input type="text" readonly class="input-text on_click" value="{{ isset($data['invoice']['address']) ? $data['invoice']['address'] : '' }}">
                            </div>
                        </div>
                        <div class="row cl">
                            <label class="form-label col-xs-4 col-sm-2">营业执照：</label>
                            <div class="formControls col-xs-8 col-sm-9">
                                <img src="{{$data['invoice']['business_license']}}" class="width-100" />
                            </div>
                        </div>
                        @if($data['invoice']['licence']==0)
                            <div class="row cl">
                                <label class="form-label col-xs-4 col-sm-2">开户许可证：</label>
                                <div class="formControls col-xs-8 col-sm-9">
                                    <img src="{{$data['invoice']['account_opening_permit']}}" class="width-100" />
                                </div>
                            </div>
                            <div class="row cl">
                                <label class="form-label col-xs-4 col-sm-2">税务登记证：</label>
                                <div class="formControls col-xs-8 col-sm-9">
                                    <img src="{{$data['invoice']['tax_registration_certificate']}}" class="width-100" />
                                </div>
                            </div>
                        @endif
                    @endif
                </div>
            </div>
            <div class="row cl">
                <div class="col-xs-8 col-sm-9 col-xs-offset-4 col-sm-offset-2">
                    <button onClick="layer_close();" class="btn btn-default radius" type="button">返回</button>
                </div>
            </div>
        </form>
    </div>

@endsection

@section('script')
<script type="text/javascript">
    $(function () {
        $("#tab-system").Huitab({
            index:0
        });
    });
</script>
@endsection