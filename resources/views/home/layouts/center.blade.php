<style>
    label.error{
        top:0;
    }
</style>
<div class="col-xs-12 col-sm-2 " id="center-menu">
    <div class="list-group text-center margin-bottom-0">
        <div href="#" class="list-group-item border-radius-0 background-navy-blue text-white border-navy-blue">
            基本信息管理
        </div>
        <a href="{{ URL::asset('center') }}" class="list-group-item {{$column_child=='index'?'active_center':''}}">个人信息</a>
        <a href="{{ URL::asset('center/address') }}" class="list-group-item {{$column_child=='address'?'active_center':''}}">地址管理</a>
        <a href="#" class="list-group-item {{$column_child=='invoice'?'active_center':''}}">发票管理</a>
    </div>
    <div class="list-group text-center margin-bottom-0">
        <div href="#" class="list-group-item border-radius-0 background-navy-blue text-white border-navy-blue">
            订单管理
        </div>
        <a href="#" class="list-group-item {{$column_child=='order'?'active_center':''}}">我的订单</a>
        <a href="#" class="list-group-item {{$column_child=='refund'?'active_center':''}}">退款单</a>
    </div>
    <div class="list-group text-center margin-bottom-0">
        <div href="#" class="list-group-item border-radius-0 background-navy-blue text-white border-navy-blue">
            我的资产
        </div>
        <a href="#" class="list-group-item {{$column_child=='score'?'active_center':''}}">我的积分</a>
    </div>
</div>