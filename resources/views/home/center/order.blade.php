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
                                        <a href=""  />
                                            发票详情
                                        </a>
                                    </div>
                                    @if($order['status']==2)
                                    <div class="float-right">
                                        <a href=""  >
                                            物流详情
                                        </a>
                                    </div>
                                    @endif
                                </td>
                                <td class="text-right width-250 border-bottom-attribute" style="display:table-cell;vertical-align:middle;">
                                    共<span>{{$order['count']}}</span>件商品
                                </td>
                                <td class="text-right width-250 border-bottom-attribute" style="display:table-cell;vertical-align:middle;">
                                    总价（包含<span>￥10.00</span> 邮费）
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
                                        <a href="javascript:" class="line-height-40">
                                            确认收货
                                        </a>
                                    </td>
                                @elseif($order['status']==3)
                                    <td class="width-110 text-blue cart-settlement border-bottom-attribute" style="display:table-cell;vertical-align:middle;padding:0px;" >
                                        <a href="javascript:" class="line-height-40">
                                            评价
                                        </a>
                                    </td>
                                @endif
                                <td class="width-110 text-blue cart-settlement border-bottom-attribute" style="display:table-cell;vertical-align:middle;padding:0px;" >
                                    <a href="javascript:" class="line-height-40">
                                        删除
                                    </a>
                                </td>
                            </tr>
                        </table>
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
        </div>
    </div>
</div>
@endsection

@section('script')
<script type="text/javascript" src="{{ URL::asset('/js/jQueryProvinces/address-select.js') }}"></script>
<script type="text/javascript">
    $(function () {
    });
</script>
@endsection