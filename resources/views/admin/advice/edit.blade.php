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
                            <div class="col-xs-4 col-sm-4">
                                <i class="Hui-iconfont">&#xe62c;</i> {{$data['name']}}
                            </div>
                            <div class="col-xs-4 col-sm-4">
                                <i class="Hui-iconfont">&#xe6a3;</i> {{$data['phonenum']}}
                            </div>
                            <div class="col-xs-4 col-sm-4">
                                <i class="Hui-iconfont">&#xe63b;</i> {{$data['email']}}
                            </div>
                            <div style="clear: both;"></div>
                        </div>
                        <div class="panel-body">
                            <p>
                                反馈类型：{{$data['type']}}
                            </p>
                            <p>
                                {{$data['content']}}
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row cl">
                <div class="col-xs-8 col-sm-9 col-xs-offset-4 col-sm-offset-2">
                    @if(!$data['status'])
                        <button onClick="advice_editDo('{{$data['id']}}')"  class="btn btn-success radius" type="button">标记已处理</button>
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
        function advice_editDo(id) {
            var param = {
                id: id,
                _token: "{{ csrf_token() }}"
            }
            stampAdvice('{{URL::asset('')}}', param, function (ret) {
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