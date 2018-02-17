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
    @include('home.layouts.attribute')
    <div class="container margin-bottom-20" id="goods_lists">
        <div class="row goods-lists-card margin-bottom-20 margin-top-10 letter-spacing-2">
            @foreach($goodses as $goods)
                <div class="col-xs-12 col-sm-3 padding-10">
                    <a href="">
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
            @endforeach
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