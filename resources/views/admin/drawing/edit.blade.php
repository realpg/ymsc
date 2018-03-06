@extends('admin.layouts.app')

@section('content')
    <div class="page-container">
        <form class="form form-horizontal" method="post" id="form-drawing-edit">
            {{csrf_field()}}
            <input type="hidden" value="{{$data['id']}}" name="id" />
            <div class="row cl">
                <label class="col-xs-4 col-sm-2"></label>
                <div class="col-xs-8 col-sm-8">
                    <div class="panel panel-default" style="padding-left:0px;padding-right:0px;">
                        <div class="panel-header">
                            图纸信息
                        </div>
                        <div class="panel-body">
                            <div class="row cl">
                                <div class="col-xs-2 col-sm-2">会员昵称：</div>
                                <div class="col-xs-10 col-sm-10">{{$data['user']['nick_name']}}</div>
                            </div>
                            <div class="row cl">
                                <div class="col-xs-2 col-sm-2">图纸：</div>
                                <div class="col-xs-10 col-sm-10">
                                    @foreach($data['content'] as $content)
                                        <img src="{{$content}}" class="margin-bottom-10 width-100" />
                                    @endforeach
                                </div>
                            </div>
                            <div class="row cl">
                                <label class="form-label col-xs-2 col-sm-2">备注：</label>
                                <div class="formControls col-xs-10 col-sm-10">
                                    <textarea  id="remarks" name="remarks" wrap="\n" class="textarea" style="resize:vertical;" placeholder="请填写备注" dragonfly="true">{{ isset($data['remarks']) ? $data['remarks'] : '' }}</textarea>
                                </div>
                            </div>
                            <div class="row cl">
                                <label class="form-label col-xs-2 col-sm-2">状态：</label>
                                <div class="formControls col-xs-10 col-sm-10">
                                    <span class="select-box">
                                        <select id="status" name="status" class="select">
                                            <option value="0" {{$data['status'] == 0? "selected":""}} >待定</option>
                                            <option value="1" {{$data['status'] == 1? "selected":""}} >已联系</option>
                                            <option value="2" {{$data['status'] == 2? "selected":""}} >处理中</option>
                                            <option value="3" {{$data['status'] == 3? "selected":""}} >已处理</option>
                                        </select>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
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
            $("#form-drawing-edit").validate({
                rules: {},
                onkeyup: false,
                focusCleanup: false,
                success: "valid",
                submitHandler: function (form) {
                    $(form).ajaxSubmit({
                        type: 'POST',
                        url: "{{ URL::asset('/admin/drawing/edit')}}",
                        success: function (ret) {
                            console.log(JSON.stringify(ret));
                            if (ret.result) {
                                layer.msg(ret.msg, {icon: 1, time: 2000});
                                setTimeout(function () {
                                    parent.$('.btn-refresh').click();
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
    </script>
@endsection