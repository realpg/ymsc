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
            <div class="col-md-12 col-lg-9">
                <div class="row goods-lists-card margin-bottom-20 margin-top-10 letter-spacing-2 border-div min-height-content" style="min-height: 250px;">
                    <div class="col-md-12 col-lg-4 padding-10">
                        <div class="text-center margin-right-10 padding-bottom-10 padding-right-10 padding-left-10">
                            <div class="goods-lists-picture padding-top-40" style="width:100%;height:100%;">
                                <img class="img-circle" src="{{$goods['picture']}}" alt="{{$goods['name']}}">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12 col-lg-8 padding-10">
                        <h4 class="style-ellipsis-1 line-height-30">设备：{{$goods['name']}}</h4>
                        <h4 class="style-ellipsis-1 line-height-30">商品货号：{{$goods['number']}}</h4>
                        <h4 class="style-ellipsis-1 line-height-30">精度：{{$goods['attribute']['accuracy']}}</h4>
                        <h4 class="style-ellipsis-1 line-height-30">成分：{{$goods['attribute']['component']}}</h4>
                        <h4 class="style-ellipsis-1 line-height-30">尺寸：{{$goods['attribute']['size']}}</h4>
                        <h3 class="style-ellipsis-1 line-height-30">
                            价 格：<span class="text-red">￥<span id="total">{{$goods['price']/100}}</span> / {{$goods['unit']}}</span>
                            <span class="style-ellipsis-1 line-height-30 font-size-18 margin-left-5">库 存：{{$goods['stock']}} {{$goods['unit']}}</span>
                        </h3>
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
                                <input id="text_box" name="" type="text" class="border-div width-50px common-text-align-center no_click" value="0" readonly/>
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
                <ul class="line-height-40 border-bottom-navy-blue row common-text-align-center" id="tab">
                    <li class="col-md-12 col-lg-2 background-detail tab_active">标 品 详 情</li>
                    <li class="col-md-12 col-lg-2 background-detail">客 户 评 价</li>
                </ul>
                <ul class="tab_content">
                    <li style="display: block;">
                        @foreach($goods['details'] as $goods['detail'])
                            @if($goods['detail']['type']==0)
                                <div>
                                    {!! $goods['detail']['content'] !!}
                                </div>
                            @elseif($goods['detail']['type']==1)
                                <div>
                                    <img src="{{$goods['detail']['content']}}" style="width:100%;" />
                                </div>
                            @elseif($goods['detail']['type']==2)
                                <div>
                                    <video src="{{$goods['detail']['content']}}" controls="controls" style="width:100%;">
                                        您的浏览器不支持 video 标签。
                                    </video>
                                </div>
                            @endif
                        @endforeach
                        @if(count($goods['details'])==0)
                            <div class="margin-top-20 margin-right-10 margin-left-10 text-center">
                                <img src="{{ URL::asset('img/nothing.png') }}"  />
                            </div>
                            <div class="margin-top-20 text-center index-font">
                                暂时没有此商品的描述
                            </div>
                        @endif
                    </li>
                    <li>
                        @if(count($comments)==0)
                            <div class="margin-top-20 margin-right-10 margin-left-10 text-center">
                                <img src="{{ URL::asset('img/nothing.png') }}"  />
                            </div>
                            <div class="margin-top-20 text-center index-font">
                                还没有人对此商品进行评价!
                            </div>
                        @else
                            @foreach($comments as $comment)
                                <div class="row goods-lists-card margin-bottom-20 margin-top-10 letter-spacing-2 border-div min-height-content" style="min-height: 100px;">
                                    <div class="col-md-2 col-lg-2 padding-10">
                                        <div class="common-text-align-center">
                                            <img src="{{$comment['user']['avatar']}}" class="width-50px height-50 border-radius-100" />
                                        </div>
                                        <div class="common-text-align-center margin-top-10 text-oneline">
                                            {{$comment['user']['nick_name']}}
                                        </div>
                                    </div>
                                    <div class="col-md-10 col-lg-10 padding-10">
                                        <div class="text-grey">
                                            {{$comment['created_at']}}
                                        </div>
                                        <div>
                                            {{$comment['content']}}
                                        </div>
                                    </div>
                                    <div class="clear"></div>
                                </div>
                            @endforeach
                            @if(count($comments)>=20)
                            <a href="{{URL::asset('comment/'.$goods['id'])}}">
                                <div class="line-height-30 row common-text-align-center background-detail">
                                    查看更多
                                </div>
                            </a>
                            @endif
                        @endif
                    </li>
                </ul>
            </div>
            <div class="col-md-12 col-lg-3">
                <h4 class="background-detail margin-top-10 padding-10 common-text-align-center">相似产品</h4>
                @foreach($goods['other_goodses'] as $goods['other_goods'])
                    <div class="border-div margin-top-10 margin-bottom-10 padding-10">
                        <a href="{{URL::asset($column.'/detail/standard/'.$goods['other_goods']['id'])}}">
                            <img src="{{$goods['other_goods']['picture']}}" class="width-100" alt="{{$goods['other_goods']['name']}}" />
                        </a>
                    </div>
                @endforeach
                @if(count($goods['other_goodses'])==0)
                    <div class="margin-top-20 margin-right-10 margin-left-10 text-center">
                        <img src="{{ URL::asset('img/nothing.png') }}"  />
                    </div>
                    <div class="margin-top-20 text-center index-font">
                        暂时没有此产品的相似产品
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script type="text/javascript" src="{{ URL::asset('/js/swiper-3.4.0.jquery.min.js') }}"></script>
    <script>
        $(function() {
            $('#tab').find('li').click(function(){
                var index = $(this).index();
                $(this).addClass('tab_active').siblings().removeClass('tab_active');
                $('.tab_content').find('li').eq(index).show().siblings().hide();
            })
        })

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