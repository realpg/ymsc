@extends('home.layouts.base')

@section('content')
<div id="main-body">
    <div class="style-home-nav-station"></div>
    <div class="container margin-top-20 margin-bottom-20">
        @include('home.layouts.center')
        <div class="col-xs-12 col-sm-10 border-center-menu padding-top-10 padding-bottom-10  line-height-34 center-address" id="center-content">
            <div class="member-nav">
                <span class="font-size-16 float-left"><b>订单{{$order['trade_no']}}评价</b></span>
                <span class="font-size-16 float-right">
                    <a href="javascript:history.go(-1)">
                        <b class="text-blue">返回</b>
                    </a>
                </span>
            </div>
            <div class="clear"></div>
            <div class="margin-top-20">
                @foreach($suborders as $k=>$suborder)
                    <div class="table-responsive">
                        <table class="table border-0 margin-bottom-20">
                            <tr class="line-height-40 text-center">
                                <td class="background-detail">图片</td>
                                <td class="background-detail">商品</td>
                                <td class="background-detail">单价（元）</td>
                                <td class="background-detail">商品单位</td>
                                <td class="background-detail">数量</td>
                                <td class="background-detail">小计（元）</td>
                            </tr>
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
                            <tr>
                                <td colspan="6" class="border-bottom-attribute">
                                    <textarea name="content" id="content_{{$suborder['goods_id']}}" class="form-control" rows="3" style="resize: none;" placeholder="请对此商品添加评论"></textarea>
                                    <div class="margin-top-10">
                                        <button type="button" onclick="submitComment(this,'{{$suborder['goods_id']}}')" class="btn btn-info border-radius-0 float-right">提 交 评 论</button>
                                    </div>
                                </td>
                            </tr>
                        </table>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
<script type="text/javascript" src="{{ URL::asset('/js/jQueryProvinces/address-select.js') }}"></script>
<script type="text/javascript">
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
    //提交评论
    function submitComment(obj,goods_id){
        var content=$('#content_'+goods_id).val()
        if(content){
            var param = {
                goods_id: goods_id,
                content: content,
                _token: "{{ csrf_token() }}"
            }
            editComment('{{URL::asset('')}}', param, function (ret) {
                console.log('editComment is : '+JSON.stringify(ret))
                if (ret.result == true) {
                    layer.msg(ret.msg, {icon: 1, time: 1000});
                    $(obj).parents("tr").remove();
                    // window.location.reload();
                } else {
                    layer.msg(ret.msg, {icon: 2, time: 1000})
                }
            })
        }
        else{
            layer.msg('请对商品进行评价', {icon: 2, time: 1000})
        }
    }
</script>
@endsection