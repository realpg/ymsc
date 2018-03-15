@extends('admin.layouts.app')

@section('content')
    <style>
        .member-image{
            width:100px;
            height:100px;
            border-radius: 100%;
        }
    </style>
    <div class="page-container">
        <form class="form form-horizontal" method="post" id="form-member-edit">
            {{csrf_field()}}
            <div class="row cl">
                <label class="form-label col-xs-4 col-sm-2">订单号：</label>
                <div class="formControls col-xs-8 col-sm-9">
                    <input type="text" readonly class="input-text on_click" value="{{ isset($data['trade_no']) ? $data['trade_no'] : '' }}">
                </div>
            </div>
            <div class="row cl">
                <label class="form-label col-xs-4 col-sm-2">微信预付订单号：</label>
                <div class="formControls col-xs-8 col-sm-9">
                    <input type="text" readonly class="input-text on_click" value="{{ isset($data['prepay_id']) ? $data['prepay_id'] : '' }}">
                </div>
            </div>
            <div class="row cl">
                <label class="form-label col-xs-4 col-sm-2">总价（元）：</label>
                <div class="formControls col-xs-8 col-sm-9">
                    <input type="text" readonly class="input-text on_click" value="{{ isset($data['total_fee']) ? $data['total_fee']/100 : '' }}">
                </div>
            </div>
            <div class="row cl">
                <label class="form-label col-xs-4 col-sm-2">数量：</label>
                <div class="formControls col-xs-8 col-sm-9">
                    <input type="text" readonly class="input-text on_click" value="{{ isset($data['count']) ? $data['count'] : '' }}">
                </div>
            </div>
            @if($data['content'])
            <div class="row cl">
                <label class="form-label col-xs-4 col-sm-2">备注：</label>
                <div class="formControls col-xs-8 col-sm-9">
                    <textarea wrap="\n" class="textarea on_click" style="resize:vertical;" dragonfly="true">{{ isset($data['content']) ? $data['content'] : '' }}</textarea>
                </div>
            </div>
            @endif
            <div class="row cl">
                <div class="col-xs-8 col-sm-9 col-xs-offset-4 col-sm-offset-2">
                    <button onClick="layer_close();" class="btn btn-default radius" type="button">返回</button>
                </div>
            </div>
        </form>
    </div>

@endsection

@section('script')
    <script type="text/javascript">
        $(function () {
        });
    </script>
@endsection