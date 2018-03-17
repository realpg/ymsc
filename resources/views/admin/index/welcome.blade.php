@extends('admin.layouts.app')

@section('content')
<div class="page-container">
    <table class="table table-border table-bordered table-bg">
        <thead>
        <tr>
            <th colspan="2" scope="col">服务器信息</th>
        </tr>
        </thead>
        <tbody>
        <tr>
            <th width="30%">服务器计算机名</th>
            <td><span id="lbServerName">http://127.0.0.1/</span></td>
        </tr>
        <tr>
            <td>服务器IP地址</td>
            <td>{{$_SERVER['SERVER_ADDR']}}</td>
        </tr>
        <tr>
            <td>服务器域名</td>
            <td>{{$_SERVER['SERVER_NAME']}}</td>
        </tr>
        <tr>
            <td>服务器端口 </td>
            <td>{{$_SERVER['SERVER_PORT']}}</td>
        </tr>
        <tr>
            <td>服务器版本 </td>
            <td>{{php_uname('s').php_uname('r')}}</td>
        </tr>
        <tr>
            <td>服务器操作系统 </td>
            <td>{{php_uname()}}</td>
        </tr>
        <tr>
            <td>php版本 </td>
            <td>{{PHP_VERSION}}</td>
        </tr>
        <tr>
            <td>PHP运行方式 </td>
            <td>{{php_sapi_name()}}</td>
        </tr>
        <tr>
            <td>服务器当前时间 </td>
            <td>{{date("Y-m-d H:i:s")}}</td>
        </tr>
        <tr>
            <td>最大上传限制 </td>
            <td>{{get_cfg_var ("upload_max_filesize")?get_cfg_var ("upload_max_filesize"):"不允许" }}</td>
        </tr>
        <tr>
            <td>最大执行时间 </td>
            <td>{{get_cfg_var("max_execution_time")."秒 "}}</td>
        </tr>
        <tr>
            <td>脚本运行占用最大内存 </td>
            <td>{{get_cfg_var ("memory_limit")?get_cfg_var("memory_limit"):"无"}}</td>
        </tr>
        <tr>
            <td>请求页面时通信协议的名称和版本 </td>
            <td>{{$_SERVER['SERVER_PROTOCOL']}}</td>
        </tr>
        <tr>
            <td>服务器语言 </td>
            <td>{{$_SERVER['HTTP_ACCEPT_LANGUAGE']}}</td>
        </tr>
        </tbody>
    </table>
</div>

@endsection

@section('script')
    <script type="text/javascript">
        var _hmt = _hmt || [];
        $(function () {
            var hm = document.createElement("script");
            hm.src = "https://hm.baidu.com/hm.js?080836300300be57b7f34f4b3e97d911";
            var s = document.getElementsByTagName("script")[0];
            s.parentNode.insertBefore(hm, s);
        })

    </script>
@endsection