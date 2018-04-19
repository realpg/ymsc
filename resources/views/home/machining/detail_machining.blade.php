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
        <div class="container line-height-40 style-ellipsis-1">
            <a href="{{URL::asset('/')}}">商城</a> > <a href="{{URL::asset($column)}}">{{$channel['parent_channel']['name']}}</a> >  <a href="{{URL::asset($column.'/lists/'.$goods['menu_id'])}}">{{$channel['name']}}</a> >{{$goods['name']}}
        </div>
    </div>
    <div class="container margin-bottom-20" id="goods_lists">
        <div class="row goods-lists-card margin-bottom-20 margin-top-10 letter-spacing-2 border-div min-height-content" style="min-height: 300px;">
            <div class="col-md-12 col-lg-4 padding-10">
                <div class="text-center margin-right-10 padding-bottom-10 padding-right-10 padding-left-10">
                    <div class="goods-lists-picture padding-top-40" style="width:100%;height:100%;">
                        <img class="img-circle" src="{{$goods['picture']}}" alt="{{$goods['name']}}">
                    </div>
                </div>
            </div>
            <div class="col-md-12 col-lg-8 padding-10">
                <h3 class="style-ellipsis-1 line-height-30">设备：{{$goods['name']}}</h3>
                <h4 class="style-ellipsis-1 line-height-30">商品货号：{{$goods['number']}}</h4>
                <h4 class="style-ellipsis-1 line-height-30">精度：{{$goods['attribute']['accuracy']?$goods['attribute']['accuracy']:'未设置'}}</h4>
                <h4 class="style-ellipsis-1 line-height-30">服务商：{{$goods['attribute']['service']?$goods['attribute']['service']:'未设置'}}</h4>
                <h4 class="style-ellipsis-1 line-height-30">产品材料：{{$goods['attribute']['material']?$goods['attribute']['material']:'未设置'}}</h4>
                <div class="row margin-top-20 margin-bottom-20">
                    <div class="col-md-6 col-lg-3">
                        <a href="tencent://message/?Menu=yes&uin={{$service['qq']}}&Service=300&sigT=45a1e5847943b64c6ff3990f8a9e644d2b31356cb0b4ac6b24663a3c8dd0f8aa12a595b1714f9d45">
                        <button type="button" class="btn btn-default width-100 border-radius-0 background-none">立 即 咨 询</button>
                        </a>
                    </div>
                </div>
            </div>
            <div class="clear"></div>
        </div>
        <ul class="line-height-40 border-bottom-navy-blue row common-text-align-center" id="tab">
            <li class="tab_active col-md-12 col-lg-2 background-detail">案 例 展 示</li>
            <li class="col-md-12 col-lg-2 background-detail">设 备 详 情</li>
            <li class="col-md-12 col-lg-2 background-detail">客 户 评 价</li>
            <li class="col-md-12 col-lg-2 background-detail">开 发 和 收 费 情 况</li>
        </ul>
        <ul class="tab_content">
            <li style="display: block;">

                @if(count($goods['cases'])==0)
                    <div class="margin-top-20 margin-right-10 margin-left-10 text-center">
                        <img src="{{ URL::asset('img/nothing.png') }}"  />
                    </div>
                    <div class="margin-top-20 text-center index-font">
                        商家太懒了，没有上传此加工类型的案例，详细信息请咨询客服
                    </div>
                @else
                    <div class="row">
                        @foreach($goods['cases'] as $goods['case'])
                            <div class="col-md-6 col-lg-3">
                                <img src="{{$goods['case']['content']}}" class="width-250 height-200" />
                                <p class="common-text-align-center width-250">{{$goods['case']['name']}}</p>
                            </div>
                        @endforeach
                    </div>
                @endif
            </li>
            <li>
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
                @if(count($comments)==0)
                    <div class="margin-top-20 margin-right-10 margin-left-10 text-center">
                        <img src="{{ URL::asset('img/nothing.png') }}"  />
                    </div>
                    <div class="margin-top-20 text-center index-font">
                        还没有人对此商品进行评价!
                    </div>
                @else
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
                    @if(count($comments)>=20)
                        <a href="{{URL::asset('comment/'.$goods['id'])}}">
                            <div class="line-height-30 row common-text-align-center background-detail">
                                查看更多
                            </div>
                        </a>
                    @endif
                @endif
                <div class="border-top-attribute row padding-top-20 margin-top-20">
                    <textarea name="content" id="content" class="form-control" rows="3" style="resize: none;" placeholder="请对此商品添加评价"></textarea>
                    <div class="margin-top-10">
                        <button type="button" onclick="submitComment(this,'{{$goods['id']}}')" class="btn btn-info border-radius-0 float-right">提 交 评 价</button>
                    </div>
                </div>
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
    //提交评论
    function submitComment(obj,goods_id){
        var content=$('#content').val()
        if(content){
            var param = {
                goods_id: goods_id,
                content: content,
                _token: "{{ csrf_token() }}"
            }
            editComment('{{URL::asset('')}}', param, function (ret) {
                console.log('editComment is : '+JSON.stringify(ret))
                if (ret.result == true) {
                    $('#content').val('')
                    layer.msg(ret.msg, {icon: 1, time: 3000});
                } else {
                    layer.msg(ret.msg, {icon: 2, time: 3000})
                }
            })
        }
        else{
            layer.msg('请对商品进行评价', {icon: 2, time: 1000})
        }
    }
</script>
@endsection