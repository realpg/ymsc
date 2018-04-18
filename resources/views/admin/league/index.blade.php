@extends('admin.layouts.app')

@section('content')
<nav class="breadcrumb"><i class="Hui-iconfont">&#xe67f;</i> 首页 <span class="c-gray en">&gt;</span> 加盟信息管理 <span class="c-gray en">&gt;</span>加盟信息列表 <a class="btn btn-success radius btn-refresh r" style="line-height:1.6em;margin-top:3px" href="javascript:location.replace(location.href);" onclick="location.replace('{{URL::asset('/admin/league/index')}}');" title="刷新" ><i class="Hui-iconfont">&#xe68f;</i></a></nav>
<div class="page-container">
    <div class="text-c">
        <form action="{{URL::asset('/admin/league/index')}}" method="post" class="form-horizontal">
            {{csrf_field()}}
            <span class="select-box" style="width:150px;">
              <select class="select" size="1" name="status">
                  <option value=""  >全部</option>
                  <option value="0" {{$status==='0'?'selected':''}}>待定</option>
                  <option value="1" {{$status==='1'?'selected':''}}>已联系</option>
              </select>
            </span>
            <input id="search" name="search" type="text" class="input-text" style="width:350px" placeholder="姓名\手机号码" value="{{$search}}">
            <button type="submit" class="btn btn-success">
                <i class="Hui-iconfont">&#xe665;</i> 搜索
            </button>
        </form>
    </div>
    <from action="{{URL::asset('/admin/league/delMore')}}" method="post"  class="form-horizontal">
        <div class="cl pd-5 bg-1 bk-gray mt-20">
            <span class="l">
                <a href="javascript:;" onclick="league_delMore()" class="btn btn-danger radius"><i class="Hui-iconfont"></i> 批量删除</a>
            </span>
        </div>
        <div class="mt-20">
            <table class="table table-border table-bordered table-bg table-hover table-sort" id="table-sort">
                <thead>
                <tr class="text-c">
                    <th width="80">
                        <input type="checkbox" id="checkbox-1">
                    </th>
                    <th width="80">ID</th>
                    <th>姓名</th>
                    <th>电话</th>
                    <th>电子邮箱</th>
                    <th width="150">状态</th>
                    <th width="150">留言时间</th>
                    <th width="100">操作</th>
                </tr>
                </thead>
                <tbody>
                @foreach($datas as $data)
                    <tr class="text-c">
                        <td>
                            <input type="checkbox" name="id_array" value="{{$data['id']}}" id="checkbox-1">
                        </td>
                        <td>{{$data['id']}}</td>
                        <td class="text-l">{{$data['name']}}</td>
                        <td>{{$data['phonenum']}}</td>
                        <td class="text-l">{{$data['email']}}</td>
                        <td width="150">
                            @if($data['status'])
                                <span class="label label-success radius">已联系</span>
                            @else
                                <span class="label label-danger radius">待定</span>
                            @endif
                        </td>
                        <td>{{$data['created_at']}}</td>
                        <td class="td-manage">
                            <a title="查看详情" href="javascript:;" onclick="league_edit('查看详情','{{URL::asset('/admin/league/edit')}}?id={{$data['id']}}',{{$data['id']}})" class="ml-5" style="text-decoration:none">
                                <i class="Hui-iconfont">&#xe695;</i>
                            </a>
                            <a title="删除" href="javascript:;" onclick="league_del(this,'{{$data['id']}}')" class="ml-5" style="text-decoration:none">
                                <i class="Hui-iconfont">&#xe6e2;</i>
                            </a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            <div id="callBackPager">
                {{ $datas->appends(['search' => $search,'status'=>$status])->links() }}
            </div>
        </div>
    </from>
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
    //         {"orderable":false,"aTargets":[0,7]}// 不参与排序的列
    //     ]
    // });

    /*查看加盟信息详情*/
    function league_edit(title, url, id) {
        // console.log("league_edit url:" + url);
        var index = layer.open({
            type: 2,
            title: title,
            content: url
        });
        layer.full(index);
    }

    /*加盟信息-删除*/
    function league_del(obj,id){
        layer.confirm('确认要删除吗？',function(index){
            //进行后台删除
            var param = {
                id: id,
                _token: "{{ csrf_token() }}"
            }
            delLeague('{{URL::asset('')}}', param, function (ret) {
                if (ret.result == true) {
                    $(obj).parents("tr").remove();
                    layer.msg(ret.msg, {icon: 1, time: 1000});
                } else {
                    layer.msg(ret.msg, {icon: 2, time: 1000})
                }
            })
        });
    }
    function league_delMore(){
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
            delMoreLeague('{{URL::asset('')}}', param, function (ret) {
                if (ret.result == true) {
                    // $(obj).parents("tr").remove();
                    layer.msg(ret.msg, {icon: 1, time: 1000});
                    $('.btn-refresh').click();
                } else {
                    layer.msg(ret.msg, {icon: 2, time: 2000})
                }
            })
        }
        else{
            layer.msg('请选择要删除的信息', {icon: 2, time: 2000})
        }
    }
</script>
@endsection