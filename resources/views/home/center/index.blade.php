@extends('home.layouts.base')

@section('content')
<div id="main-body">
    <div class="style-home-nav-station"></div>
    <div class="container margin-top-20 margin-bottom-20">
        @include('home.layouts.center')
        <div class="col-xs-12 col-sm-10 border-center-menu padding-top-10 padding-bottom-10  line-height-34" id="center-content">
            <div class="member-nav">
                <span class="font-size-16"><b>个人信息</b></span>
            </div>
            <form method="post" id="form-center-edit">
                {{ csrf_field() }}
                <div class="col-xs-12 col-sm-8">
                    <div class="row position-relative margin-top-20">
                        <div class="col-xs-6 col-sm-3 text-right">昵 称：</div>
                        <div class="col-xs-6 col-sm-8">
                            <input type="text" name="nick_name" id="nick_name" class="form-control" value="{{$user['nick_name']}}" placeholder="请输入昵称">
                        </div>
                    </div>
                    <div class="row position-relative margin-top-20">
                        <div class="col-xs-6 col-sm-3 text-right">真 实 姓 名：</div>
                        <div class="col-xs-6 col-sm-8">
                            <input type="text" name="real_name" id="real_name" value="{{$user['real_name']}}" class="form-control" placeholder="请输入真实姓名">
                        </div>
                    </div>
                    <div class="row position-relative margin-top-20">
                        <div class="col-xs-6 col-sm-3 text-right">手 机 号：</div>
                        <div class="col-xs-6 col-sm-8">
                            @if($user['phonenum'])
                                {{$user['phonenum']}} <a href="{{ URL::asset('center/phonenum/check')}}"><span class="text-blue">修改绑定手机号</span></a>
                            @else
                                <a href="{{ URL::asset('center/phonenum/replace')}}"><span class="text-blue">绑定手机号</span></a>
                            @endif
                        </div>
                    </div>
                    <div class="row position-relative margin-top-20">
                        <div class="col-xs-6 col-sm-3 text-right" style="line-height: 34px;">邮 箱：</div>
                        <div class="col-xs-6 col-sm-8">
                            @if($user['email'])
                                {{$user['email']}} <a href="{{ URL::asset('center/email/check')}}"><span class="text-blue">修改绑定的邮箱</span></a>
                            @else
                                <a href="{{ URL::asset('center/email/replace')}}"><span class="text-blue">绑定邮箱</span></a>
                            @endif
                        </div>
                    </div>
                    @if(!$user['web_openid'])
                        <div class="row position-relative margin-top-20">
                            <div class="col-xs-6 col-sm-3 text-right" style="line-height: 34px;">微 信 绑 定：</div>
                            <div class="col-xs-6 col-sm-8">
                                绑定微信后，可以通过微信扫描二维码进行登录。
                            </div>bang
                        </div>
                    @endif
                    <div class="row position-relative margin-top-20">
                        <div class="col-xs-6 col-sm-3 text-right">Q Q：</div>
                        <div class="col-xs-6 col-sm-8">
                            <input type="text" name="qq" id="qq" value="{{$user['qq']}}" class="form-control" placeholder="请输入QQ号">
                        </div>
                    </div>
                    <div class="row position-relative margin-top-20">
                        <div class="col-xs-6 col-sm-3 text-right">微 信 号：</div>
                        <div class="col-xs-6 col-sm-8">
                            <input type="text" name="wechat" id="wechat" value="{{$user['wechat']}}" class="form-control" placeholder="请输入微信号">
                        </div>
                    </div>
                    <div class="row position-relative margin-top-20">
                        <div class="col-xs-6 col-sm-3 text-right">性 别：</div>
                        <div class="col-xs-6 col-sm-8">
                            <input type="radio" name="gender" id="gender_1" value="1" {{$user['gender']==1?'checked':''}} />&nbsp; 男&nbsp;
                            <input type="radio" name="gender" id="gender_2" value="2" {{$user['gender']==2?'checked':''}} />&nbsp; 女
                        </div>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-2">
                    <div class="margin-top-20 text-center" id="container">
                        <div class="width-150 flex-auto">
                            @if($user['avatar'])
                                <img src="{{$user['avatar']}}" id="imagePrv" class="width-150 height-150 border-radius-100" />
                            @else
                                @if($user['gender']==2)
                                    <img src="{{URL::asset('img/avatar_girl.png')}}" id="imagePrv" class="width-150 height-150 border-radius-100" />
                                @else
                                    <img src="{{URL::asset('img/avatar_boy.png')}}" id="imagePrv" class="width-150 height-150 border-radius-100" />
                                @endif
                            @endif
                            <input type="hidden" name="avatar" id="avatar" value="{{$user['avatar']}}" />
                            <div class="margin-top-10">
                                点击图片上传头像
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-8">
                    <div class="row position-relative margin-top-20 margin-bottom-20">
                        <div class="col-xs-3 col-sm-3 text-right"></div>
                        <div class="col-xs-9 col-sm-8">
                            <button type="submint" class="btn btn-info border-radius-0">确 认 修 改</button>
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
            //获取七牛token
            initQNUploader();
            $("#form-center-edit").validate({
                onkeyup: false,
                focusCleanup: false,
                success: "valid",
                submitHandler: function (form) {
                    var nick_name=$('#nick_name').val();
                    if(!nick_name){
                        layer.msg('请输入昵称', {icon: 2, time: 2000});
                        $('#nick_name').focus();
                    }
                    else{
                        $(form).ajaxSubmit({
                            type: 'POST',
                            url: "{{ URL::asset('center/base')}}",
                            success: function (ret) {
                                console.log(JSON.stringify(ret));
                                if (ret.result) {
                                    layer.msg(ret.msg, {icon: 1, time: 2000});
                                    window.location.reload()
                                } else {
                                    if(ret.code==9999){
                                        location.href='{{URL::asset('signIn')}}';
                                    }
                                    else{
                                        layer.msg(ret.msg, {icon: 2, time: 3000})
                                    }
                                }
                            },
                            error: function (XmlHttpRequest, textStatus, errorThrown) {
                                layer.msg('保存失败', {icon: 2, time: 2000});
                                console.log("XmlHttpRequest:" + JSON.stringify(XmlHttpRequest));
                                console.log("textStatus:" + textStatus);
                                console.log("errorThrown:" + errorThrown);
                            }
                        });
                    }
                }

            });
        });
        //初始化七牛上传模块
        function initQNUploader() {
            var uploader = Qiniu.uploader({
                runtimes: 'html5,flash,html4',      // 上传模式，依次退化
                browse_button: 'imagePrv',         // 上传选择的点选按钮，必需
                container: 'container',//上传按钮的上级元素ID
                // 在初始化时，uptoken，uptoken_url，uptoken_func三个参数中必须有一个被设置
                // 切如果提供了多个，其优先级为uptoken > uptoken_url > uptoken_func
                // 其中uptoken是直接提供上传凭证，uptoken_url是提供了获取上传凭证的地址，如果需要定制获取uptoken的过程则可以设置uptoken_func
                uptoken: "{{$upload_token}}", // uptoken是上传凭证，由其他程序生成
                // uptoken_url: '/uptoken',         // Ajax请求uptoken的Url，强烈建议设置（服务端提供）
                // uptoken_func: function(file){    // 在需要获取uptoken时，该方法会被调用
                //    // do something
                //    return uptoken;
                // },
                get_new_uptoken: false,             // 设置上传文件的时候是否每次都重新获取新的uptoken
                // downtoken_url: '/downtoken',
                // Ajax请求downToken的Url，私有空间时使用，JS-SDK将向该地址POST文件的key和domain，服务端返回的JSON必须包含url字段，url值为该文件的下载地址
                unique_names: true,              // 默认false，key为文件名。若开启该选项，JS-SDK会为每个文件自动生成key（文件名）
                // save_key: true,                  // 默认false。若在服务端生成uptoken的上传策略中指定了sava_key，则开启，SDK在前端将不对key进行任何处理
                domain: 'http://dsyy.isart.me/',     // bucket域名，下载资源时用到，必需
                max_file_size: '100mb',             // 最大文件体积限制
                flash_swf_url: 'path/of/plupload/Moxie.swf',  //引入flash，相对路径
                max_retries: 3,                     // 上传失败最大重试次数
                dragdrop: true,                     // 开启可拖曳上传
                drop_element: 'container',          // 拖曳上传区域元素的ID，拖曳文件或文件夹后可触发上传
                chunk_size: '4mb',                  // 分块上传时，每块的体积
                auto_start: true,                   // 选择文件后自动上传，若关闭需要自己绑定事件触发上传
                //x_vars : {
                //    查看自定义变量
                //    'time' : function(up,file) {
                //        var time = (new Date()).getTime();
                // do something with 'time'
                //        return time;
                //    },
                //    'size' : function(up,file) {
                //        var size = file.size;
                // do something with 'size'
                //        return size;
                //    }
                //},
                init: {
                    'FilesAdded': function (up, files) {
                        plupload.each(files, function (file) {
                            // 文件添加进队列后，处理相关的事情
//                                            alert(alert(JSON.stringify(file)));
                        });
                    },
                    'BeforeUpload': function (up, file) {
                        // 每个文件上传前，处理相关的事情
//                        console.log("BeforeUpload up:" + up + " file:" + JSON.stringify(file));
                    },
                    'UploadProgress': function (up, file) {
                        // 每个文件上传时，处理相关的事情
//                        console.log("UploadProgress up:" + up + " file:" + JSON.stringify(file));
                    },
                    'FileUploaded': function (up, file, info) {
                        // 每个文件上传成功后，处理相关的事情
                        // 其中info是文件上传成功后，服务端返回的json，形式如：
                        // {
                        //    "hash": "Fh8xVqod2MQ1mocfI4S4KpRL6D98",
                        //    "key": "gogopher.jpg"
                        //  }
//                        console.log(JSON.stringify(info));
                        var domain = up.getOption('domain');
                        var res = JSON.parse(info);
                        //获取上传成功后的文件的Url
                        var sourceLink = domain + res.key;
                        $("#avatar").val(sourceLink);
                        $("#imagePrv").attr('src', qiniuUrlTool(sourceLink, "head_icon"));
                        // console.log($("#pickfiles").attr('src'));
                    },
                    'Error': function (up, err, errTip) {
                        //上传出错时，处理相关的事情
                        console.log(err + errTip);
                    },
                    'UploadComplete': function () {
                        //队列文件处理完毕后，处理相关的事情
                    },
                    'Key': function (up, file) {
                        // 若想在前端对每个文件的key进行个性化处理，可以配置该函数
                        // 该配置必须要在unique_names: false，save_key: false时才生效

                        var key = "";
                        // do something with key here
                        return key
                    }
                }
            });
        }
    </script>
@endsection