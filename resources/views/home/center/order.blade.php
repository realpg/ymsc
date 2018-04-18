@extends('home.layouts.base')

@section('content')
<div id="main-body">
    <div class="style-home-nav-station"></div>
    <div class="container margin-top-20 margin-bottom-20">
        @include('home.layouts.center')
        <div class="col-xs-12 col-sm-10 border-center-menu padding-top-10 padding-bottom-10  line-height-34 center-address" id="center-content">
            <div class="member-nav">
                <span class="font-size-16"><b>订单管理</b></span>
            </div>
            <div>
                @foreach($orders as $order)
                    <div class="table-responsive">
                        <table class="table border-0 margin-bottom-20">
                            <tr>
                                <td class="text-left" colspan="3" style="border:0;">
                                    订单号：<span id="trade_no">{{$order['trade_no']}}</span>
                                </td>
                                <td class="text-right text-red" colspan="3" style="border:0;">
                                    @if($order['status']==1)
                                        待支付
                                    @elseif($order['status']==2)
                                        支付成功
                                    @elseif($order['status']==3)
                                        交易成功
                                    @elseif($order['status']==4)
                                        退款中
                                    @elseif($order['status']==5)
                                        退款成功
                                    @elseif($order['status']==6)
                                        退款失败
                                    @endif
                                </td>
                            </tr>
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
                                    <td class="border-bottom-attribute" style="display:table-cell;vertical-align:middle;" id="total_{{$suborder['id']}}">{{$suborder['total_fee']/100*$suborder['count']}}</td>
                                </tr>
                            @endforeach
                            @if($order['content'])
                                <tr>
                                    <td colspan="6" class="border-bottom-attribute" style="display:table-cell;vertical-align:middle;">备注：{{$order['content']}}</td>
                                </tr>
                            @endif
                            <tr class="line-height-40 text-center">
                                <td class="text-left text-blue width-250 border-bottom-attribute" style="display:table-cell;vertical-align:middle;">
                                    <div class="float-left">
                                        @if($order['invoice_id'])
                                            <a href=""  data-toggle="modal" data-target="#invoiceModel_{{$order['invoice_id']}}"  />
                                                发票详情
                                            </a>
                                        @else
                                            <span class="no_click background-none">未选择开发票</span>
                                        @endif
                                    </div>
                                    @if($order['status']!=1&&$order['logistics_company']&&$order['logistics_no'])
                                        <div class="float-right">
                                            <a href=""  data-toggle="modal" data-target="#logisticsModel_{{$order['id']}}" >
                                                物流详情
                                            </a>
                                        </div>
                                    @elseif($order['status']==2&&empty($order['logistics_company'])&&empty($order['logistics_no']))
                                        <div class="float-right">
                                            <a href="javascript:" onclick="applicationForRefund(this,'{{$order['id']}}')" >
                                                申请退款
                                            </a>
                                        </div>
                                    @endif
                                </td>
                                <td class="text-right width-250 border-bottom-attribute" style="display:table-cell;vertical-align:middle;">
                                    共<span>{{$order['count']}}</span>件商品
                                </td>
                                <td class="text-right width-250 border-bottom-attribute" style="display:table-cell;vertical-align:middle;">
                                    总价（包含<span>￥{{$postage}}</span> 邮费）
                                </td>
                                <td class="text-center width-150 text-red border-bottom-attribute" style="display:table-cell;vertical-align:middle;">
                                    ￥<span id="total_all">{{$order['total_fee']/100}}</span>
                                </td>
                                @if($order['status']==1)
                                    <td class="width-110 text-blue cart-settlement border-bottom-attribute" style="display:table-cell;vertical-align:middle;padding:0px;" >
                                        <a href="{{URL::asset('order/'.$order['trade_no'])}}" class="line-height-40">
                                            立即支付
                                        </a>
                                    </td>
                                @elseif($order['status']==2)
                                    <td class="width-110 text-blue cart-settlement border-bottom-attribute" style="display:table-cell;vertical-align:middle;padding:0px;" >
                                        <a href="javascript:" onclick="confirmReceipt(this,'{{$order['id']}}')" class="line-height-40">
                                            确认收货
                                        </a>
                                    </td>
                                @elseif($order['status']==3)
                                    <td class="width-110 text-blue cart-settlement border-bottom-attribute" style="display:table-cell;vertical-align:middle;padding:0px;" >
                                        <a href="{{URL::asset('center/comment/'.$order['id'])}}" class="line-height-40">
                                            评价
                                        </a>
                                    </td>
                                @else
                                    <td class="width-110 text-blue cart-settlement border-bottom-attribute" style="display:table-cell;vertical-align:middle;padding:0px;"></td>
                                @endif
                                <td class="width-110 text-blue cart-settlement border-bottom-attribute" style="display:table-cell;vertical-align:middle;padding:0px;" >
                                    @if($order['status']==1||$order['status']==3||$order['status']==5)
                                    <a href="javascript:" class="line-height-40" onclick="order_del(this,'{{$order['id']}}')">
                                        删除
                                    </a>
                                    @else
                                       <span class="no_click background-none">删除</span>
                                    @endif
                                </td>
                            </tr>
                        </table>
                    </div>

                    @if($order['invoice_type']==0)
                    <!-- Modal -->
                        <div class="modal fade" id="invoiceModel_{{$order['invoice']['id']}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
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
                                                {{$order['invoice']['title']}}
                                            </div>
                                        </div>
                                        <div class="row position-relative margin-top-20">
                                            <div class="col-xs-6 col-sm-4 text-right">税 号 / 信 用 代 码：</div>
                                            <div class="col-xs-6 col-sm-8">
                                                {{$order['invoice']['credit']}}
                                            </div>
                                        </div>
                                        <div class="row position-relative margin-top-20">
                                            <div class="col-xs-6 col-sm-4 text-right">收 票 人 姓 名：</div>
                                            <div class="col-xs-6 col-sm-8">
                                                {{$order['invoice']['name']}}
                                            </div>
                                        </div>
                                        <div class="row position-relative margin-top-20">
                                            <div class="col-xs-6 col-sm-4 text-right">收 票 人 电 话：</div>
                                            <div class="col-xs-6 col-sm-8">
                                                {{$order['invoice']['phonenum']}}
                                            </div>
                                        </div>
                                        <div class="row position-relative margin-top-20">
                                            <div class="col-xs-6 col-sm-4 text-right">收 票 人 地 址：</div>
                                            <div class="col-xs-6 col-sm-8">
                                                {{$order['invoice']['address']}}
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @else
                    <!-- Modal -->
                        <div class="modal fade" id="invoiceModel_{{$order['invoice']['id']}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
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
                                                {{$order['invoice']['title']}}
                                            </div>
                                        </div>
                                        <div class="row position-relative margin-top-20">
                                            <div class="col-xs-6 col-sm-4 text-right">纳 税 人 识 别 码：</div>
                                            <div class="col-xs-6 col-sm-8">
                                                {{$order['invoice']['credit']}}
                                            </div>
                                        </div>
                                        <div class="row position-relative margin-top-20">
                                            <div class="col-xs-6 col-sm-4 text-right">注 册 地 址：</div>
                                            <div class="col-xs-6 col-sm-8">
                                                {{$order['invoice']['company_address']}}
                                            </div>
                                        </div>
                                        <div class="row position-relative margin-top-20">
                                            <div class="col-xs-6 col-sm-4 text-right">注 册 电 话：</div>
                                            <div class="col-xs-6 col-sm-8">
                                                {{$order['invoice']['company_tel']}}
                                            </div>
                                        </div>
                                        <div class="row position-relative margin-top-20">
                                            <div class="col-xs-6 col-sm-4 text-right">开 户 银 行：</div>
                                            <div class="col-xs-6 col-sm-8">
                                                {{$order['invoice']['bank']}}
                                            </div>
                                        </div>
                                        <div class="row position-relative margin-top-20">
                                            <div class="col-xs-6 col-sm-4 text-right">银 行 账 号：</div>
                                            <div class="col-xs-6 col-sm-8">
                                                {{$order['invoice']['number']}}
                                            </div>
                                        </div>
                                        {{--<div class="row position-relative margin-top-20">--}}
                                            {{--<div class="col-xs-6 col-sm-4 text-right">公 司 证 照：</div>--}}
                                            {{--<div class="col-xs-6 col-sm-8">--}}
                                                {{--@if($order['invoice']['licence']==0)--}}
                                                    {{--<div class="row height-150 text-center">--}}
                                                        {{--<div class="col-xs-12 col-sm-4">--}}
                                                            {{--<img src="{{$order['invoice']['business_license']}}" class="width-100 height-150" />--}}
                                                            {{--<p>营业执照</p>--}}
                                                        {{--</div>--}}
                                                        {{--<div class="col-xs-12 col-sm-4">--}}
                                                            {{--<img src="{{$order['invoice']['account_opening_permit']}}" class="width-100 height-150" />--}}
                                                            {{--<p>开户许可证</p>--}}
                                                        {{--</div>--}}
                                                        {{--<div class="col-xs-12 col-sm-4">--}}
                                                            {{--<img src="{{$order['invoice']['tax_registration_certificate']}}" class="width-100 height-150" />--}}
                                                            {{--<p>税务登记证</p>--}}
                                                        {{--</div>--}}
                                                    {{--</div>--}}
                                                {{--@else--}}
                                                    {{--<div class="row height-150 text-center">--}}
                                                        {{--<div class="col-xs-12 col-sm-4">--}}
                                                            {{--<img src="{{$order['invoice']['business_license']}}" class="width-100 height-150" />--}}
                                                            {{--<p>营业执照</p>--}}
                                                        {{--</div>--}}
                                                    {{--</div>--}}
                                                {{--@endif--}}
                                            {{--</div>--}}
                                        {{--</div>--}}
                                        <div class="row position-relative margin-top-20">
                                            <div class="col-xs-6 col-sm-4 text-right">收 票 人 姓 名：</div>
                                            <div class="col-xs-6 col-sm-8">
                                                {{$order['invoice']['name']}}
                                            </div>
                                        </div>
                                        <div class="row position-relative margin-top-20">
                                            <div class="col-xs-6 col-sm-4 text-right">收 票 人 电 话：</div>
                                            <div class="col-xs-6 col-sm-8">
                                                {{$order['invoice']['phonenum']}}
                                            </div>
                                        </div>
                                        <div class="row position-relative margin-top-20">
                                            <div class="col-xs-6 col-sm-4 text-right">收 票 人 地 址：</div>
                                            <div class="col-xs-6 col-sm-8">
                                                {{$order['invoice']['address']}}
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


                <!-- Modal -->
                    <div class="modal fade" id="logisticsModel_{{$order['id']}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                    <h4>物流信息</h4>
                                </div>
                                @if($order['logistics_company']&&$order['logistics_no'])
                                    <div class="modal-body max-height-modal overflow-y-scroll">
                                        <div class="position-relative margin-top-10 margin-left-10 margin-right-10 padding-bottom-10 border-box-active">
                                            <div class="row position-relative margin-top-10 font-size-14">
                                                <div class="col-xs-6 col-sm-3 text-right">物 流 公 司：</div>
                                                <div class="col-xs-6 col-sm-9">
                                                    {{$order['logistics']['ret']['result']['company']}}
                                                </div>
                                            </div>
                                            <div class="row position-relative margin-top-10">
                                                <div class="col-xs-6 col-sm-3 text-right">物 流 单 号：</div>
                                                <div class="col-xs-6 col-sm-9">{{$order['logistics_no']}}</div>
                                            </div>
                                            <div class="row position-relative margin-top-10">
                                                <div class="col-xs-6 col-sm-3 text-right">收 货 地 址：</div>
                                                <div class="col-xs-6 col-sm-9">
                                                    {{$order['address']['province']}} {{$order['address']['city']}} {{$order['address']['town']}}
                                                    {{$order['address']['detail']}}<br />
                                                    <span class="margin-right-50">收货人：{{$order['address']['name']}}</span>联系电话：{{$order['address']['phonenum']}}<br />
                                                    @if($order['address']['phone'])
                                                        <span class="margin-right-50">收货人：固定电话：{{$order['address']['phone']}}</span>
                                                    @endif
                                                    @if($order['address']['code'])
                                                        邮编：{{$order['address']['code']}}
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                        @if($order['logistics']['ret']['resultcode']==200)
                                            <ul class="margin-top-20 margin-bottom-20 font-size-14 padding-left-10 padding-right-10">
                                                @foreach($order['logistics']['ret']['result']['list'] as $list)
                                                    <li>
                                                        <span class="glyphicon glyphicon-play margin-right-20" aria-hidden="true"></span>
                                                        <span class="margin-right-20">{{$list['datetime']}}</span>{{$list['remark']}}
                                                    </li>
                                                @endforeach
                                            </ul>
                                        @else
                                            {{--<div class="margin-top-10 margin-right-10 margin-left-10 text-center">--}}
                                                {{--<img src="{{ URL::asset('img/nothing.png') }}"  />--}}
                                            {{--</div>--}}
                                            <div class="margin-top-20 text-center index-font">
                                                {{$order['logistics']['ret']['reason']}}
                                            </div>
                                        @endif
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
                                    </div>
                                @else
                                    <div class="margin-top-20 margin-right-10 margin-left-10 text-center">
                                        <img src="{{ URL::asset('img/nothing.png') }}"  />
                                    </div>
                                    <div class="margin-top-20 text-center index-font">
                                        查不到物流信息！
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="row margin-bottom-20 padding-left-20 padding-right-20">
                @if(count($orders)==0)
                    <div class="margin-top-20 margin-right-10 margin-left-10 text-center">
                        <img src="{{ URL::asset('img/nothing.png') }}"  />
                    </div>
                    <div class="margin-top-20 text-center index-font">
                        您还没有订单，快去添加一个吧！
                    </div>
                @endif
            </div>
            <div class="common-text-align-center">
                {!! $orders->links() !!}
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
<script type="text/javascript" src="{{ URL::asset('/js/jQueryProvinces/address-select.js') }}"></script>
<script type="text/javascript">

    //删除订单
    function order_del(obj,id){
        layer.confirm('确认要删除吗？',function(index){
            //进行后台删除
            var param = {
                id: id,
                _token: "{{ csrf_token() }}"
            }
            delOrder('{{URL::asset('')}}', param, function (ret) {
                if (ret.result == true) {
                    layer.msg(ret.msg, {icon: 1, time: 1000});
                    $(obj).parents("table").remove();
                } else {
                    layer.msg(ret.msg, {icon: 2, time: 1000})
                }
            })
        });
    }

    //确认收货
    function confirmReceipt(obj,id){
        layer.confirm('确认已经收货了吗？',function(index){
            //进行后台删除
            var param = {
                id: id,
                _token: "{{ csrf_token() }}"
            }
            confirmOrder('{{URL::asset('')}}', param, function (ret) {
                if (ret.result == true) {
                    layer.msg(ret.msg, {icon: 1, time: 1000});
                    window.location.reload();
                } else {
                    layer.msg(ret.msg, {icon: 2, time: 1000})
                }
            })
        });
    }

    //申请退款
    function applicationForRefund(obj,id){
        layer.confirm('确认要申请退款吗？',function(index){
            //进行后台删除
            var param = {
                id: id,
                _token: "{{ csrf_token() }}"
            }
            refundOrder('{{URL::asset('')}}', param, function (ret) {
                if (ret.result == true) {
                    layer.msg(ret.msg, {icon: 1, time: 1000});
                    window.location.reload();
                } else {
                    layer.msg(ret.msg, {icon: 2, time: 1000})
                }
            })
        });
    }
</script>
@endsection