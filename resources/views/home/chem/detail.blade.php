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
            <a href="{{URL::asset('/')}}">商城</a> > <a href="{{URL::asset($column)}}">{{$channel['parent_channel']['name']}}</a> >  <a href="{{URL::asset($column.'/lists/'.$goods['menu_id'])}}">{{$channel['name']}}</a> >{{$goods['name']}}
        </div>
    </div>
    <div class="container margin-bottom-20" id="goods_lists">
        <div class="row goods-lists-card margin-bottom-20 margin-top-10 letter-spacing-2 border-div min-height-content" style="min-height: 250px;">
            <div class="col-xs-12 col-sm-3 padding-10">
                <div class="text-center margin-right-10 padding-bottom-10 padding-right-10 padding-left-10">
                    <div class="goods-lists-picture padding-top-40" style="width:100%;height:100%;">
                        <img class="img-circle" src="{{$goods['chem_class']['picture']}}" alt="{{$goods['name']}}">
                    </div>
                </div>
            </div>
            <div class="col-xs-12 col-sm-9 padding-10">
                <h3 class="style-ellipsis-1 line-height-30">{{$goods['name']}}</h3>
                <h4 class="style-ellipsis-1 line-height-30">商品货号：{{$goods['number']}}</h4>
                <h4 class="style-ellipsis-1 line-height-30">CAS号：{{$goods['chem_class']['cas']}}</h4>
                <h4 class="style-ellipsis-1 line-height-30">
                    <div class="col-xs-6 col-sm-2 padding-0">规格：{{$goods['attribute']['spec']}}</div>
                    <div class="col-xs-6 col-sm-2 padding-0">纯度：{{$goods['s_attribute']['name']}}</div>
                    <div class="col-xs-6 col-sm-2 padding-0">货期：{{$goods['attribute']['delivery']}}</div>
                    <div class="col-xs-6 col-sm-2 padding-0">分类：{{$goods['f_attribute']['name']}}</div>
                </h4>
                <div class="style-ellipsis-1">
                    <div class="col-xs-6 col-sm-4 padding-0 line-height-40 font-size-24">
                        价 格：<span class="text-red">￥<span id="total">{{$goods['price']/100}}</span> / {{$goods['unit']}}</span>
                    </div>
                    <div class="col-xs-6 col-sm-4 padding-0 line-height-40 font-size-18">
                        库 存：{{$goods['stock']}} {{$goods['unit']}}
                    </div>
                </div>
                @if($goods['stock']>0)
                    <h4 class="style-ellipsis-1 line-height-30 margin-top-20">
                        数量：
                        <input id="min" name="" type="button" value="-" class="background-none border-div" />
                        <input id="text_box" name="" type="text" value="1" class="border-div width-50px common-text-align-center"/>
                        <input id="add" name="" type="button" value="+" class="background-none border-div" />
                    </h4>
                    <div class="row margin-top-20 margin-bottom-20">
                        <div class="col-xs-6 col-sm-3">
                            <button type="button" onclick="settlement()" class="btn btn-danger width-100 border-radius-0">购 买</button>
                        </div>
                        <div class="col-xs-6 col-sm-3">
                            <button type="button" class="btn btn-default width-100 border-radius-0 background-none" onclick="addShoppingCart('{{$goods['id']}}')">加入购物车</button>
                        </div>
                    </div>
                @else
                    <h4 class="style-ellipsis-1 line-height-30 margin-top-20">
                        数量：
                        <input id="min" name="" type="button" value="-" class="background-none border-div no_click" disabled="true" />
                        <input id="text_box" name="" type="text" value="0" class="border-div width-50px common-text-align-center no_click" readonly/>
                        <input id="add" name="" type="button" value="+" class="background-none border-div no_click" disabled="true" />
                    </h4>
                    <div class="row margin-top-20 margin-bottom-20">
                        <div class="col-xs-6 col-sm-3">
                            <button type="button" onclick="getNotice()" class="btn btn-danger width-100 border-radius-0">购 买</button>
                        </div>
                        <div class="col-xs-6 col-sm-3">
                            <button type="button" class="btn btn-default width-100 border-radius-0 background-none" onclick="getNotice()">加入购物车</button>
                        </div>
                    </div>
                @endif
            </div>
            <div class="clear"></div>
        </div>
        <div class="margin-bottom-10">
            <div class="line-height-40 border-bottom-navy-blue row common-text-align-center">
                <div class="col-xs-12 col-sm-2 background-navy-blue text-white">其 他 规 格</div>
            </div>
            <div class="table-responsive">
                <table class="table border-0">
                    <tr class="line-height-40 border-bottom-attribute row common-text-align-center">
                        <td class="col-xs-2 col-sm-2">货号</td>
                        <td class="col-xs-2 col-sm-2">品牌</td>
                        <td class="col-xs-2 col-sm-2">纯度</td>
                        <td class="col-xs-2 col-sm-2">规格</td>
                        <td class="col-xs-2 col-sm-2">货期</td>
                        <td class="col-xs-2 col-sm-2 text-red">优迈价</td>
                    </tr>
                    @foreach($goods['other_goodses'] as $goods['other_goods'])
                        <tr class="line-height-40 border-bottom-attribute row common-text-align-center">
                            <td class="col-xs-0 col-sm-2">
                                <a href="{{URL::asset($column.'/detail/'.$goods['other_goods']['goods_id'])}}">
                                    {{$goods['other_goods']['number']}}
                                </a>
                            </td>
                            <td class="col-xs-0 col-sm-2">
                                <a href="{{URL::asset($column.'/detail/'.$goods['other_goods']['goods_id'])}}">
                                    {{$goods['other_goods']['f_attribute']}}
                                </a>
                            </td>
                            <td class="col-xs-0 col-sm-2">
                                <a href="{{URL::asset($column.'/detail/'.$goods['other_goods']['goods_id'])}}">
                                    {{$goods['other_goods']['s_attribute']}}
                                </a>
                            </td>
                            <td class="col-xs-0 col-sm-2">
                                <a href="{{URL::asset($column.'/detail/'.$goods['other_goods']['goods_id'])}}">
                                    {{$goods['other_goods']['spec']}}
                                </a>
                            </td>
                            <td class="col-xs-0 col-sm-2">
                                <a href="{{URL::asset($column.'/detail/'.$goods['other_goods']['goods_id'])}}">
                                    {{$goods['other_goods']['delivery']}}
                                </a>
                            </td>
                            <td class="col-xs-0 col-sm-2 text-red">
                                <a href="{{URL::asset($column.'/detail/'.$goods['other_goods']['goods_id'])}}">
                                    ￥{{$goods['other_goods']['price']/100}}/{{$goods['other_goods']['unit']}}
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </table>
            </div>
        </div>
        <div class="margin-top-20">
            <div class="line-height-40 border-bottom-navy-blue row common-text-align-center">
                <div class="col-xs-12 col-sm-2 background-navy-blue text-white">商 品 详 情</div>
            </div>
            <div>
                <div class="line-height-40 row" style="background: #E7E7E7;">
                    <div class="col-xs-12 col-sm-2 common-text-align-center">商 品 信 息</div>
                </div>
                <div class="line-height-40 row border-detail border-bottom-0">
                    <div class="col-xs-12 col-sm-1 padding-0"></div>
                    <div class="col-xs-12 col-sm-3 padding-0">名 称：{{$goods['name']}}</div>
                    <div class="col-xs-12 col-sm-2 padding-0">品 牌：{{$goods['f_attribute']['name']}}</div>
                    <div class="col-xs-12 col-sm-3 padding-0">纯 度：{{$goods['s_attribute']['name']}}</div>
                    <div class="col-xs-12 col-sm-3 padding-0">规 格：{{$goods['attribute']['spec']}}</div>
                    <div class="col-xs-12 col-sm-1 padding-0"></div>
                </div>
                <div class="line-height-40 border-bottom-attribute row border-detail border-top-0">
                    <div class="col-xs-12 col-sm-1 padding-0"></div>
                    <div class="col-xs-12 col-sm-3 padding-0">货 号：{{$goods['number']}}</div>
                    <div class="col-xs-12 col-sm-2 padding-0">货 期：{{$goods['attribute']['delivery']}}</div>
                    <div class="col-xs-12 col-sm-3 padding-0">仓 库：{{$goods['attribute']['depot']}}</div>
                    <div class="col-xs-12 col-sm-3 padding-0">品 牌 商 货 号：{{$goods['attribute']['merchant']}}</div>
                    <div class="col-xs-12 col-sm-1 padding-0"></div>
                </div>
                <div class="line-height-40 row background-detail">
                    <div class="col-xs-12 col-sm-2 common-text-align-center">化 合 物 信 息</div>
                </div>
                <div class="line-height-40 border-bottom-attribute row border-detail border-bottom-0 border-top-0">
                    <div class="col-xs-12 col-sm-2 common-text-align-center border-top-white background-detail">化 合 物 英 文 学 名</div>
                    <div class="col-xs-12 col-sm-10 border-detail border-bottom-0 border-left-0 border-right-0">{{$goods['chem_class']['english_name']}}</div>
                </div>
                <div class="line-height-40 border-bottom-attribute row border-detail border-bottom-0 border-top-0">
                    <div class="col-xs-12 col-sm-2 common-text-align-center border-top-white background-detail">化 合 物 中 文 学 名</div>
                    <div class="col-xs-12 col-sm-10 border-detail border-bottom-0 border-left-0 border-right-0">{{$goods['chem_class']['sub_name']}}</div>
                </div>
                <div class="line-height-40 border-bottom-attribute row border-detail border-bottom-0 border-top-0">
                    <div class="col-xs-12 col-sm-2 common-text-align-center border-top-white background-detail">C A S 号</div>
                    <div class="col-xs-12 col-sm-10 border-detail border-bottom-0 border-left-0 border-right-0">{{$goods['chem_class']['cas']?$goods['chem_class']['cas']:'暂无'}}</div>
                </div>
                <div class="line-height-40 border-bottom-attribute row border-detail border-bottom-0 border-top-0">
                    <div class="col-xs-12 col-sm-2 common-text-align-center border-top-white background-detail">分 子 量</div>
                    <div class="col-xs-12 col-sm-10 border-detail border-bottom-0 border-left-0 border-right-0">{{$goods['attribute']['molecular']}}</div>
                </div>
                <div class="line-height-40 border-bottom-attribute row border-detail border-bottom-0 border-top-0">
                    <div class="col-xs-12 col-sm-2 common-text-align-center border-top-white background-detail">精 准 质 量</div>
                    <div class="col-xs-12 col-sm-10 border-detail border-bottom-0 border-left-0 border-right-0">{{$goods['attribute']['accurate']}}</div>
                </div>
                <div class="line-height-40 border-bottom-attribute row border-detail border-bottom-0 border-top-0">
                    <div class="col-xs-12 col-sm-2 common-text-align-center border-top-white background-detail">分 子 式</div>
                    <div class="col-xs-12 col-sm-10 border-detail border-left-0 border-right-0">{!! $goods['chem_class']['molecule'] !!}</div>
                </div>
            </div>
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
        $('#min').addClass('no_click');
        // 判断库存是否为1，如果为1就不能点击
        var stock=Math.abs(parseInt('{{$goods['stock']}}'))
        if(stock==1){
            $('#add').addClass('no_click');
            $('#add').attr('disabled',true);
        }
        //数量增加操作
        $("#add").click(function(){
            // 给获取的val加上绝对值，避免出现负数
            {{--var stock=Math.abs(parseInt('{{$goods['stock']}}'))--}}
            if((Math.abs(parseInt(t.val()))+1)<stock){
                t.val(Math.abs(parseInt(t.val()))+1);
                if (parseInt(t.val())!=1){
                    $('#min').attr('disabled',false);
                    $('#min').removeClass('no_click');
                };
            }
            else if((Math.abs(parseInt(t.val()))+1)==stock){
                t.val(Math.abs(parseInt(t.val()))+1);
                if (parseInt(t.val())!=1){
                    $('#min').attr('disabled',false);
                    $('#min').removeClass('no_click');
                };
                $('#add').attr('disabled',true);
                $('#add').addClass('no_click');
            }
            else{
                $('#add').attr('disabled',true);
                $('#add').addClass('no_click');
                // layer.msg('数量已到上限', {icon: 2, time: 3000})
            }
        })
        //数量减少操作
        $("#min").click(function(){
            t.val(Math.abs(parseInt(t.val()))-1);
            if (parseInt(t.val())==1){
                $('#min').attr('disabled',true);
                $('#min').addClass('no_click');
                // layer.msg('数量必须大于1', {icon: 2, time: 3000})
            }
            else{
                $('#min').removeClass('no_click');
            }
            // 判断是否等于库存，如果不等于就移除样式改为可以点击
            {{--            var stock=Math.abs(parseInt('{{$goods['stock']}}'))--}}
            if(parseInt(t.val())==stock){
                $('#add').addClass('no_click');
                $('#add').attr('disabled',true);
            }
            else{
                $('#add').removeClass('no_click');
                $('#add').attr('disabled',false);
            }
        })
    });

    //添加购物车调用函数
    function addShoppingCart(goods_id){
        var count=$('#text_box').val();
        if(isPositiveInteger(count)){
            var stock=Math.abs(parseInt('{{$goods['stock']}}'))
            if(count<=stock){
                var param={
                    goods_id: goods_id,
                    count:count,
                    _token: "{{ csrf_token() }}"
                }
                editShoppingCart('{{URL::asset('')}}', param, function (ret) {
                    if (ret.result == true) {
                        layer.msg(ret.msg, {icon: 1, time: 3000});
                        window.location.reload()
                    } else {
                        layer.msg(ret.msg, {icon: 2, time: 3000})
                    }
                })
            }
            else{
                layer.msg('购买数量不能大于库存', {icon: 2, time: 3000})
            }
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
            var stock=Math.abs(parseInt('{{$goods['stock']}}'))
            if(count<=stock){
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
                        layer.msg(ret.msg, {icon: 2, time: 3000})
                    }
                })
            }
            else{
                layer.msg('购买数量不能大于库存', {icon: 2, time: 3000})
            }
        }
        else{
            layer.msg('数量一栏中请填写大于1的正整数', {icon: 2, time: 3000})
        }
    }

    //库存为0时的警告
    function getNotice(){
        layer.msg('此商品库存已空，商城正在进货中...', {icon: 2, time: 3000})
    }
</script>
@endsection