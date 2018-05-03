@extends('home.layouts.base')
@section('content')
<div id="main-body">
    <div class="style-home-nav-station"></div>
    @include('home.layouts.payProgress')
    <div class="container margin-top-20" id="cart-content">
        <div class="table-responsive">
            <table class="table border-0">
                <tr class="line-height-40 text-center">
                    <td class="background-detail width-110px">
                        <input type="checkbox" id='checkall' class='checkAll' > 全选
                    </td>
                    <td class="background-detail">图片</td>
                    <td class="background-detail">商品</td>
                    <td class="background-detail">单价（元）</td>
                    <td class="background-detail">商品单位</td>
                    <td class="background-detail">数量</td>
                    <td class="background-detail">库存</td>
                    <td class="background-detail">小计（元）</td>
                    <td class="background-detail">操作</td>
                </tr>
                @foreach($carts as $k=>$cart)
                    @if($cart['goods_info']['stock']>0||$cart['goods_id']==1)
                        <tr class="text-center">
                        <td class="border-bottom-attribute" style="display:table-cell;vertical-align:middle;">
                            <input type="checkbox" name="id_array" value="{{$cart['id']}}" class='checkSingle'>
                        </td>
                        <td class="border-bottom-attribute"  style="display:table-cell;vertical-align:middle;">
                            @if($cart['goods_menu']['menu_id']==1)
                                <a href="{{URL::asset($cart['goods_column'].'/detail/'.$cart['goods_info']['id'])}}">
                            @elseif($cart['goods_menu']['menu_id']==2)
                                <a href="{{URL::asset($cart['goods_column'].'/detail/'.$cart['goods_info']['id'])}}">
                            @elseif($cart['goods_menu']['menu_id']==3)
                                @if($cart['goods_type']==0)
                                <a href="{{URL::asset($cart['goods_column'].'/detail/machining/'.$cart['goods_info']['id'])}}">
                                @else
                                <a href="{{URL::asset($cart['goods_column'].'/detail/standard/'.$cart['goods_info']['id'])}}">
                                @endif
                            @endif
                                    <img src="{{$cart['goods_info']['picture']}}" alt="{{$cart['goods_info']['name']}}" class="width-50px height-50" />
                            @if($cart['goods_menu']['menu_id']==1||$cart['goods_menu']['menu_id']==2||$cart['goods_menu']['menu_id']==3)
                                </a>
                            @endif
                        </td>
                        <td class="border-bottom-attribute width-250 text-left" style="display:table-cell;vertical-align:middle;">
                            @if($cart['goods_menu']['menu_id']==1)
                                <a href="{{URL::asset($cart['goods_column'].'/detail/'.$cart['goods_info']['id'])}}">
                            @elseif($cart['goods_menu']['menu_id']==2)
                                <a href="{{URL::asset($cart['goods_column'].'/detail/'.$cart['goods_info']['id'])}}">
                            @elseif($cart['goods_menu']['menu_id']==3)
                                @if($cart['goods_type']==0)
                                <a href="{{URL::asset($cart['goods_column'].'/detail/machining/'.$cart['goods_info']['id'])}}">
                                @else
                                <a href="{{URL::asset($cart['goods_column'].'/detail/standard/'.$cart['goods_info']['id'])}}">
                                @endif
                            @endif
                                商品货号：{{$cart['goods_info']['number']}}<br />
                                商品名称：{{$cart['goods_info']['name']}}
                            @if($cart['goods_menu']['menu_id']==1||$cart['goods_menu']['menu_id']==2||$cart['goods_menu']['menu_id']==3)
                                </a>
                            @endif
                        </td>
                        <td class="border-bottom-attribute" style="display:table-cell;vertical-align:middle;" id="price_{{$cart['id']}}">{{$cart['goods_info']['price']/100}}</td>
                        <td class="border-bottom-attribute" style="display:table-cell;vertical-align:middle;">{{$cart['goods_info']['unit']}}</td>
                        <td class="border-bottom-attribute" style="display:table-cell;vertical-align:middle;">
                            <input id="min_{{$cart['id']}}" onclick="minCount('{{$cart['id']}}')" name="" type="button" value="-" class="background-none border-div {{$cart['count']==1?'no_click':''}}" {{$cart['count']==1?'disabled':''}} />
                            @if($cart['goods_id']!=1)
                                <input id="text_box_{{$cart['id']}}" name="count" type="text" value="{{$cart['count']>$cart['goods_info']['stock']?$cart['goods_info']['stock']:$cart['count']}}" class="border-div width-50px common-text-align-center" readonly/>
                            @else
                                <input id="text_box_{{$cart['id']}}" name="count" type="text" value="{{$cart['count']}}" class="border-div width-50px common-text-align-center" readonly/>
                            @endif
                            @if($cart['goods_id']!=1)
                                <input id="add_{{$cart['id']}}" onclick="addCount('{{$cart['id']}}')" name="" type="button" value="+" class="background-none border-div {{$cart['count']==$cart['goods_info']['stock']?'no_click':''}}" {{$cart['count']==$cart['goods_info']['stock']?'disabled':''}} />
                            @else
                                <input id="add_{{$cart['id']}}" onclick="addCount('{{$cart['id']}}')" name="" type="button" value="+" class="background-none border-div" />
                            @endif
                        </td>
                        @if($cart['goods_id']==1)
                            <td class="border-bottom-attribute" id="stock_{{$cart['id']}}" style="display:table-cell;vertical-align:middle;">无限</td>
                        @else
                            <td class="border-bottom-attribute" id="stock_{{$cart['id']}}" style="display:table-cell;vertical-align:middle;">{{$cart['goods_info']['stock']}}</td>
                        @endif
                        <td class="border-bottom-attribute text-red" style="display:table-cell;vertical-align:middle;" id="total_{{$cart['id']}}">
                            @if($cart['goods_id']!=1)
                                @if($cart['count']<$cart['goods_info']['stock'])
                                    {{$cart['goods_info']['price']/100*$cart['count']}}
                                @else
                                    {{$cart['goods_info']['price']/100*$cart['goods_info']['stock']}}
                                @endif
                            @else
                                {{$cart['goods_info']['price']/100*$cart['count']}}
                            @endif
                        </td>
                        <td class="border-bottom-attribute" style="display:table-cell;vertical-align:middle;">
                            <a href="javascript:" onclick="cart_del(this,'{{$cart['id']}}')" >
                                删除
                            </a>
                        </td>
                    </tr>
                    @else
                        <tr class="text-center background-detail">
                            <td class="border-bottom-attribute" style="display:table-cell;vertical-align:middle;">
                                失效
                            </td>
                            <td class="border-bottom-attribute"  style="display:table-cell;vertical-align:middle;">
                                <img src="{{$cart['goods_info']['picture']}}" alt="{{$cart['goods_info']['name']}}" class="width-50px height-50" />
                            </td>
                            <td class="border-bottom-attribute width-250 text-left" style="display:table-cell;vertical-align:middle;">
                                商品货号：{{$cart['goods_info']['number']}}<br />
                                商品名称：{{$cart['goods_info']['name']}}
                            </td>
                            <td class="border-bottom-attribute" style="display:table-cell;vertical-align:middle;" id="price_{{$cart['id']}}">{{$cart['goods_info']['price']/100}}</td>
                            <td class="border-bottom-attribute" style="display:table-cell;vertical-align:middle;">{{$cart['goods_info']['unit']}}</td>
                            <td class="border-bottom-attribute" style="display:table-cell;vertical-align:middle;">-</td>
                            <td class="border-bottom-attribute" id="stock_{{$cart['id']}}" style="display:table-cell;vertical-align:middle;">0</td>
                            <td class="border-bottom-attribute" style="display:table-cell;vertical-align:middle;" id="total_{{$cart['id']}}">-</td>
                            <td class="border-bottom-attribute" style="display:table-cell;vertical-align:middle;">
                                <a href="javascript:" onclick="cart_del(this,'{{$cart['id']}}')" >
                                    删除
                                </a>
                            </td>
                        </tr>
                    @endif
                @endforeach
            </table>
            @if(count($carts)>0)
            <table class="table border-detail">
                <tr class="line-height-40 text-center">
                    <td class="width-110" style="display:table-cell;vertical-align:middle;border:0px;">
                        <input type="checkbox" id='checkall' class='checkAll' > 全选
                    </td>
                    <td class="text-left text-blue" style="display:table-cell;vertical-align:middle;border:0px;">
                        <a href="javascript:" onclick="cart_delMore()" >
                            批量删除选中的商品
                        </a>
                    </td>
                    <td class="text-right width-250" style="display:table-cell;vertical-align:middle;border:0px;">
                        已选择<span class="text-red" id="count_all">0</span>件商品
                    </td>
                    <td class="text-right width-150" style="display:table-cell;vertical-align:middle;border:0px;">总价（不包含邮费）</td>
                    <td class="text-center width-150" style="display:table-cell;vertical-align:middle;border:0px;">
                        ￥<span class="text-red" id="total_all">0</span>
                    </td>
                    <td class="width-110 text-white background-blue cart-settlement" style="display:table-cell;vertical-align:middle;border:0px;padding:0px;" >
                        <a href="javascript:" onclick="settlement()" class="line-height-40">
                            立即结算
                        </a>
                    </td>
                </tr>
            </table>
            @else
                <div class="margin-top-20 margin-right-10 margin-left-10 text-center">
                    <img src="{{ URL::asset('img/nothing.png') }}"  />
                </div>
                <div class="margin-top-20 text-center index-font">
                    购物车里还没有添加商品，快去选购吧！
                </div>
            @endif
        </div>
    </div>
</div>
@endsection

@section('script')
<script>
    function minCount(id){
        $('#min_'+id).attr('disabled',true);
        var t=$("#text_box_"+id);
        var count=Math.abs(parseInt(t.val()))-1
        if (parseInt(t.val())==1){
            layer.msg('数量必须大于1', {icon: 2, time: 3000})
            $('#min_'+id).attr('disabled',true);
        }
        else{
            $('#min_'+id).attr('disabled',false);
            editShoppingCartCount(id,count)
        }
    }
    function addCount(id){
        var t=$("#text_box_"+id);
        // $('#min_'+id).attr('disabled',true);
        var count=Math.abs(parseInt(t.val()))+1
        var stock=$('#stock_'+id).text();
        if(stock=='无限'){
            if (parseInt(t.val())!=1){
                $('#min_'+id).attr('disabled',false);
            };
            editShoppingCartCount(id,count)
        }
        else{
            stock=Math.abs(parseInt(stock))
            if(count<=stock){
                if (parseInt(t.val())!=1){
                    $('#min_'+id).attr('disabled',false);
                };
                editShoppingCartCount(id,count)
            }
            else{
                $('#add_'+id).attr('disabled',false);
                layer.msg('数量已到上限', {icon: 2, time: 3000})
            }
        }
    }
    function editShoppingCartCount(id,count){
        var param={
            id: id,
            count:count,
            _token: "{{ csrf_token() }}"
        }
        editShoppingCart('{{URL::asset('')}}', param, function (ret) {
            if (ret.result == true) {
                var t=$("#text_box_"+id);
                t.val(count);

                var price=parseFloat($('#price_'+id).text());
                var total=(price*count).toFixed(2);
                $('#total_'+id).text(total);

                //判断数量的状态，如果小于1失效减，如果大于库存失效加
                var stock=$('#stock_'+id).text();
                stock=Math.abs(parseInt(stock))
                if(count>=stock){
                    $('#add_'+id).addClass('no_click');
                    $('#add_'+id).attr('disabled',true);
                }
                else{
                    $('#add_'+id).removeClass('no_click');
                    $('#add_'+id).attr('disabled',false);
                }
                if(count<=1){
                    $('#min_'+id).addClass('no_click');
                    $('#min_'+id).attr('disabled',true);
                }
                else{
                    $('#min_'+id).removeClass('no_click');
                    $('#min_'+id).attr('disabled',false);
                }

                statistics()


            }
            else{
                layer.msg('操作失败', {icon: 2, time: 3000})
            }
        })
    }
    //全选
    $(".checkAll").click(function () {
        if ($(this).is(":checked") == true) {
            $("input[class=checkSingle]").each(function (h) {
                $(this).prop("checked",true);
                // $(this).parent().parent().css("background-color","#E3EFFA");
                $(this).parent().parent().addClass("background-light"); //选中状态高亮
            });
        }else {
            $("input[class=checkSingle]").each(function (h) {
                $(this).prop("checked",false);
                // $(this).parent().parent().css("background-color","#ffffff");
                $(this).parent().parent().removeClass("background-light");
            });
        }
        statistics()
    });
    //选中一行
    var checknum = $("input[class=checkSingle]").size();
    $(".checkSingle").click(function () {
        if ($(this).is(":checked") == true) {
            if($(".checkSingle:checked").length == checknum){

                $(".checkAll").prop("checked",true);
            }else{
                $(".checkAll").prop("checked",false);
            }
            // $(this).parent().parent().css("background-color","#E3EFFA"); //选中状态高亮
            $(this).parent().parent().addClass("background-light"); //选中状态高亮

        }else {
            if($(".checkSingle:checked").length == checknum){
                $(".checkAll").prop("checked",true);
            }else{
                $(".checkAll").prop("checked",false);
            }
            // $(this).parent().parent().css("background-color","#ffffff");
            $(this).parent().parent().removeClass("background-light");
        }
        statistics()
    });
    //批量删除
    function cart_delMore(){
        var id_array=''
        $("input:checkbox[name='id_array']:checked").each(function() { // 遍历name=test的多选框
            id_array=id_array+$(this).val()+',';  // 每一个被选中项的值
        });
        id_array=id_array.substring(0,id_array.length-1)
        var param = {
            id_array: id_array,
            _token: "{{ csrf_token() }}"
        }
        if(id_array){
            delMoreShoppingCart('{{URL::asset('')}}', param, function (ret) {
                if (ret.result == true) {
                    layer.msg(ret.msg, {icon: 1, time: 1000});
                    window.location.reload()
                } else {
                    if(ret.code==9999){
                        location.href='{{URL::asset('signIn')}}';
                    }
                    else{
                        layer.msg(ret.msg, {icon: 2, time: 3000})
                    }
                }
            })
        }
        else{
            layer.msg('请选择要删除的商品', {icon: 2, time: 2000})
        }
    }
    //统计
    function statistics(){
        var id_array=new Array();
        $("input:checkbox[name='id_array']:checked").each(function() { // 遍历name=test的多选框
            // 每一个被选中项的值
            id_array.push($(this).val())
        });
        // console.log("statistics id_array is : "+JSON.stringify(id_array));
        var count=0
        var total=0
        for(var i=0;i<id_array.length;i++){
            count+=parseInt($('#text_box_'+id_array[i]).val());
            total+=parseFloat($('#total_'+id_array[i]).text());
        }
        console.log("statistics count is : "+count+" ; statistics total is : "+total);
        $('#count_all').text(count);
        $('#total_all').text((total).toFixed(2));
    }
    //结算
    function settlement(){
        var id_array=new Array();
        $("input:checkbox[name='id_array']:checked").each(function() { // 遍历name=test的多选框
            // 每一个被选中项的值
            id_array.push($(this).val())
        });
        if(id_array.length>0){
            var total=$('#total_all').text();
            var count=$('#count_all').text();
            var param = {
                id_array: id_array,
                total:total,
                count:count,
                _token: "{{ csrf_token() }}"
            }
            addOrder('{{URL::asset('')}}', param, function (ret) {
                if (ret.result == true) {
                    layer.msg(ret.msg, {icon: 1, time: 1000});
                    window.location.href = "{{URL::asset('order')}}";
                } else {
                    if(ret.code==9999){
                        location.href='{{URL::asset('signIn')}}';
                    }
                    else{
                        layer.msg(ret.msg, {icon: 2, time: 3000})
                    }
                }
            })
        }
        else{
            layer.msg('请选择要结算的商品', {icon: 2, time: 2000})
        }
    }
</script>
@endsection