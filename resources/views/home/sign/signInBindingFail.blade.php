@extends('home.layouts.base')
@section('content')
    <div id="main-body">
        <div class="style-home-nav-station"></div>
        <div class="container margin-top-70 text-center">
            <div class="border-box-active margin-top-20 margin-bottom-50 padding-20 width-100" style="min-height:300px;">
                <div class="margin-top-30 margin-bottom-50">
                    <img src="{{URL::asset('img/pay_fail.png')}}" class="width-110"  />
                </div>
                <h4 class="line-height-40">绑定失败<br /><a href="{{ URL::asset('signIn') }}"><span class="text-blue">返回重新登录</span></a></h4>
            </div>
        </div>
    </div>
@endsection

@section('script')
@endsection