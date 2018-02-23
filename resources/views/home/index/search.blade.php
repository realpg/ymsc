@extends('home.layouts.base')
@section('content')
<div id="main-body">
    <div class="style-home-nav-station"></div>
    @include('home.layouts.search')
    <div class="container margin-bottom-20" id="goods_lists">
        <ul class="line-height-40 border-bottom-navy-blue row common-text-align-center" id="tab">
            @foreach($menus as $k=>$menu)
                @if($k==0)
                    <li class="tab_active col-xs-12 col-sm-2 background-detail ">{{$menu['name']}}</li>
                @else
                    <li class="col-xs-12 col-sm-2 background-detail">{{$menu['name']}}</li>
                @endif
            @endforeach
        </ul>
        <ul class="tab_content">
            @foreach($menus as $k=>$menu)
                @if($k==0)
                    <li style="display: block;">
                @else
                    <li>
                @endif
                        <div class="row goods-lists-card margin-bottom-20 margin-top-10 letter-spacing-2">
                            @if(isset($goodses[$k]))
                                @foreach($goodses[$k]['goodses'] as $goods)
                                    <div class="col-xs-12 col-sm-3 padding-top-10 padding-right-10 padding-left-10">
                                        @if($goodses[$k]['column_id']==1)
                                            <a href="{{URL::asset($goodses[$k]['column'].'/classlists/'.$goods['id'])}}">
                                                <div class="text-center padding-bottom-10 padding-right-10 padding-left-10 border-box">
                                                    <h3 class="style-ellipsis-1">{{$goods['name']}}</h3>
                                                    <div class="goods-lists-picture">
                                                        <img class="img-circle" src="{{$goods['picture']}}" alt="{{$goods['name']}}">
                                                    </div>
                                                    <h4 class="style-ellipsis-1">CAS号：{{$goods['cas']}}</h4>
                                                    <h4 class="style-ellipsis-1">分子式：{{$goods['molecule']}}</h4>
                                                </div>
                                            </a>
                                        @else
                                            <a href="{{URL::asset($goodses[$k]['column'].'/detail/'.$goods['id'])}}">
                                                <div class="text-center padding-bottom-10 padding-right-10 padding-left-10 border-box">
                                                    <h3 class="style-ellipsis-2 font-size-20 line-height-25 height-50">{{$goods['name']}}</h3>
                                                    <div class="goods-lists-picture margin-bottom-10">
                                                        <img class="img-circle" src="{{$goods['picture']}}" alt="{{$goods['name']}}">
                                                    </div>
                                                    <button type="button" class="btn btn-info margin-top-20 margin-bottom-10">查 看 详 情</button>
                                                </div>
                                            </a>
                                        @endif
                                    </div>
                                @endforeach
                                <div class="clear"></div>
                                @if(count($goodses[$k])==0)
                                    <div class="margin-top-20 margin-right-10 margin-left-10 text-center">
                                        <img src="{{ URL::asset('img/nothing.png') }}"  />
                                    </div>
                                    <div class="margin-top-20 text-center index-font">
                                        没有您要找的商品！
                                    </div>
                                @endif
                            @endif
                        </div>
                    </li>
            @endforeach
        </ul>
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