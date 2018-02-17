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
    @include('home.layouts.banner')
    <div class="container margin-bottom-20" id="goods_lists">
        @foreach($menus as $menu)
            <div class="margin-top-10 line-height-30">
                <div class="col-xs-6 col-sm-8 padding-left-0 letter-spacing-2">
                    <span class="font-size-18 border-bottom-title">
                        {{$menu['name']}}
                    </span>
                </div>
                <div class="col-xs-6 col-sm-4 text-right">
                    <span class="text-red margin-right-10">
                        热销
                    </span>
                    <span>
                        <a href="">
                            更多
                        </a>
                    </span>
                </div>
            </div>
            <div class="clear"></div>
            <div class="row goods-lists-card margin-bottom-20 margin-top-10 letter-spacing-2">
                @foreach($menu['machining_goodses'] as $machining_goods)
                    @if($machining_goods['type']==0)
                        <div class="col-xs-12 col-sm-3 padding-top-10 padding-right-10 padding-left-10">
                            <a href="">
                                <div class="text-center padding-bottom-10 padding-right-10 padding-left-10 border-box padding-top-10">
                                    <div class="goods-lists-picture margin-top-10">
                                        <img class="img-circle" src="{{$machining_goods['picture']}}" alt="{{$machining_goods['name']}}">
                                    </div>
                                    <h3 class="style-ellipsis-1 font-size-20 line-height-25">{{$machining_goods['name']}}</h3>
                                    @if($machining_goods['goods_attribute']['accuracy'])
                                        <h5 class="style-ellipsis-1">精度：{{$machining_goods['goods_attribute']['accuracy']}}</h5>
                                    @else
                                        <h5 class="style-ellipsis-1">精度暂无</h5>
                                    @endif
                                    <button type="button" class="btn btn-default margin-top-10 margin-bottom-10 background-none">立 即 咨 询</button>
                                </div>
                            </a>
                        </div>
                    @else
                        <div class="col-xs-12 col-sm-3 padding-top-10 padding-right-10 padding-left-10">
                            <a href="">
                                <div class="text-center padding-bottom-10 padding-right-10 padding-left-10 border-box padding-top-10">
                                    <div class="goods-lists-picture">
                                        <img class="img-circle" src="{{$machining_goods['picture']}}" alt="{{$machining_goods['name']}}">
                                    </div>
                                    @if($machining_goods['goods_attribute']['size'])
                                        <h3 class="style-ellipsis-1 font-size-20 line-height-25">尺寸：{{$machining_goods['goods_attribute']['size']}}</h3>
                                    @else
                                        <h3 class="style-ellipsis-1 font-size-20 line-height-25">尺寸暂无</h3>
                                    @endif
                                    <h5 class="style-ellipsis-1">{{$machining_goods['name']}}</h5>
                                    <button type="button" class="btn btn-default margin-top-10 margin-bottom-10 background-none text-red">￥{{$machining_goods['price']/100}}&nbsp;/{{$machining_goods['unit']}}</button>
                                </div>
                            </a>
                        </div>
                    @endif
                @endforeach
            </div>
        @endforeach
    </div>
</div>
@endsection

@section('script')

@endsection