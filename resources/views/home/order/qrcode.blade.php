@extends('home.layouts.base')
@section('content')
    <div id="main-body">
        <div class="style-home-nav-station"></div>
        @include('home.layouts.payProgress')
        <div class="container margin-top-20 text-center">
            @if($order['suborders'])
                <div id="output"></div>
                <h4>请打开微信扫一扫，扫描图中二维码进行支付</h4>
            @else
                <div class="margin-top-20 margin-right-10 margin-left-10 text-center">
                    <img src="{{ URL::asset('img/nothing.png') }}"  />
                </div>
                <div class="margin-top-20 text-center index-font">
                    支付二维码生成失败！
                </div>
            @endif
        </div>
    </div>
@endsection

@section('script')
<script type="text/javascript" src="{{URL::asset('js/jquery.qrcode.min.js')}}"></script>
<script type="text/javascript">
    $(function(){
        $('#output').qrcode("{{$order['code_url']}}");
    })
</script>
@endsection