@extends('admin.layouts.app')

@section('content')
<nav class="breadcrumb"><i class="Hui-iconfont">&#xe67f;</i> 首页 <span class="c-gray en">&gt;</span> 图纸信息管理 <span class="c-gray en">&gt;</span>图纸信息列表 <a class="btn btn-success radius btn-refresh r" style="line-height:1.6em;margin-top:3px" href="javascript:location.replace(location.href);" onclick="location.replace('{{URL::asset('/admin/drawing/index')}}');" title="刷新" ><i class="Hui-iconfont">&#xe68f;</i></a></nav>
<div class="page-container">
    <div class="text-c">
        <form action="{{URL::asset('/admin/drawing/index')}}" method="post" class="form-horizontal">
            {{csrf_field()}}
            <span class="select-box" style="width:150px;">
              <select class="select" size="1" name="status">
                  <option value=""  >全部</option>
                  <option value="0" {{$status==='0'?'selected':''}}>待定</option>
                  <option value="1" {{$status==='1'?'selected':''}}>已联系</option>
                  <option value="2" {{$status==='2'?'selected':''}}>处理中</option>
                  <option value="3" {{$status==='3'?'selected':''}}>已处理</option>
              </select>
            </span>
            <input id="search" name="search" type="text" class="input-text" style="width:350px" placeholder="会员名称">
            <button type="submit" class="btn btn-success">
                <i class="Hui-iconfont">&#xe665;</i> 搜索
            </button>
        </form>
    </div>
    <from action="{{URL::asset('/admin/drawing/delMore')}}" method="post"  class="form-horizontal">
        <div class="cl pd-5 bg-1 bk-gray mt-20">
            <span class="l">
                <a href="javascript:;" onclick="drawing_delMore()" class="btn btn-danger radius"><i class="Hui-iconfont"></i> 批量删除</a>
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
                    <th width="150">会员昵称</th>
                    <th>后台标注的备注</th>
                    <th width="100">状态</th>
                    <th width="150">上传时间</th>
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
                        <td class="text-l">{{$data['nick_name']}}</td>
                        <td class="text-l">{{$data['remarks']}}</td>
                        <td width="150">
                            @if($data['status']==1)
                                <span class="label label-primary radius">已联系</span>
                            @elseif($data['status']==2)
                                <span class="label label-warning radius">处理中</span>
                            @elseif($data['status']==3)
                                <span class="label label-success radius">已处理</span>
                            @else
                                <span class="label label-danger radius">待定</span>
                            @endif
                        </td>
                        <td>{{$data['updated_at']}}</td>
                        <td class="td-manage">
                            <a title="查看详情" href="javascript:;" onclick="drawing_edit('查看详情','{{URL::asset('/admin/drawing/edit')}}?id={{$data['id']}}',{{$data['id']}})" class="ml-5" style="text-decoration:none">
                                <i class="Hui-iconfont">&#xe695;</i>
                            </a>
                            <a title="删除" href="javascript:;" onclick="drawing_del(this,'{{$data['id']}}')" class="ml-5" style="text-decoration:none">
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
    //     "aaSorting": [[ 1, "desc" ]],//默认第几个排序
    //     "bStateSave": true,//状态保存
    //     "pading":false,
    //     "searching" : false, //去掉搜索框
    //     "bLengthChange": false,   //去掉每页显示多少条数据方法
    //     "aoColumnDefs": [
    //         //{"bVisible": false, "aTargets": [ 3 ]} //控制列的隐藏显示
    //         {"orderable":false,"aTargets":[0,6]}// 不参与排序的列
    //     ]
    // });

    /*查看图纸信息详情*/
    function drawing_edit(title, url, id) {
        // console.log("drawing_edit url:" + url);
        var index = layer.open({
            type: 2,
            title: title,
            content: url
        });
        layer.full(index);
    }

    /*图纸信息-删除*/
    function drawing_del(obj,id){
        layer.confirm('确认要删除吗？',function(index){
            //进行后台删除
            var param = {
                id: id,
                _token: "{{ csrf_token() }}"
            }
            delDrawing('{{URL::asset('')}}', param, function (ret) {
                if (ret.result == true) {
                    $(obj).parents("tr").remove();
                    layer.msg(ret.msg, {icon: 1, time: 1000});
                } else {
                    layer.msg(ret.msg, {icon: 2, time: 1000})
                }
            })
        });
    }
    function drawing_delMore(){
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
            delMoreDrawing('{{URL::asset('')}}', param, function (ret) {
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