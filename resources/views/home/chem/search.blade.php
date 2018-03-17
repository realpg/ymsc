@extends('home.layouts.base')
@section('seo')
    <title>{{$channel['seo_title']?$channel['seo_title']:$common['base']['seo_title']}}</title>
    <meta name="keywords" content="{{$channel['seo_keywords']?$channel['seo_keywords']:$common['base']['seo_keywords']}}" />
    <meta name="description" content="{{$channel['seo_description']?$channel['seo_description']:$common['base']['seo_description']}}" />
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
                    <div class="table-responsive">
                        <table class="table border-0">
                            <tr class="line-height-40 border-bottom-navy-blue row common-text-align-center">
                                <td class="background-navy-blue text-white" style="border-top:0;">货 号</td>
                                <td style="border-top:0;">品 牌</td>
                                <td style="border-top:0;">纯 度</td>
                                <td style="border-top:0;">规 格</td>
                                <td style="border-top:0;">货 期</td>
                                <td style="border-top:0;">优 迈 价</td>
                                <td style="border-top:0;">操 作</td>
                            </tr>
                            @foreach($goods['goodses'] as $goods['goods'])
                                <tr class="line-height-40 border-bottom-attribute row common-text-align-center">
                                    <td style="border-top:0;">
                                        <a href="{{URL::asset($column.'/detail/'.$goods['goods']['goods_id'])}}">
                                        {{$goods['goods']['number']}}
                                        </a>
                                    </td>
                                    <td style="border-top:0;">
                                        <a href="{{URL::asset($column.'/detail/'.$goods['goods']['goods_id'])}}">
                                        {{$goods['goods']['f_attribute']}}
                                        </a>
                                    </td>
                                    <td style="border-top:0;">{{$goods['goods']['s_attribute']}}</td>
                                    <td style="border-top:0;">{{$goods['goods']['spec']}}</td>
                                    <td style="border-top:0;">{{$goods['goods']['delivery']}}</td>
                                    <td style="border-top:0;">￥{{$goods['goods']['price']/100}}/{{$goods['goods']['unit']}}</td>
                                    <td style="border-top:0;">
                                        <a href="{{URL::asset($column.'/detail/'.$goods['goods']['goods_id'])}}">
                                            详 情
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </table>
                    </div>
                    @if(count($goods['goodses'])==7)
                        <a href="{{URL::asset($column.'/classlists/'.$goods['id'])}}">
                            <div onclik="show_goods_lists()" class="line-height-30 row common-text-align-center background-detail" style="margin-top:-5px;">
                                加载更多
                            </div>
                        </a>
                    @endif
                </div>
                <div class="clear"></div>
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