@extends('admin.layouts.app')

@section('content')
<nav class="breadcrumb"><i class="Hui-iconfont">&#xe67f;</i> 首页 <span class="c-gray en">&gt;</span> 商品管理 <span class="c-gray en">&gt;</span>商品列表 <a class="btn btn-success radius btn-refresh r" style="line-height:1.6em;margin-top:3px" href="javascript:location.replace(location.href);" onclick="location.replace('{{URL::asset('/admin/chem/select')}}?chem_class_id={{$chem_class_id}}&menu_id={{$menu_id}}');" title="刷新" ><i class="Hui-iconfont">&#xe68f;</i></a></nav>
<div class="page-container">
    <div class="text-c">
        <form action="{{URL::asset('/admin/chem/select')}}" method="get" class="form-horizontal">
            {{csrf_field()}}
            <input type="hidden" name="chem_class_id" id="chem_class_id" value="{{$chem_class_id}}" />
            <input type="hidden" name="menu_id" id="menu_id" value="{{$menu_id}}" />
            <input id="search" name="search" type="text" class="input-text" style="width:300px" placeholder="商品货号" value="{{$search}}">
            <button type="submit" class="btn btn-success">
                <i class="Hui-iconfont">&#xe665;</i> 搜索
            </button>
        </form>
    </div>
    <div class="cl pd-5 bg-1 bk-gray mt-20">
        <span class="l">
            <a class="btn btn-primary radius" onclick="chem_edit('添加商品','{{URL::asset('/admin/chem/edit')}}?chem_class_id={{$chem_class_id}}&menu_id={{$menu_id}}')" href="javascript:;">
                <i class="Hui-iconfont">&#xe600;</i> 添加商品
            </a>
        </span>
        <span class="l ml-10">
            <a href="javascript:;" onclick="goods_delMore()" class="btn btn-danger radius"><i class="Hui-iconfont"></i> 批量删除</a>
        </span>
    </div>
    <div class="mt-10">
        <table class="table table-border table-bordered table-bg table-hover table-sort" id="table-sort">
            <thead>
            <tr class="text-c">
                <th width="80">
                    <input type="checkbox" id="checkbox-1">
                </th>
                <th width="80">ID</th>
                {{--<th width="150">名称</th>--}}
                <th width="150">货号</th>
                <th width="100s">品牌</th>
                <th width="100">纯度</th>
                <th width="80">规格</th>
                <th width="100">价格</th>
                <th width="100">库存</th>
                <th width="100">栏目</th>
                <th width="150">更新时间</th>
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
                    {{--<td class="text-l">{{$data['name']}}</td>--}}
                    <td>{{$data['number']}}</td>
                    <td>{{$data['brand']}}</td>
                    <td>{{$data['purity']}}</td>
                    <td>{{$data['spec']}}</td>
                    <td>￥{{$data['price']/100}}&nbsp;/{{$data['unit']}}</td>
                    <td>{{$data['stock']}}</td>
                    <td>{{$data['menu']}}</td>
                    <td>{{$data['updated_at']}}</td>
                    <td class="td-manage">
                        <a title="编辑" href="javascript:;" onclick="chem_edit('编辑','{{URL::asset('/admin/chem/edit')}}?id={{$data['id']}}&chem_class_id={{$chem_class_id}}&menu_id={{$menu_id}}',{{$data['id']}})" class="ml-5" style="text-decoration:none">
                            <i class="Hui-iconfont">&#xe6df;</i>
                        </a>
                        <a title="删除" href="javascript:;" onclick="chem_del(this,'{{$data['id']}}')" class="ml-5" style="text-decoration:none">
                            <i class="Hui-iconfont">&#xe6e2;</i>
                        </a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        <div id="callBackPager">
            {{ $datas->appends(['search' => $search,'chem_class_id'=>$chem_class_id,'menu_id'=>$menu_id])->links() }}
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
    //         {"orderable":false,"aTargets":[0,10]}// 不参与排序的列
    //     ]
    // });

    /*查看商品详情*/
    function chem_edit(title, url, id) {
        // console.log("chem_edit url:" + url);
        var index = layer.open({
            type: 2,
            title: title,
            content: url
        });
        layer.full(index);
    }

    /*商品-删除*/
    function chem_del(obj,id){
        layer.confirm('确认要删除吗？',function(index){
            //进行后台删除
            var param = {
                id: id,
                _token: "{{ csrf_token() }}"
            }
            delChem('{{URL::asset('')}}', param, function (ret) {
                if (ret.result == true) {
                    $(obj).parents("tr").remove();
                    layer.msg(ret.msg, {icon: 1, time: 1000});
                } else {
                    layer.msg(ret.msg, {icon: 2, time: 2000})
                }
            })
        });
    }

    /*商品-批量删除*/
    function goods_delMore(){
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
            delMoreChem('{{URL::asset('')}}', param, function (ret) {
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