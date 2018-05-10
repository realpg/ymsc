@extends('home.layouts.base')
@section('content')
<div id="main-body">
    <div class="style-home-nav-station"></div>
    <div class="height-80"></div>
    @include('home.layouts.search')
    {{--<div class="border-top-attribute">--}}
        <div class="container">
            <div class="line-height-40 style-ellipsis-1 border-bottom-attribute">
                <span class="padding-right-10 border-right-attribute height-14">栏目</span>
                <a href="{{URL::asset('index/search')}}?search={{$search}}">
                    <span class="margin-right-10 margin-left-10 padding-right-10 padding-left-10 radius-20 text-white background-navy-blue">全部</span>
                </a>
                @foreach($menus as $menu)
                    <a href="{{URL::asset('index/search')}}?search={{$search}}&menu_id={{$menu['id']}}">
                        @if($menu['id']==$menu_id)
                            <span class="margin-right-10 text-red">{{$menu['name']}}</span>
                        @else
                            <span class="margin-right-10">{{$menu['name']}}</span>
                        @endif
                    </a>
                @endforeach
            </div>
        </div>
    {{--</div>--}}
    <div class="container margin-bottom-20" id="goods_lists">
        <div class="row goods-lists-card margin-bottom-20 margin-top-10 letter-spacing-2">
            @foreach($goodses as $goods)
                <div class="col-xs-12 col-sm-3 padding-top-10 padding-right-10 padding-left-10">
                    @if($goods['column_id']==1)
                        <a href="{{URL::asset($goods['column_code'].'/classlists/'.$goods['chem_class_id'])}}">
                    @elseif($goods['column_id']==2)
                        <a href="{{URL::asset($goods['column_code'].'/detail/'.$goods['id'])}}">
                    @elseif($goods['column_id']==3)
                        @if($goods['type']==0)
                            <a href="{{URL::asset($goods['column_code'].'/detail/machining/'.$goods['id'])}}">
                        @elseif($goods['type']==1)
                            <a href="{{URL::asset($goods['column_code'].'/detail/standard/'.$goods['id'])}}">
                        @endif
                    @endif
                            <div class="text-center padding-bottom-10 padding-right-10 padding-left-10 border-box">
                                <h3 class="style-ellipsis-1">{{$goods['name']}}</h3>
                                <div class="goods-lists-picture">
                                    <img class="img-circle" src="{{$goods['picture']}}" alt="{{$goods['name']}}">
                                </div>
                                <h4 class="style-ellipsis-1 margin-top-20">{{$goods['column']['name']}} / {{$goods['menu_name']}}</h4>
                                <button type="button" class="btn btn-info margin-top-10 margin-bottom-10">查 看 详 情</button>
                            </div>
                        </a>
                </div>
            @endforeach
            <div class="clear"></div>
            @if(count($goodses)==0)
                <div class="margin-top-20 margin-right-10 margin-left-10 text-center">
                    <img src="{{ URL::asset('img/nothing.png') }}"  />
                </div>
                <div class="margin-top-20 text-center index-font">
                    此栏目下没有您要找的商品！
                </div>
            @else
                <div class="common-text-align-center margin-top-20">
                    @if($menu_id)
                        {!! $goodses->appends(['search' => $search,'menu_id'=>$menu_id])->links() !!}
                    @else
                        {!! $goodses->appends(['search' => $search])->links() !!}
                    @endif
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
    </script>
@endsection