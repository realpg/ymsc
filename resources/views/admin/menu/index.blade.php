@extends('admin.layouts.app')

@section('content')
<nav class="breadcrumb"><i class="Hui-iconfont">&#xe67f;</i> 首页 <span class="c-gray en">&gt;</span> 栏目管理 <span class="c-gray en">&gt;</span>栏目列表 <a class="btn btn-success radius btn-refresh r" style="line-height:1.6em;margin-top:3px" href="javascript:location.replace(location.href);" onclick="location.replace('{{URL::asset('/admin/menu/index')}}');" title="刷新" ><i class="Hui-iconfont">&#xe68f;</i></a></nav>
<div class="page-container">
    <div class="text-c">
        <form action="{{URL::asset('/admin/menu/index')}}" method="post" class="form-horizontal">
            {{csrf_field()}}
            <span class="select-box" style="width:200px;">
              <select class="select" size="1" name="menu_id">
                  @foreach($menu_lists as $menu_list)
                      @if($datas['id']==$menu_list['id'])
                          <option value="{{$menu_list['id']}}" selected >{{$menu_list['name']}}</option>
                      @else
                          <option value="{{$menu_list['id']}}" >{{$menu_list['name']}}</option>
                      @endif
                  @endforeach
              </select>
            </span>
            <input id="search" name="search" type="text" class="input-text" style="width:250px" placeholder="子栏目名称">
            <button type="submit" class="btn btn-success">
                <i class="Hui-iconfont">&#xe665;</i> 搜索
            </button>
        </form>
    </div>
    <div class="mt-10">
        <table class="table table-border table-bordered table-bg table-hover">
            <thead>
            <tr class="text-c">
                <th width="80">ID</th>
                <th>栏目名称</th>
                <th width="150">状态</th>
                <th width="150">更新时间</th>
                <th width="100">操作</th>
            </tr>
            </thead>
            <tbody>
            <tr class="text-c">
                <td>{{$datas['id']}}</td>
                <td class="text-l">{{$datas['name']}}</td>
                @if($datas['status']==1)
                    <td><span class="label label-success radius">显示</span></td>
                @else
                    <td><span class="label label-danger radius">隐藏</span></td>
                @endif
                <td>{{$datas['updated_at']}}</td>
                <td class="td-manage">
                    <a title="编辑" href="javascript:;" onclick="menu_edit('编辑','{{URL::asset('/admin/menu/edit')}}?id={{$datas['id']}}&menu_id={{$datas['id']}}',{{$datas['id']}})" class="ml-5" style="text-decoration:none">
                        <i class="Hui-iconfont">&#xe6df;</i>
                    </a>
                </td>
            </tr>
            </tbody>
        </table>
    </div>
    <div class="cl pd-5 bg-1 bk-gray mt-20">
        <span class="l">
            <a class="btn btn-primary radius" onclick="menu_edit('添加栏目','{{URL::asset('/admin/menu/edit')}}?menu_id={{$datas['id']}}')" href="javascript:;">
                <i class="Hui-iconfont">&#xe600;</i> 添加栏目
            </a>
        </span>
    </div>
    <div class="mt-10">
        <table class="table table-border table-bordered table-bg table-hover table-sort" id="table-sort">
            <thead>
            <tr class="text-c">
                <th width="80">ID</th>
                <th>栏目名称</th>
                <th width="150">状态</th>
                <th width="150">更新时间</th>
                <th width="100">操作</th>
            </tr>
            </thead>
            <tbody>
            @foreach($datas['menus'] as $menu)
                <tr class="text-c">
                    <td>{{$menu['id']}}</td>
                    <td class="text-l">{{$menu['name']}}</td>
                    @if($menu['status']==1)
                        <td><span class="label label-success radius">显示</span></td>
                    @else
                        <td><span class="label label-danger radius">隐藏</span></td>
                    @endif
                    <td>{{$menu['updated_at']}}</td>
                    <td class="td-manage">
                        <a title="编辑" href="javascript:;" onclick="menu_edit('编辑','{{URL::asset('/admin/menu/edit')}}?id={{$menu['id']}}&menu_id={{$menu['menu_id']}}',{{$menu['id']}})" class="ml-5" style="text-decoration:none">
                            <i class="Hui-iconfont">&#xe6df;</i>
                        </a>
                        <a title="删除" href="javascript:;" onclick="menu_del(this,'{{$menu['id']}}')" class="ml-5" style="text-decoration:none">
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
    // $('.table-sort').dataTable({
    //     "aaSorting": [[ 0, "asc" ]],//默认第几个排序
    //     "bStateSave": true,//状态保存
    //     "pading":false,
    //     "searching" : false, //去掉搜索框
    //     "bLengthChange": false,   //去掉每页显示多少条数据方法
    //     "aoColumnDefs": [
    //         //{"bVisible": false, "aTargets": [ 3 ]} //控制列的隐藏显示
    //         {"orderable":false,"aTargets":[4]}// 不参与排序的列
    //     ]
    // });

    /*查看栏目详情*/
    function menu_edit(title, url, id) {
        // console.log("menu_edit url:" + url);
        var index = layer.open({
            type: 2,
            title: title,
            content: url
        });
        layer.full(index);
    }

    /*栏目-删除*/
    function menu_del(obj,id){
        layer.confirm('为了保证网站能够正常运行，请先将此栏目下的商品删除或转移到其他栏目下。确认要删除吗？',function(index){
            //进行后台删除
            var param = {
                id: id,
                _token: "{{ csrf_token() }}"
            }
            delMenu('{{URL::asset('')}}', param, function (ret) {
                if (ret.result == true) {
                    $(obj).parents("tr").remove();
                    layer.msg(ret.msg, {icon: 1, time: 1000});
                } else {
                    layer.msg(ret.msg, {icon: 2, time: 2000})
                }
            })
        });
    }
</script>
@endsection