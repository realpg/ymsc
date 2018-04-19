@extends('admin.layouts.app')

@section('content')
    <nav class="breadcrumb"><i class="Hui-iconfont">&#xe67f;</i> 首页 <span class="c-gray en">&gt;</span> 商品管理 <span class="c-gray en">&gt;</span>属性列表 <a class="btn btn-success radius btn-refresh r" style="line-height:1.6em;margin-top:3px" href="javascript:location.replace(location.href);" onclick="location.replace('{{URL::asset('/admin/chem/attribute')}}?chem_class_id={{$chem_class_id}}&menu_id={{$menu_id}}');" title="刷新" ><i class="Hui-iconfont">&#xe68f;</i></a></nav>
    <div class="page-container">
        @foreach($attributes as $k=>$attribute)
        <div>
            @if($attribute['attributes'])
                <div>
                    <div style="padding-left:10px;padding-right:10px;text-align: center;float:left;line-height: 30px;margin:10px;">
                        {{$attribute['name']}}
                    </div>
                    <div style="float:left;">
                        @foreach($attribute['attributes'] as $attribute_detail)
                            <div style="padding-left:10px;padding-right:10px;text-align: center;line-height: 30px;border:1px solid red;float:left;margin:10px;">
                                {{$attribute_detail['name']}}
                                <a title="删除" href="javascript:;" onclick="del(this,'{{$attribute_detail['id']}}','{{$k}}')" class="ml-5" style="text-decoration:none;color:red;">
                                    <i class="Hui-iconfont">&#xe6e2;</i>
                                </a>
                            </div>
                        @endforeach
                    </div>
                </div>
                <div class="clear"></div>
            @endif
        </div>
        @endforeach
        <div class="clear"></div>
        @if($all_attributes)
            @foreach($all_attributes as $k=>$all_attribute)
            <div class="text-l mt-20">
                <form action="{{URL::asset('')}}" method="post" class="form-horizontal" id="form-{{$k}}">
                    {{csrf_field()}}
                    <div style="padding-left:10px;padding-right:10px;text-align: center;float:left;line-height: 30px;">
                        {{$all_attribute['name']}}
                    </div>
                    <input type="hidden" name="class_id" value="{{$data['id']}}" />
                    <input type="hidden" name="index" value="{{$k}}" />
                    <span class="select-box" style="width:150px;">
                          <select class="select" size="1" name="attribute_id" id="attribute_id">
                              @foreach($all_attributes[$k]['attributes'] as $attribute)
                                  <option value="{{$attribute['id']}}"  >{{$attribute['name']}}</option>
                              @endforeach
                          </select>
                    </span>
                    <button type="submint" class="btn btn-success" id="add-{{$k}}" name="">添加</button>
                </form>
            </div>
            @endforeach
        @endif
    </div>

@endsection

@section('script')
<script type="text/javascript">
    $(function () {
        $("#form-0").validate({
            onkeyup: false,
            focusCleanup: false,
            success: "valid",
            submitHandler: function (form) {
                $(form).ajaxSubmit({
                    type: 'POST',
                    url: "{{ URL::asset('/admin/chem/addAttribute')}}",
                    success: function (ret) {
                        console.log(JSON.stringify(ret));
                        if (ret.result) {
                            layer.msg(ret.msg, {icon: 1, time: 2000});
                            setTimeout(function () {
                                // var index = parent.layer.getFrameIndex(window.name);
                                $('.btn-refresh').click();
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
        $("#form-1").validate({
            onkeyup: false,
            focusCleanup: false,
            success: "valid",
            submitHandler: function (form) {
                $(form).ajaxSubmit({
                    type: 'POST',
                    url: "{{ URL::asset('/admin/chem/addAttribute')}}",
                    success: function (ret) {
                        console.log(JSON.stringify(ret));
                        if (ret.result) {
                            layer.msg(ret.msg, {icon: 1, time: 2000});
                            setTimeout(function () {
                                // var index = parent.layer.getFrameIndex(window.name);
                                $('.btn-refresh').click();
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
    /*删除*/
    function del(obj,attribute_id,k){
        layer.confirm('确认要删除吗？',function(index){
            //进行后台删除
            var param = {
                class_id:'{{$data['id']}}',
                attribute_id: attribute_id,
                index:k,
                _token: "{{ csrf_token() }}"
            }
            delChemClassAttribute('{{URL::asset('')}}', param, function (ret) {
                console.log('delChemClassAttribute ret is : '+JSON.stringify(ret))
                if (ret.result == true) {
                    layer.msg('删除成功', {icon: 1, time: 1000});
                    $('.btn-refresh').click();
                } else {
                    layer.msg(ret.message, {icon: 2, time: 2000})
                }
            })
        });
    }
</script>
@endsection