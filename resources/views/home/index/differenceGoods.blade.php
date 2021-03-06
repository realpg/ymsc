@extends('home.layouts.base')
@section('seo')
    <title>{{$goods['seo_title']?$goods['seo_title']:$common['base']['seo_title']}}</title>
    <meta name="keywords" content="{{$goods['seo_keywords']?$goods['seo_keywords']:$common['base']['seo_keywords']}}" />
    <meta name="description" content="{{$goods['seo_description']?$goods['seo_description']:$common['base']['seo_description']}}" />
@endsection
@section('content')
<div id="main-body">
    <div class="style-home-nav-station"></div>
    <div class="height-80"></div>
    @include('home.layouts.search')
    <div class="border-bottom-attribute">
        <div class="container line-height-40 style-ellipsis-1">
            <a href="{{URL::asset('/')}}">商城</a> >{{$goods['name']}}
        </div>
    </div>
    <div class="container margin-bottom-20" id="goods_lists">
        <div class="row goods-lists-card margin-bottom-20 margin-top-10 letter-spacing-2 border-div min-height-content">
            <div class="col-xs-12 col-sm-3 padding-10">
                <div class="text-center margin-right-10 padding-bottom-10 padding-right-10 padding-left-10">
                    <div class="goods-lists-picture padding-top-40" style="width:100%;height:100%;">
                        <img class="img-circle" src="{{$goods['picture']}}" alt="{{$goods['name']}}">
                    </div>
                </div>
            </div>
            <div class="col-xs-12 col-sm-9 padding-10">
                <h3 class="style-ellipsis-1 line-height-30">{{$goods['name']}}</h3>
                <h3 class="style-ellipsis-1 line-height-30">
                    价 格：<span class="text-red">￥<span id="total">{{$goods['price']/100}}</span> / {{$goods['unit']}}</span>
                </h3>
                <h4 class="style-ellipsis-1 line-height-30 margin-top-20">
                    数量：
                    <input id="min" name="" type="button" value="-" class="background-none border-div" />
                    <input id="text_box" name="" type="text" value="1" class="border-div width-50px common-text-align-center"/>
                    <input id="add" name="" type="button" value="+" class="background-none border-div" />
                </h4>
                <h5 class="line-height-30 text-red">
                    说明：<br />
                    购买此产品前请联系客服，细节确定后再购买；
                    差多少钱，拍几件；
                    支付时请在备注一栏中填好想要购买的商品名称、商品货号、购买数量，以及详细要求，以便管理人员进行订单核实。
                </h5>
                <div class="row margin-top-20">
                    <div class="col-xs-6 col-sm-3">
                        <button type="button" onclick="settlement()" class="btn btn-danger width-100 border-radius-0">购 买</button>
                    </div>
                    <div class="col-xs-6 col-sm-3">
                        <button type="button" class="btn btn-default width-100 border-radius-0 background-none" onclick="addShoppingCart('{{$goods['id']}}')">加入购物车</button>
                    </div>
                </div>
            </div>
            <div class="clear"></div>
        </div>
    </div>
</div>
@endsection

@section('script')
<script>
    $(document).ready(function(){
        //获得文本框对象
        var t = $("#text_box");
        //初始化数量为1,并失效减
        $('#min').attr('disabled',true);
        //数量增加操作
        $("#add").click(function(){
            // 给获取的val加上绝对值，避免出现负数
            t.val(Math.abs(parseInt(t.val()))+1);
            if (parseInt(t.val())!=1){
                $('#min').attr('disabled',false);
            };
        })
        //数量减少操作
        $("#min").click(function(){
            t.val(Math.abs(parseInt(t.val()))-1);
            if (parseInt(t.val())==1){
                $('#min').attr('disabled',true);
            };
        })
    });

    //添加购物车调用函数
    function addShoppingCart(goods_id){
        var count=$('#text_box').val();
        if(isPositiveInteger(count)){
            var param={
                goods_id: goods_id,
                count:count,
                _token: "{{ csrf_token() }}"
            }
            console.log('addShoppingCart param is : '+JSON.stringify(param));
            editShoppingCart('{{URL::asset('')}}', param, function (ret) {
                if (ret.result == true) {
                    layer.msg(ret.msg, {icon: 1, time: 3000});
                    setTimeout(function () {
                        window.location.reload();
                    }, 1000)
                } else {
                    if(ret.code==9999){
                        location.href='{{URL::asset('signIn')}}';
                    }
                    else{
                        layer.msg(ret.msg, {icon: 2, time: 3000})
                    }
                }
            })
        }
        else{
            layer.msg('数量一栏中请填写大于1的正整数', {icon: 2, time: 3000})
        }
    }

    //结算
    function settlement(){
        var total=$('#total').text();
        var count=$('#text_box').val();
        if(isPositiveInteger(count)){
            var param = {
                goods_id: '{{$goods['id']}}',
                total:total,
                count:count,
                _token: "{{ csrf_token() }}"
            }
            addGoodsOrder('{{URL::asset('')}}', param, function (ret) {
                if (ret.result == true) {
                    layer.msg(ret.msg, {icon: 1, time: 1000});
                    window.location.href = "{{URL::asset('order')}}";
                } else {
                    if(ret.code==9999){
                        location.href='{{URL::asset('signIn')}}';
                    }
                    else{
                        layer.msg(ret.msg, {icon: 2, time: 3000})
                    }
                }
            })
        }
        else{
            layer.msg('数量一栏中请填写大于1的正整数', {icon: 2, time: 3000})
        }
    }
</script>
@endsection