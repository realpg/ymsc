@extends('home.layouts.base')

@section('content')
<div id="main-body">
    <div class="style-home-nav-station"></div>
    <div class="container margin-top-20 margin-bottom-20">
        @include('home.layouts.center')
        <div class="col-xs-12 col-sm-10 border-center-menu padding-top-10 padding-bottom-10  line-height-34" id="center-content">
            <form method="post" id="form-league-edit">
                {{ csrf_field() }}
                <div class="col-xs-12 col-sm-8">
                    <div class="row position-relative margin-top-20">
                        <div class="col-xs-6 col-sm-3 text-right">昵 称：</div>
                        <div class="col-xs-6 col-sm-8">
                            <input type="text" name="nick_name" id="nick_name" class="form-control" value="{{$user['nick_name']}}" placeholder="请输入昵称">
                        </div>
                    </div>
                    <div class="row position-relative margin-top-20">
                        <div class="col-xs-6 col-sm-3 text-right">真 实 姓 名：</div>
                        <div class="col-xs-6 col-sm-8">
                            <input type="text" name="real_name" id="real_name" value="{{$user['real_name']}}" class="form-control" placeholder="请输入真实姓名">
                        </div>
                    </div>
                    <div class="row position-relative margin-top-20">
                        <div class="col-xs-6 col-sm-3 text-right">手 机 号：</div>
                        <div class="col-xs-6 col-sm-8">
                            @if($user['phonenum'])
                                {{$user['phonenum']}} <a href=""><span class="text-blue">修改绑定手机号</span></a>
                            @else
                                <input type="text" name="phonenum" id="phonenum" class="form-control" placeholder="请输入绑定的手机号">
                            @endif
                        </div>
                    </div>
                    <div class="row position-relative margin-top-20">
                        <div class="col-xs-6 col-sm-3 text-right" style="line-height: 34px;">邮 箱：</div>
                        <div class="col-xs-6 col-sm-8">
                            @if($user['email'])
                                {{$user['email']}} <a href=""><span class="text-blue">修改绑定的邮箱</span></a>
                            @else
                                <input type="text" name="email" id="email" class="form-control" placeholder="请输入绑定的邮箱">
                            @endif
                        </div>
                    </div>
                    <div class="row position-relative margin-top-20">
                        <div class="col-xs-6 col-sm-3 text-right">Q Q：</div>
                        <div class="col-xs-6 col-sm-8">
                            <input type="text" name="qq" id="qq" value="{{$user['qq']}}" class="form-control" placeholder="请输入QQ号">
                        </div>
                    </div>
                    <div class="row position-relative margin-top-20">
                        <div class="col-xs-6 col-sm-3 text-right">微 信 号：</div>
                        <div class="col-xs-6 col-sm-8">
                            <input type="text" name="wechat" id="wechat" value="{{$user['wechat']}}" class="form-control" placeholder="请输入微信号">
                        </div>
                    </div>
                    <div class="row position-relative margin-top-20">
                        <div class="col-xs-6 col-sm-3 text-right">性 别：</div>
                        <div class="col-xs-6 col-sm-8">
                            <input type="radio" name="gender" id="gender_1" value="1" checked>&nbsp; 男&nbsp;
                            <input type="radio" name="gender" id="gender_2" value="2">&nbsp; 女
                        </div>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-2">
                    <div class="margin-top-20 text-center">
                        @if($user['avatar'])
                            <img src="{{$user['avatar']}}" class="width-150 border-radius-100" />
                        @else
                            @if($user['gender']==2)
                                <img src="{{URL::asset('img/avatar_girl.png')}}" class="width-150 border-radius-100" />
                            @else
                                <img src="{{URL::asset('img/avatar_boy.png')}}" class="width-150 border-radius-100" />
                            @endif
                        @endif
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 text-center margin-top-20 margin-bottom-20">
                    <button type="button" class="btn btn-info">确 认 修 改</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('script')

@endsection