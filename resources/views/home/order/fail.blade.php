@extends('home.layouts.base')
@section('content')
    <div id="main-body">
        <div class="style-home-nav-station"></div>
        @include('home.layouts.payProgress')
        <div class="container margin-top-20 text-center">
            <div class="margin-top-20 margin-bottom-50">
                <img src="{{URL::asset('img/pay_fail.png')}}"  />
            </div>
            <h4>支付成功，<a href="{{ URL::asset('order/'.$trade_no) }}"><span class="text-blue">返回继续支付</span></a></h4>
        </div>
    </div>
@endsection

@section('script')
@endsection