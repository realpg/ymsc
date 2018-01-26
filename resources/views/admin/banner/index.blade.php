@extends('admin.layouts.app')

@section('content')
<nav class="breadcrumb"><i class="Hui-iconfont">&#xe67f;</i> 首页 <span class="c-gray en">&gt;</span> Banner管理 <span class="c-gray en">&gt;</span> 图片列表 <a class="btn btn-success radius btn-refresh r" style="line-height:1.6em;margin-top:3px" href="javascript:location.replace(location.href);" onclick="location.replace('{{URL::asset('/admin/banner/index')}}');" title="刷新" ><i class="Hui-iconfont">&#xe68f;</i></a></nav>
<div class="page-container">
    <div class="text-c">
        <form action="{{URL::asset('/admin/banner/index')}}" method="post" class="form-horizontal">
            {{csrf_field()}}
            <input id="search" name="search" type="text" class="input-text" style="width:450px" placeholder="标题">
            <button type="submit" class="btn btn-success" id="" name="">
                <i class="Hui-iconfont">&#xe665;</i> 搜索
            </button>
        </form>
    </div>
    <div class="cl pd-5 bg-1 bk-gray mt-20">
        <span class="l">
            <a class="btn btn-primary radius" onclick="banner_edit('添加Banner','{{URL::asset('/admin/banner/edit')}}')" href="javascript:;">
                <i class="Hui-iconfont">&#xe600;</i> 添加Banner
            </a>
        </span>
    </div>
    <div class="mt-20">
        <table class="table table-border table-bordered table-bg table-hover table-sort" id="table-sort">
            <thead>
            <tr class="text-c">
                <th width="80">ID</th>
                <th width="100">栏目</th>
                <th width="100">图片</th>
                <th>标题</th>
                <th width="100">状态</th>
                <th width="150">更新时间</th>
                <th width="100">操作</th>
            </tr>
            </thead>
            <tbody>
            @foreach($datas as $data)
                <tr class="text-c">
                    <td>{{$data['id']}}</td>
                    <td>{{$data['menu_name']}}</td>
                    <td><img width="210" class="picture-thumb" src="{{$data['picture']}}"></td>
                    <td class="text-l">{{$data['name']}}</td>
                    <td>
                        @if($data['status'])
                            <span class="label label-success radius">显示</span>
                        @else
                            <span class="label label-danger radius">隐藏</span>
                        @endif
                    </td>
                    <td>{{$data['updated_at']}}</td>
                    <td class="td-manage">
                        <a title="编辑" href="javascript:;" onclick="banner_edit('Banner编辑','{{URL::asset('/admin/banner/edit')}}?id={{$data['id']}}',{{$data['id']}})" class="ml-5" style="text-decoration:none">
                            <i class="Hui-iconfont">&#xe6df;</i>
                        </a>
                        <a title="删除" href="javascript:;" onclick="banner_del(this,'{{$data['id']}}')" class="ml-5" style="text-decoration:none">
                            <i class="Hui-iconfont">&#xe6e2;</i>
                        </a>
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
    $('.table-sort').dataTable({
        "aaSorting": [[ 1, "desc" ]],//默认第几个排序
        "bStateSave": true,//状态保存
        "pading":false,
        "searching" : false, //去掉搜索框
        "bLengthChange": false,   //去掉每页显示多少条数据方法
        "aoColumnDefs": [
            //{"bVisible": false, "aTargets": [ 3 ]} //控制列的隐藏显示
            {"orderable":false,"aTargets":[0,2,6]}// 不参与排序的列
        ]
    });

    /*Banner-添加*/
    function banner_edit(title,url){
        var index = layer.open({
            type: 2,
            title: title,
            content: url
        });
        layer.full(index);
    }

    /*Banner-编辑*/
    function banner_edit(title, url, id) {
        console.log("banner_edit url:" + url);
        var index = layer.open({
            type: 2,
            title: title,
            content: url
        });
        layer.full(index);
    }

    /*图片-删除*/
    function banner_del(obj,id){
        layer.confirm('确认要删除吗？',function(index){
            //进行后台删除
            var param = {
                id: id,
                _token: "{{ csrf_token() }}"
            }
            delBanner('{{URL::asset('')}}', param, function (ret) {
                if (ret.result == true) {
                    $(obj).parents("tr").remove();
                    layer.msg(ret.msg, {icon: 1, time: 1000});
                } else {
                    layer.msg(ret.msg, {icon: 2, time: 1000})
                }
            })
        });
    }


</script>
@endsection