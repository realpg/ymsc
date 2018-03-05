@extends('admin.layouts.app')

@section('content')
    <div class="page-container">
        <form class="form form-horizontal" method="post" id="form-comment-edit">
            {{csrf_field()}}
            <div class="row cl">
                <label class="col-xs-4 col-sm-2"></label>
                <div class="col-xs-8 col-sm-8">
                    <div class="panel panel-default" style="padding-left:0px;padding-right:0px;">
                        <div class="panel-header">
                            <div>
                                收票人姓名： {{$data['name']}}
                            </div>
                            <div>
                                收票人电话： {{$data['phonenum']}}
                            </div>
                            <div>
                                收票人地址： {{$data['address']}}
                            </div>
                            <div style="clear: both;"></div>
                        </div>
                        <div class="panel-body">
                            <p>
                                单位名称：{{$data['title']}}
                            </p>
                            <p>
                                纳税人识别码：{{$data['credit']}}
                            </p>
                            <p>
                                注册地址：{{$data['company_address']}}
                            </p>
                            <p>
                                注册电话：{{$data['company_tel']}}
                            </p>
                            <p>
                                开户银行：{{$data['bank']}}
                            </p>
                            <p>
                                银行账号：{{$data['number']}}
                            </p>
                            @if($data['licence']==0)
                                <p>
                                    公司证照：
                                    <div class="row height-200 text-c">
                                        <div class="col-xs-12 col-sm-12 padding-left-20 padding-right-20">
                                            <img src="{{$data['business_license']}}" class="width-100" />
                                            <p>营业执照</p>
                                        </div>
                                        <div class="col-xs-12 col-sm-12 padding-left-20 padding-right-20">
                                            <img src="{{$data['account_opening_permit']}}" class="width-100" />
                                            <p>开户许可证</p>
                                        </div>
                                        <div class="col-xs-12 col-sm-12 padding-left-20 padding-right-20">
                                            <img src="{{$data['tax_registration_certificate']}}" class="width-100" />
                                            <p>税务登记证</p>
                                        </div>
                                    </div>
                                </p>
                                @else
                                <p>
                                    营业执照：
                                    <img src="{{$data['business_license']}}"  />
                                </p>
                                @endif
                            <div style="clear: both;"></div>
                            @if($data['examine']==1)
                                <p>
                                    审核状态：审核通过
                                </p>
                            @elseif($data['examine']==2)
                                <p>
                                    审核状态：审核未通过
                                </p>
                            @else
                                <p>
                                    审核状态：待定
                                </p>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            <div class="row cl">
                <div class="col-xs-9 col-sm-9 col-xs-offset-4 col-sm-offset-2">
                    @if($data['examine']==0)
                        <button onClick="invoice_editDo('{{$data['id']}}',1)"  class="btn btn-success radius" type="button">审核通过</button>
                        <button onClick="invoice_editDo('{{$data['id']}}',2)"  class="btn btn-warning radius" type="button">审核不通过</button>
                    @elseif($data['examine']==1)
                        <button onClick="invoice_editDo('{{$data['id']}}',2)"  class="btn btn-warning radius" type="button">重新审核不通过</button>
                    @elseif($data['examine']==2)
                        <button onClick="invoice_editDo('{{$data['id']}}',1)"  class="btn btn-success radius" type="button">重新审核通过</button>
                    @endif

                    <button onClick="layer_close();" class="btn btn-default radius" type="button">取消</button>
                </div>
            </div>
        </form>
    </div>

@endsection

@section('script')
    <script type="text/javascript">
        $(function () {
        });
        $(".preview").Huipreview();
        /* 点击审核通过 */
        function invoice_editDo(id,examine) {
            var param = {
                id: id,
                examine:examine,
                _token: "{{ csrf_token() }}"
            }
            examineInvoice('{{URL::asset('')}}', param, function (ret) {
                console.log('examineInvoice ret is :' + JSON.stringify(ret))
                if (ret.result == true) {
                    layer.msg(ret.msg, {icon: 1, time: 1000});
                    setTimeout(function () {
                        parent.$('.btn-refresh').click();
                    }, 1000)
                } else {
                    layer.msg(ret.msg, {icon: 2, time: 1000})
                }
            })
        }
    </script>
@endsection