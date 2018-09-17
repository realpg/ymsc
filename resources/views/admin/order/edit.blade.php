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
        <form class="form form-horizontal" method="post" id="form-order-edit">
            {{csrf_field()}}
            <div id="tab-system" class="HuiTab">
                <div class="tabBar clearfix">
                    <span>订单基本信息</span>
                    <span>商品详情</span>
                    @if($data['status']!=1)
                    <span>收货地址</span>
                        @if($data['invoice_id'])
                        <span>发票信息</span>
                        @endif
                        @if($data['status']==2||$data['status']==6)
                        <span>物流信息</span>
                        @endif
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
                    @if($data['status']==4)
                    <div class="row cl">
                        <label class="form-label col-xs-4 col-sm-2"></label>
                        <div class="formControls col-xs-8 col-sm-9">
                            <span class="c-red">*温馨提示：退款流程请在微信商户平台中进行退款，确定在微信商户已退款后，点击退款成功更改订单状态！避免造成损失！</span>
                        </div>
                    </div>
                    @endif
                    <div class="row cl">
                        <div class="col-xs-8 col-sm-9 col-xs-offset-4 col-sm-offset-2">
                            @if($data['status']==4)
                                <button onClick="refundSuccess('{{$data['id']}}')"  class="btn btn-success radius" type="button">退款成功</button>
                                <button onClick="refundFail('{{$data['id']}}')"  class="btn btn-danger radius" type="button">退款失败</button>
                            @endif
                            <button onClick="layer_close();" class="btn btn-default radius" type="button">返回</button>
                        </div>
                    </div>
                </div>
                <div class="tabCon">
                    <table class="table table-border table-bordered table-bg table-hover table-sort" id="table-sort">
                        <thead>
                        <tr class="text-c">
                            <th width="80">ID</th>
                            <th width="100">图片</th>
                            <th>商品</th>
                            <th width="100">单价（元）</th>
                            <th width="100">商品单位</th>
                            <th width="100">数量</th>
                            <th width="100">小计（元）</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($data['suborders'] as $suborder)
                            <tr class="text-c">
                                <td>{{$suborder['goods_id']}}</td>
                                <td><img width="100%" src="{{$suborder['goods_picture']}}?imageView2/2/w/200" /></td>
                                <td class="text-l">
                                    商品货号：{{$suborder['goods_number']}}<br />
                                    商品名称：{{$suborder['goods_name']}}
                                </td>
                                <td>{{$suborder['total_fee']/100}}</td>
                                <td>{{$suborder['goods_unit']}}</td>
                                <td>{{$suborder['count']}}</td>
                                <td>{{$suborder['total_fee']/100*$suborder['count'] }}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    <div class="row cl">
                        <div class="col-xs-8 col-sm-9 col-xs-offset-4 col-sm-offset-2">
                            <button onClick="layer_close();" class="btn btn-default radius" type="button">返回</button>
                        </div>
                    </div>
                </div>
                @if($data['status']!=1)
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
                    <div class="row cl">
                        <div class="col-xs-8 col-sm-9 col-xs-offset-4 col-sm-offset-2">
                            <button onClick="layer_close();" class="btn btn-default radius" type="button">返回</button>
                        </div>
                    </div>
                </div>
                    @if($data['invoice_id'])
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
                    @endif
                    <div class="row cl">
                        <div class="col-xs-8 col-sm-9 col-xs-offset-4 col-sm-offset-2">
                            <button onClick="layer_close();" class="btn btn-default radius" type="button">返回</button>
                        </div>
                    </div>
                </div>
                    @endif
                    @if($data['status']==2||$data['status']==6)
                        <div class="tabCon">
                    <div class="row cl hidden">
                        <label class="form-label col-xs-4 col-sm-2"><span class="c-red">*</span>id：</label>
                        <div class="formControls col-xs-8 col-sm-9">
                            <input id="id" name="id" readonly type="text" class="input-text" value="{{ isset($data['id']) ? $data['id'] : '' }}" placeholder="id">
                        </div>
                    </div>
                    <div class="row cl">
                        <label class="form-label col-xs-4 col-sm-2"><span class="c-red">*</span>物流公司：</label>
                        <div class="formControls col-xs-8 col-sm-9">
                            <span class="select-box">
                                <select id="type" name="logistics_company" id="logistics_company" class="select">
                                    @foreach($data['expressComs'] as $expressCom)
                                        <option value="{{$expressCom['no']}}" {{$data['logistics_company']==$expressCom['no']?'selected':''}}>{{$expressCom['com']}}</option>
                                    @endforeach
                                </select>
                            </span>
                        </div>
                    </div>
                    <div class="row cl">
                        <label class="form-label col-xs-4 col-sm-2"><span class="c-red">*</span>物流单号：</label>
                        <div class="formControls col-xs-8 col-sm-9">
                            <input type="text" name="logistics_no" id="logistics_no" class="input-text" value="{{ isset($data['logistics_no']) ? $data['logistics_no'] : '' }}" placeholder="请填写物流单号">
                        </div>
                    </div>
                    <div class="row cl">
                        <label class="form-label col-xs-4 col-sm-2"></label>
                        <div class="formControls col-xs-8 col-sm-9">
                            <span class="c-red">*物流信息一旦保存，禁止修改！请核对后再点击保存</span>
                        </div>
                    </div>
                    @if($data['logistics_company']&&$data['logistics_no'])
                        @if($data['logistics']['ret']['resultcode']==200)
                            @foreach($data['logistics']['ret']['result']['list'] as $list)
                                <div class="row cl">
                                    <label class="form-label col-xs-6 col-sm-4">{{$list['datetime']}}</label>
                                    <div class="formControls col-xs-6 col-sm-8">
                                        <span>{{$list['remark']}}</span>
                                    </div>
                                </div>
                            @endforeach
                        @else
                            <div class="margin-top-20 index-font col-xs-12 col-sm-12 text-c">
                                {{$data['logistics']['ret']['reason']}}
                            </div>
                        @endif
                    @endif
                    <div class="row cl">
                        <div class="col-xs-8 col-sm-9 col-xs-offset-4 col-sm-offset-2">
                            @if(($data['status']==2||$data['status']==6)&&empty($data['logistics_company'])&&empty($data['logistics_no']))
                                <button class="btn btn-primary radius" type="submit"><i class="Hui-iconfont">&#xe632;</i> 保存</button>
                            @endif
                            <button onClick="layer_close();" class="btn btn-default radius" type="button">返回</button>
                        </div>
                    </div>
                </div>
                    @endif
                @endif
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

        $("#form-order-edit").validate({
            rules: {
                logistics_no: {
                    required: true,
                }
            },
            onkeyup: false,
            focusCleanup: false,
            success: "valid",
            submitHandler: function (form) {
                $(form).ajaxSubmit({
                    type: 'POST',
                    url: "{{ URL::asset('/admin/order/logistics')}}",
                    success: function (ret) {
                        console.log(JSON.stringify(ret));
                        if (ret.result) {
                            layer.msg(ret.msg, {icon: 1, time: 2000});
                            setTimeout(function () {
                                parent.$('.btn-refresh').click();
                            }, 1000)
                        } else {
                            layer.msg(ret.msg, {icon: 2, time: 2000});
                        }
                    },
                    error: function (XmlHttpRequest, textStatus, errorThrown) {
                        layer.msg('保存失败', {icon: 2, time: 2000});
                        console.log("XmlHttpRequest:" + JSON.stringify(XmlHttpRequest));
                        console.log("textStatus:" + textStatus);
                        console.log("errorThrown:" + errorThrown);
                    }
                });
            }

        });
    });

    /* 点击退款成功 */
    function refundSuccess(id) {
        layer.confirm('为了避免业务纠纷，请确定已在微信商户平台对此订单成功退款？',function(){
            var param = {
                id: id,
                _token: "{{ csrf_token() }}"
            }
            refundSuccessDo('{{URL::asset('')}}', param, function (ret) {
                if (ret.result == true) {
                    layer.msg(ret.msg, {icon: 1, time: 1000});
                    setTimeout(function () {
                        parent.$('.btn-refresh').click();
                    }, 1000)
                } else {
                    layer.msg(ret.msg, {icon: 2, time: 1000})
                }
            })
        })
    }

    /* 点击退款失败 */
    function refundFail(id) {
        layer.confirm('为了避免业务纠纷，请确定没有在微信商户平台对此订单退款，并且退款失败后按正常流程为客户发送商品？',function(){
            var param = {
                id: id,
                _token: "{{ csrf_token() }}"
            }
            refundFailDo('{{URL::asset('')}}', param, function (ret) {
                if (ret.result == true) {
                    layer.msg(ret.msg, {icon: 1, time: 1000});
                    setTimeout(function () {
                        parent.$('.btn-refresh').click();
                    }, 1000)
                } else {
                    layer.msg(ret.msg, {icon: 2, time: 1000})
                }
            })
        })
    }
</script>
@endsection