@extends('admin.layouts.app')

@section('content')
<nav class="breadcrumb"><i class="Hui-iconfont">&#xe67f;</i> 首页 <span class="c-gray en">&gt;</span> 评论管理 <span class="c-gray en">&gt;</span>评论列表 <a class="btn btn-success radius btn-refresh r" style="line-height:1.6em;margin-top:3px" href="javascript:location.replace(location.href);" onclick="location.replace('{{URL::asset('/admin/comment/index')}}');" title="刷新" ><i class="Hui-iconfont">&#xe68f;</i></a></nav>
<div class="page-container">
    <div class="text-c">
        <form action="{{URL::asset('/admin/comment/index')}}" method="post" class="form-horizontal">
            {{csrf_field()}}
            <span class="select-box" style="width:200px;">
              <select class="select" size="1" name="status">
                  <option value="">全部</option>
                  <option value="1" {{$status==1?'selected':''}}>审核通过</option>
                  <option value="0" {{$status==0?'selected':''}}>待审核</option>
              </select>
            </span>
            <input id="search" name="search" type="text" class="input-text" style="width:250px" placeholder="评论内容关键字" value="{{$search}}">
            <button type="submit" class="btn btn-success">
                <i class="Hui-iconfont">&#xe665;</i> 搜索
            </button>
        </form>
    </div>
    <div class="mt-20">
        <table class="table table-border table-bordered table-bg table-hover table-sort" id="table-sort">
            <thead>
            <tr class="text-c">
                <th width="80">ID</th>
                <th width="100">头像</th>
                <th width="100">昵称</th>
                <th width="200">商品</th>
                <th>评论内容</th>
                <th width="80">审核状态</th>
                <th width="150">更新时间</th>
                <th width="100">操作</th>
            </tr>
            </thead>
            <tbody>
            @foreach($datas as $data)
                <tr class="text-c">
                    <td>{{$data['id']}}</td>
                    <td>
                        <img src="{{ $data['user_id']['avatar'] ? $data['user_id']['avatar'].'?imageView2/1/w/200/h/200/interlace/1/q/75|imageslim' : URL::asset('/img/default_headicon.png')}}"
                             class="img-rect-30 radius-5">
                    </td>
                    <td>{{$data['user_id']['nick_name']}}</td>
                    <td class="text-l">商品编号：{{$data['goods_id']['number']}}<br />商品名称：{{$data['goods_id']['name']}}</td>
                    <td class="text-l">{{$data['content']}}</td>
                    @if($data['status'])
                        <th>
                            <span class="label label-success radius">通过</span>
                        </th>
                    @else
                        <th>
                            <span class="label label-danger radius">待审核</span>
                        </th>
                    @endif
                    <td>{{$data['updated_at']}}</td>
                    <td class="td-manage">
                        <a title="查看详情" href="javascript:;" onclick="comment_edit('查看详情','{{URL::asset('/admin/comment/edit')}}?id={{$data['id']}}',{{$data['id']}})" class="ml-5" style="text-decoration:none">
                            <i class="Hui-iconfont">&#xe695;</i>
                        </a>
                        <a title="删除" href="javascript:;" onclick="comment_del(this,'{{$data['id']}}')" class="ml-5" style="text-decoration:none">
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
    //         {"orderable":false,"aTargets":[0,1,6]}// 不参与排序的列
    //     ]
    // });

    /*查看评价详情*/
    function comment_edit(title, url, id) {
        // console.log("comment_edit url:" + url);
        var index = layer.open({
            type: 2,
            title: title,
            content: url
        });
        layer.full(index);
    }

    /*评价-删除*/
    function comment_del(obj,id){
        layer.confirm('确认要删除吗？',function(index){
            //进行后台删除
            var param = {
                id: id,
                _token: "{{ csrf_token() }}"
            }
            delComment('{{URL::asset('')}}', param, function (ret) {
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