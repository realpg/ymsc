<!DOCTYPE HTML>
<html>
<head>
    <meta charset="utf-8">
    <meta name="renderer" content="webkit|ie-comp|ie-stand">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport"
          content="width=device-width,initial-scale=1,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no"/>
    <meta http-equiv="Cache-Control" content="no-siteapp"/>
    <link rel="Bookmark" href="{{ URL::asset('img/favor.ico') }}">
    <link rel="Shortcut Icon" href="{{ URL::asset('img/favor.ico') }}"/>
    <!--[if lt IE 9]>
    <script type="text/javascript" src="{{ URL::asset('dist/lib/html5shiv.js') }}"></script>
    <script type="text/javascript" src="{{ URL::asset('dist/lib/respond.min.js') }}"></script>
    <![endif]-->
    <link rel="stylesheet" type="text/css" href="{{ URL::asset('css/bootstrap/bootstrap.css') }}"/>
    <link rel="stylesheet" type="text/css" href="{{ URL::asset('css/bootstrap/bootstrap-theme.css') }}"/>
    <link rel="stylesheet" type="text/css" href="{{ URL::asset('/css/iconfont/iconfont.css') }}"/>
    <link rel="stylesheet" type="text/css" href="{{ URL::asset('/css/common.css') }}"/>
    <link rel="stylesheet" type="text/css" href="{{ URL::asset('/css/right.css') }}"/>
    <link rel="stylesheet" type="text/css" href="{{ URL::asset('/css/carousel.css') }}"/>
    <!--[if IE 6]>
    <script type="text/javascript" src="{{ URL::asset('dist/lib/DD_belatedPNG_0.0.8a-min.js') }}"></script>
    <script>DD_belatedPNG.fix('*');</script>
    <![endif]-->
    @section('seo')
        <title>{{$common['base']['seo_title']}}</title>
        <meta name="keywords" content="{{$common['base']['seo_keywords']}}" />
        <meta name="description" content="{{$common['base']['seo_description']}}" />
    @show
</head>
<body>
@section('header')
    <header class="navbar navbar-inverse navbar-fixed-top style-home-nav-background">
        <div class="container">
            <div class="navbar-header">
                <button class="navbar-toggle collapsed" type="button" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
            </div>
            <div class="navbar-collapse collapse" role="navigation">
                <ul class="nav navbar-nav style-home-nav">
                    <li class="hidden-sm hidden-md dropdown {{$column=='index'?'style-home-nav-active':''}}" style="border:0;">
                        <a href="" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                            商城
                            <span class="caret"></span>
                        </a>
                        <ul class="dropdown-menu" style="background-color: #01061a;">
                            <li style="border-bottom: 0px;padding:0;"><a href="{{ URL::asset('index') }}">首页</a></li>
                            @foreach($common['cartes'] as $carte)
                            <li style="border-bottom: 0px;"><a href="{{URL::asset($carte['route'])}}">{{$carte['name']}}</a></li>
                            @endforeach
                        </ul>
                    </li>
                    <li class=" {{$column=='league'?'style-home-nav-active':''}}">
                        <a href="{{ URL::asset('league') }}">合作与服务</a>
                    </li>
                    <li class=" {{$column=='about'?'style-home-nav-active':''}}">
                        <a href="{{ URL::asset('about') }}">关于我们</a>
                    </li>
                </ul>
                <ul class="nav navbar-nav navbar-right hidden-sm style-home-nav">
                    @if($user)
                        <li class=" {{$column=='center'?'style-home-nav-active':''}}">
                            <a href="{{ URL::asset('center') }}">我的优迈</a>
                        </li>
                        <li class=" {{$column=='cart'?'style-home-nav-active':''}}">
                            <a href="{{ URL::asset('cart') }}">
                                购物车
                                @if(count($carts)>0)
                                    <i class="upper-right-prompt"></i>
                                @endif
                            </a>
                        </li>
                        <li>
                            <a href="{{ URL::asset('signOut') }}">安全退出</a>
                        </li>
                    @else
                        <li class=" {{$column=='signIn'?'style-home-nav-active':''}}">
                            <a href="{{ URL::asset('signIn') }}">登录</a>
                        </li>
                        <li class=" {{$column=='signUp'?'style-home-nav-active':''}}">
                            <a href="{{ URL::asset('signUp') }}">注册</a>
                        </li>
                    @endif
                </ul>
            </div>
        </div>
    </header>
@show
@yield('content')
@section('footer')
    <footer class="background-navy-blue text-silver-grey padding-top-20 padding-bottom-20" id="menu-map" hidden>
        <div class="container">
            <div class="row">
                <div class="col-xs-12 col-sm-8">
                    <div class="col-xs-12 col-sm-5">
                        <div class="text-left">
                            <img src="{{$common['base']['logo']}}" class="width-90" />
                        </div>
                        <h5 class="margin-top-20">
                            <i class="iconfont icon-dianhua"></i>
                            {{$common['base']['phonenum']}}
                        </h5>
                        <h5 class="margin-top-10">
                            <i class="iconfont icon-QQ"></i>
                            {{$common['base']['qq']}}
                        </h5>
                        <h5 class="margin-top-10">
                            <i class="iconfont icon-dingwei"></i>
                            {{$common['base']['address']}}
                        </h5>
                    </div>
                    @foreach($common['cartes'] as $cartes)
                    <div class="col-xs-12 col-sm-2">
                        <a href="{{URL::asset($cartes['route'])}}">
                            <h5 class="font-size-16" style="margin-top:0;">{{$cartes['name']}}</h5>
                        </a>
                        <ul>
                            @foreach($cartes['menus'] as $cartes['menu'])
                                <li class="line-height-34">
                                    <a href="{{URL::asset($cartes['column'].'/lists/'.$cartes['menu']['id'])}}">
                                    {{$cartes['menu']['name']}}
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                    @endforeach
                </div>
                <div class="col-xs-12 col-sm-4">
                    <div class="text-center">
                        <img src="{{$common['base']['wechat']}}" />
                    </div>
                    <h4 class="text-center margin-top-20">
                        扫描二维码，关注微信公众号
                    </h4>
                </div>
            </div>
        </div>
    </footer>
    <footer class="style-home-footer text-center">
        {{$common['base']['copyright']}}&nbsp;{{$common['base']['number']}}
    </footer>
@show
<div id='style-home-right'>
    <div class="tab">
        <div id="rightArrow0" onclick="changeChannel(0)">
            <a href="javascript:;" title="购物车">
                <i class="iconfont icon-48 font-size-24"></i>
                @if($user)
                    @if(count($carts)>0)
                        <i class="upper-right-prompt"></i>
                    @endif
                @endif
            </a>
        </div>
        <div id="rightArrow1" onclick="changeChannel(1)">
            <a href="javascript:;" title="帮你找货">
                <i class="iconfont icon-chazhao font-size-24"></i>
            </a>
        </div>
        <div id="rightArrow2" onclick="changeChannel(2)">
            <a href="javascript:;" title="客服">
                <i class="iconfont icon-kefu-tianchong font-size-24"></i>
            </a>
        </div>
        <div id="rightArrow3" onclick="changeChannel(3)">
            <a href="javascript:;" title="意见反馈">
                <i class="iconfont icon-yijianfankui1xfuzhi font-size-24"></i>
            </a>
        </div>
    </div>
    <div class="style-home-right-content">
        <div id="floatDivBoxs0" style="overflow-y: auto;">
            <div class="right-content-title padding-left-5 padding-right-5">
                <div class="float-left">
                    <i class="iconfont icon-48 font-size-18"></i>
                    购物车
                </div>
                <div class="float-right">
                    <a href="javascript:" onclick="cloaseChannel()" />
                        <i class="iconfont icon-guanbi font-size-18"></i>
                    </a>
                </div>
            </div>
            <div class="right-content-content">
                @if($user)
                    @if(count($carts)>0)
                        <ul>
                            @foreach($carts as $cart)
                            <li class="padding-10 border-bottom-attribute">
                                <div class="row font-size-12">
                                    @if($cart['goods_menu']['menu_id']==1)
                                        <a href="{{URL::asset($cart['goods_column'].'/detail/'.$cart['goods_info']['id'])}}">
                                    @elseif($cart['goods_menu']['menu_id']==2)
                                        <a href="{{URL::asset($cart['goods_column'].'/detail/'.$cart['goods_info']['id'])}}">
                                    @elseif($cart['goods_menu']['menu_id']==3)
                                        @if($cart['goods_type']==0)
                                        <a href="{{URL::asset($cart['goods_column'].'/detail/machining/'.$cart['goods_info']['id'])}}">
                                        @else
                                        <a href="{{URL::asset($cart['goods_column'].'/detail/standard/'.$cart['goods_info']['id'])}}">
                                        @endif
                                    @endif
                                            <div class="col-xs-5 col-sm-5">
                                                <img src="{{$cart['goods_info']['picture']}}" class="width-100" />
                                            </div>
                                    @if($cart['goods_menu']['menu_id']==1||$cart['goods_menu']['menu_id']==2||$cart['goods_menu']['menu_id']==3)
                                        </a>
                                    @endif
                                    <div class="col-xs-7 col-sm-7">
                                        <p>{{$cart['goods_info']['name']}}</p>
                                        <p class="text-red">￥{{$cart['goods_info']['price']/100}} /{{$cart['goods_info']['unit']}}</p>
                                        <div class="row">
                                            <p class="col-xs-7 col-sm-7">数量：{{$cart['count']}}</p>
                                            <a href="javascript:" onclick="cart_del(this,'{{$cart['id']}}')" >
                                                <p class="col-xs-5 col-sm-5 text-blue" >删除</p>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            @endforeach
                        </ul>
                        <a href="{{URL::asset('cart')}}">
                            <div class="margin-top-10 margin-bottom-50 col-xs-12 col-sm-12">
                                <button type="button" class="btn btn-danger width-100 border-radius-0">查看购物车</button>
                            </div>
                        </a>
                    @else
                        <div class="margin-top-20 margin-right-10 margin-left-10">
                            <img src="{{ URL::asset('img/nothing.png') }}"  />
                        </div>
                        <div class="margin-top-20 text-center index-font">
                            购物车中还没有商品，赶紧选购吧！
                        </div>
                    @endif
                @else
                    <a href="{{ URL::asset('signIn') }}">
                        <div class="margin-top-150 col-xs-12 col-sm-12">
                            <button type="button" class="btn btn-danger width-100 border-radius-0">立即登录</button>
                        </div>
                    </a>
                @endif
            </div>
        </div>
        <div id="floatDivBoxs1" style="overflow-y: auto;">
            <div class="right-content-title padding-left-5 padding-right-5">
                <div class="float-left">
                    <i class="iconfont icon-chazhao font-size-18"></i>
                    帮你找货
                </div>
                <div class="float-right">
                    <a href="javascript:" onclick="cloaseChannel()" />
                    <i class="iconfont icon-guanbi font-size-18"></i>
                    </a>
                </div>
            </div>
            <div class="right-content-content">
                <form method="post" action="{{ URL::asset('searching') }}" id="form-searching">
                    {{ csrf_field() }}
                    <div class="margin-top-5 col-xs-12 col-sm-12 ">
                        需要采购的商品<i>*</i>
                    </div>
                    <div class="margin-top-5 col-xs-12 col-sm-12">
                        <input type="text" class="form-control" name="searching_goods" id="searching_goods" placeholder="请输入需要采购的商品">
                    </div>
                    <div class="margin-top-5 col-xs-12 col-sm-12 ">
                        <div class=" col-xs-6 col-sm-6 padding-left-0">
                            采购数量<i>*</i>
                        </div>
                        <div class=" col-xs-6 col-sm-6 padding-left-0">
                            单位<i>*</i>
                        </div>
                    </div>
                    <div class="margin-top-5 col-xs-12 col-sm-12">
                        <div class=" col-xs-6 col-sm-6 padding-left-0">
                            <input type="text" class="form-control" name="searching_count" id="searching_count" placeholder="采购数量">
                        </div>
                        <div class=" col-xs-6 col-sm-6 padding-left-0">
                            <select name="searching_unit" class="form-control">
                                <option value="g">g</option>
                                <option value="ton">ton</option>
                                <option value="kg">kg</option>
                                <option value="mg">mg</option>
                                <option value="L">L</option>
                                <option value="ml">ml</option>
                            </select>
                        </div>
                    </div>
                    <div class="margin-top-5 col-xs-12 col-sm-12 ">
                        纯度
                    </div>
                    <div class="margin-top-5 col-xs-12 col-sm-12">
                        <input type="text" class="form-control" name="searching_purity" id="searching_purity" placeholder="请输入纯度">
                    </div>
                    <div class="margin-top-5 col-xs-12 col-sm-12 ">
                        联系人
                    </div>
                    <div class="margin-top-5 col-xs-12 col-sm-12">
                        <input type="text" class="form-control" name="searching_name" id="searching_name" placeholder="请输入联系人">
                    </div>
                    <div class="margin-top-5 col-xs-12 col-sm-12 ">
                        联系人手机<i>*</i>
                    </div>
                    <div class="margin-top-5 col-xs-12 col-sm-12">
                        <input type="text" class="form-control" name="searching_phonenum" id="searching_phonenum" placeholder="请输入联系人手机">
                    </div>
                    <div class="margin-top-5 col-xs-12 col-sm-12 ">
                        需求时效<i>*</i>
                    </div>
                    <div class="margin-top-5 col-xs-12 col-sm-12">
                        <select name="searching_time" class="form-control">
                            <option value="3天">3天</option>
                            <option value="1天以内">1天以内</option>
                            <option value="7天">7天</option>
                            <option value="1个月">1个月</option>
                            <option value="3个月">3个月</option>
                        </select>
                    </div>
                    <div class="margin-top-5 col-xs-12 col-sm-12 ">
                        收货地址<i>*</i>
                    </div>
                    <div class="margin-top-5 col-xs-12 col-sm-12 ">
                        <div class="col-xs-6 col-sm-6 padding-left-0">
                            <select name="searching_province" id="searching_province"  class="form-control">
                                <option value="">请选择</option>
                            </select>
                        </div>
                        <div class=" col-xs-6 col-sm-6 padding-left-0">
                            <select name="searching_city" id="searching_city"  class="form-control">
                                <option value="">请选择</option>
                            </select>
                        </div>
                    </div>
                    <div class="margin-top-5 col-xs-12 col-sm-12 ">
                        公司/单位<i>*</i>
                    </div>
                    <div class="margin-top-5 col-xs-12 col-sm-12">
                        <input type="text" class="form-control" name="searching_address" id="searching_address" placeholder="请输入公司/单位">
                    </div>
                    <div class="margin-top-5 col-xs-12 col-sm-12 ">
                        备注
                    </div>
                    <div class="margin-top-5 col-xs-12 col-sm-12">
                        <textarea class="form-control" rows="6" name="searching_content" id="searching_content" style="resize:none"  placeholder="请输入备注"></textarea>
                    </div>
                    <div class="margin-top-5 margin-bottom-40 col-xs-12 col-sm-12">
                        <button type="submit" class="btn btn-danger width-100 border-radius-0">立即提交</button>
                    </div>
                </form>
            </div>
        </div>
        <div id="floatDivBoxs2">
            <div class="right-content-title padding-left-5 padding-right-5">
                <div class="float-left">
                    <i class="iconfont icon-kefu-tianchong font-size-18"></i>
                    联系客服
                </div>
                <div class="float-right">
                    <a href="javascript:" onclick="cloaseChannel()" />
                    <i class="iconfont icon-guanbi font-size-18"></i>
                    </a>
                </div>
            </div>
            <div class="right-content-content">
                <img src="{{ URL::asset('img/contact.jpg') }}" class="right-content-service-image" />
                @foreach($common['services'] as $service)
                    <div class="margin-top-20 right-content-service-list">
                        <div class="col-xs-0 col-sm-8">
                            <p class="style-ellipsis-1">{{$service['name']}}</p>
                            <p class="style-ellipsis-1">{{$service['phonenum']}}</p>
                        </div>
                        <div class="col-xs-12 col-sm-4 common-text-align-center">
                            <a href="tencent://message/?uin={{$service['qq']}}&Menu=yes" >
                                <img src="{{ URL::asset('img/social-qq.png') }}" class="right-content-service-qq" />
                            </a>
                        </div>
                    </div>
                @endforeach
                <div class="margin-top-20 common-text-align-center right-content-service-time">
                    <p>在线服务时间</p>
                    <p class="style-ellipsis-1">{{$common['base']['time']}}</p>
                </div>
            </div>
        </div>
        <div id="floatDivBoxs3">
            <div class="right-content-title padding-left-5 padding-right-5">
                <div class="float-left">
                    <i class="iconfont icon-yijianfankui1xfuzhi font-size-18"></i>
                    意见反馈
                </div>
                <div class="float-right">
                    <a href="javascript:" onclick="cloaseChannel()" />
                        <i class="iconfont icon-guanbi font-size-18"></i>
                    </a>
                </div>
            </div>
            <div class="right-content-content">
                <form method="post" action="{{ URL::asset('advice') }}" id="form-advice">
                    {{ csrf_field() }}
                    <div class="margin-top-5 col-xs-12 col-sm-12 ">
                        咨询类型<i>*</i>
                    </div>
                    <div class="margin-top-5 col-xs-12 col-sm-12">
                        <select name="advice_type" class="form-control">
                            <option value="建议">建议</option>
                            <option value="投诉">投诉</option>
                            <option value="关于产品">关于产品</option>
                            <option value="关于供应商">关于供应商</option>
                            <option value="关于采购商">关于采购商</option>
                            <option value="关于询盘">关于询盘</option>
                            <option value="关于订单">关于订单</option>
                            <option value="其他">其他</option>
                        </select>
                    </div>
                    <div class="margin-top-5 col-xs-12 col-sm-12 ">
                        问题描述<i>*</i>
                    </div>
                    <div class="margin-top-5 col-xs-12 col-sm-12">
                        <textarea class="form-control" rows="6" name="advice_content" id="advice_content" style="resize:none"  placeholder="请输入问题描述"></textarea>
                    </div>
                    <div class="margin-top-5 col-xs-12 col-sm-12 ">
                        联系人电话<i>*</i>
                    </div>
                    <div class="margin-top-5 col-xs-12 col-sm-12">
                        <input type="text" class="form-control" name="advice_phonenum" id="advice_phonenum" placeholder="请输入联系人电话">
                    </div>
                    <div class="margin-top-5 col-xs-12 col-sm-12 ">
                        联系人<i>*</i>
                    </div>
                    <div class="margin-top-5 col-xs-12 col-sm-12">
                        <input type="text" class="form-control" name="advice_name" id="advice_name" placeholder="请输入联系人">
                    </div>
                    <div class="margin-top-40 col-xs-12 col-sm-12">
                        <button type="submit" class="btn btn-danger width-100 border-radius-0">立即提交</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!--_footer 作为公共模版分离出去-->
<script type="text/javascript" src="{{ URL::asset('dist/lib/jquery/1.9.1/jquery.min.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('dist/lib/layer/2.4/layer.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('js/bootstrap/bootstrap.js') }}"></script>
<!--/_footer 作为公共模版分离出去-->

<!--请在下方写此页面业务相关的脚本-->
<script type="text/javascript" src="{{ URL::asset('dist/lib/jquery.contextmenu/jquery.contextmenu.r2.js') }}"></script>
<!--请在下方写此页面业务相关的脚本-->
<script type="text/javascript" src="{{ URL::asset('dist/lib/My97DatePicker/4.8/WdatePicker.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('dist/lib/datatables/1.10.0/jquery.dataTables.min.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('dist/lib/laypage/1.2/laypage.js') }}"></script>
{{--doT、md5、七牛等相关--}}
<script type="text/javascript" src="{{ URL::asset('/js/doT.min.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('/js/md5.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('/js/qiniu.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('/js/plupload/plupload.full.min.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('/js/plupload/moxie.js') }}"></script>
<!--请在下方写此页面业务相关的脚本-->
<script type="text/javascript" src="{{ URL::asset('dist/lib/jquery.validation/1.14.0/jquery.validate.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('dist/lib/jquery.validation/1.14.0/validate-methods.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('dist/lib/jquery.validation/1.14.0/messages_zh.js') }}"></script>


<script type="text/javascript" src="{{ URL::asset('/js/right.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('/js/jquery.form.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('/js/jQueryProvinces/area.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('/js/jQueryProvinces/searching-select.js') }}"></script>
<script type="text/javascript" src="{{URL::asset('js/carousel.js')}}"></script>
{{--common.js--}}
<script type="text/javascript" src="{{ URL::asset('/js/common.js') }}"></script>
<script>
    $("#form-advice").validate({
        rules: {
            advice_content:{
                required:true,
            },
            advice_phonenum:{
                required:true,
                maxlength:11,
                minlength:11,
            },
            advice_name:{
                required:true,
            },
        },
        onkeyup: false,
        focusCleanup: false,
        success: "valid",
        submitHandler: function (form) {
            var phonenum=$('#advice_phonenum').val();
            if(isPoneAvailable(phonenum)){
                $(form).ajaxSubmit({
                    type: 'POST',
                    url: "{{ URL::asset('advice')}}",
                    success: function (ret) {
                        // console.log(JSON.stringify(ret));
                        if (ret.result) {
                            layer.msg(ret.msg, {icon: 1, time: 2000});
                            $('#form-advice')[0].reset();
                        } else {
                            layer.msg(ret.msg, {icon: 2, time: 2000});
                        }
                    },
                    error: function (XmlHttpRequest, textStatus, errorThrown) {
                        layer.msg('操作失败', {icon: 2, time: 2000});
                        console.log("XmlHttpRequest:" + JSON.stringify(XmlHttpRequest));
                        console.log("textStatus:" + textStatus);
                        console.log("errorThrown:" + errorThrown);
                    }
                });
            }
            else{
                layer.msg('请填写正确的手机号', {icon: 2, time: 2000});
            }
        }

    });
    $("#form-searching").validate({
        rules: {
            searching_goods:{
                required:true,
            },
            searching_count:{
                required:true,
                number:true
            },
            searching_phonenum:{
                required:true,
                maxlength:11,
                minlength:11,
            },
            searching_province:{
                required:true,
            },
            searching_city:{
                required:true,
            },
            searching_address:{
                required:true,
            },
        },
        onkeyup: false,
        focusCleanup: false,
        success: "valid",
        submitHandler: function (form) {
            var phonenum=$('#searching_phonenum').val();
            if(isPoneAvailable(phonenum)){
                $(form).ajaxSubmit({
                    type: 'POST',
                    url: "{{ URL::asset('searching')}}",
                    success: function (ret) {
                        // console.log(JSON.stringify(ret));
                        if (ret.result) {
                            layer.msg(ret.msg, {icon: 1, time: 2000});
                            $('#form-searching')[0].reset();
                        } else {
                            layer.msg(ret.msg, {icon: 2, time: 2000});
                        }
                    },
                    error: function (XmlHttpRequest, textStatus, errorThrown) {
                        layer.msg('操作失败', {icon: 2, time: 2000});
                        console.log("XmlHttpRequest:" + JSON.stringify(XmlHttpRequest));
                        console.log("textStatus:" + textStatus);
                        console.log("errorThrown:" + errorThrown);
                    }
                });
            }
            else{
                layer.msg('请填写正确的手机号', {icon: 2, time: 2000});
            }
        }

    });

    $(function(){
        //轮播图列表
        var carouselContentLength=$('.carousel-content').length;
        if(carouselContentLength){
            $(".carousel-content").carousel({
                carousel : ".carousel",//轮播图容器
                //indexContainer : ".img-index",//下标容器
                // prev : ".carousel-prev",//左按钮
                // next : ".carousel-next",//右按钮
                timing : 5000,//自动播放间隔
                animateTime : 800,//动画时间
                auto : true,//是否自动播放
            });

            $(".carousel-prev").hover(function(){
                $(this).find("img").attr("src","./images/left_btn2.png");
            },function(){
                $(this).find("img").attr("src","./images/left_btn1.png");
            });
            $(".carousel-next").hover(function(){
                $(this).find("img").attr("src","./images/right_btn2.png");
            },function(){
                $(this).find("img").attr("src","./images/right_btn1.png");
            });

            //规定banner的高度
            $('#banner').height('450');
            var bannerHeight=$('#banner').height();
            $('#side_bar_menus').css('margin-top',-bannerHeight);
        }
        //个人中心内容最低高度设置
        var centerMenuLength=$('#center-menu').length;
        if(centerMenuLength){
            var center_height=$('#center-menu').height();
            $('#center-content').css('min-height',center_height);
        }

        var column='{{$column}}'
        if(column=='chem'||column=='testing'||column=='machining'||column=='center'||column=='cart'){
            $('#menu-map').show();
            $('footer').addClass('background-navy-blue');
            $('.style-home-footer').addClass('border-top');
            $('.style-home-footer').css('margin','0');
        }
        var winWidth=$(window).width();
        if(winWidth<500){
            $('#style-layouts-header-search .detail-logo').css('display','none')
            $('#style-layouts-header-search input').css('margin-top','10px')
            $('#style-layouts-header-search button').css('margin-top','10px')
        }
    });

    //删除购物车
    function cart_del(obj,id){
        layer.confirm('确认要删除吗？',function(index){
            //进行后台删除
            var param = {
                id: id,
                _token: "{{ csrf_token() }}"
            }
            delShoppingCart('{{URL::asset('')}}', param, function (ret) {
                if (ret.result == true) {
                    layer.msg(ret.msg, {icon: 1, time: 1000});
                    $(obj).parents("li").remove();
                    var cartContentLength=$('#cart-content').length;
                    if(cartContentLength){
                        window.location.reload()
                    }
                } else {
                    layer.msg(ret.msg, {icon: 2, time: 1000})
                }
            })
        });
    }
</script>

</body>
</html>

@yield('script')