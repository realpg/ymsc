@extends('home.layouts.base')

@section('content')
<div id="main-body">
    <div class="style-home-nav-station"></div>
    <div class="container margin-top-20 margin-bottom-20">
        @include('home.layouts.center')
        <div class="col-xs-12 col-sm-10 border-center-menu padding-top-10 padding-bottom-10  line-height-34 center-address" id="center-content">
            <div class="member-nav">
                <span class="font-size-16"><b>地址管理</b></span>
            </div>
            <div class="row margin-bottom-20">
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
                                <input type="checkbox" name="status" id="status" value="1"> 设为默认地址
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
            </div>
            <div class="row margin-bottom-20 padding-left-20 padding-right-20">
                <div class="line-height-40 text-center">
                    <div class="col-xs-2 col-sm-2 background-detail style-ellipsis-1">收货人</div>
                    <div class="col-xs-6 col-sm-6 background-detail style-ellipsis-1">地址</div>
                    <div class="col-xs-4 col-sm-4 background-detail style-ellipsis-1">操作</div>
                </div>
                @foreach($addresses as $address)
                    <div class="line-height-40">
                        <div class="col-xs-2 col-sm-2 text-center style-ellipsis-1 border-bottom-attribute">{{$address['name']}}</div>
                        <div class="col-xs-6 col-sm-6 style-ellipsis-1 border-bottom-attribute">{{$address['province']}} {{$address['city']}} {{$address['town']}}  {{$address['detail']}}</div>
                        <div class="col-xs-4 col-sm-4 text-center style-ellipsis-1 border-bottom-attribute">
                            <a href="" data-toggle="modal" data-target="#addressModel_{{$address['id']}}" >
                                <span class="text-blue padding-left-5 padding-right-5">详 情</span>
                            </a>
                            <a href="javascript:" onclick="address_del(this,'{{$address['id']}}')">
                                <span class="text-blue padding-left-5 padding-right-5">删 除</span>
                            </a>
                            @if($address['status'])
                                <span class="label label-danger padding-left-5 padding-right-5">默 认 地 址</span>
                            @else
                                <a href="javascript:" onclick="address_default(this,'{{$address['id']}}')">
                                    <span class="text-blue">设 置 默 认</span>
                                </a>
                            @endif
                        </div>
                    </div>
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
                @if(count($addresses)==0)
                    <div class="margin-top-20 margin-right-10 margin-left-10 text-center">
                        <img src="{{ URL::asset('img/nothing.png') }}"  />
                    </div>
                    <div class="margin-top-20 text-center index-font">
                        还没有添加收货地址，快添加一个吧！
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
<script type="text/javascript" src="{{ URL::asset('/js/jQueryProvinces/address-select.js') }}"></script>
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
    });
    //删除
    function address_del(obj,id){
        layer.confirm('确认要删除吗？',function(index){
            //进行后台删除
            var param = {
                id: id,
                _token: "{{ csrf_token() }}"
            }
            delAddress('{{URL::asset('')}}', param, function (ret) {
                if (ret.result == true) {
                    layer.msg(ret.msg, {icon: 1, time: 1000});
                    window.location.reload()
                } else {
                    layer.msg(ret.msg, {icon: 2, time: 1000})
                }
            })
        });
    }
    //设置默认
    function address_default(obj,id){
        var param = {
            id: id,
            _token: "{{ csrf_token() }}"
        }
        defaultAddress('{{URL::asset('')}}', param, function (ret) {
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