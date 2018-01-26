@extends('admin.layouts.app')

@section('content')
    <div class="page-container">
        <form class="form form-horizontal" method="post" id="form-admin-edit">
            {{csrf_field()}}
            <div class="row cl hidden">
                <label class="form-label col-xs-4 col-sm-2"><span class="c-red">*</span>id：</label>
                <div class="formControls col-xs-8 col-sm-9">
                    <input id="id" name="id" type="text" class="input-text"
                           value="{{ isset($data['id']) ? $data['id'] : '' }}" placeholder="管理员id">
                </div>
            </div>
            <div class="row cl">
                <label class="form-label col-xs-4 col-sm-2"><span class="c-red">*</span>管理员：</label>
                <div class="formControls col-xs-8 col-sm-9">
                    <input id="name" name="name" type="text" class="input-text"
                           value="{{ isset($data['name']) ? $data['name'] : '' }}" placeholder="请输入管理员姓名">
                </div>
            </div>
            <div class="row cl">
                <label class="form-label col-xs-4 col-sm-2"><span class="c-red">*</span>联系电话：</label>
                <div class="formControls col-xs-8 col-sm-9">
                    @if(isset($data['id']))
                        @if($admin['type']==1)
                            @if($admin['id']==1||$admin['id']==$data['id'])
                                <input id="phonenum" name="phonenum" type="text" class="input-text"
                               value="{{ isset($data['phonenum']) ? $data['phonenum'] : '' }}" placeholder="请输入联系电话">
                            @else
                                <input id="phonenum" name="phonenum" type="text" class="input-text no_click" value="{{ isset($data['phonenum']) ? $data['phonenum'] : '' }}" readonly>
                            @endif
                        @else
                            <input id="phonenum" name="phonenum" type="text" class="input-text no_click" value="{{ isset($data['phonenum']) ? $data['phonenum'] : '' }}" readonly>
                        @endif
                    @else
                        <input id="phonenum" name="phonenum" type="text" class="input-text" placeholder="请输入联系电话">
                    @endif
                </div>
            </div>
            @if($data['id']!=1)
            <div class="row cl">
                <label class="form-label col-xs-4 col-sm-2"><span class="c-red">*</span>角色：</label>
                <div class="formControls col-xs-8 col-sm-9">
                    <span class="select-box">
                        <select id="type" name="type" class="select">
                            <option value="0" {{$data['type'] == "0"? "selected":""}}>普通管理员</option>
                            <option value="1" {{$data['type'] == "1"? "selected":""}}>超级管理员</option>
                        </select>
                    </span>
                </div>
            </div>
            @endif
            @if(!isset($data['id']))
                <div class="row cl">
                    <label class="form-label col-xs-4 col-sm-2"></label>
                    <div class="formControls col-xs-8 col-sm-9">
                        <span class="grey-font">新建管理员的默认密码为Aa123456</span>
                    </div>
                </div>
            @endif
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
            $("#form-admin-edit").validate({
                rules:{
                    name:{
                        required:true,
                    },
                    phonenum:{
                        required:true,
                        number:true,
                        maxlength:11,
                        minlength:11
                    },
                },
                onkeyup:false,
                focusCleanup:false,
                success:"valid",
                submitHandler:function(form){
                    $('#error').hide();
                    $('.btn-primary').html('<i class="Hui-iconfont">&#xe634;</i> 保存中...')
                    $(form).ajaxSubmit({
                        type: 'POST',
                        url: "{{ URL::asset('/admin/admin/edit')}}",
                        success: function (ret) {
                            console.log(JSON.stringify(ret));
                            if (ret.result) {
                                layer.msg(ret.msg, {icon: 1, time: 2000});
                                setTimeout(function () {
                                    var index = parent.layer.getFrameIndex(window.name);
                                    parent.$('.btn-refresh').click();
                                    // parent.layer.close(index);
                                }, 1000)
                            } else {
                                layer.msg(ret.msg, {icon: 2, time: 2000});
                            }
                            $('.btn-primary').html('<i class="Hui-iconfont">&#xe632;</i> 保存')
                        },
                        error: function (XmlHttpRequest, textStatus, errorThrown) {
                            layer.msg('保存失败', {icon: 1, time: 2000});
                            console.log("XmlHttpRequest:" + JSON.stringify(XmlHttpRequest));
                            console.log("textStatus:" + textStatus);
                            console.log("errorThrown:" + errorThrown);
                            $('.btn-primary').html('<i class="Hui-iconfont">&#xe632;</i> 保存')
                        }
                    });
                }
            });
        });
    </script>
@endsection