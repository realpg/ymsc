@extends('home.layouts.base')

@section('content')
<div id="main-body">
    <div class="style-home-nav-station"></div>
    <div class="container margin-top-20 margin-bottom-20">
        @include('home.layouts.center')
        <div class="col-xs-12 col-sm-10 border-center-menu padding-top-10 padding-bottom-10  line-height-34" id="center-content">
            <div class="member-nav">
                <span class="font-size-16"><b>修改绑定的邮箱</b></span>
            </div>
            <form method="post" id="form-email-edit"  name="checkEmail">
                {{ csrf_field() }}
                <input type="hidden" name="type" id="type" class="form-control" value="checkEmail" readonly>
                <div class="col-xs-12 col-sm-8">
                    <div class="row position-relative margin-top-20">
                        <div class="col-xs-4 col-sm-3 text-right">原 邮 箱：</div>
                        <div class="col-xs-8 col-sm-8">
                            <input type="text" name="email" id="email" class="form-control not-click" value="{{$user['email']}}" readonly />
                        </div>
                    </div>
                    <div class="row position-relative margin-top-20">
                        <div class="col-xs-4 col-sm-3 text-right">验 证 码：</div>
                        <div class="col-xs-8 col-sm-8">
                            <input type="text" name="verificationCode" id="verificationCode" class="form-control width-55 float-left" placeholder="请输入验证码">
                            <input type="button" class="btn btn-warning width-40 float-right" value="获取验证码"  name="send" onclick="showtime()">
                        </div>
                    </div>
                    <div class="row position-relative margin-top-20 margin-bottom-20">
                        <div class="col-xs-4 col-sm-3 text-right"></div>
                        <div class="col-xs-8 col-sm-8">
                            <button type="submint" class="btn btn-info border-radius-0">下 一 步</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('script')
    <script type="text/javascript">
        $(function () {
            $("#form-email-edit").validate({
                rules: {
                    email:{
                        required:true,
                        email:true
                    },
                },
                onkeyup: false,
                focusCleanup: false,
                success: "valid",
                submitHandler: function (form) {
                    $(form).ajaxSubmit({
                        type: 'POST',
                        url: "{{ URL::asset('center/check')}}",
                        success: function (ret) {
                            console.log(JSON.stringify(ret));
                            if (ret.result) {
                                layer.msg(ret.msg, {icon: 1, time: 2000});
                                setTimeout(function () {
                                    location.href="{{ URL::asset('center/email/replace')}}";
                                }, 1000)
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

            });
        });
        function showtime(){
            var email=$('#email').val();
            if(isEmail(email)){
                if(email){
                    var param={
                        _token: "{{ csrf_token() }}",
                        email:email,
                    }
                    sendEmailCode('{{URL::asset('')}}', param, function(ret){
                        if(ret.result){
                            layer.msg(ret.msg, {icon: 1, time: 2000});
                        }
                        else{
                            layer.msg(ret.msg, {icon: 2, time: 2000});
                        }
                    })
                    //倒计时
                    document.checkEmail.send.disabled=true;
                    var t=60;
                    for(i=1;i<=t;i++) {
                        window.setTimeout("update_p(" + i + ","+t+")", i * 1000);
                    }
                }
                else{
                    layer.msg('请填写邮箱', {icon: 2, time: 2000});
                }
            }
            else{
                layer.msg('请正确填写邮箱', {icon: 2, time: 2000});
            }
        }

        function update_p(num,t) {
            if(num == t) {
                document.checkEmail.send.value =" 重新发送 ";
                document.checkEmail.send.disabled=false;
            }
            else {
                printnr = t-num;
                document.checkEmail.send.value = " (" + printnr +")秒后重新发送";
            }
        }
    </script>
@endsection