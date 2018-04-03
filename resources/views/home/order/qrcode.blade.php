@extends('home.layouts.base')
@section('content')
    <div id="main-body">
        <div class="style-home-nav-station"></div>
        @include('home.layouts.payProgress')
        <div class="container margin-top-20 text-center">
            @if($order['suborders'])
                <div class="border-box-active margin-top-20 margin-bottom-50 padding-20 width-100" style="min-height:300px;" id="payInfo">
                    <div class="col-xs-12 col-sm-6">
                        <h5>距离二维码过期还剩<span class="font-size-18 text-red" id="time">45</span>秒，过期后请重新刷新页面进行支付</h5>
                        <div id="output" class="margin-top-20 margin-bottom-20"></div>
                        <div style="width:256px;margin:0 auto;">
                            <h4>请打开微信扫一扫</h4>
                            <h4>扫描图中二维码进行支付</h4>
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-6">
                        <img src="{{URL::asset('img/pay_ts.png')}}"class="height-100" />
                    </div>
                    <div class="clear"></div>
                </div>
            @else
                <div class="margin-top-20 margin-right-10 margin-left-10 text-center">
                    <img src="{{ URL::asset('img/nothing.png') }}" />
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
        CountDown()
    })
    function result(trade_no){
        var param = {
            trade_no:trade_no,
            _token: "{{ csrf_token() }}"
        }
        getTheResultOfPayment('{{URL::asset('')}}', param, function (ret) {
            console.log("getTheResultOfPayment is : "+ JSON.stringify(ret))
            if (ret.result == true) {
                window.location.href = "{{URL::asset('order/pay/success')}}";
            } else {
                layer.msg(ret.msg, {icon: 2, time: 3000})
            }
        })
    }
    //倒计时
    var setTime;
    function CountDown(){
        var time=parseInt($("#time").text());
        setTime=setInterval(function(){
            if(time<=0){
                $('#payInfo').html('<img src="{{ URL::asset('img/nothing.png') }}" class="margin-bottom-20" /><h4>支付二维码已过期，请重新生成！</h4>')
                return;
            }
            if(time%5==0){
                var param={
                    trade_no: '{{$order['trade_no']}}',
                    _token: "{{ csrf_token() }}"
                }
                // console.log('getQrcodeState param is : '+JSON.stringify(param))
                getOrderState('{{URL::asset('')}}', param, function (ret) {
                    console.log('getOrderState is : '+JSON.stringify(ret))
                    if (ret.result == true) {
                        if(ret.code==1){
                            location.href="{{URL::asset('order/pay/success')}}"
                        }
                        else if(ret.code==0){
                            location.href="{{URL::asset('order/pay/fail/'.$order['trade_no'])}}"
                        }
                    }
                    else {
                        layer.msg(ret.msg, {icon: 2, time: 2000})
                    }
                })
            }
            time--;
            $("#time").text(time);
        },1000);
    }
</script>
@endsection