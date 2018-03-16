@extends('home.layouts.base')
@section('content')
    <div id="main-body">
        <div class="style-home-nav-station"></div>
        @include('home.layouts.payProgress')
        <div class="container margin-top-20 text-center">
            @if($order['suborders'])
                <div id="output" class="margin-top-20"></div>
                <h4>请打开微信扫一扫，扫描图中二维码进行支付</h4>
                <h4>支付后<a href="javascript:" onclick="result('{{$order['trade_no']}}')"><span class="font-blue">请点击此链接查看结果</span></a></h4>
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
    function result(trade_no){
        var param = {
            trade_no:trade_no,
            _token: "{{ csrf_token() }}"
        }
        getTheResultOfPayment('{{URL::asset('')}}', param, function (ret) {
            if (ret.result == true) {
                window.location.href = "{{URL::asset('order/pay/success')}}";
            } else {
                window.location.href = "{{URL::asset('order/pay/fail/')}}"+"/"+trade_no;
            }
        })
    }
</script>
@endsection