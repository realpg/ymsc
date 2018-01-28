@extends('admin.layouts.app')

@section('content')
    <div class="page-container">
        <form class="form form-horizontal" method="post" id="form-menu-edit">
            {{csrf_field()}}
            <div class="row cl hidden">
                <label class="form-label col-xs-4 col-sm-2"><span class="c-red">*</span>id：</label>
                <div class="formControls col-xs-8 col-sm-9">
                    <input id="id" name="id" type="text" class="input-text"
                           value="{{ isset($data['id']) ? $data['id'] : '' }}" placeholder="Menu_id">
                </div>
            </div>
            <div class="row cl">
                <label class="form-label col-xs-4 col-sm-2"><span class="c-red">*</span>栏目名称：</label>
                <div class="formControls col-xs-8 col-sm-9">
                    <input id="name" name="name" type="text" class="input-text" value="{{ isset($data['name']) ? $data['name'] : '' }}" placeholder="请输入栏目名称">
                </div>
            </div>
            @if(!isset($data['name'])||$data['menu_id']!=0)
                <div class="row cl">
                    <label class="form-label col-xs-4 col-sm-2"><span class="c-red">*</span>栏目：</label>
                    <div class="formControls col-xs-8 col-sm-9">
                        <input type="text" class="input-text no_click" value="{{ $menuClassA['name'] }}" readonly />
                        <input id="menu_id" name="menu_id" type="hidden" class="input-text" value="{{ $menuClassA['id'] }}" />
                    </div>
                </div>
            @endif
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
        </form>
    </div>
@endsection

@section('script')
    <script type="text/javascript">
        $(function () {
            $("#form-menu-edit").validate({
                rules: {
                    name: {
                        required: true,
                    },
                    sort: {
                        required: true,
                        digits:true,
                    }
                },
                onkeyup: false,
                focusCleanup: false,
                success: "valid",
                submitHandler: function (form) {
                    $(form).ajaxSubmit({
                        type: 'POST',
                        url: "{{ URL::asset('/admin/menu/edit')}}",
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
                            layer.msg('保存失败', {icon: 1, time: 2000});
                            console.log("XmlHttpRequest:" + JSON.stringify(XmlHttpRequest));
                            console.log("textStatus:" + textStatus);
                            console.log("errorThrown:" + errorThrown);
                        }
                    });
                }

            });
        });
    </script>
@endsection