@extends('home.layouts.base')
@section('seo')
    <title>{{$channel['seo_title']}}</title>
    <meta name="keywords" content="{{$channel['seo_keywords']}}" />
    <meta name="description" content="{{$channel['seo_description']}}" />
@endsection
@section('content')
<div id="main-body">
    <div class="style-home-nav-station"></div>
    @include('home.layouts.search')
    @include('home.layouts.characteristic')
    <div class="container margin-bottom-20" id="goods_lists">
        <div class="row goods-lists-card margin-bottom-20 margin-top-10 letter-spacing-2">
            @foreach($goodses as $goods)
                <div class="col-xs-12 col-sm-3 padding-10">
                    <a href="{{URL::asset($column.'/classlists/'.$goods['id'])}}">
                        <div class="text-center padding-bottom-10 padding-right-10 padding-left-10 border-box">
                            <h3 class="style-ellipsis-1">{{$goods['name']}}</h3>
                            <h4 class="style-ellipsis-1">{{$goods['english_name']}}</h4>
                            <div class="goods-lists-picture">
                                <img class="img-circle" src="{{$goods['picture']}}" alt="{{$goods['name']}}">
                            </div>
                            <h4 class="style-ellipsis-1">CAS号：{{$goods['cas']}}</h4>
                            <h4 class="style-ellipsis-1">分子式：{{$goods['molecule']}}</h4>
                        </div>
                    </a>
                </div>
                <div class="col-xs-12 col-sm-9 padding-10" style="min-height: 365px;">
                    <div class="line-height-40 border-bottom-navy-blue row common-text-align-center">
                        <div class="col-xs-2 col-sm-2 background-navy-blue text-white">货 号</div>
                        <div class="col-xs-2 col-sm-2">品 牌</div>
                        <div class="col-xs-2 col-sm-2">纯 度</div>
                        <div class="col-xs-2 col-sm-2">规 格</div>
                        <div class="col-xs-1 col-sm-1">货 期</div>
                        <div class="col-xs-2 col-sm-2">优 迈 价</div>
                        <div class="col-xs-1 col-sm-1">操 作</div>
                    </div>
                    @foreach($goods['goodses'] as $goods['goods'])
                        <div class="line-height-40 border-bottom-attribute row common-text-align-center">
                            <div class="col-xs-2 col-sm-2">{{$goods['goods']['number']}}</div>
                            <div class="col-xs-2 col-sm-2">{{$goods['goods']['f_attribute']}}</div>
                            <div class="col-xs-2 col-sm-2">{{$goods['goods']['s_attribute']}}</div>
                            <div class="col-xs-2 col-sm-2">{{$goods['goods']['spec']}}</div>
                            <div class="col-xs-1 col-sm-1">{{$goods['goods']['delivery']}}</div>
                            <div class="col-xs-2 col-sm-2 text-red">￥{{$goods['goods']['price']/100}}/{{$goods['goods']['unit']}}</div>
                            <div class="col-xs-1 col-sm-1">详 情</div>
                        </div>
                    @endforeach
                    @if(count($goods['goodses'])>6)
                        <a href="{{URL::asset($column.'/classlists/'.$goods['id'])}}">
                            <div onclik="show_goods_lists()" class="line-height-30 row common-text-align-center margin-top-10 background-navy-blue text-white" style="margin-top:23px;">
                                加载更多
                            </div>
                        </a>
                    @endif
                </div>
            @endforeach
            @if(count($goodses)==0)
                <div class="margin-top-20 margin-right-10 margin-left-10 text-center">
                    <img src="{{ URL::asset('img/nothing.png') }}"  />
                </div>
                <div class="margin-top-20 text-center index-font">
                    没有您要找的商品！
                </div>
            @endif
            <div class="clear"></div>
        </div>
    </div>
</div>
@endsection

@section('script')

@endsection