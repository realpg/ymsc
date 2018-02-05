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
    </header>
@show
@yield('content')
@section('footer')
    <footer class="style-home-footer">
        <p>{{$common['base']['copyright']}}</p>
        <p>{{$common['base']['number']}}</p>
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
    <div class="style-home-right-content">
        <div id="floatDivBoxs0">
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
        </div>
        <div id="floatDivBoxs1" style="overflow-y: scroll;">
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
                        <button type="submit" class="btn btn-danger width-100 border-ridus-0">立即提交</button>
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
                        <button type="submit" class="btn btn-danger width-100 border-ridus-0">立即提交</button>
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
{{--common.js--}}
<script type="text/javascript" src="{{ URL::asset('/js/common.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('/js/right.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('/js/jquery.form.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('/js/jQueryProvinces/area.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('/js/jQueryProvinces/searching-select.js') }}"></script>
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
</script>

</body>
</html>

@yield('script')