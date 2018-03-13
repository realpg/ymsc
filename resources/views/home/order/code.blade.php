@extends('home.layouts.base')
@section('content')
    <div id="main-body">
        <div class="style-home-nav-station"></div>
        @include('home.layouts.payProgress')
        <div class="container margin-top-20">
            @if($order['suborders'])
                <h4>请打开微信扫一扫，扫描图中二维码进行支付</h4>
                {{$order['code_url']}}
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
<script type="text/javascript" src="{{ URL::asset('/js/jQueryProvinces/address-select.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('/js/swiper-3.4.0.jquery.min.js') }}"></script>
<script type="text/javascript">
    $(function () {
        $("#form-center-address-edit").validate({
            rules: {
                name:{
                    required:true,
                },
                phonenum:{
                    required:true,
                    maxlength:11,
                    minlength:11,
                },
                address_province:{
                    required:true,
                },
                address_city:{
                    required:true,
                },
                address_town:{
                    required:true,
                },
                address_address:{
                    required:true,
                },
                address_detail:{
                    required:true,
                },
            },
            onkeyup: false,
            focusCleanup: false,
            success: "valid",
            submitHandler: function (form) {
                $(form).ajaxSubmit({
                    type: 'POST',
                    url: "{{ URL::asset('center/address')}}",
                    success: function (ret) {
                        if (ret.result) {
                            layer.msg(ret.msg, {icon: 1, time: 2000});
                            window.location.reload()
                        } else {
                            layer.msg(ret.msg, {icon: 2, time: 2000});
                        }
                    },
                    error: function (XmlHttpRequest, textStatus, errorThrown) {
                        layer.msg('操作失败', {icon: 2, time: 2000});
                        console.log("XmlHttpRequest:" + JSON.stringify(XmlHttpRequest));
                        console.log("textStatus:" + textStatus);
                        console.log("errorThrown:" + errorThrown);
                    }
                });
            }

        });
        $('#tab').find('li').click(function(){
            var index = $(this).index();
            $(this).addClass('tab_active').siblings().removeClass('tab_active');
            $('.tab_content').find('li').eq(index).show().siblings().hide();
        })
        $("#form-center-invoice-ordinary-edit").validate({
            rules: {
                type:{
                    required:true,
                },
                title:{
                    required:true,
                },
                credit:{
                    required:true,
                },
                invoice_name:{
                    required:true,
                },
                invoice_phonenum:{
                    required:true,
                },
                invoice_address:{
                    required:true,
                },
            },
            onkeyup: false,
            focusCleanup: false,
            success: "valid",
            submitHandler: function (form) {
                var name=$('#invoice_name').val();
                var phonenum=$('#invoice_phonenum').val();
                var address=$('#invoice_address').val();
                if(name){
                    if(isPhone(phonenum)){
                        if(address){
                            $(form).ajaxSubmit({
                                type: 'POST',
                                url: "{{ URL::asset('center/invoice')}}",
                                success: function (ret) {
                                    console.log(JSON.stringify(ret));
                                    if (ret.result) {
                                        layer.msg(ret.msg, {icon: 1, time: 2000});
                                        window.location.reload()
                                    } else {
                                        layer.msg(ret.msg, {icon: 2, time: 2000});
                                    }
                                },
                                error: function (XmlHttpRequest, textStatus, errorThrown) {
                                    layer.msg('操作失败', {icon: 2, time: 2000});
                                    console.log("XmlHttpRequest:" + JSON.stringify(XmlHttpRequest));
                                    console.log("textStatus:" + textStatus);
                                    console.log("errorThrown:" + errorThrown);
                                }
                            });
                        }
                        else{
                            layer.msg('请填写收票人地址', {icon: 2, time: 2000});
                        }
                    }
                    else{
                        layer.msg('请填写正确的电话号码', {icon: 2, time: 2000});
                    }
                }
                else{
                    layer.msg('请填写收票人姓名', {icon: 2, time: 2000});
                }
            }

        });
    });
    //结算
    function pay(){
        var address_id=$("input[name='address_id']:checked").val();
        var invoice_id=$("input[name='invoice_id']:checked").val();
        var trade_no=$('#trade_no').text();
        var content=$('#content').val();
        var param = {
            address_id: address_id,
            invoice_id:invoice_id,
            trade_no:trade_no,
            content:content,
            _token: "{{ csrf_token() }}"
        }
        payOrder('{{URL::asset('')}}', param, function (ret) {
            console.log("editOrder ret is : "+JSON.stringify(ret))
            if (ret.result == true) {
                window.location.href = "{{URL::asset('order/pay/code')}}"+"/"+trade_no;
            } else {
                layer.msg(ret.msg, {icon: 2, time: 3000})
            }
        })
    }
</script>
@endsection