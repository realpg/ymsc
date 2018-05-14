@extends('home.layouts.base')
@section('seo')
    <title>{{$channel['seo_title']?$channel['seo_title']:$common['base']['seo_title']}}</title>
    <meta name="keywords" content="{{$channel['seo_keywords']?$channel['seo_keywords']:$common['base']['seo_keywords']}}" />
    <meta name="description" content="{{$channel['seo_description']?$channel['seo_description']:$common['base']['seo_description']}}" />
@endsection
@section('content')
<div id="main-body">
    <div class="style-home-nav-station"></div>
    <div class="height-80"></div>
    @include('home.layouts.search')
    @include('home.layouts.banner')
    <div class="container margin-bottom-20" id="goods_lists">
        @foreach($menus as $menu)
            @if(count($menu['chem_classes'])>0)
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
                        <a href="{{URL::asset($column.'/lists/'.$menu['id'])}}">
                            更多
                        </a>
                    </span>
                </div>
            </div>
            <div class="clear"></div>
            <div class="row goods-lists-card margin-bottom-20 margin-top-10 letter-spacing-2">
                @foreach($menu['chem_classes'] as $chem_class)
                    <div class="col-xs-12 col-sm-3 padding-top-10 padding-right-10 padding-left-10">
                        <a href="{{URL::asset($column.'/classlists/'.$chem_class['id'])}}">
                            <div class="text-center padding-bottom-10 padding-right-10 padding-left-10 border-box">
                                <h3 class="style-ellipsis-1">{{$chem_class['name']}}</h3>
                                <h4 class="style-ellipsis-1">{{$chem_class['english_name']}}</h4>
                                <div class="goods-lists-picture">
                                    <img class="img-circle" src="{{$chem_class['picture']}}" alt="{{$chem_class['name']}}">
                                </div>
                                @if($chem_class['cas'])
                                <h4 class="style-ellipsis-1">CAS号：{{$chem_class['cas']?$chem_class['cas']:'暂无'}}</h4>
                                @else
                                <h4 class="style-ellipsis-1">&nbsp;</h4>
                                @endif
                                @if($chem_class['molecule'])
                                <h4 class="style-ellipsis-1">分子式：{!! $chem_class['molecule'] !!}</h4>
                                @else
                                <h4 class="style-ellipsis-1">&nbsp;</h4>
                                @endif
                            </div>
                        </a>
                    </div>
                @endforeach
            </div>
            @endif
        @endforeach
    </div>
</div>
@endsection

@section('script')

@endsection