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
    @include('home.layouts.attribute')
    <div class="container margin-bottom-20" id="goods_lists">
        <div class="row goods-lists-card margin-bottom-20 margin-top-10 letter-spacing-2">
            @foreach($goodses as $goods)
                <div class="col-xs-12 col-sm-3 padding-10">
                    <a href="{{URL::asset($column.'/detail/'.$goods['id'])}}">
                        <div class="text-center padding-bottom-10 padding-right-10 padding-left-10 border-box">
                            <h3 class="style-ellipsis-2 font-size-20 line-height-25 height-50">{{$goods['name']}}</h3>
                            <div class="goods-lists-picture">
                                <img class="img-circle" src="{{$goods['picture']}}" alt="{{$goods['name']}}">
                            </div>
                            <button type="button" class="btn btn-info margin-top-10 margin-bottom-10">立 即 咨 询</button>
                            @if($goods['goods_attribute']['lab'])
                                <h4 class="style-ellipsis-1">实验室：{{$goods['goods_attribute']['lab']}}</h4>
                            @else
                                <h4 class="style-ellipsis-1">&nbsp;</h4>
                            @endif
                            <h4 class="style-ellipsis-1">应用领域：{{$goods['f_attribute']['name']}}</h4>
                        </div>
                    </a>
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
            <div class="common-text-align-center">
                {!! $goodses->links() !!}
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')

@endsection