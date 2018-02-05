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
    <!--[if IE 6]>
    <script type="text/javascript" src="{{ URL::asset('dist/lib/DD_belatedPNG_0.0.8a-min.js') }}"></script>
    <script>DD_belatedPNG.fix('*');</script>
    <![endif]-->
    @section('seo')
        <title>{{$base['seo_title']}}</title>
        <meta name="keywords" content="{{$base['seo_keywords']}}" />
        <meta name="description" content="{{$base['seo_description']}}" />
    @show
</head>
<body>
@section('header')
    <div class="navbar navbar-inverse navbar-fixed-top style-home-nav-background">
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
                    <li class="hidden-sm hidden-md {{$column=='index'?'style-home-nav-active':''}}">
                        <a href="{{ URL::asset('index') }}">首页</a>
                    </li>
                    <li class=" {{$column=='league'?'style-home-nav-active':''}}">
                        <a href="{{ URL::asset('league') }}">合作与服务</a>
                    </li>
                    <li class=" {{$column=='about'?'style-home-nav-active':''}}">
                        <a href="{{ URL::asset('about') }}">关于我们</a>
                    </li>
                </ul>
                <ul class="nav navbar-nav navbar-right hidden-sm style-home-nav">
                    <li class=" {{$column=='center'?'style-home-nav-active':''}}">
                        <a href="{{ URL::asset('center') }}">我的优迈</a>
                    </li>
                    <li class=" {{$column=='signIn'?'style-home-nav-active':''}}">
                        <a href="{{ URL::asset('signIn') }}">登录</a>
                    </li>
                    <li class=" {{$column=='signUp'?'style-home-nav-active':''}}">
                        <a href="{{ URL::asset('signUp') }}">注册</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
@show
@yield('content')
@section('footer')
    <footer class="style-home-footer">
        <p>{{$base['copyright']}}</p>
        <p>{{$base['number']}}</p>
    </footer>
@show
<div id='style-home-right'>
    <div class="tab">
        <div id="rightArrow0" onclick="changeChannel(0)">
            <a href="javascript:;" title="购物车">
                <i class="iconfont icon-48 font-size-24"></i>
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
    <div class="content">
        <div id="floatDivBoxs0">
            <div class="right-content-title padding-left-5 padding-right-5">
                <div class="float-left">
                    <i class="iconfont icon-48 font-size-18"></i>
                    我是购物车
                </div>
                <div class="float-right">
                    <a href="javascript:" onclick="cloaseChannel()" />
                        <i class="iconfont icon-guanbi font-size-18"></i>
                    </a>
                </div>
            </div>
        </div>
        <div id="floatDivBoxs1">
            <div class="right-content-title padding-left-5 padding-right-5">
                <div class="float-left">
                    <i class="iconfont icon-chazhao font-size-18"></i>
                    我是帮你找货
                </div>
                <div class="float-right">
                    <a href="javascript:" onclick="cloaseChannel()" />
                    <i class="iconfont icon-guanbi font-size-18"></i>
                    </a>
                </div>
            </div>
        </div>
        <div id="floatDivBoxs2">
            <div class="right-content-title padding-left-5 padding-right-5">
                <div class="float-left">
                    <i class="iconfont icon-kefu-tianchong font-size-18"></i>
                    我是帮你找货
                </div>
                <div class="float-right">
                    <a href="javascript:" onclick="cloaseChannel()" />
                    <i class="iconfont icon-guanbi font-size-18"></i>
                    </a>
                </div>
            </div>
        </div>
        <div id="floatDivBoxs3">
            <div class="right-content-title padding-left-5 padding-right-5">
                <div class="float-left">
                    <i class="iconfont icon-yijianfankui1xfuzhi font-size-18"></i>
                    我是投诉建议
                </div>
                <div class="float-right">
                    <a href="javascript:" onclick="cloaseChannel()" />
                    <i class="iconfont icon-guanbi font-size-18"></i>
                    </a>
                </div>
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
{{--common.js--}}
<script type="text/javascript" src="{{ URL::asset('/js/common.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('/js/right.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('/js/jquery.form.js') }}"></script>


</body>
</html>

@yield('script')