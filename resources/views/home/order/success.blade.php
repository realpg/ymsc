@extends('home.layouts.base')
@section('content')
    <div id="main-body">
        <div class="style-home-nav-station"></div>
        @include('home.layouts.payProgress')
        <div class="container margin-top-20 text-center">
            <div class="margin-top-20">
                <img src="{{URL::asset('img/pay_success.png')}}"  />
            </div>
            <h4>支付成功，<a href="{{ URL::asset('index') }}"><span class="text-blue">返回首页</span></a>继续购物</h4>
        </div>
    </div>
@endsection

@section('script')
@endsection