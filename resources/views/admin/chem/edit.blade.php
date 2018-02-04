@extends('admin.layouts.app')

@section('content')
    <div class="page-container">
        <form class="form form-horizontal" method="post" id="form-testing-edit">
            {{csrf_field()}}
            <div class="row cl hidden">
                <label class="form-label col-xs-4 col-sm-2"><span class="c-red">*</span>id：</label>
                <div class="formControls col-xs-8 col-sm-9">
                    <input id="id" name="id" type="text" class="input-text"
                           value="{{ isset($data['id']) ? $data['id'] : '' }}" placeholder="id">
                </div>
            </div>
            <div class="row cl hidden">
                <label class="form-label col-xs-4 col-sm-2"><span class="c-red">*</span>goods_id：</label>
                <div class="formControls col-xs-8 col-sm-9">
                    <input id="goods_id" name="goods_id" type="text" class="input-text"
                           value="{{ isset($data['id']) ? $data['id'] : '' }}" placeholder="goods_id">
                </div>
            </div>
            <div class="row cl hidden">
                <label class="form-label col-xs-4 col-sm-2"><span class="c-red">*</span>menu_id：</label>
                <div class="formControls col-xs-8 col-sm-9">
                    <input id="menu_id" name="menu_id" type="text" class="input-text"
                           value="{{ isset($menu_id) ? $menu_id : '' }}" placeholder="menu_id">
                </div>
            </div>
            <div class="row cl hidden">
                <label class="form-label col-xs-4 col-sm-2"><span class="c-red">*</span>chem_class_id：</label>
                <div class="formControls col-xs-8 col-sm-9">
                    <input id="chem_class_id" name="chem_class_id" type="text" class="input-text"
                           value="{{ isset($chem_class_id) ? $chem_class_id : '' }}" placeholder="chem_class_id">
                </div>
            </div>
            <div class="row cl">
                <label class="form-label col-xs-4 col-sm-2"><span class="c-red">*</span>商品名称：</label>
                <div class="formControls col-xs-8 col-sm-9">
                    <input id="name" name="name" type="text" class="input-text no_click" readonly value="{{ isset($chem_class['name']) ? $chem_class['name'] : '' }}" placeholder="请输入商品名称">
                </div>
            </div>
            @if(isset($data['id']))
                <div class="row cl">
                    <label class="form-label col-xs-4 col-sm-2"><span class="c-red">*</span>商品货号：</label>
                    <div class="formControls col-xs-8 col-sm-9">
                        <input type="text" class="input-text no_click" readonly value="{{ isset($data['number']) ? $data['number'] : '' }}">
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
                <label class="form-label col-xs-4 col-sm-2"><span class="c-red">*</span>价格单位：</label>
                <div class="formControls col-xs-8 col-sm-9">
                    <input id="unit" name="unit" type="text" class="input-text" value="{{ isset($data['unit']) ? $data['unit'] : '' }}" placeholder="请输入价格单位">
                </div>
            </div>
            <div class="row cl">
                <label class="form-label col-xs-4 col-sm-2"><span class="c-red">*</span>品牌分类：</label>
                <div class="formControls col-xs-8 col-sm-9">
                        <span class="select-box">
                            <select id="f_attribute_id" name="f_attribute_id" class="select">
                                @foreach($brands as $brand)
                                    @if($brand['id']==$data['f_attribute_id'])
                                        <option value="{{$brand['id']}}" selected >{{$brand['name']}}</option>
                                    @else
                                        <option value="{{$brand['id']}}" >{{$brand['name']}}</option>
                                    @endif
                                @endforeach
                            </select>
                        </span>
                </div>
            </div>
            <div class="row cl">
                <label class="form-label col-xs-4 col-sm-2"><span class="c-red">*</span>纯度：</label>
                <div class="formControls col-xs-8 col-sm-9">
                        <span class="select-box">
                            <select id="s_attribute_id" name="s_attribute_id" class="select">
                                @foreach($purities as $purity)
                                    @if($purity['id']==$data['s_attribute_id'])
                                        <option value="{{$purity['id']}}" selected >{{$purity['name']}}</option>
                                    @else
                                        <option value="{{$purity['id']}}" >{{$purity['name']}}</option>
                                    @endif
                                @endforeach
                            </select>
                        </span>
                </div>
            </div>
            <div class="row cl">
                <label class="form-label col-xs-4 col-sm-2"><span class="c-red">*</span>规格：</label>
                <div class="formControls col-xs-8 col-sm-9">
                    <input id="spec" name="spec" type="text" class="input-text"  value="{{ isset($data['attribute']['spec']) ? $data['attribute']['spec'] : '' }}" placeholder="请输入商品规格">
                </div>
            </div>
            <div class="row cl">
                <label class="form-label col-xs-4 col-sm-2"><span class="c-red">*</span>货期：</label>
                <div class="formControls col-xs-8 col-sm-9">
                    <input id="delivery" name="delivery" type="text" class="input-text"  value="{{ isset($data['attribute']['delivery']) ? $data['attribute']['delivery'] : '' }}" placeholder="请输入货期">
                </div>
            </div>
            <div class="row cl">
                <label class="form-label col-xs-4 col-sm-2"><span class="c-red">*</span>仓库：</label>
                <div class="formControls col-xs-8 col-sm-9">
                    <input id="depot" name="depot" type="text" class="input-text"  value="{{ isset($data['attribute']['depot']) ? $data['attribute']['depot'] : '' }}" placeholder="请输入仓库">
                </div>
            </div>
            <div class="row cl">
                <label class="form-label col-xs-4 col-sm-2"><span class="c-red">*</span>品牌商户号：</label>
                <div class="formControls col-xs-8 col-sm-9">
                    <input id="merchant" name="merchant" type="text" class="input-text"  value="{{ isset($data['attribute']['merchant']) ? $data['attribute']['merchant'] : '' }}" placeholder="请输入品牌商户号">
                </div>
            </div>
            <div class="row cl">
                <label class="form-label col-xs-4 col-sm-2"><span class="c-red">*</span>分子量：</label>
                <div class="formControls col-xs-8 col-sm-9">
                    <input id="molecular" name="molecular" type="text" class="input-text"  value="{{ isset($data['attribute']['molecular']) ? $data['attribute']['molecular'] : '' }}" placeholder="请输入分子量">
                </div>
            </div>
            <div class="row cl">
                <label class="form-label col-xs-4 col-sm-2"><span class="c-red">*</span>精确量：</label>
                <div class="formControls col-xs-8 col-sm-9">
                    <input id="accurate" name="accurate" type="text" class="input-text"  value="{{ isset($data['attribute']['accurate']) ? $data['attribute']['accurate'] : '' }}" placeholder="请输入精确量">
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
        </form>
    </div>
@endsection

@section('script')
    <script type="text/javascript">
        $(function () {
            $("#form-testing-edit").validate({
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
                    spec: {
                        required: true,
                    },
                    delivery: {
                        required: true,
                    },
                    depot: {
                        required: true,
                    },
                    merchant: {
                        required: true,
                    },
                    molecular: {
                        required: true,
                    },
                    accurate: {
                        required: true,
                    },
                },
                onkeyup: false,
                focusCleanup: false,
                success: "valid",
                submitHandler: function (form) {
                    $(form).ajaxSubmit({
                        type: 'POST',
                        url: "{{ URL::asset('/admin/chem/edit')}}",
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
    </script>
@endsection