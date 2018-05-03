@extends('home.layouts.base')
@section('seo')
    <title>{{$channel['seo_title']?$channel['seo_title']:$common['base']['seo_title']}}</title>
    <meta name="keywords" content="{{$channel['seo_keywords']?$channel['seo_keywords']:$common['base']['seo_keywords']}}" />
    <meta name="description" content="{{$channel['seo_description']?$channel['seo_description']:$common['base']['seo_description']}}" />
@endsection
@section('content')
<div id="main-body">
    <div class="style-home-nav-station"></div>
    <div class="height-80"></div>
    @include('home.layouts.search')
    @include('home.layouts.banner')
    <div class="container margin-bottom-20" id="goods_lists">
        @foreach($menus as $menu)
            @if(count($menu['machining_goodses'])>0)
            <div class="margin-top-10 line-height-30">
                <div class="col-xs-6 col-sm-8 padding-left-0 letter-spacing-2">
                    <span class="font-size-18 border-bottom-title">
                        {{$menu['name']}}
                    </span>
                </div>
                <div class="col-xs-6 col-sm-4 text-right">
                    <span class="text-red margin-right-10">
                        热销
                    </span>
                    <span>
                        <a href="{{URL::asset($column.'/lists/'.$menu['id'])}}">
                            更多
                        </a>
                    </span>
                </div>
            </div>
            <div class="clear"></div>
            <div class="row goods-lists-card margin-bottom-20 margin-top-10 letter-spacing-2">
                @foreach($menu['machining_goodses'] as $machining_goods)
                    @if($machining_goods['type']==0)
                        <div class="col-xs-12 col-sm-3 padding-top-10 padding-right-10 padding-left-10">
                            <a href="{{URL::asset($column.'/detail/machining/'.$machining_goods['id'])}}">
                                <div class="text-center padding-bottom-10 padding-right-10 padding-left-10 border-box padding-top-10">
                                    <div class="goods-lists-picture margin-top-10">
                                        <img class="img-circle" src="{{$machining_goods['picture']}}" alt="{{$machining_goods['name']}}">
                                    </div>
                                    <h3 class="style-ellipsis-1 font-size-20 line-height-25">{{$machining_goods['name']}}</h3>
                                    @if($machining_goods['goods_attribute']['accuracy'])
                                        <h5 class="style-ellipsis-1">精度：{{$machining_goods['goods_attribute']['accuracy']}}</h5>
                                    @else
                                        <h5 class="style-ellipsis-1">精度暂无</h5>
                                    @endif
                                    <a href="tencent://message/?Menu=yes&uin={{$service['qq']}}&Service=300&sigT=45a1e5847943b64c6ff3990f8a9e644d2b31356cb0b4ac6b24663a3c8dd0f8aa12a595b1714f9d45">
                                    <button type="button" class="btn btn-default margin-top-10 margin-bottom-10 background-none">立 即 咨 询</button>
                                    </a>
                                </div>
                            </a>
                        </div>
                    @else
                        <div class="col-xs-12 col-sm-3 padding-top-10 padding-right-10 padding-left-10">
                            <a href="{{URL::asset($column.'/detail/standard/'.$machining_goods['id'])}}">
                                <div class="text-center padding-bottom-10 padding-right-10 padding-left-10 border-box padding-top-10">
                                    <div class="goods-lists-picture">
                                        <img class="img-circle" src="{{$machining_goods['picture']}}" alt="{{$machining_goods['name']}}">
                                    </div>
                                    @if($machining_goods['goods_attribute']['size'])
                                        <h3 class="style-ellipsis-1 font-size-20 line-height-25">尺寸：{{$machining_goods['goods_attribute']['size']}}</h3>
                                    @else
                                        <h3 class="style-ellipsis-1 font-size-20 line-height-25">尺寸暂无</h3>
                                    @endif
                                    <h5 class="style-ellipsis-1">{{$machining_goods['name']}}</h5>
                                    <button type="button" class="btn btn-default margin-top-10 margin-bottom-10 background-none text-red">￥{{$machining_goods['price']/100}}&nbsp;/{{$machining_goods['unit']}}</button>
                                </div>
                            </a>
                        </div>
                    @endif
                @endforeach
            </div>
            @endif
        @endforeach
    </div>
</div>
@endsection

@section('script')
<script id="machining_uplaod_template" type="text/x-dot-template">
    @{{~ it:item:index }}
    <div class="col-sm-12 col-md-4 margin-top-10 margin-bottom-10">
        <img src="@{{=item}}" class="width-100 height-80"/>
        <input type="hidden" name="upload_@{{=index}}" />
        {{--<button type="button" class="btn btn-danger width-100" onclick="deleteUploadImage('@{{=index}}')">移 除</button>--}}
        <button type="button" class="btn btn-default width-100" onclick="deleteUploadImage('@{{=index}}')">移 除</button>
    </div>
    @{{~ }}
</script>
<script type="text/javascript">
    var uploadImages=new Array();
    $(function(){
        //获取七牛token
        initQNUploader();
    })
    //初始化七牛上传模块
    function initQNUploader() {
        var uploader = Qiniu.uploader({
            runtimes: 'html5,flash,html4',      // 上传模式，依次退化
            browse_button: 'uploadImage',         // 上传选择的点选按钮，必需
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
                    // $("#picture").val(sourceLink);
                    // $("#imagePrv").attr('src', qiniuUrlTool(sourceLink, "head_icon"));
                    uploadImages.push(sourceLink);
                    console.log('uploadImages is : '+JSON.stringify(uploadImages));
                    machiningUplaodHtml(uploadImages)
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
    function deleteUploadImage(index){
        uploadImages.splice(index,1);
        console.log('uploadImages is : '+JSON.stringify(uploadImages));
        machiningUplaodHtml(uploadImages);
    }
    function machiningUplaodHtml(data){
        $('#machining_uplaod').html('');
        var interText = doT.template($("#machining_uplaod_template").text())
        $("#machining_uplaod").append(interText(data))
    }
    $('#uploadMachiningImagesDo').click(function(){
        var param = {
            uploadImages: uploadImages,
            _token: "{{ csrf_token() }}"
        }
        uploadMachiningImages('{{URL::asset('')}}', param, function (ret) {
            if (ret.result == true) {
                layer.msg(ret.msg, {icon: 1, time: 1000});
                setTimeout(function () {
                    window.location.reload();
                }, 1000)
            } else {
                if(ret.code==9999){
                    location.href='{{URL::asset('signIn')}}';
                }
                else{
                    layer.msg(ret.msg, {icon: 2, time: 3000})
                }
            }
        })
    })
</script>
@endsection