@extends('admin.layouts.app')

@section('content')
    <div class="page-container">
        <form class="form form-horizontal" method="post" id="form-machining-editMachining">
            {{csrf_field()}}
            <div class="row cl hidden">
                <label class="form-label col-xs-4 col-sm-2"><span class="c-red">*</span>id：</label>
                <div class="formControls col-xs-8 col-sm-9">
                    <input id="id" name="id" type="text" class="input-text"
                           value="{{ isset($data['id']) ? $data['id'] : '' }}" placeholder="id">
                </div>
            </div>
            <div class="row cl hidden">
                <label class="form-label col-xs-4 col-sm-2"><span class="c-red">*</span>id：</label>
                <div class="formControls col-xs-8 col-sm-9">
                    <input id="goods_id" name="goods_id" type="text" class="input-text"
                           value="{{ isset($data['id']) ? $data['id'] : '' }}" placeholder="goods_id">
                </div>
            </div>
            <div id="tab-system" class="HuiTab">
                <div class="tabBar clearfix">
                    <span>基本信息</span>
                    <span>详细信息</span>
                    <span>属性配置</span>
                    <span>案例编辑</span>
                </div>
                <div class="tabCon">
                    <div class="row cl">
                        <label class="form-label col-xs-4 col-sm-2"><span class="c-red">*</span>栏目：</label>
                        <div class="formControls col-xs-8 col-sm-9">
                            <span class="select-box">
                                <select id="menu_id" name="menu_id" class="select">
                                    @foreach($menus as $menu)
                                        @if($menu['id']==$data['menu_id'])
                                            <option value="{{$menu['id']}}" selected >{{$menu['name']}}</option>
                                        @else
                                            <option value="{{$menu['id']}}" >{{$menu['name']}}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </span>
                        </div>
                    </div>
                    <div class="row cl" id="container">
                        <label class="form-label col-xs-4 col-sm-2"><span class="c-red">*</span>图片上传：</label>
                        <div class="formControls col-xs-8 col-sm-9">
                            @if($data['picture'])
                                <img id="imagePrv" src="{{$data['picture'] }}" width="210" />
                            @else
                                <img id="imagePrv" src="{{ URL::asset('/img/upload.png') }}" width="210" />
                            @endif
                            <span class="c-red">*请上传180*180尺寸的图片</span>
                            <input type="hidden" class="input-text" id="picture" name="picture" value="{{ isset($data['picture']) ? $data['picture'] : '' }}"  />
                        </div>
                    </div>
                    <div class="row cl">
                        <label class="form-label col-xs-4 col-sm-2"><span class="c-red">*</span>商品名称：</label>
                        <div class="formControls col-xs-8 col-sm-9">
                            <input id="name" name="name" type="text" class="input-text" value="{{ isset($data['name']) ? $data['name'] : '' }}" placeholder="请输入商品名称">
                        </div>
                    </div>
                    @if(isset($data['id']))
                        <div class="row cl">
                            <label class="form-label col-xs-4 col-sm-2"><span class="c-red">*</span>商品货号：</label>
                            <div class="formControls col-xs-8 col-sm-9">
                                <input type="text" class="input-text no_click" readonly value="{{ isset($data['number']) ? $data['number'] : '' }}">
                            </div>
                        </div>
                        <div class="row cl">
                            <label class="form-label col-xs-4 col-sm-2"><span class="c-red">*</span>类型：</label>
                            <div class="formControls col-xs-8 col-sm-9">
                                <input type="text" class="input-text no_click" readonly value="机加工类型">
                            </div>
                        </div>
                    @endif
                    <div class="row cl">
                        <label class="form-label col-xs-4 col-sm-2"><span class="c-red">*</span>售价（分）：</label>
                        <div class="formControls col-xs-8 col-sm-9">
                            <input id="price" name="price" type="text" class="input-text" value="{{ isset($data['price']) ? $data['price'] : '' }}" placeholder="请输入售价,以“分”为单位">
                        </div>
                    </div>
                    <div class="row cl">
                        <label class="form-label col-xs-4 col-sm-2"><span class="c-red">*</span>商品单位：</label>
                        <div class="formControls col-xs-8 col-sm-9">
                            <input id="unit" name="unit" type="text" class="input-text" value="{{ isset($data['unit']) ? $data['unit'] : '' }}" placeholder="请输入价格单位">
                        </div>
                    </div>
                    <div class="row cl">
                        <label class="form-label col-xs-4 col-sm-2"><span class="c-red">*</span>制造工业分类：</label>
                        <div class="formControls col-xs-8 col-sm-9">
                            <span class="select-box">
                                <select id="f_attribute_id" name="f_attribute_id" class="select">
                                    @foreach($manufactures as $manufacture)
                                        @if($manufacture['id']==$data['f_attribute_id'])
                                            <option value="{{$manufacture['id']}}" selected >{{$manufacture['name']}}</option>
                                        @else
                                            <option value="{{$manufacture['id']}}" >{{$manufacture['name']}}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </span>
                        </div>
                    </div>
                    <div class="row cl">
                        <label class="form-label col-xs-4 col-sm-2"><span class="c-red">*</span>是否标记为热销商品：</label>
                        <div class="formControls col-xs-8 col-sm-9">
                            <span class="select-box">
                                <select id="hot" name="hot" class="select">
                                    <option value="0" {{$data['hot'] == "0"? "selected":""}}>否</option>
                                    <option value="1" {{$data['hot'] == "1"? "selected":""}}>热销</option>
                                </select>
                            </span>
                        </div>
                    </div>
                    <div class="row cl">
                        <label class="form-label col-xs-4 col-sm-2"><span class="c-red">*</span>排序：</label>
                        <div class="formControls col-xs-8 col-sm-9">
                            <input id="sort" name="sort" type="text" class="input-text" value="{{ isset($data['sort']) ? $data['sort'] : '' }}" placeholder="请输入排序，越大越靠前">
                        </div>
                    </div>
                    <div class="row cl">
                        <label class="form-label col-xs-4 col-sm-2">SEO_标题：</label>
                        <div class="formControls col-xs-8 col-sm-9">
                            <textarea  id="seo_title" name="seo_title" wrap="\n" class="textarea" style="resize:vertical;" placeholder="请填写SEO_标题" dragonfly="true" nullmsg="SEO_标题不能为空！">{{ isset($data['seo_title']) ? $data['seo_title'] : '' }}</textarea>
                        </div>
                    </div>
                    <div class="row cl">
                        <label class="form-label col-xs-4 col-sm-2">SEO_关键字：</label>
                        <div class="formControls col-xs-8 col-sm-9">
                            <textarea  id="seo_keywords" name="seo_keywords" wrap="\n" class="textarea" style="resize:vertical;" placeholder="请填写SEO_关键字" dragonfly="true" nullmsg="SEO_关键字不能为空！">{{ isset($data['seo_keywords']) ? $data['seo_keywords'] : '' }}</textarea>
                        </div>
                    </div>
                    <div class="row cl">
                        <label class="form-label col-xs-4 col-sm-2">SEO_描述：</label>
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
                </div>
                <style>
                    #details_black img,video{
                        width:100%;
                    }
                    #details_black .details_black_label{
                        text-align: center;
                        font-weight: bold;
                    }
                    #details_black .detail_add_text{
                        line-height:30px;
                        background: #5eb95e;
                        text-align: center;
                        color:#fff;
                    }
                    #details_black .detail_add_text:hover{
                        background: #429842;
                    }
                    #details_black .detail_add_image{
                        line-height:30px;
                        background: #dd514c;
                        text-align: center;
                        color:#fff;
                    }
                    #details_black .detail_add_image:hover{
                        background: #c62b26;
                    }
                    #details_black .detail_add_video{
                        line-height:30px;
                        background: #f37b1d;
                        text-align: center;
                        color:#fff;
                    }
                    #details_black .detail_add_video:hover{
                        background: #c85e0b;
                    }
                    #details_black .detail_add_button{
                        line-height:30px;
                        background: #000;
                        text-align: center;
                        color:#fff;
                    }
                    #details_black .imagePrv{
                        width:100px;
                        height:100px;
                    }
                    .details_show{
                        /*width:375px;*/
                        height:500px;
                        overflow-y: scroll;
                        margin:0 auto;
                        border:3px solid #000;
                    }
                    #machining_details_content_detail a div{
                        margin:5px 0;
                        line-height: 25px;
                        text-align: center;
                        font-size: 19px;
                        border: 1px solid #ddd;
                    }
                    #machining_details_content_detail a div:hover{
                        background: #ddd;
                    }
                    #machining_details_content_detail a div:active{
                        background: #666;
                    }
                    .teltphone_header{
                        height:30px;
                        background: #000;
                        /*border-radius: 10px 10px 0 0;*/
                    }
                    .teltphone_logo{
                        text-align: center;
                        line-height: 30px;
                        font-weight: bold;
                        color: #ddd;
                        font-size: 16px;
                    }
                    .teltphone_footer{
                        height:30px;
                        background: #000;
                        /*border-radius: 0 0 10px 10px;*/
                        padding-top:10px;
                    }
                    .telephone_button{
                        width:50px;
                        height:10px;
                        margin:0px auto;
                        border: #ddd 2px solid;
                        background: #000;
                        border-radius: 10px;
                    }
                </style>
                <div class="tabCon" id="details_black">
                    <div class="row cl details_black_label">
                        <div class="formControls col-xs-6 col-sm-6">编辑区</div>
                        <div class="formControls col-xs-1 col-sm-1"></div>
                        <div class="formControls col-xs-4 col-sm-4">预览参考区</div>
                        <div class="formControls col-xs-1 col-sm-1"></div>
                    </div>
                    <div class="row cl" id="container">
                        <div class="formControls col-xs-6 col-sm-6">
                            <div id="machining_details_content"></div>
                            <div>
                                <a href="javascript:" onclick="addDetailText()">
                                    <div id="machining_details_content" class="formControls col-xs-4 col-sm-4 detail_add_text">添加文本</div>
                                </a>
                                <a href="javascript:" onclick="addDetailImage()">
                                    <div id="machining_details_content" class="formControls col-xs-4 col-sm-4 detail_add_image">添加图片</div>
                                </a>
                                <a href="javascript:" onclick="addDetailVideo()">
                                    <div id="machining_details_content" class="formControls col-xs-4 col-sm-4 detail_add_video">添加视频</div>
                                </a>
                                <div id="add_detail_text" >
                                    <textarea name="" id="add_text" wrap="\n" class="textarea" style="resize:vertical;" placeholder="请填写内容" dragonfly="true" nullmsg="内容不能为空！"></textarea>
                                    <a href="javascript:" onclick="submitDetailText()">
                                        <div id="machining_details_content" class="formControls col-xs-12 col-sm-12 detail_add_button">确认添加</div>
                                    </a>
                                </div>
                                <div id="add_detail_image" style="text-align: center;" hidden >
                                    <img id="imagePrv_image" src="{{ URL::asset('/img/add_image.png') }}" />
                                    <input id="add_image" type="hidden" />
                                    <a href="javascript:" onclick="submitDetailImage()">
                                        <div id="machining_details_content" class="formControls col-xs-12 col-sm-12 detail_add_button">确认添加</div>
                                    </a>
                                </div>
                                <div id="add_detail_video" style="text-align: center;" hidden >
                                    <img id="imagePrv_video" src="{{ URL::asset('/img/add_image.png') }}" />
                                    <video src="" id="videoPrv" controls="controls" hidden>
                                        您的浏览器不支持 video 标签。
                                    </video>
                                    <div class="progress-bar"><span class="sr-only"></span></div>
                                    <input id="add_video" type="hidden" />
                                    <a href="javascript:" onclick="submitDetailVideo()">
                                        <div id="machining_details_content" class="formControls col-xs-12 col-sm-12 detail_add_button">确认添加</div>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="formControls col-xs-1 col-sm-1"></div>
                        <div class="formControls col-xs-4 col-sm-4 padding-top-10 ">
                            <div class="teltphone_header">
                                {{--<div class="teltphone_logo">TelePhone</div>--}}
                            </div>
                            <div id="machining_details_show_content" class="details_show"></div>
                            <div class="teltphone_footer">
                                {{--<div class="telephone_button"></div>--}}
                            </div>
                        </div>
                        <div class="formControls col-xs-1 col-sm-1"></div>
                    </div>
                </div>
                <div class="tabCon">
                    <div class="row cl">
                        <label class="form-label col-xs-4 col-sm-2"><span class="c-red">*</span>精度：</label>
                        <div class="formControls col-xs-8 col-sm-9">
                            <input id="accuracy" name="accuracy" type="text" class="input-text" value="{{ isset($data['attribute']['accuracy']) ? $data['attribute']['accuracy'] : '' }}" placeholder="请输入精度">
                        </div>
                    </div>
                    <div class="row cl">
                        <label class="form-label col-xs-4 col-sm-2"><span class="c-red">*</span>服务商：</label>
                        <div class="formControls col-xs-8 col-sm-9">
                            <input id="service" name="service" type="text" class="input-text" value="{{ isset($data['attribute']['service']) ? $data['attribute']['service'] : '' }}" placeholder="请输入服务商">
                        </div>
                    </div>
                    <div class="row cl">
                        <label class="form-label col-xs-4 col-sm-2"><span class="c-red">*</span>材料：</label>
                        <div class="formControls col-xs-8 col-sm-9">
                            <input id="material" name="material" type="text" class="input-text" value="{{ isset($data['attribute']['material']) ? $data['attribute']['material'] : '' }}" placeholder="请输入材料">
                        </div>
                    </div>
                    <div class="row cl">
                        <label class="form-label col-xs-4 col-sm-2"><span class="c-red">*</span>开发和收费情况：</label>
                        <div class="formControls col-xs-8 col-sm-9">
                            <textarea  id="explain" name="explain" wrap="\n" class="textarea" style="resize:vertical;" placeholder="开发和收费情况" dragonfly="true" nullmsg="开发和收费情况！">{{ isset($data['attribute']['explain']) ? $data['attribute']['explain'] : '' }}</textarea>
                        </div>
                    </div>
                    <div class="row cl">
                        <div class="col-xs-8 col-sm-9 col-xs-offset-4 col-sm-offset-2">
                            <button class="btn btn-primary radius" type="submit"><i class="Hui-iconfont">&#xe632;</i> 保存</button>
                            <button onClick="layer_close();" class="btn btn-default radius" type="button">取消</button>
                        </div>
                    </div>
                </div>
                <style>
                    #cases_black img,video{
                        width:100%;
                    }
                    #cases_black .cases_black_label{
                        text-align: center;
                        font-weight: bold;
                    }
                    #cases_black .case_add_image{
                        line-height:30px;
                        background: #dd514c;
                        text-align: center;
                        color:#fff;
                    }
                    #cases_black .case_add_button{
                        line-height:30px;
                        background: #000;
                        text-align: center;
                        color:#fff;
                    }
                    #cases_black .imagePrv{
                        width:100px;
                        height:100px;
                    }
                    .cases_show{
                        /*width:375px;*/
                        height:500px;
                        overflow-y: scroll;
                        margin:0 auto;
                        border:3px solid #000;
                    }
                    #machining_cases_content_detail a div{
                        margin:5px 0;
                        line-height: 25px;
                        text-align: center;
                        font-size: 19px;
                        border: 1px solid #ddd;
                    }
                    #machining_cases_content_detail a div:hover{
                        background: #ddd;
                    }
                    #machining_cases_content_detail a div:active{
                        background: #666;
                    }
                    .teltphone_header{
                        height:30px;
                        background: #000;
                        /*border-radius: 10px 10px 0 0;*/
                    }
                    .teltphone_logo{
                        text-align: center;
                        line-height: 30px;
                        font-weight: bold;
                        color: #ddd;
                        font-size: 16px;
                    }
                    .teltphone_footer{
                        height:30px;
                        background: #000;
                        /*border-radius: 0 0 10px 10px;*/
                        padding-top:10px;
                    }
                    .telephone_button{
                        width:50px;
                        height:10px;
                        margin:0px auto;
                        border: #ddd 2px solid;
                        background: #000;
                        border-radius: 10px;
                    }
                </style>
                <div class="tabCon" id="cases_black">
                    <div class="row cl" id="container">
                        <div class="common-text-align-center text-red line-height-40">*请上传250*200尺寸的图片，预览内容仅供参考</div>
                        <div class="formControls col-xs-12 col-sm-12">
                            <div id="machining_cases_content"></div>
                            <div class="col-xs-12 col-sm-3">
                                <a href="javascript:">
                                    <div class="formControls col-xs-12 col-sm-12 case_add_image">添加图片</div>
                                </a>
                                <div id="add_case_image" style="text-align: center;" >
                                    <img id="imagePrv_case" src="{{ URL::asset('/img/add_picture.png') }}" style="height:153px;" />
                                    <input type="text" id="add_case_name" class="input-text margin-bottom-10" placeholder="请输入名称" />
                                    <a href="javascript:" onclick="submitCaseImage()">
                                        <div id="machining_case_content" class="formControls col-xs-12 col-sm-12 case_add_button">确认添加</div>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
    {{--详情--}}
    <script id="machining_details_content_template" type="text/x-dot-template">
        <div id="machining_details_content_detail" class="formControls col-xs-12 col-sm-12">
            @{{? it.type==0 }}
            <textarea  id="text_detail_@{{=it.index}}" wrap="\n" class="textarea" style="resize:vertical;" placeholder="请填写内容" dragonfly="true" nullmsg="内容不能为空！">@{{=it.content}}</textarea>
            @{{?? it.type==1 }}
            <img src="@{{=it.content}}" />
            @{{?? it.type==2 }}
            <video src="@{{=it.content}}" controls="controls">
                您的浏览器不支持 video 标签。
            </video>
            @{{? }}
            @{{? it.type==0 }}
            <a href="javascript:" onclick="sortUp(@{{=it.index}},@{{=it.id}})" title="上移">
                <div class="formControls col-xs-3 col-sm-3 Hui-iconfont">&#xe6d6;</div>
            </a>
            <a href="javascript:" onclick="delDetial(@{{=it.index}},@{{=it.id}})" title="删除">
                <div class="formControls col-xs-3 col-sm-3 c-red Hui-iconfont">&#xe6a6;</div>
            </a>
            <a href="javascript:" onclick="updateTextDetial(@{{=it.index}},@{{=it.id}})" title="提交编辑">
                <div class="formControls col-xs-3 col-sm-3 c-green  Hui-iconfont">&#xe60c;</div>
            </a>
            <a href="javascript:" onclick="sortDown(@{{=it.index}},@{{=it.id}})" title="下移">
                <div class="formControls col-xs-3 col-sm-3 Hui-iconfont">&#xe6d5;</div>
            </a>
            @{{?? }}
            <a href="javascript:" onclick="sortUp(@{{=it.index}},@{{=it.id}})" title="上移">
                <div class="formControls col-xs-4 col-sm-4 Hui-iconfont">&#xe6d6;</div>
            </a>
            <a href="javascript:" onclick="delDetial(@{{=it.index}},@{{=it.id}})" title="删除">
                <div class="formControls col-xs-4 col-sm-4 c-red Hui-iconfont">&#xe6a6;</div>
            </a>
            <a href="javascript:" onclick="sortDown(@{{=it.index}},@{{=it.id}})" title="下移">
                <div class="formControls col-xs-4 col-sm-4 Hui-iconfont">&#xe6d5;</div>
            </a>
            @{{? }}
        </div>
    </script>
    <script id="machining_details_show_content_template" type="text/x-dot-template">
        @{{? it.type==0 }}
        <div>@{{=it.content}}</div>
        @{{?? it.type==1 }}
        <img src="@{{=it.content}}" />
        @{{?? it.type==2 }}
        <video src="@{{=it.content}}" controls="controls">
            您的浏览器不支持 video 标签。
        </video>
        @{{? }}
    </script>
    {{--案例--}}
    <script id="machining_cases_content_template" type="text/x-dot-template">
        <div id="machining_details_content_detail" class="formControls col-xs-12 col-sm-3">
            <img src="@{{=it.content}}" class="height-200" />
            @{{?it.name}}
                <div class="common-text-align-center">@{{=it.name}}</div>
            @{{??}}
                <div class="common-text-align-center">&nbsp;</div>
            @{{?}}
            <a href="javascript:" onclick="sortUpCase(@{{=it.index}},@{{=it.id}})" title="上移">
                <div class="formControls col-xs-4 col-sm-4 Hui-iconfont">&#xe6d6;</div>
            </a>
            <a href="javascript:" onclick="delCase(@{{=it.index}},@{{=it.id}})" title="删除">
                <div class="formControls col-xs-4 col-sm-4 c-red Hui-iconfont">&#xe6a6;</div>
            </a>
            <a href="javascript:" onclick="sortDownCase(@{{=it.index}},@{{=it.id}})" title="下移">
                <div class="formControls col-xs-4 col-sm-4 Hui-iconfont">&#xe6d5;</div>
            </a>
        </div>
    </script>
    <script id="machining_cases_show_content_template" type="text/x-dot-template">
        <img src="@{{=it.content}}" />
    </script>
@endsection

@section('script')
    <script type="text/javascript">
        $(function () {
            $("#tab-system").Huitab({
                index:0
            });
            //获取七牛token
            initQNUploader();
            $("#form-machining-editMachining").validate({
                rules: {
                    name: {
                        required: true,
                    },
                    price: {
                        required: true,
                        // number:true,
                        digits:true
                    },
                    unit: {
                        required: true,
                    },
                    sort: {
                        required: true,
                        digits:true,
                    },
                    accuracy: {
                        required: true,
                    },
                    service: {
                        required: true,
                    },
                    material: {
                        required: true,
                    },
                    explain: {
                        required: true,
                    },
                },
                onkeyup: false,
                focusCleanup: false,
                success: "valid",
                submitHandler: function (form) {
                    $(form).ajaxSubmit({
                        type: 'POST',
                        url: "{{ URL::asset('/admin/machining/editMachining')}}",
                        success: function (ret) {
                            console.log(JSON.stringify(ret));
                            if (ret.result) {
                                layer.msg(ret.msg, {icon: 1, time: 2000});
                                setTimeout(function () {
                                    // var index = parent.layer.getFrameIndex(window.name);
                                    parent.$('.btn-refresh').click();
                                    // parent.layer.close(index);
                                }, 1000)
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
            var uploader_1 = Qiniu.uploader({
                runtimes: 'html5,flash,html4',      // 上传模式，依次退化
                browse_button: 'imagePrv_image',         // 上传选择的点选按钮，必需
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
                        console.log(JSON.stringify(info));
                        var domain = up.getOption('domain');
                        var res = JSON.parse(info);
                        //获取上传成功后的文件的Url
                        var sourceLink = domain + res.key;
                        $("#imagePrv_image").attr('src', sourceLink);
                        $('#add_image').val(sourceLink)
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
            var uploader_2 = Qiniu.uploader({
                runtimes: 'html5,flash,html4',      // 上传模式，依次退化
                browse_button: 'imagePrv_video',         // 上传选择的点选按钮，必需
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
                        $('.sr-only').css('width',file.percent+'%');
                        $('.sr-only').css('float','left');
                        console.log("UploadProgress up:" + up + " file:" + JSON.stringify(file));
                    },
                    'FileUploaded': function (up, file, info) {
                        // 每个文件上传成功后，处理相关的事情
                        // 其中info是文件上传成功后，服务端返回的json，形式如：
                        // {
                        //    "hash": "Fh8xVqod2MQ1mocfI4S4KpRL6D98",
                        //    "key": "gogopher.jpg"
                        //  }
                        console.log(JSON.stringify(info));
                        var domain = up.getOption('domain');
                        var res = JSON.parse(info);
                        //获取上传成功后的文件的Url
                        var sourceLink = domain + res.key;
                        $("#imagePrv_video").hide();
                        $("#videoPrv").show()
                        $("#videoPrv").attr('src', sourceLink);
                        $('#add_video').val(sourceLink)
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
            //案例
            var uploader_3 = Qiniu.uploader({
                runtimes: 'html5,flash,html4',      // 上传模式，依次退化
                browse_button: 'imagePrv_case',         // 上传选择的点选按钮，必需
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
                        $('.sr-only').css('width',file.percent+'%');
                        $('.sr-only').css('float','left');
                        console.log("UploadProgress up:" + up + " file:" + JSON.stringify(file));
                    },
                    'FileUploaded': function (up, file, info) {
                        // 每个文件上传成功后，处理相关的事情
                        // 其中info是文件上传成功后，服务端返回的json，形式如：
                        // {
                        //    "hash": "Fh8xVqod2MQ1mocfI4S4KpRL6D98",
                        //    "key": "gogopher.jpg"
                        //  }
                        console.log(JSON.stringify(info));
                        var domain = up.getOption('domain');
                        var res = JSON.parse(info);
                        //获取上传成功后的文件的Url
                        var sourceLink = domain + res.key;
                        $("#imagePrv_case").attr('src', sourceLink);
                        $('#add_case_image').val(sourceLink)
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

        //对详情进行编辑
        //json转数组
        var str='{{$data['details']}}'
        var jsonStr=str.replace(/&quot;/ig, '"')
        var jsonObj =  JSON.parse(jsonStr)
        // console.log(jsonObj)
        //内容详情页
        LoadDetailsHtml(jsonObj)
        // 内容详情页编辑
        function LoadDetailsHtml(data){
            // console.log("data is : "+JSON.stringify(data))
            for(var i=0;i<data.length;i++){
                data[i]['index']=i
                // console.log('LoadDetailsHtml data['+i+'] is : ' + JSON.stringify((data[i])))
                //编辑
                var interText = doT.template($("#machining_details_content_template").text())
                $("#machining_details_content").append(interText(data[i]))
                //展示
                var interText = doT.template($("#machining_details_show_content_template").text())
                $("#machining_details_show_content").append(interText(data[i]))
            }
        }
        //点击排序-上升
        function sortUp(index,id){
            // console.log('sortUp index is : ' + JSON.stringify((jsonObj[index])))
            //判断如果不是最上面的内容，执行向上操作
            if(index!=0){
                //再交换jsonObj中的位置
                var pack=jsonObj[index-1]
                jsonObj[index-1]=jsonObj[index]
                jsonObj[index]=pack
                for(var i=0;i<jsonObj.length;i++){
                    jsonObj[i]['sort']=i
                }
                for(var i=0;i<jsonObj.length;i++){
                    editMachiningDetailList(jsonObj[i])
                }
                //重新展示
                refresh(jsonObj)
            }
        }
        //点击排序-下降
        function sortDown(index){
            // console.log('sortDown index is : ' + JSON.stringify((jsonObj[index])))
            //判断如果不是最上面的内容，执行向上操作
            if(index!=jsonObj.length-1){
                //再交换jsonObj中的位置
                var pack=jsonObj[index+1]
                jsonObj[index+1]=jsonObj[index]
                jsonObj[index+1]['sort']=index+1
                jsonObj[index]=pack
                jsonObj[index]['sort']=index
                for(var i=0;i<jsonObj.length;i++){
                    jsonObj[i]['sort']=i
                }
                for(var i=0;i<jsonObj.length;i++){
                    editMachiningDetailList(jsonObj[i])
                }
                //重新展示
                refresh(jsonObj)
            }
        }
        //删除这条数据
        function delDetial(index,id){
            layer.confirm('确认要删除这条数据吗？',function(index){
                //进行后台删除
                var param = {
                    id: id,
                    _token: "{{ csrf_token() }}"
                }
                delMachiningDetail('{{URL::asset('')}}', param, function (ret) {
                    if (ret.result == true) {
                        layer.msg(ret.msg, {icon: 1, time: 1000});
                        console.log('sortDown index is : ' + JSON.stringify((jsonObj[index])))
                        for(var i=0;i<jsonObj.length;i++){
                            if(id==jsonObj[i]['id']){
                                jsonObj.splice(i,1);//从下标为i的元素开始，连续删除1个元素
                            }
                        }
                        //重新展示
                        refresh(jsonObj)
                    } else {
                        layer.msg(ret.msg, {icon: 2, time: 1000})
                    }
                })
            });
        }
        //提交修改后的文本
        function updateTextDetial(index){
            var content=$('#text_detail_'+index).val();
            jsonObj[index]['content']=content;
            for(var i=0;i<jsonObj.length;i++){
                editMachiningDetailList(jsonObj[i])
            }
            //重新展示
            refresh(jsonObj)
        }
        //显示添加文本
        function addDetailText(){
            $('#add_detail_text').show();
            $('#add_detail_image').hide();
            $('#add_detail_video').hide();
        }
        //确认添加文本
        function submitDetailText() {
            var add_text=$('#add_text').val()
            if(add_text==''){
                layer.msg('添加失败，内容不能为空', {icon: 2, time: 2000});
            }
            else{
                var detail={};
                detail['goods_id']='{{$data['id']}}';
                detail['content']=add_text;
                detail['type']=0;
                detail['sort']=jsonObj.length;
                jsonObj.push(detail);
                addMachiningDetailList(detail,function(ret){
                    if (ret.result == true) {
                        //重新展示
                        $('#add_text').val('')
                        refresh(jsonObj)
                    } else {
                        layer.msg(ret.msg, {icon: 2, time: 1000})
                    }
                })
            }
        }
        //显示添加图片
        function addDetailImage(){
            $('#add_detail_text').hide();
            $('#add_detail_image').show();
            $('#add_detail_video').hide();
        }
        //确认添加图片
        function submitDetailImage() {
            var add_image=$("#add_image").val();
            if(add_image==''){
                layer.msg('添加失败，请上传图片', {icon: 2, time: 2000});
            }
            else{
                var detail={};
                detail['goods_id']='{{$data['id']}}';
                detail['content']=add_image;
                detail['type']=1;
                detail['sort']=jsonObj.length;
                jsonObj.push(detail);
                addMachiningDetailList(detail,function(ret){
                    if (ret.result == true) {
                        //重新展示
                        $('#add_image').val('')
                        $("#imagePrv_image").attr('src', '{{ URL::asset('/img/add_image.png') }}')
                        refresh(jsonObj)
                    } else {
                        layer.msg(ret.msg, {icon: 2, time: 1000})
                    }
                })
            }
        }
        //显示添加视频
        function addDetailVideo(){
            $('#add_detail_text').hide();
            $('#add_detail_image').hide();
            $('#add_detail_video').show();
        }
        //确认添加视频
        function submitDetailVideo() {
            var add_video=$("#add_video").val();
            if(add_video==''){
                layer.msg('添加失败，请上传视频', {icon: 2, time: 2000});
            }
            else{
                var detail={};
                detail['goods_id']='{{$data['id']}}';
                detail['content']=add_video;
                detail['type']=2;
                detail['sort']=jsonObj.length;
                jsonObj.push(detail);
                addMachiningDetailList(detail,function(ret){
                    if (ret.result == true) {
                        //重新展示
                        $('#add_video').val('')
                        $('#videoPrv').attr('src', '')
                        $('#videoPrv').hide()
                        $('#imagePrv_video').show()
                        $('.sr-only').css('width','0%');
                        refresh(jsonObj)
                    } else {
                        layer.msg(ret.msg, {icon: 2, time: 1000})
                    }
                })
            }
        }
        //刷新页面
        function refresh(jsonObj){
            $("#machining_details_content").html('')
            $("#machining_details_show_content").html('')
            LoadDetailsHtml(jsonObj)
        }
        //提交后台编辑数据
        function editMachiningDetailList(jsonObj){
            var param = {
                sort:jsonObj['sort'],
                content:jsonObj['content'],
                id: jsonObj['id'],
                _token: "{{ csrf_token() }}"
            }
            editMachiningDetail('{{URL::asset('')}}', param, function (ret) {
                // console.log("editMachiningDetail ret is ： "+JSON.stringify(ret))
                if (ret.result == true) {
                    return ret.result;
                } else {
                    layer.msg(ret.msg, {icon: 2, time: 1000})
                    return ret.result;
                }
            })
        }
        //提交后台添加数据
        function addMachiningDetailList(detail,callBack){
            var param={
                _token: "{{ csrf_token() }}",
                goods_id:detail['goods_id'],
                content:detail['content'],
                type:detail['type'],
                sort:detail['sort']
            }
            editMachiningDetail('{{URL::asset('')}}', param, callBack)
        }

        //对案例进行编辑
        //json转数组
        var strCase='{{$data['cases']}}'
        // console.log(strCase)
        var jsonStrCase=strCase.replace(/&quot;/ig, '"')
        var jsonObjCase =  JSON.parse(jsonStrCase)
        // console.log(jsonObjCase)
        LoadCasesHtml(jsonObjCase)
        // 案例编辑
        function LoadCasesHtml(data){
            // console.log("data is : "+JSON.stringify(data))
            for(var i=0;i<data.length;i++){
                data[i]['index']=i
                console.log('LoadCasesHtml data['+i+'] is : ' + JSON.stringify((data[i])))
                //编辑
                var interText = doT.template($("#machining_cases_content_template").text())
                $("#machining_cases_content").append(interText(data[i]))
                //展示
                var interText = doT.template($("#machining_cases_show_content_template").text())
                $("#machining_cases_show_content").append(interText(data[i]))
            }
        }
        //点击排序-上升
        function sortUpCase(index,id){
            // console.log('sortUp index is : ' + JSON.stringify((jsonObj[index])))
            //判断如果不是最上面的内容，执行向上操作
            if(index!=0){
                //再交换jsonObj中的位置
                var pack=jsonObjCase[index-1]
                jsonObjCase[index-1]=jsonObjCase[index]
                jsonObjCase[index]=pack
                for(var i=0;i<jsonObjCase.length;i++){
                    jsonObjCase[i]['sort']=i
                }
                for(var i=0;i<jsonObjCase.length;i++){
                    editMachiningCaseList(jsonObjCase[i])
                }
                //重新展示
                refreshCase(jsonObjCase)
            }
        }
        //点击排序-下降
        function sortDownCase(index){
            // console.log('sortDown index is : ' + JSON.stringify((jsonObj[index])))
            //判断如果不是最上面的内容，执行向上操作
            if(index!=jsonObjCase.length-1){
                //再交换jsonObjCase中的位置
                var pack=jsonObjCase[index+1]
                jsonObjCase[index+1]=jsonObjCase[index]
                jsonObjCase[index+1]['sort']=index+1
                jsonObjCase[index]=pack
                jsonObjCase[index]['sort']=index
                for(var i=0;i<jsonObjCase.length;i++){
                    jsonObjCase[i]['sort']=i
                }
                for(var i=0;i<jsonObjCase.length;i++){
                    editMachiningCaseList(jsonObjCase[i])
                }
                //重新展示
                refreshCase(jsonObjCase)
            }
        }
        //删除这条数据
        function delCase(index,id){
            layer.confirm('确认要删除这条数据吗？',function(index){
                //进行后台删除
                var param = {
                    id: id,
                    _token: "{{ csrf_token() }}"
                }
                delMachiningCase('{{URL::asset('')}}', param, function (ret) {
                    if (ret.result == true) {
                        layer.msg(ret.msg, {icon: 1, time: 1000});
                        // console.log('sortDown index is : ' + JSON.stringify((jsonObjCase[index])))
                        for(var i=0;i<jsonObjCase.length;i++){
                            if(id==jsonObjCase[i]['id']){
                                jsonObjCase.splice(i,1);//从下标为i的元素开始，连续删除1个元素
                            }
                        }
                        //重新展示
                        refreshCase(jsonObjCase)
                    } else {
                        layer.msg(ret.msg, {icon: 2, time: 1000})
                    }
                })
            });
        }
        //确认添加图片
        function submitCaseImage() {
            var add_case_image=$("#add_case_image").val();
            var add_case_name=$("#add_case_name").val();
            if(add_case_image==''){
                layer.msg('添加失败，请上传图片', {icon: 2, time: 2000});
            }
            else{
                var detail={};
                detail['goods_id']='{{$data['id']}}';
                detail['content']=add_case_image;
                detail['name']=add_case_name;
                detail['sort']=jsonObjCase.length?jsonObjCase.length:0;
                jsonObjCase.push(detail);
                addMachiningCaseList(detail,function(ret){
                    if (ret.result == true) {
                        //重新展示
                        $('#add_case_image').val('')
                        $("#imagePrv_case").attr('src', '{{ URL::asset('/img/add_picture.png') }}')
                        $("#add_case_name").val('')
                        refreshCase(jsonObjCase)
                    } else {
                        layer.msg(ret.msg, {icon: 2, time: 1000})
                    }
                })
            }
        }
        //刷新页面
        function refreshCase(jsonObjCase){
            $("#machining_cases_content").html('')
            $("#machining_cases_show_content").html('')
            LoadCasesHtml(jsonObjCase)
        }
        //提交后台编辑数据
        function editMachiningCaseList(jsonObjCase){
            var param = {
                sort:jsonObjCase['sort'],
                content:jsonObjCase['content'],
                id: jsonObjCase['id'],
                _token: "{{ csrf_token() }}"
            }
            editMachiningCase('{{URL::asset('')}}', param, function (ret) {
                // console.log("editMachiningDetail ret is ： "+JSON.stringify(ret))
                if (ret.result == true) {
                    return ret.result;
                } else {
                    layer.msg(ret.msg, {icon: 2, time: 1000})
                    return ret.result;
                }
            })
        }
        //提交后台添加数据
        function addMachiningCaseList(detail,callBack){
            var param={
                _token: "{{ csrf_token() }}",
                goods_id:detail['goods_id'],
                content:detail['content'],
                name:detail['name'],
                sort:detail['sort']
            }
            editMachiningCase('{{URL::asset('')}}', param, callBack)
        }
    </script>
@endsection