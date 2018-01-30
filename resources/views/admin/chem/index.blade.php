@extends('admin.layouts.app')

@section('content')
<nav class="breadcrumb"><i class="Hui-iconfont">&#xe67f;</i> 首页 <span class="c-gray en">&gt;</span> 商品管理 <span class="c-gray en">&gt;</span>商品列表 <a class="btn btn-success radius btn-refresh r" style="line-height:1.6em;margin-top:3px" href="javascript:location.replace(location.href);" onclick="location.replace('{{URL::asset('/admin/chem/index')}}');" title="刷新" ><i class="Hui-iconfont">&#xe68f;</i></a></nav>
<div class="page-container">
    <div class="text-c">
        <form action="{{URL::asset('/admin/chem/index')}}" method="post" class="form-horizontal">
            {{csrf_field()}}
            <span class="select-box" style="width:150px;">
              <select class="select" size="1" name="menu_id">
                  <option value=""  >全部</option>
                  @foreach($menu_lists as $menu_list)
                      @if($menu_id==$menu_list['id'])
                          <option value="{{$menu_list['id']}}" selected >{{$menu_list['name']}}</option>
                      @else
                          <option value="{{$menu_list['id']}}" >{{$menu_list['name']}}</option>
                      @endif
                  @endforeach
              </select>
            </span>
            <input id="search" name="search" type="text" class="input-text" style="width:300px" placeholder="商品名称/商品别名/商品英文名称/CAS">
            <button type="submit" class="btn btn-success">
                <i class="Hui-iconfont">&#xe665;</i> 搜索
            </button>
        </form>
    </div>
    <div class="cl pd-5 bg-1 bk-gray mt-20">
        <span class="l">
            <a class="btn btn-primary radius" onclick="chem_editClass('添加商品大类','{{URL::asset('/admin/chem/editClass')}}')" href="javascript:;">
                <i class="Hui-iconfont">&#xe600;</i> 添加商品大类
            </a>
        </span>
    </div>
    <div class="mt-10">
        <table class="table table-border table-bordered table-bg table-hover table-sort" id="table-sort">
            <thead>
            <tr class="text-c">
                <th width="80">ID</th>
                <th width="100">图片</th>
                <th width="150">名称</th>
                <th width="150">中文别名</th>
                <th width="150">英文名称</th>
                <th width="150">CAS</th>
                <th width="150">栏目</th>
                <th width="150">更新时间</th>
                <th width="100">操作</th>
            </tr>
            </thead>
            <tbody>
            @foreach($datas as $data)
                <tr class="text-c">
                    <td>{{$data['id']}}</td>
                    <td><img width="100%" class="picture-thumb" src="{{$data['picture']}}"></td>
                    <td class="text-l">{{$data['name']}}</td>
                    <td class="text-l">{{$data['sub_name']}}</td>
                    <td class="text-l">{{$data['english_name']}}</td>
                    <td>{{$data['cas']}}</td>
                    <td>{{$data['menu']['name']}}</td>
                    <td>{{$data['updated_at']}}</td>
                    <td class="td-manage">
                        <a title="商品管理" href="javascript:;" onclick="chem_selectGoodses('商品管理','{{URL::asset('/admin/chem/select')}}?chem_class_id={{$data['id']}}&menu_id={{$data['menu_id']}}',{{$data['id']}})" class="ml-5" style="text-decoration:none">
                            <i class="Hui-iconfont">&#xe620;</i>
                        </a>
                        <a title="编辑" href="javascript:;" onclick="chem_editClass('编辑','{{URL::asset('/admin/chem/editClass')}}?id={{$data['id']}}&menu_id={{$data['menu_id']}}',{{$data['id']}})" class="ml-5" style="text-decoration:none">
                            <i class="Hui-iconfont">&#xe6df;</i>
                        </a>
                        <a title="删除" href="javascript:;" onclick="chem_delClass(this,'{{$data['id']}}')" class="ml-5" style="text-decoration:none">
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
        "aaSorting": [[ 0, "desc" ]],//默认第几个排序
        "bStateSave": true,//状态保存
        "pading":false,
        "searching" : false, //去掉搜索框
        "bLengthChange": false,   //去掉每页显示多少条数据方法
        "aoColumnDefs": [
            //{"bVisible": false, "aTargets": [ 3 ]} //控制列的隐藏显示
            {"orderable":false,"aTargets":[8]}// 不参与排序的列
        ]
    });

    /*查看商品列表*/
    function chem_selectGoodses(title, url, id) {
        // console.log("chem_selectGoodses url:" + url);
        var index = layer.open({
            type: 2,
            title: title,
            content: url
        });
        layer.full(index);
    }

    /*查看商品大类详情*/
    function chem_editClass(title, url, id) {
        // console.log("chem_editClass url:" + url);
        var index = layer.open({
            type: 2,
            title: title,
            content: url
        });
        layer.full(index);
    }

    /*商品大类-删除*/
    function chem_delClass(obj,id){
        layer.confirm('为了保证网站能够正常运行，请先将此商品大类下的商品删除或转移到其他商品大类下。确认要删除吗？',function(index){
            //进行后台删除
            var param = {
                id: id,
                _token: "{{ csrf_token() }}"
            }
            delChemClass('{{URL::asset('')}}', param, function (ret) {
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