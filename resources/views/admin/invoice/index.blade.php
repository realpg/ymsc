@extends('admin.layouts.app')

@section('content')
<nav class="breadcrumb"><i class="Hui-iconfont">&#xe67f;</i> 首页 <span class="c-gray en">&gt;</span> 增值税专用发票管理 <span class="c-gray en">&gt;</span>增值税专用发票列表 <a class="btn btn-success radius btn-refresh r" style="line-height:1.6em;margin-top:3px" href="javascript:location.replace(location.href);" onclick="location.replace('{{URL::asset('/admin/invoice/index')}}');" title="刷新" ><i class="Hui-iconfont">&#xe68f;</i></a></nav>
<div class="page-container">
    <div class="text-c">
        <form action="{{URL::asset('/admin/invoice/index')}}" method="post" class="form-horizontal">
            {{csrf_field()}}
            <span class="select-box" style="width:150px;">
              <select class="select" size="1" name="examine">
                  <option value="" >全部</option>
                  <option value="0" {{$examine==='0'?'selected':''}}>待审核</option>
                  <option value="1" {{$examine==='1'?'selected':''}}>已通过</option>
                  <option value="2" {{$examine==='2'?'selected':''}}>未通过</option>
              </select>
            </span>
            <input id="search" name="search" type="text" class="input-text" style="width:350px" placeholder="增值税专用发票昵称/电话">
            <button type="submit" class="btn btn-success" id="" name="">
                <i class="Hui-iconfont">&#xe665;</i> 搜索
            </button>
        </form>
    </div>
    <div class="mt-20">
        <table class="table table-border table-bordered table-bg table-hover table-sort" id="table-sort">
            <thead>
            <tr class="text-c">
                <th width="80">ID</th>
                <th>收票人姓名</th>
                <th>收票人电话</th>
                <th>收票人地址</th>
                <th>状态</th>
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
                    <td class="text-l">{{$data['address']}}</td>
                    <td>
                        @if($data['examine']==0)
                            <span class="label label-danger radius">待审核</span>
                        @elseif($data['examine']==1)
                            <span class="label label-success radius">已通过</span>
                        @elseif($data['examine']==2)
                            <span class="label label-warning radius">未通过</span>
                        @endif
                    </td>
                    <td>{{$data['updated_at']}}</td>
                    <td class="td-manage">
                        <a title="查看详情" href="javascript:;" onclick="invoice_edit('查看详情','{{URL::asset('/admin/invoice/edit')}}?id={{$data['id']}}',{{$data['id']}})" class="ml-5" style="text-decoration:none">
                            <i class="Hui-iconfont">&#xe695;</i>
                        </a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        <div id="callBackPager">
            {{ $datas->appends(['search' => $search,'examine'=>$examine])->links() }}
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

    /*查看增值税专用发票详情*/
    function invoice_edit(title, url, id) {
        console.log("invoice_edit url:" + url);
        var index = layer.open({
            type: 2,
            title: title,
            content: url
        });
        layer.full(index);
    }


</script>
@endsection