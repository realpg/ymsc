@extends('admin.layouts.app')

@section('content')
    <div class="page-container">
        <form class="form form-horizontal" method="post" id="form-comment-edit">
            {{csrf_field()}}
            <div class="row cl">
                <label class="col-xs-4 col-sm-2"></label>
                <div class="col-xs-8 col-sm-8">
                    <div class="panel panel-default" style="padding-left:0px;padding-right:0px;">
                        <div class="panel-header">
                            货物信息
                        </div>
                        <div class="panel-body">
                            <div class="row cl">
                                <div class="col-xs-3 col-sm-3">需要采购的商品：</div>
                                <div class="col-xs-9 col-sm-9">{{$data['goods']}}</div>
                            </div>
                            <div class="row cl">
                                <div class="col-xs-3 col-sm-3">采购数量：</div>
                                <div class="col-xs-9 col-sm-9">{{$data['count']}}</div>
                            </div>
                            <div class="row cl">
                                <div class="col-xs-3 col-sm-3">采购单位：</div>
                                <div class="col-xs-9 col-sm-9">{{$data['unit']}}</div>
                            </div>
                            <div class="row cl">
                                <div class="col-xs-3 col-sm-3">纯度：</div>
                                <div class="col-xs-9 col-sm-9">{{$data['purity']}}</div>
                            </div>
                            <div class="row cl">
                                <div class="col-xs-3 col-sm-3">需求时效：</div>
                                <div class="col-xs-9 col-sm-9">{{$data['time']}}</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row cl">
                <label class="col-xs-4 col-sm-2"></label>
                <div class="col-xs-8 col-sm-8">
                    <div class="panel panel-default" style="padding-left:0px;padding-right:0px;">
                        <div class="panel-header">
                            联系人信息
                        </div>
                        <div class="panel-body">
                            <div class="row cl">
                                <div class="col-xs-3 col-sm-3">联系人：</div>
                                <div class="col-xs-9 col-sm-9">{{$data['name']}}</div>
                            </div>
                            <div class="row cl">
                                <div class="col-xs-3 col-sm-3">电话：</div>
                                <div class="col-xs-9 col-sm-9">{{$data['phonenum']}}</div>
                            </div>
                            <div class="row cl">
                                <div class="col-xs-3 col-sm-3">省：</div>
                                <div class="col-xs-9 col-sm-9">{{$data['province']}}</div>
                            </div>
                            <div class="row cl">
                                <div class="col-xs-3 col-sm-3">市：</div>
                                <div class="col-xs-9 col-sm-9">{{$data['city']}}</div>
                            </div>
                            <div class="row cl">
                                <div class="col-xs-3 col-sm-3">公司地址：</div>
                                <div class="col-xs-9 col-sm-9">{{$data['address']}}</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row cl">
                <label class="col-xs-4 col-sm-2"></label>
                <div class="col-xs-8 col-sm-8">
                    <div class="panel panel-default" style="padding-left:0px;padding-right:0px;">
                        <div class="panel-header">
                            备注信息
                        </div>
                        <div class="panel-body">{{$data['content']}}</div>
                    </div>
                </div>
            </div>
            <div class="row cl">
                <div class="col-xs-8 col-sm-9 col-xs-offset-4 col-sm-offset-2">
                    @if(!$data['status'])
                        <button onClick="searching_editDo('{{$data['id']}}')"  class="btn btn-success radius" type="button">标记已联系</button>
                    @endif
                    <button onClick="layer_close();" class="btn btn-default radius" type="button">取消</button>
                </div>
            </div>
        </form>
    </div>

@endsection

@section('script')
    <script type="text/javascript">
        $(function () {
        });

        /* 点击审核通过 */
        function searching_editDo(id) {
            var param = {
                id: id,
                _token: "{{ csrf_token() }}"
            }
            stampSearching('{{URL::asset('')}}', param, function (ret) {
                if (ret.result == true) {
                    layer.msg(ret.msg, {icon: 1, time: 1000});
                    setTimeout(function () {
                        // var index = parent.layer.getFrameIndex(window.name);
                        parent.$('.btn-refresh').click();
                        // parent.layer.close(index);
                    }, 1000)
                } else {
                    layer.msg(ret.msg, {icon: 2, time: 1000})
                }
            })
        }
    </script>
@endsection