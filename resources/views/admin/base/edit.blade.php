@extends('admin.layouts.app')

@section('content')
    <div class="page-container">
        <div id="tab-system" class="HuiTab">
            <div class="tabBar clearfix">
                <span>网站基本信息</span>
                <span>关于我们设置</span>
                <span>首页SEO设置</span>
                <span>补差价商品链接</span>
            </div>
            <div class="tabCon">
                <form class="form form-horizontal" method="post" id="form-baseInfo-edit">
                    {{csrf_field()}}
                    <div class="row cl">
                        <label class="form-label col-xs-4 col-sm-2"><span class="c-red">*</span>公司名称：</label>
                        <div class="formControls col-xs-8 col-sm-9">
                            <input id="name" name="name" type="text" class="input-text" value="{{ isset($data['name']) ? $data['name'] : '' }}" placeholder="请输入公司名称">
                        </div>
                    </div>
                    <div class="row cl" id="container_logo">
                        <label class="form-label col-xs-4 col-sm-2"><span class="c-red">*</span>LOGO上传：</label>
                        <div class="formControls col-xs-8 col-sm-9">
                            @if($data['logo'])
                                <img id="logoPrv" src="{{$data['logo'] }}" width="154" />
                            @else
                                <img id="logoPrv" src="{{ URL::asset('/img/upload.png') }}" width="154" />
                            @endif
                            <span class="c-red">*请上传154*105尺寸的图片</span>
                            <input type="hidden" class="input-text" id="logo" name="logo" value="{{ isset($data['logo']) ? $data['logo'] : '' }}"  />
                        </div>
                    </div>
                    <div class="row cl" id="container_logo_page">
                        <label class="form-label col-xs-4 col-sm-2"><span class="c-red">*</span>内页LOGO上传：</label>
                        <div class="formControls col-xs-8 col-sm-9">
                            @if($data['logo_page'])
                                <img id="logoPagePrv" src="{{$data['logo_page'] }}" width="180" />
                            @else
                                <img id="logoPagePrv" src="{{ URL::asset('/img/upload.png') }}" width="180" />
                            @endif
                            <span class="c-red">*请上传180*32尺寸的图片</span>
                            <input type="hidden" class="input-text" id="logo_page" name="logo_page" value="{{ isset($data['logo_page']) ? $data['logo_page'] : '' }}"  />
                        </div>
                    </div>
                    <div class="row cl">
                        <label class="form-label col-xs-4 col-sm-2"><span class="c-red">*</span>邮件：</label>
                        <div class="formControls col-xs-8 col-sm-9">
                            <input id="email" name="email" type="email" class="input-text" value="{{ isset($data['email']) ? $data['email'] : '' }}" placeholder="请输入邮件">
                        </div>
                    </div>
                    <div class="row cl">
                        <label class="form-label col-xs-4 col-sm-2"><span class="c-red">*</span>电话：</label>
                        <div class="formControls col-xs-8 col-sm-9">
                            <input id="phonenum" name="phonenum" type="text" class="input-text" value="{{ isset($data['phonenum']) ? $data['phonenum'] : '' }}" placeholder="请输入电话">
                        </div>
                    </div>
                    <div class="row cl">
                        <label class="form-label col-xs-4 col-sm-2"><span class="c-red">*</span>QQ：</label>
                        <div class="formControls col-xs-8 col-sm-9">
                            <input id="qq" name="qq" type="text" class="input-text" value="{{ isset($data['qq']) ? $data['qq'] : '' }}" placeholder="请输入QQ号">
                        </div>
                    </div>
                    <div class="row cl">
                        <label class="form-label col-xs-4 col-sm-2"><span class="c-red">*</span>公司地址：</label>
                        <div class="formControls col-xs-8 col-sm-9">
                            <input id="address" name="address" type="text" class="input-text" value="{{ isset($data['address']) ? $data['address'] : '' }}" placeholder="请输入公司地址">
                        </div>
                    </div>
                    <div class="row cl">
                        <label class="form-label col-xs-4 col-sm-2"><span class="c-red">*</span>网站服务时间：</label>
                        <div class="formControls col-xs-8 col-sm-9">
                            <input id="time" name="time" type="text" class="input-text" value="{{ isset($data['time']) ? $data['time'] : '' }}" placeholder="请输入网站服务时间">
                        </div>
                    </div>
                    <div class="row cl">
                        <label class="form-label col-xs-4 col-sm-2"><span class="c-red">*</span>版权信息：</label>
                        <div class="formControls col-xs-8 col-sm-9">
                            <input id="copyright" name="copyright" type="text" class="input-text" value="{{ isset($data['copyright']) ? $data['copyright'] : '' }}" placeholder="请输入版权信息">
                        </div>
                    </div>
                    <div class="row cl">
                        <label class="form-label col-xs-4 col-sm-2"><span class="c-red">*</span>备案号：</label>
                        <div class="formControls col-xs-8 col-sm-9">
                            <input id="number" name="number" type="text" class="input-text" value="{{ isset($data['number']) ? $data['number'] : '' }}" placeholder="请输入备案号">
                        </div>
                    </div>
                    <div class="row cl">
                        <div class="col-xs-8 col-sm-9 col-xs-offset-4 col-sm-offset-2">
                            <button class="btn btn-primary radius" type="submit"><i class="Hui-iconfont">&#xe632;</i> 保存</button>
                            <button onClick="layer_close();" class="btn btn-default radius" type="button">取消</button>
                        </div>
                    </div>
                </form>
            </div>
            <div class="tabCon">
                <form class="form form-horizontal" method="post" id="form-baseAbout-edit">
                    {{csrf_field()}}
                    <div class="row cl" id="container">
                        <label class="form-label col-xs-4 col-sm-2"><span class="c-red">*</span>图片上传：</label>
                        <div class="formControls col-xs-8 col-sm-9">
                            @if($data['picture'])
                                <img id="imagePrv" src="{{$data['picture'] }}" width="210" />
                            @else
                                <img id="imagePrv" src="{{ URL::asset('/img/upload.png') }}" width="210" />
                            @endif
                            <span class="c-red">*请上传330*225的尺寸图片</span>
                            <input type="hidden" class="input-text" id="picture" name="picture" value="{{ isset($data['picture']) ? $data['picture'] : '' }}"  />
                        </div>
                    </div>
                    <div class="row cl">
                        <label class="form-label col-xs-4 col-sm-2"><span class="c-red">*</span>内容：</label>
                        <div class="formControls col-xs-8 col-sm-9">
                            <textarea  id="content" name="content" wrap="\n" class="textarea" style="resize:vertical;" placeholder="请填写内容" dragonfly="true" nullmsg="内容不能为空！">{{ isset($data['content']) ? $data['content'] : '' }}</textarea>
                        </div>
                    </div>
                    <div class="row cl">
                        <div class="col-xs-8 col-sm-9 col-xs-offset-4 col-sm-offset-2">
                            <button class="btn btn-primary radius" type="submit"><i class="Hui-iconfont">&#xe632;</i> 保存</button>
                            <button onClick="layer_close();" class="btn btn-default radius" type="button">取消</button>
                        </div>
                    </div>
                </form>
            </div>
            <div class="tabCon">
                <form class="form form-horizontal" method="post" id="form-baseSeo-edit">
                    {{csrf_field()}}
                    <div class="row cl">
                        <label class="form-label col-xs-4 col-sm-2"><span class="c-red">*</span>SEO_标题：</label>
                        <div class="formControls col-xs-8 col-sm-9">
                            <textarea  id="seo_title" name="seo_title" wrap="\n" class="textarea" style="resize:vertical;" placeholder="请填写SEO_标题" dragonfly="true" nullmsg="SEO_标题不能为空！">{{ isset($data['seo_title']) ? $data['seo_title'] : '' }}</textarea>
                        </div>
                    </div>
                    <div class="row cl">
                        <label class="form-label col-xs-4 col-sm-2"><span class="c-red">*</span>SEO_关键字：</label>
                        <div class="formControls col-xs-8 col-sm-9">
                            <textarea  id="seo_keywords" name="seo_keywords" wrap="\n" class="textarea" style="resize:vertical;" placeholder="请填写SEO_关键字" dragonfly="true" nullmsg="SEO_关键字不能为空！">{{ isset($data['seo_keywords']) ? $data['seo_keywords'] : '' }}</textarea>
                        </div>
                    </div>
                    <div class="row cl">
                        <label class="form-label col-xs-4 col-sm-2"><span class="c-red">*</span>SEO_描述：</label>
                        <div class="formControls col-xs-8 col-sm-9">
                            <textarea  id="seo_description" name="seo_description" wrap="\n" class="textarea" style="resize:vertical;" placeholder="请填写SEO_描述" dragonfly="true" nullmsg="SEO_描述不能为空！">{{ isset($data['seo_description']) ? $data['seo_description'] : '' }}</textarea>
                        </div>
                    </div>
                    <div class="row cl">
                        <div class="col-xs-8 col-sm-9 col-xs-offset-4 col-sm-offset-2">
                            <button class="btn btn-primary radius" type="submit"><i class="Hui-iconfont">&#xe632;</i> 保存</button>
                            <button onClick="layer_close();" class="btn btn-default radius" type="button">取消</button>
                        </div>
                    </div>
                </form>
            </div>
            <div class="tabCon">
                <form class="form form-horizontal" method="post">
                    <div class="row cl">
                        <label class="form-label col-xs-4 col-sm-2">商品链接：</label>
                        <div class="formControls col-xs-8 col-sm-9">
                            <input type="text" readonly class="input-text no_click" value="http://{{$_SERVER['SERVER_NAME']}}/differenceGoods" />
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
            $("#tab-system").Huitab({
                index:0
            });
            //编辑网站基本信息
            $("#form-baseInfo-edit").validate({
                rules: {
                    name: {
                        required: true,
                    },
                    phonenum:{
                        required:true,
                    },
                    email:{
                        required:true,
                        email:true
                    },
                    qq: {
                        required: true,
                    },
                    address: {
                        required: true,
                    },
                    time: {
                        required: true,
                    },
                    copyright: {
                        required: true,
                    },
                    number: {
                        required: true,
                    },
                },
                onkeyup: false,
                focusCleanup: false,
                success: "valid",
                submitHandler: function (form) {
                    $(form).ajaxSubmit({
                        type: 'POST',
                        url: "{{ URL::asset('/admin/baseInfo/edit')}}",
                        success: function (ret) {
                            console.log(JSON.stringify(ret));
                            if (ret.result) {
                                layer.msg(ret.msg, {icon: 1, time: 2000});
                            } else {
                                layer.msg(ret.msg, {icon: 2, time: 2000});
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

            });
            //编辑关于我们
            $("#form-baseAbout-edit").validate({
                rules: {
                    picture: {
                        required: true,
                    },
                    content:{
                        required:true,
                    },
                },
                onkeyup: false,
                focusCleanup: false,
                success: "valid",
                submitHandler: function (form) {
                    $(form).ajaxSubmit({
                        type: 'POST',
                        url: "{{ URL::asset('/admin/baseAbout/edit')}}",
                        success: function (ret) {
                            console.log(JSON.stringify(ret));
                            if (ret.result) {
                                layer.msg(ret.msg, {icon: 1, time: 2000});
                            } else {
                                layer.msg(ret.msg, {icon: 2, time: 2000});
                            }
                        },
                        error: function (XmlHttpRequest, textStatus, errorThrown) {
                            layer.msg('保存失败', {icon: 1, time: 2000});
                            console.log("XmlHttpRequest:" + JSON.stringify(XmlHttpRequest));
                            console.log("textStatus:" + textStatus);
                            console.log("errorThrown:" + errorThrown);
                        }
                    });
                }

            });
            //编辑SEO
            $("#form-baseSeo-edit").validate({
                rules: {
                    seo_title: {
                        required: true,
                    },
                    seo_keywords:{
                        required:true,
                    },
                    seo_description:{
                        required:true,
                    },
                },
                onkeyup: false,
                focusCleanup: false,
                success: "valid",
                submitHandler: function (form) {
                    $(form).ajaxSubmit({
                        type: 'POST',
                        url: "{{ URL::asset('/admin/baseSeo/edit')}}",
                        success: function (ret) {
                            console.log(JSON.stringify(ret));
                            if (ret.result) {
                                layer.msg(ret.msg, {icon: 1, time: 2000});
                            } else {
                                layer.msg(ret.msg, {icon: 2, time: 2000});
                            }
                        },
                        error: function (XmlHttpRequest, textStatus, errorThrown) {
                            layer.msg('保存失败', {icon: 1, time: 2000});
                            console.log("XmlHttpRequest:" + JSON.stringify(XmlHttpRequest));
                            console.log("textStatus:" + textStatus);
                            console.log("errorThrown:" + errorThrown);
                        }
                    });
                }

            });
        });
        //初始化七牛上传模块
        function initQNUploader() {
            var uploader_logo = Qiniu.uploader({
                runtimes: 'html5,flash,html4',      // 上传模式，依次退化
                browse_button: 'logoPrv',         // 上传选择的点选按钮，必需
                container: 'container_logo',//上传按钮的上级元素ID
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
                drop_element: 'container_logo',          // 拖曳上传区域元素的ID，拖曳文件或文件夹后可触发上传
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
                        $("#logo").val(sourceLink);
                        $("#logoPrv").attr('src', qiniuUrlTool(sourceLink, "head_icon"));
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
            var uploader_logo_page = Qiniu.uploader({
                runtimes: 'html5,flash,html4',      // 上传模式，依次退化
                browse_button: 'logoPagePrv',         // 上传选择的点选按钮，必需
                container: 'container_logo_page',//上传按钮的上级元素ID
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
                drop_element: 'container_logo_page',          // 拖曳上传区域元素的ID，拖曳文件或文件夹后可触发上传
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
                        $("#logo_page").val(sourceLink);
                        $("#logoPagePrv").attr('src', qiniuUrlTool(sourceLink, "head_icon"));
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
                        $("#picture").val(sourceLink);
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