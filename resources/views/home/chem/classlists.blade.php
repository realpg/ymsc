@extends('home.layouts.base')
@section('seo')
    <title>{{$class['seo_title']?$class['seo_title']:$common['base']['seo_title']}}</title>
    <meta name="keywords" content="{{$class['seo_keywords']?$class['seo_keywords']:$common['base']['seo_keywords']}}" />
    <meta name="description" content="{{$class['seo_description']?$class['seo_description']:$common['base']['seo_description']}}" />
@endsection
@section('content')
<div id="main-body">
    <div class="style-home-nav-station"></div>
    <div class="height-80"></div>
    @include('home.layouts.search')
    <div class="border-bottom-attribute">
        <div class="container line-height-40 style-ellipsis-1">
            <a href="{{URL::asset('/')}}">商城</a> > <a href="{{URL::asset($column)}}">{{$channel['name']}}</a> > {{$chem_class['name']}}
        </div>
    </div>
    <div class="container margin-bottom-20" id="goods_lists">
        <div class="row goods-lists-card margin-bottom-20 margin-top-10 letter-spacing-2">
            <div class="col-xs-12 col-sm-3 padding-10">
                <div class="text-center margin-right-10 padding-bottom-10 padding-right-10 padding-left-10 border-div">
                    <h3 class="style-ellipsis-1">{{$chem_class['name']}}</h3>
                    {{--<h4 class="style-ellipsis-1">{{$chem_class['english_name']}}</h4>--}}
                    <div class="goods-lists-picture">
                        <img class="img-circle" src="{{$chem_class['picture']}}" alt="{{$chem_class['name']}}">
                    </div>
                    <h4 class="style-ellipsis-1">CAS号：{{$chem_class['cas']?$chem_class['cas']:'暂无'}}</h4>
                    <h4 class="style-ellipsis-1">分子式：{!! $chem_class['molecule'] !!}</h4>
                </div>
            </div>
            <div class="col-xs-12 col-sm-9 padding-10 min-height-content">
                <div class="margin-bottom-10">
                    @foreach($attributes as $k=>$attribute)
                        <div class="line-height-40 border-bottom-attribute style-ellipsis-1">
                            <span class="padding-right-10 border-right-attribute height-14">{{$attribute['name']}} </span>
                            @if($k==0)
                                @if($s_attribute_id)
                                <a href="{{URL::asset($column.'/classlists/'.$chem_class['id'].'/f/0/s/'.$s_attribute_id)}}" >
                                @else
                                    <a href="{{URL::asset($column.'/classlists/'.$chem_class['id'])}}" >
                                @endif
                            @else
                                @if($f_attribute_id)
                                    <a href="{{URL::asset($column.'/classlists/'.$chem_class['id'].'/f/'.$f_attribute_id.'/s/0')}}" >
                                @else
                                    <a href="{{URL::asset($column.'/classlists/'.$chem_class['id'])}}" >
                                @endif
                            @endif
                                        <span class="margin-right-10 margin-left-10 padding-right-10 padding-left-10 radius-20 text-white background-navy-blue">全部</span>
                                    </a>
                            @foreach($attribute['attributes'] as $attribute['attribute'])
                                @if($k==0)
                                    @if($s_attribute_id)
                                        <a href="{{URL::asset($column.'/classlists/'.$chem_class['id'].'/f/'.$attribute['attribute']['id'].'/s/'.$s_attribute_id)}}" >
                                    @else
                                        <a href="{{URL::asset($column.'/classlists/'.$chem_class['id'].'/f/'.$attribute['attribute']['id'].'/s/0')}}" >
                                    @endif
                                @else
                                    @if($f_attribute_id)
                                        <a href="{{URL::asset($column.'/classlists/'.$chem_class['id'].'/f/'.$f_attribute_id.'/s/'.$attribute['attribute']['id'])}}" >
                                    @else
                                        <a href="{{URL::asset($column.'/classlists/'.$chem_class['id'].'/f/0/s/'.$attribute['attribute']['id'])}}" >
                                    @endif
                                @endif
                                            @if($attribute['attribute']['id']==$f_attribute_id||$attribute['attribute']['id']==$s_attribute_id)
                                                <span class="margin-right-10 text-red">{{$attribute['attribute']['name']}}</span>
                                            @else
                                                <span class="margin-right-10">{{$attribute['attribute']['name']}}</span>
                                            @endif
                                        </a>
                            @endforeach
                        </div>
                    @endforeach
                </div>
                <div class="table-responsive">
                    <table class="table border-0">
                        <tr>
                            <th class="background-navy-blue text-white text-center line-height-40 border-bottom-navy-blue" style="border-top:0;">货 号</th>
                            <th class=" text-center line-height-40 border-bottom-navy-blue" style="border-top:0;">品 牌</th>
                            <th class=" text-center line-height-40 border-bottom-navy-blue" style="border-top:0;">纯 度</th>
                            <th class=" text-center line-height-40 border-bottom-navy-blue" style="border-top:0;">规 格</th>
                            <th class=" text-center line-height-40 border-bottom-navy-blue" style="border-top:0;">货 期</th>
                            <th class=" text-center line-height-40 border-bottom-navy-blue" style="border-top:0;">优 迈 价</th>
                            <th class=" text-center line-height-40 border-bottom-navy-blue" style="border-top:0;">操 作</th>
                        </tr>
                        @foreach($chem_class['goodses'] as $chem_class['goods'])
                            <tr>
                                <td class="line-height-40 border-bottom-attribute text-center">
                                    <a href="{{URL::asset($column.'/detail/'.$chem_class['goods']['goods_id'])}}">
                                    {{$chem_class['goods']['number']}}
                                    </a>
                                </td>
                                <td class="line-height-40 border-bottom-attribute text-center">
                                    <a href="{{URL::asset($column.'/detail/'.$chem_class['goods']['goods_id'])}}">
                                    {{$chem_class['goods']['f_attribute']}}
                                    </a>
                                </td>
                                <td class="line-height-40 border-bottom-attribute text-center">{{$chem_class['goods']['s_attribute']}}</td>
                                <td class="line-height-40 border-bottom-attribute text-center">{{$chem_class['goods']['spec']}}</td>
                                <td class="line-height-40 border-bottom-attribute text-center">{{$chem_class['goods']['delivery']}}</td>
                                <td class="line-height-40 border-bottom-attribute text-center text-red">￥{{$chem_class['goods']['price']/100}}/{{$chem_class['goods']['unit']}}</td>
                                <td class="line-height-40 border-bottom-attribute text-center">
                                    <a href="{{URL::asset($column.'/detail/'.$chem_class['goods']['goods_id'])}}">
                                    详 情
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </table>
                </div>

                @if(count($chem_class['goodses'])==0)
                    <div class="margin-top-20 margin-right-10 margin-left-10 text-center">
                        <img src="{{ URL::asset('img/nothing.png') }}"  />
                    </div>
                    <div class="margin-top-20 text-center index-font">
                        没有您要找的商品！
                    </div>
                @endif
                <div class="common-text-align-center">
                    {!! $chem_class['goodses']->links() !!}
                </div>
            </div>
            <div class="clear"></div>
        </div>
    </div>
</div>
@endsection

@section('script')

@endsection