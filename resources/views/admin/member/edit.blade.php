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
                <label class="form-label col-xs-4 col-sm-2">头像：</label>
                <div class="formControls col-xs-8 col-sm-9">
                    @if($data['avatar'])
                        <img src="{{$data['avatar']}}" class="member-image" />
                    @else
                        <img src="{{URL::asset('/img/default_headicon.png')}}" class="member-image" />
                    @endif
                </div>
            </div>
            <div class="row cl">
                <label class="form-label col-xs-4 col-sm-2">昵称：</label>
                <div class="formControls col-xs-8 col-sm-9">
                    <input type="text" readonly class="input-text" value="{{ isset($data['nick_name']) ? $data['nick_name'] : '' }}">
                </div>
            </div>
            <div class="row cl">
                <label class="form-label col-xs-4 col-sm-2">真实姓名：</label>
                <div class="formControls col-xs-8 col-sm-9">
                    <input type="text" readonly class="input-text" value="{{ isset($data['real_name']) ? $data['real_name'] : '' }}">
                </div>
            </div>
            <div class="row cl">
                <label class="form-label col-xs-4 col-sm-2">电话：</label>
                <div class="formControls col-xs-8 col-sm-9">
                    <input type="text" readonly class="input-text" value="{{ isset($data['phonenum']) ? $data['phonenum'] : '' }}">
                </div>
            </div>
            <div class="row cl">
                <label class="form-label col-xs-4 col-sm-2">电子邮件：</label>
                <div class="formControls col-xs-8 col-sm-9">
                    <input type="text" readonly class="input-text" value="{{ isset($data['email']) ? $data['email'] : '' }}">
                </div>
            </div>
            <div class="row cl">
                <label class="form-label col-xs-4 col-sm-2">QQ号：</label>
                <div class="formControls col-xs-8 col-sm-9">
                    <input type="text" readonly class="input-text" value="{{ isset($data['qq']) ? $data['qq'] : '' }}">
                </div>
            </div>
            <div class="row cl">
                <label class="form-label col-xs-4 col-sm-2">微信号：</label>
                <div class="formControls col-xs-8 col-sm-9">
                    <input type="text" readonly class="input-text" value="{{ isset($data['wechat']) ? $data['wechat'] : '' }}">
                </div>
            </div>
            <div class="row cl">
                <label class="form-label col-xs-4 col-sm-2">性别：</label>
                <div class="formControls col-xs-8 col-sm-9">
                    <input type="text" readonly class="input-text" value="{{ isset($data['gender']) ? $data['gender']==1?'男':'女' : '' }}">
                </div>
            </div>
            <div class="row cl">
                <label class="form-label col-xs-4 col-sm-2">积分：</label>
                <div class="formControls col-xs-8 col-sm-9">
                    <input type="text" readonly class="input-text" value="{{ isset($data['score']) ? $data['score'] : '' }}">
                </div>
            </div>
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