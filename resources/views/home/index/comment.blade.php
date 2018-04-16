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
            <div class="container line-height-40">
                <div class="float-left">
                    <a href="{{URL::asset('/')}}">商城</a> >
                    @if($goods['goods_menu']['menu_id']==1)
                        <a href="{{URL::asset($goods['goods_column'].'/detail/'.$goods['id'])}}">
                    @elseif($goods['goods_menu']['menu_id']==2)
                        <a href="{{URL::asset($goods['goods_column'].'/detail/'.$goods['id'])}}">
                    @elseif($goods['goods_menu']['menu_id']==3)
                        @if($goods['goods_type']==0)
                            <a href="{{URL::asset($goods['goods_column'].'/detail/machining/'.$goods['id'])}}">
                        @else
                            <a href="{{URL::asset($goods['goods_column'].'/detail/standard/'.$goods['id'])}}">
                        @endif
                    @endif
                        {{$goods['name']}}
                    </a>
                    >评价
                </div>
                <div class="float-right common-text-align-right">
                    <a href="javascript:history.go(-1)">
                        <span class="text-blue">返 回</span>
                    </a>
                </div>
            </div>
        </div>
        <div class="container">
            @if(count($comments)>0)
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
                <div class="common-text-align-center">
                    {!! $comments->links() !!}
                </div>
            @else
                <div class="margin-top-20 margin-right-10 margin-left-10 text-center">
                    <img src="{{ URL::asset('img/nothing.png') }}"  />
                </div>
                <div class="margin-top-20 text-center index-font">
                    还没有人对此商品进行评价!
                </div>
            @endif
        </div>
    </div>
@endsection

@section('script')
<script>
</script>
@endsection