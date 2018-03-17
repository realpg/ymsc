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
            <a href="{{URL::asset('/')}}">商城</a> > <a href="{{URL::asset($column)}}">{{$channel['parent_channel']['name']}}</a> >  <a href="{{URL::asset($column.'/lists/'.$goods['menu_id'])}}">{{$channel['name']}}</a> >{{$goods['name']}}
        </div>
    </div>
    <div class="container margin-bottom-20" id="goods_lists">
        <div class="row goods-lists-card margin-bottom-20 margin-top-10 letter-spacing-2 border-div min-height-content">
            <div class="col-xs-12 col-sm-4 padding-10">
                <div class="text-center margin-right-10 padding-bottom-10 padding-right-10 padding-left-10">
                    <div class="goods-lists-picture padding-top-40" style="width:100%;height:100%;">
                        <img class="img-circle" src="{{$goods['picture']}}" alt="{{$goods['name']}}">
                    </div>
                </div>
            </div>
            <div class="col-xs-12 col-sm-8 padding-10">
                <h3 class="style-ellipsis-1 line-height-30">{{$goods['name']}}</h3>
                <h4 class="style-ellipsis-1 line-height-30">商品货号：{{$goods['number']}}</h4>
                <h4 class="style-ellipsis-1 line-height-30">实验室：{{$goods['attribute']['lab']}}</h4>
                <h4 class="style-ellipsis-1 line-height-30">
                    参考价格：<span class="text-red font-size-24">￥{{$goods['price']/100}} / {{$goods['unit']}}</span>
                </h4>
                <h4 class="style-ellipsis-1 line-height-30">
                    <div class="col-xs-6 col-sm-6 padding-0">应用领域：{{$goods['f_attribute']['name']}}</div>
                    <div class="col-xs-6 col-sm-6 padding-0">仪器分类：{{$goods['s_attribute']['name']}}</div>
                </h4>
                <h4 class="style-ellipsis-1 line-height-30">
                    <div class="col-xs-6 col-sm-6 padding-0">联系人：{{$goods['attribute']['contacts']}}</div>
                    <div class="col-xs-6 col-sm-6 padding-0">地域：{{$goods['attribute']['region']}}</div>
                </h4>
                {{--<h4 class="style-ellipsis-1 line-height-30">应用领域：{{$goods['f_attribute']['name']}}</h4>--}}
                {{--<h4 class="style-ellipsis-1 line-height-30">仪器分类：{{$goods['s_attribute']['name']}}</h4>--}}
                {{--<h4 class="style-ellipsis-1 line-height-30">联系人：{{$goods['attribute']['contacts']}}</h4>--}}
                {{--<h4 class="style-ellipsis-1 line-height-30">地域：{{$goods['attribute']['region']}}</h4>--}}
                <h4 class="style-ellipsis-1 line-height-30">地址：{{$goods['attribute']['address']}}</h4>
                <div class="row margin-top-10 margin-bottom-20">
                    <div class="col-xs-6 col-sm-3">
                        <button type="button" class="btn btn-info width-100 border-radius-0">立 即 咨 询</button>
                    </div>
                </div>
            </div>
            <div class="clear"></div>
        </div>
        <ul class="line-height-40 border-bottom-navy-blue row common-text-align-center" id="tab">
            <li class="tab_active col-xs-12 col-sm-2 background-detail ">设 备 详 情</li>
            <li class="col-xs-12 col-sm-2 background-detail">客 户 评 价</li>
            <li class="col-xs-12 col-sm-2 background-detail">开 发 和 收 费 情 况</li>
        </ul>
        <ul class="tab_content">
            <li style="display: block;">
                @foreach($goods['details'] as $goods['detail'])
                    @if($goods['detail']['type']==0)
                        <div>
                            {{$goods['detail']['content']}}
                        </div>
                    @elseif($goods['detail']['type']==1)
                        <div>
                            <img src="{{$goods['detail']['content']}}" style="width:100%;" />
                        </div>
                    @elseif($goods['detail']['type']==2)
                        <div>
                            <video src="{{$goods['detail']['content']}}" controls="controls" style="width:100%;">
                                您的浏览器不支持 video 标签。
                            </video>
                        </div>
                    @endif
                @endforeach
                @if(count($goods['details'])==0)
                    <div class="margin-top-20 margin-right-10 margin-left-10 text-center">
                        <img src="{{ URL::asset('img/nothing.png') }}"  />
                    </div>
                    <div class="margin-top-20 text-center index-font">
                        暂时没有此商品的描述
                    </div>
                @endif
            </li>
            <li>
                @if(empty($goods['comments']))
                    <div class="margin-top-20 margin-right-10 margin-left-10 text-center">
                        <img src="{{ URL::asset('img/nothing.png') }}"  />
                    </div>
                    <div class="margin-top-20 text-center index-font">
                        还没有人对此商品进行评价
                    </div>
                @endif
            </li>
            <li>
                @if($goods['attribute']['explain'])
                    {{$goods['attribute']['explain']}}
                @else
                    <div class="margin-top-20 margin-right-10 margin-left-10 text-center">
                        <img src="{{ URL::asset('img/nothing.png') }}"  />
                    </div>
                    <div class="margin-top-20 text-center index-font">
                        商家太懒了，没有设置此项，详细信息请咨询客服
                    </div>
                @endif
            </li>
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