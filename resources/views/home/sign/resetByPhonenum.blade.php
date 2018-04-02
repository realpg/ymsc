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
                                    <li role="presentation" class="active"><a href="{{ URL::asset('reset') }}?type=0">手机找回密码</a></li>
                                    <li role="presentation"><a href="{{ URL::asset('reset') }}?type=1">邮箱找回密码</a></li>
                                </ul>
                                <form method="post" id="form-reset-phonenum" name="resetByPhonenum">
                                    {{ csrf_field() }}
                                    <input type="hidden" name="type" id="type" class="form-control" value="resetByPhonenum" readonly>
                                    <p class="position-relative margin-top-40">
                                        <input type="text" name="phonenum" id="phonenum" class="form-control" placeholder="请输入绑定的手机号">
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
                                    <p class="position-relative form-group margin-top-30 text-right text-blue">
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
            $("#form-reset-phonenum").validate({
                rules: {
                    phonenum:{
                        required:true,
                        minlength:11,
                        maxlength:11
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
                    if(verificationCode==''){
                        layer.msg('修改密码失败，请填写验证码', {icon: 2, time: 2000});
                    }
                    else{
                        var password=$('#password').val();
                        $("#password").val(hex_md5(password));
                        $(form).ajaxSubmit({
                            type: 'POST',
                            url: "{{ URL::asset('reset')}}",
                            success: function (ret) {
                                // console.log(JSON.stringify(ret));
                                if (ret.result) {
                                    layer.msg(ret.msg, {icon: 1, time: 1000});
                                    location.href="{{ URL::asset('signIn')}}"
                                } else {
                                    $("#password").val('');
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
                }

            });
        });
        function showtime(){
            var phonenum=$('#phonenum').val();
            if(isPoneAvailable(phonenum)){
                if(phonenum){
                    var param={
                        _token: "{{ csrf_token() }}",
                        phonenum:phonenum,
                    }
                    sendSMSCode('{{URL::asset('')}}', param, function(ret){
                        if(ret.result){
                            layer.msg(ret.msg, {icon: 1, time: 2000});
                        }
                        else{
                            layer.msg(ret.msg, {icon: 2, time: 2000});
                        }
                    })
                    //倒计时
                    document.resetByPhonenum.send.disabled=true;
                    var t=60;
                    for(i=1;i<=t;i++) {
                        window.setTimeout("update_p(" + i + ","+t+")", i * 1000);
                    }
                }
                else{
                    layer.msg('请填写手机号', {icon: 2, time: 2000});
                }
            }
            else{
                layer.msg('请正确填写手机号', {icon: 2, time: 2000});
            }
        }

        function update_p(num,t) {
            if(num == t) {
                document.signUpByEmail.send.value =" 重新发送 ";
                document.resetByPhonenum.send.disabled=false;
            }
            else {
                printnr = t-num;
                document.resetByPhonenum.send.value = " (" + printnr +")秒后重新发送";
            }
        }
    </script>
@endsection