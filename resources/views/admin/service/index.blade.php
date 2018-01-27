@extends('admin.layouts.app')

@section('content')
<nav class="breadcrumb"><i class="Hui-iconfont">&#xe67f;</i> 首页 <span class="c-gray en">&gt;</span> 客服管理 <span class="c-gray en">&gt;</span> 客服列表 <a class="btn btn-success radius btn-refresh r" style="line-height:1.6em;margin-top:3px" href="javascript:location.replace(location.href);" onclick="location.replace('{{URL::asset('/admin/service/index')}}');" title="刷新" ><i class="Hui-iconfont">&#xe68f;</i></a></nav>
<div class="page-container">
    <div class="mt-20">
        <table class="table table-border table-bordered table-bg table-hover table-sort" id="table-sort">
            <thead>
            <tr class="text-c">
                <th width="80">ID</th>
                <th>名称</th>
                <th>电话</th>
                <th>QQ</th>
                <th width="150">更新时间</th>
                <th width="100">操作</th>
            </tr>
            </thead>
            <tbody>
            @foreach($datas as $data)
                <tr class="text-c">
                    <td>{{$data['id']}}</td>
                    <td class="text-l">{{$data['name']}}</td>
                    <td class="text-l">{{$data['phonenum']}}</td>
                    <td class="text-l">{{$data['qq']}}</td>
                    <td>{{$data['updated_at']}}</td>
                    <td class="td-manage">
                        <a title="编辑" href="javascript:;" onclick="service_edit('客服编辑','{{URL::asset('/admin/service/edit')}}?id={{$data['id']}}',{{$data['id']}})" class="ml-5" style="text-decoration:none">
                            <i class="Hui-iconfont">&#xe6df;</i>
                        </a>
                        {{--<a title="删除" href="javascript:;" onclick="service_del(this,'{{$data['id']}}')" class="ml-5" style="text-decoration:none">--}}
                            {{--<i class="Hui-iconfont">&#xe6e2;</i>--}}
                        {{--</a>--}}
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</div>

@endsection

@section('script')
<script type="text/javascript">

    /*客服-编辑*/
    function service_edit(title, url, id) {
        console.log("service_edit url:" + url);
        var index = layer.open({
            type: 2,
            title: title,
            content: url
        });
        layer.full(index);
    }

</script>
@endsection