@extends('home.layouts.base')
@section('content')
    <div id="sign-body">
        <div class="style-home-nav-station"></div>
        <div class="container">
            <div class="row">
                <div class="col-xs-12 col-md-8"></div>
                <div class="col-xs-12 col-md-4">
                    <div class="padding-top-50">
                        <div class="panel panel-default" style="height:413px;">
                            <div class="panel-body">
                                <ul class="nav nav-tabs">
                                    <li role="presentation"><a href="{{ URL::asset('reset') }}?type=0">手机找回密码</a></li>
                                    <li role="presentation" class="active"><a href="{{ URL::asset('reset') }}?type=1">邮箱找回密码</a></li>
                                </ul>
                                <form id="form-signUp-email" name="signUpByEmail">
                                    {{ csrf_field() }}
                                    <p class="position-relative margin-top-40">
                                        <input type="email" name="email" id="email" class="form-control" placeholder="请输入绑定的邮箱">
                                    </p>
                                    <p class="position-relative margin-top-30">
                                        <input type="password" name="password" id="password" class="form-control" placeholder="请输入新密码6-12字符、数字组成">
                                    </p>
                                    <p class="position-relative form-group margin-top-30">
                                        <input type="text" name="verificationCode" id="verificationCode" class="form-control width-55 float-left" placeholder="请输入验证码">
                                        <input type="button" class="btn btn-warning width-40 float-right" value="获取验证码"  name="send" onclick="showtime(30)">
                                    </p>
                                    <p class="clear"></p>
                                    <p class="margin-top-30">
                                        <button class="btn btn-lg btn-primary btn-block" type="submit">确 认 修 改</button>
                                    </p>
                                    <p class="position-relative form-group margin-top-30 text-right">
                                        <a href="{{ URL::asset('signIn') }}">返回登录</a>
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
            $('#sign-body').css('height',winHeight-80);
            //编辑网站基本信息
            $("#form-signUp-email").validate({
                rules: {
                    email:{
                        required:true,
                        email:true
                    },
                    password:{
                        required:true,
                        minlength:6,
                        maxlength:12
                    },
                },
                onkeyup: false,
                focusCleanup: false,
                success: "valid",
                submitHandler: function (form) {
                    var verificationCode=$('#verificationCode').val();
                    var agree = $('#agree').prop('checked');
                    if(verificationCode==''){
                        layer.msg('注册失败，请填写验证码', {icon: 2, time: 3000});
                    }
                    else{
                        if(agree==''){
                            layer.msg('只有阅读并同意用户服务协议才可以注册', {icon: 2, time: 3000});
                        }
                        else{
                            {{--$(form).ajaxSubmit({--}}
                            {{--type: 'POST',--}}
                            {{--url: "{{ URL::asset('signUp')}}",--}}
                            {{--success: function (ret) {--}}
                            {{--console.log(JSON.stringify(ret));--}}
                            {{--if (ret.result) {--}}
                            {{--layer.msg(ret.msg, {icon: 1, time: 3000});--}}
                            {{--window.location.reload();--}}
                            {{--} else {--}}
                            {{--layer.msg(ret.msg, {icon: 2, time: 3000});--}}
                            {{--}--}}
                            {{--},--}}
                            {{--error: function (XmlHttpRequest, textStatus, errorThrown) {--}}
                            {{--layer.msg('保存失败', {icon: 2, time: 3000});--}}
                            {{--console.log("XmlHttpRequest:" + JSON.stringify(XmlHttpRequest));--}}
                            {{--console.log("textStatus:" + textStatus);--}}
                            {{--console.log("errorThrown:" + errorThrown);--}}
                            {{--}--}}
                            {{--});--}}
                        }
                    }
                }

            });
        });
        function showtime(t){
            document.signUpByEmail.send.disabled=true;
            for(i=1;i<=t;i++) {
                window.setTimeout("update_p(" + i + ","+t+")", i * 1000);
            }

        }

        function update_p(num,t) {
            if(num == t) {
                document.myform.send.value =" 重新发送 ";
                document.signUpByEmail.send.disabled=false;
            }
            else {
                printnr = t-num;
                document.signUpByEmail.send.value = " (" + printnr +")秒后重新发送";
            }
        }
    </script>
@endsection