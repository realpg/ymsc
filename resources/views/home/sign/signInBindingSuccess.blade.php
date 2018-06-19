@extends('home.layouts.base')
@section('content')
    <div id="main-body">
        <div class="style-home-nav-station"></div>
        <div class="container margin-top-70 text-center">
            <div class="border-box-active margin-top-20 margin-bottom-50 padding-20 width-100" style="min-height:300px;">
                <div class="margin-top-30 margin-bottom-50">
                    <img src="{{URL::asset('img/pay_success.png')}}" class="width-110"  />
                </div>
                <h4 class="line-height-40">绑定成功，下次可直接扫描二维码进行微信登录<br /><a href="javascript:" onclick="back()"><span class="text-blue">点击此处返回继续购物</span></a></h4>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script type="text/javascript">
        function back(){
            var back=getCookie('before_url')
            delCookie('before_url')
            window.location.href = back;//返回上一页并刷新
        }
    </script>
@endsection