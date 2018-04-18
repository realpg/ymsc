@extends('admin.layouts.app')

@section('content')
<nav class="breadcrumb"><i class="Hui-iconfont">&#xe67f;</i> 首页 <span class="c-gray en">&gt;</span> 搜索属性管理 <span class="c-gray en">&gt;</span>搜索属性列表 <a class="btn btn-success radius btn-refresh r" style="line-height:1.6em;margin-top:3px" href="javascript:location.replace(location.href);" onclick="location.replace('{{URL::asset('/admin/attribute/index')}}');" title="刷新" ><i class="Hui-iconfont">&#xe68f;</i></a></nav>
<div class="page-container">
    <div class="text-c">
        <form action="{{URL::asset('/admin/attribute/index')}}" method="post" class="form-horizontal">
            {{csrf_field()}}
            <span class="select-box" style="width:200px;">
              <select class="select" size="1" name="menu_id">
                  @foreach($menu_lists as $menu_list)
                      @if($menu_id==$menu_list['id'])
                          <option value="{{$menu_list['id']}}" selected >{{$menu_list['name']}}</option>
                      @else
                          <option value="{{$menu_list['id']}}" >{{$menu_list['name']}}</option>
                      @endif
                  @endforeach
              </select>
            </span>
            <input id="search" name="search" type="text" class="input-text" style="width:250px" placeholder="搜索属性名称">
            <button type="submit" class="btn btn-success">
                <i class="Hui-iconfont">&#xe665;</i> 搜索
            </button>
        </form>
    </div>
    <div class="cl pd-5 bg-1 bk-gray mt-20">
        <span class="l">
            <a class="btn btn-primary radius" onclick="attribute_edit('添加搜索属性','{{URL::asset('/admin/attribute/edit')}}?menu_id={{$menu_id}}')" href="javascript:;">
                <i class="Hui-iconfont">&#xe600;</i> 添加二级搜索属性
            </a>
        </span>
    </div>
    <div class="mt-10">
        <table class="table table-border table-bordered table-bg table-hover table-sort" id="table-sort">
            <thead>
            <tr class="text-c">
                <th width="80">ID</th>
                <th>名称</th>
                <th>一级属性</th>
                <th width="150">更新时间</th>
                <th width="100">操作</th>
            </tr>
            </thead>
            <tbody>
            @foreach($datas as $data)
                @if($data['attribute_id']==0)
                    <tr class="text-c">
                        <td style="background-color: #eeeeee;">{{$data['id']}}</td>
                        <td class="text-l" style="background-color: #eeeeee;">{{$data['name']}}</td>
                        <td class="text-l" style="background-color: #eeeeee;">{{$data['name']}}（一级搜索属性固定）</td>
                        <td style="background-color: #eeeeee;">{{$data['updated_at']}}</td>
                        <td class="td-manage" style="background-color: #eeeeee;">
                            <a title="编辑" href="javascript:;" onclick="attribute_edit('编辑','{{URL::asset('/admin/attribute/edit')}}?id={{$data['id']}}&menu_id={{$data['menu_id']}}',{{$data['id']}})" class="ml-5" style="text-decoration:none">
                                <i class="Hui-iconfont">&#xe6df;</i>
                            </a>
                        </td>
                    </tr>
                    @foreach($datas as $data_f)
                        @if($data_f['attribute_id']==$data['id'])
                        <tr class="text-c">
                            <td>{{$data_f['id']}}</td>
                            <td class="text-l">{{$data_f['name']}}</td>
                            <td class="text-l">{{$data_f['attribute_father']['name']}}</td>
                            <td>{{$data_f['updated_at']}}</td>
                            <td class="td-manage">
                                <a title="编辑" href="javascript:;" onclick="attribute_edit('编辑','{{URL::asset('/admin/attribute/edit')}}?id={{$data_f['id']}}&menu_id={{$data_f['menu_id']}}',{{$data_f['id']}})" class="ml-5" style="text-decoration:none">
                                    <i class="Hui-iconfont">&#xe6df;</i>
                                </a>
                                <a title="删除" href="javascript:;" onclick="attribute_del(this,'{{$data_f['id']}}')" class="ml-5" style="text-decoration:none">
                                    <i class="Hui-iconfont">&#xe6e2;</i>
                                </a>
                            </td>
                        </tr>
                        @endif
                    @endforeach
                @endif
            @endforeach
            </tbody>
        </table>
    </div>
</div>

@endsection

@section('script')
<script type="text/javascript">
    // $('.table-sort').dataTable({
    //     "aaSorting": [[ 2, "desc" ]],//默认第几个排序
    //     "bStateSave": true,//状态保存
    //     "pading":false,
    //     "searching" : false, //去掉搜索框
    //     "bLengthChange": false,   //去掉每页显示多少条数据方法
    //     "aoColumnDefs": [
    //         //{"bVisible": false, "aTargets": [ 3 ]} //控制列的隐藏显示
    //         {"orderable":false,"aTargets":[4]}// 不参与排序的列
    //     ]
    // });

    /*查看搜索属性详情*/
    function attribute_edit(title, url, id) {
        // console.log("attribute_edit url:" + url);
        var index = layer.open({
            type: 2,
            title: title,
            content: url
        });
        layer.full(index);
    }

    /*搜索属性-删除*/
    function attribute_del(obj,id){
        layer.confirm('为了保证数据能够正常显示，请先将拥有此搜索属性的商品删除或更改成其他搜索属性。确认要删除吗？',function(index){
            //进行后台删除
            var param = {
                id: id,
                _token: "{{ csrf_token() }}"
            }
            delAttribute('{{URL::asset('')}}', param, function (ret) {
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