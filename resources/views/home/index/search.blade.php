@extends('home.layouts.base')
@section('content')
<div id="main-body">
    <div class="style-home-nav-station"></div>
    <div class="height-80"></div>
    @include('home.layouts.search')
    <div class="container margin-bottom-20" id="goods_lists">
        <ul class="line-height-40 border-bottom-navy-blue row common-text-align-center" id="tab">
            @foreach($goodses as $k=>$goods)
                @if($k==0)
                    <li class="tab_active col-xs-12 col-sm-2 background-detail ">{{$goods['menu']['name']}}</li>
                @else
                    <li class="col-xs-12 col-sm-2 background-detail">{{$goods['menu']['name']}}</li>
                @endif
            @endforeach
        </ul>
        <ul class="tab_content">
            @foreach($goodses as $k=>$goods)
                @if($k==0)
                    <li style="display: block;">
                @else
                    <li>
                @endif
                        <div class="row goods-lists-card margin-bottom-20 margin-top-10 letter-spacing-2">
                            @if(isset($goods))
                                @foreach($goods['goodses'] as $goods_info)
                                    <div class="col-xs-12 col-sm-3 padding-top-10 padding-right-10 padding-left-10">
                                        @if($goods['column_id']==1)
                                            <a href="{{URL::asset($goods['column'].'/classlists/'.$goods_info['chem_class_id'])}}">
                                                <div class="text-center padding-bottom-10 padding-right-10 padding-left-10 border-box">
                                                    <h3 class="style-ellipsis-1">{{$goods_info['name']}}</h3>
                                                    <div class="goods-lists-picture">
                                                        <img class="img-circle" src="{{$goods_info['picture']}}" alt="{{$goods_info['name']}}">
                                                    </div>
                                                    <h4 class="style-ellipsis-1">CAS号：{{$goods_info['cas']}}</h4>
                                                    <h4 class="style-ellipsis-1">分子式：{{$goods_info['molecule']}}</h4>
                                                </div>
                                            </a>
                                        @elseif($goods['column_id']==2)
                                            <a href="{{URL::asset($goods['column'].'/detail/'.$goods_info['id'])}}">
                                                <div class="text-center padding-bottom-10 padding-right-10 padding-left-10 border-box">
                                                    <h3 class="style-ellipsis-2 font-size-20 line-height-25 height-50">{{$goods_info['name']}}</h3>
                                                    <div class="goods-lists-picture margin-bottom-10">
                                                        <img class="img-circle" src="{{$goods_info['picture']}}" alt="{{$goods_info['name']}}">
                                                    </div>
                                                    <button type="button" class="btn btn-info margin-top-20 margin-bottom-10">查 看 详 情</button>
                                                </div>
                                            </a>
                                        @elseif($goods['column_id']==3)
                                            @if($goods_info['type']==0)
                                                <a href="{{URL::asset($goods['column'].'/detail/machining/'.$goods_info['id'])}}">
                                            @elseif($goods_info['type']==1)
                                                <a href="{{URL::asset($goods['column'].'/detail/standard/'.$goods_info['id'])}}">
                                            @endif
                                                <div class="text-center padding-bottom-10 padding-right-10 padding-left-10 border-box">
                                                    <h3 class="style-ellipsis-2 font-size-20 line-height-25 height-50">{{$goods_info['name']}}</h3>
                                                    <div class="goods-lists-picture margin-bottom-10">
                                                        <img class="img-circle" src="{{$goods_info['picture']}}" alt="{{$goods_info['name']}}">
                                                    </div>
                                                    <button type="button" class="btn btn-info margin-top-20 margin-bottom-10">查 看 详 情</button>
                                                </div>
                                            </a>
                                        @endif
                                    </div>
                                @endforeach
                                <div class="clear"></div>
                            @endif
                            @if(count($goods['goodses'])==0)
                                <div class="margin-top-20 margin-right-10 margin-left-10 text-center">
                                    <img src="{{ URL::asset('img/nothing.png') }}"  />
                                </div>
                                <div class="margin-top-20 text-center index-font">
                                    此栏目下没有您要找的商品！
                                </div>
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