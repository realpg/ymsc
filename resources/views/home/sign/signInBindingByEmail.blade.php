@extends('home.layouts.base')
@section('content')
    <div id="sign-body">
        <div class="style-home-nav-station"></div>
        <div class="container">
            <div class="row">
                <div class="col-xs-12 col-md-8"></div>
                <div class="col-xs-12 col-md-4">
                    <div class="padding-top-50" id="sign-form">
                        <div class="panel panel-default" style="height:413px;">
                            <div class="panel-body">
                                <ul class="nav nav-tabs">
                                    <li role="presentation"><a href="{{ URL::asset('signInBinding') }}?type=0">手机绑定</a></li>
                                    <li role="presentation" class="active"><a href="{{ URL::asset('signInBinding') }}?type=1">邮箱绑定</a></li>
                                </ul>
                                <h3>微信授权成功</h3>
                                <h4 class="text-red">请输入要绑定的邮箱，下次可以直接登录</h4>
                                <form method="post" id="form-signIn-bindiing" name="signIn">
                                    {{ csrf_field() }}
                                    <p class="position-relative margin-top-40">
                                        <input type="text" name="email" id="email" class="form-control" placeholder="请输入要绑定的邮箱">
                                    </p>
                                    <p class="position-relative form-group margin-top-30">
                                        <input type="text" name="verificationCode" id="verificationCode" class="form-control width-55 float-left" placeholder="请输入验证码">
                                        <img src="{{ URL::asset('code') }}" class="form-control width-40 float-right padding-0 border-0 border-radius-0 cursor-pointer"  id="verifyimage"  onclick="this.src='{{ url('code') }}?r='+Math.random();" alt="验证码" />
                                    </p>
                                    <p class="clear"></p>
                                    <p class="margin-top-30">
                                        <button class="btn btn-lg btn-primary btn-block" type="submit">确 认</button>
                                    </p>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script type="text/javascript">
        $(function () {
            //初始化画布的size
            var winWidth=$(window).width();
            var winHeight=$(window).height();
            $('#sign-body').css('width',winWidth);
            $('#sign-body').css('height',winHeight-45);
            var bodyHeight=$('#sign-body').height();
            if(bodyHeight>700&&bodyHeight<=800){
                $('#sign-form').css('padding-top','80px');
            }
            else if(bodyHeight>800&&bodyHeight<=900){
                $('#sign-form').css('padding-top','120px');
            }
            else if(bodyHeight>900){
                $('#sign-form').css('padding-top','180px');
            }
            //编辑网站基本信息
            $("#form-signIn-bindiing").validate({
                onkeyup: false,
                focusCleanup: false,
                success: "valid",
                submitHandler: function (form) {
                    var phonenum=$('#phonenum').val();
                    var email=$('#email').val();
                    var verificationCode=$('#verificationCode').val();
                    if(!phonenum&&!email){
                        layer.msg('请输入需要绑定的邮箱', {icon: 2, time: 2000});
                        $('#phonenum').focus();
                    }
                    else if(!isEmail(email)){
                        layer.msg('请输入正确的邮箱', {icon: 2, time: 2000});
                        $('#email').focus();
                    }
                    else if(!verificationCode){
                        layer.msg('绑定失败，请填写验证码', {icon: 2, time: 2000});
                    }
                    else{
                        $(form).ajaxSubmit({
                            type: 'POST',
                            url: "{{ URL::asset('signInBinding')}}",
                            success: function (ret) {
                                if (ret.result) {
                                    layer.msg(ret.msg, {icon: 1, time: 2000});
                                    {{--location.href="{{ URL::asset('index')}}"--}}
                                    // window.history.go(-1);
                                    window.location.href = document.referrer;//返回上一页并刷新
                                } else {
                                    $("#password").val('');
                                    $("#verifyimage").click();
                                    layer.msg(ret.msg, {icon: 2, time: 3000});
                                }
                            },
                            error: function (XmlHttpRequest, textStatus, errorThrown) {
                                $("#password").val('');
                                $("#verifyimage").click();
                                layer.msg('操作失败', {icon: 2, time: 2000});
                                console.log("XmlHttpRequest:" + JSON.stringify(XmlHttpRequest));
                                console.log("textStatus:" + textStatus);
                                console.log("errorThrown:" + errorThrown);
                            }
                        });
                    }
                }

            });
        });
    </script>
@endsection