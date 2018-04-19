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
    @include('home.layouts.attribute')
    <div class="container margin-bottom-20" id="goods_lists">
        <div class="row goods-lists-card margin-bottom-20 margin-top-10 letter-spacing-2">
            @foreach($goodses as $goods)
                @if($goods['type']==0)
                    <div class="col-xs-12 col-sm-3 padding-top-10 padding-right-10 padding-left-10">
                        <a href="{{URL::asset($column.'/detail/machining/'.$goods['id'])}}">
                            <div class="text-center padding-bottom-10 padding-right-10 padding-left-10 border-box padding-top-10">
                                <div class="goods-lists-picture margin-top-10">
                                    <img class="img-circle" src="{{$goods['picture']}}" alt="{{$goods['name']}}">
                                </div>
                                <h3 class="style-ellipsis-1 font-size-20 line-height-25">{{$goods['name']}}</h3>
                                @if($goods['goods_attribute']['accuracy'])
                                    <h5 class="style-ellipsis-1">精度：{{$goods['goods_attribute']['accuracy']}}</h5>
                                @else
                                    <h5 class="style-ellipsis-1">精度暂无</h5>
                                @endif
                                <a href="tencent://message/?Menu=yes&uin={{$service['qq']}}&Service=300&sigT=45a1e5847943b64c6ff3990f8a9e644d2b31356cb0b4ac6b24663a3c8dd0f8aa12a595b1714f9d45">
                                <button type="button" class="btn btn-default margin-top-10 margin-bottom-10 background-none">立 即 咨 询</button>
                                </a>
                            </div>
                        </a>
                    </div>
                @else
                    <div class="col-xs-12 col-sm-3 padding-top-10 padding-right-10 padding-left-10">
                        <a href="{{URL::asset($column.'/detail/standard/'.$goods['id'])}}">
                            <div class="text-center padding-bottom-10 padding-right-10 padding-left-10 border-box padding-top-10">
                                <div class="goods-lists-picture">
                                    <img class="img-circle" src="{{$goods['picture']}}" alt="{{$goods['name']}}">
                                </div>
                                @if($goods['goods_attribute']['size'])
                                    <h3 class="style-ellipsis-1 font-size-20 line-height-25">尺寸：{{$goods['goods_attribute']['size']}}</h3>
                                @else
                                    <h3 class="style-ellipsis-1 font-size-20 line-height-25">尺寸暂无</h3>
                                @endif
                                <h5 class="style-ellipsis-1">{{$goods['name']}}</h5>
                                <button type="button" class="btn btn-default margin-top-10 margin-bottom-10 background-none text-red">￥{{$goods['price']/100}}&nbsp;/{{$goods['unit']}}</button>
                            </div>
                        </a>
                    </div>
                @endif
            @endforeach
            <div class="clear"></div>
            @if(count($goodses)==0)
                <div class="margin-top-20 margin-right-10 margin-left-10 text-center">
                    <img src="{{ URL::asset('img/nothing.png') }}"  />
                </div>
                <div class="margin-top-20 text-center index-font">
                    没有您要找的商品！
                </div>
            @else
                <div class="common-text-align-center margin-top-20">
                    {!! $goodses->links() !!}
                </div>
            @endif
        </div>
    </div>
</div>
@endsection

@section('script')

@endsection