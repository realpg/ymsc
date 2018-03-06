@extends('admin.layouts.app')

@section('content')

    <header class="navbar-wrapper">
        <div class="navbar navbar-fixed-top">
            <div class="container-fluid cl"><a class="logo navbar-logo f-l mr-10 hidden-xs"
                                               href="/aboutHui.shtml">优迈商城</a>
                <a class="logo navbar-logo-m f-l mr-10 visible-xs" href="#"></a>
                <span class="logo navbar-slogan f-l mr-10 hidden-xs">v1.3</span>
                <a aria-hidden="false" class="nav-toggle Hui-iconfont visible-xs" href="javascript:;">&#xe667;</a>
                <nav id="Hui-userbar" class="nav navbar-nav navbar-userbar hidden-xs">
                    <ul class="cl">
                        <li><a href="{{ URL::asset('/') }}" class="dropDown_A" target="_blank">查看前台</a></li>
                        @if($admin['type']==1)
                            @if($admin['id']==1)
                                <li>根级管理员</li>
                            @else
                                <li>超级管理员</li>
                            @endif
                        @else
                            <li>普通管理员</li>
                        @endif
                        <li class="dropDown dropDown_hover">
                            <a href="#" class="dropDown_A">{{$admin['name']}}<i class="Hui-iconfont">&#xe6d5;</i></a>
                            <ul class="dropDown-menu menu radius box-shadow">
                                <li><a  href="javascript:;" onclick="mysqlf_edit('修改个人信息','{{ route('editMySelf') }}')">个人信息</a></li>
                                <li><a href="{{ URL::asset('/admin/loginout') }}">退出</a></li>
                            </ul>
                        </li>
                        {{--<li id="Hui-msg">--}}
                            {{--<a href="#" title="消息">--}}
                                {{--<span class="badge badge-danger">1</span>--}}
                                {{--<i class="Hui-iconfont" style="font-size:18px">&#xe68a;</i>--}}
                            {{--</a>--}}
                        {{--</li>--}}
                        <li id="Hui-skin" class="dropDown right dropDown_hover">
                            <a href="javascript:;" class="dropDown_A" title="换肤">
                                <i class="Hui-iconfont" style="font-size:18px">&#xe62a;</i>
                            </a>
                            <ul class="dropDown-menu menu radius box-shadow">
                                <li><a href="javascript:;" data-val="default" title="默认（黑色）">默认（黑色）</a></li>
                                <li><a href="javascript:;" data-val="blue" title="蓝色">蓝色</a></li>
                                <li><a href="javascript:;" data-val="green" title="绿色">绿色</a></li>
                                <li><a href="javascript:;" data-val="red" title="红色">红色</a></li>
                                <li><a href="javascript:;" data-val="yellow" title="黄色">黄色</a></li>
                                <li><a href="javascript:;" data-val="orange" title="橙色">橙色</a></li>
                            </ul>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>
    </header>
    <aside class="Hui-aside">
        <div class="menu_dropdown bk_2">
            <dl id="menu-user">
                <dt>
                    <i class="Hui-iconfont">&#xe62d;</i> 管理员管理<i class="Hui-iconfont menu_dropdown-arrow">&#xe6d5;</i>
                </dt>
                <dd>
                    <ul>
                        <li><a data-href="{{ URL::asset('/admin/admin/index') }}" data-title="管理员管理"
                               href="javascript:void(0)">管理员管理</a></li>
                    </ul>
                </dd>
            </dl>
            <dl id="menu-picture">
                <dt>
                    <i class="Hui-iconfont">&#xe62e;</i> 网站基本设置<i class="Hui-iconfont menu_dropdown-arrow">&#xe6d5;</i>
                </dt>
                <dd>
                    <ul>
                        <li><a data-href="{{ URL::asset('/admin/base/edit') }}" data-title="网站基本设置" href="javascript:void(0)">网站基本设置</a></li>
                        <li><a data-href="{{ URL::asset('/admin/word/index') }}" data-title="搜索关键字设置" href="javascript:void(0)">搜索关键字设置</a></li>
                    </ul>
                </dd>
            </dl>
            <dl id="menu-picture">
                <dt><i class="Hui-iconfont">&#xe613;</i> Banner管理<i class="Hui-iconfont menu_dropdown-arrow">&#xe6d5;</i>
                </dt>
                <dd>
                    <ul>
                        <li><a data-href="{{ URL::asset('/admin/banner/index') }}" data-title="Banner管理" href="javascript:void(0)">Banner管理</a></li>
                    </ul>
                </dd>
            </dl>
            <dl id="menu-goods">
                <dt><i class="Hui-iconfont">&#xe620;</i> 商品管理<i class="Hui-iconfont menu_dropdown-arrow">&#xe6d5;</i>
                </dt>
                <dd>
                    <ul>
                        <li><a data-href="{{ URL::asset('/admin/menu/index') }}" data-title="栏目管理" href="javascript:void(0)">栏目管理</a></li>
                        <li><a data-href="{{ URL::asset('/admin/attribute/index') }}" data-title="搜索属性管理" href="javascript:void(0)">搜索属性管理</a></li>
                        {{--<li><a data-href="{{ URL::asset('/admin/goods/index') }}" data-title="商品管理" href="javascript:void(0)">商品管理</a></li>--}}
                        <li><a data-href="{{ URL::asset('/admin/chem/index') }}" data-title="试剂耗材商品管理" href="javascript:void(0)">试剂耗材商品管理</a></li>
                        <li><a data-href="{{ URL::asset('/admin/testing/index') }}" data-title="第三方检测商品管理" href="javascript:void(0)">第三方检测商品管理</a></li>
                        <li><a data-href="{{ URL::asset('/admin/machining/index') }}" data-title="机加工商品管理" href="javascript:void(0)">机加工商品管理</a></li>
                    </ul>
                </dd>
            </dl>
            <dl id="menu-contact">
                <dt><i class="Hui-iconfont">&#xe63b;</i> 互动模块管理<i class="Hui-iconfont menu_dropdown-arrow">&#xe6d5;</i>
                </dt>
                <dd>
                    <ul>
                        <li><a data-href="{{ URL::asset('/admin/league/index') }}" data-title="加盟信息管理" href="javascript:void(0)">加盟信息管理</a></li>
                        <li><a data-href="{{ URL::asset('/admin/advice/index') }}" data-title="建议反馈信息管理" href="javascript:void(0)">投诉建议信息管理</a></li>
                        <li><a data-href="{{ URL::asset('/admin/searching/index') }}" data-title="帮你找货信息管理" href="javascript:void(0)">帮你找货信息管理</a></li>
                    </ul>
                </dd>
            </dl>
            <dl id="menu-sevice">
                <dt><i class="Hui-iconfont">&#xe6d0;</i> 客服模块管理<i class="Hui-iconfont menu_dropdown-arrow">&#xe6d5;</i>
                </dt>
                <dd>
                    <ul>
                        <li><a data-href="{{ URL::asset('/admin/service/index') }}" data-title="客服管理" href="javascript:void(0)">客服管理</a></li>
                    </ul>
                </dd>
            </dl>
            <dl id="menu-member">
                <dt><i class="Hui-iconfont">&#xe62b;</i> 会员中心<i class="Hui-iconfont menu_dropdown-arrow">&#xe6d5;</i>
                </dt>
                <dd>
                    <ul>
                        <li><a data-href="{{ URL::asset('/admin/member/index') }}" data-title="会员管理" href="javascript:void(0)">会员管理</a></li>
                        <li><a data-href="{{ URL::asset('/admin/invoice/index') }}" data-title="专用发票审核管理" href="javascript:void(0)">专用发票审核管理</a></li>
                    </ul>
                </dd>
            </dl>
            {{--<dl id="menu-comment">--}}
                {{--<dt><i class="Hui-iconfont">&#xe6b3;</i> 评论管理<i class="Hui-iconfont menu_dropdown-arrow">&#xe6d5;</i>--}}
                {{--</dt>--}}
                {{--<dd>--}}
                    {{--<ul>--}}
                        {{--<li><a data-href="{{ URL::asset('/admin/comment/index') }}" data-title="评论管理" href="javascript:void(0)">评论管理</a></li>--}}
                    {{--</ul>--}}
                {{--</dd>--}}
            {{--</dl>--}}
        </div>
    </aside>
    <div class="dislpayArrow hidden-xs"><a class="pngfix" href="javascript:void(0);" onClick="displaynavbar(this)"></a>
    </div>
    <section class="Hui-article-box">
        <div id="Hui-tabNav" class="Hui-tabNav hidden-xs">
            <div class="Hui-tabNav-wp">
                <ul id="min_title_list" class="acrossTab cl">
                    <li class="active">
                        <span title="业务概览" data-href="welcome.html">系统首页</span>
                        <em></em></li>
                </ul>
            </div>
            <div class="Hui-tabNav-more btn-group"><a id="js-tabNav-prev" class="btn radius btn-default size-S"
                                                      href="javascript:;"><i class="Hui-iconfont">&#xe6d4;</i></a><a
                        id="js-tabNav-next" class="btn radius btn-default size-S" href="javascript:;"><i
                            class="Hui-iconfont">
                        &#xe6d7;</i></a></div>
        </div>
        <div id="iframe_box" class="Hui-article">
            <div class="show_iframe">
                <div style="display:none" class="loading"></div>
                <iframe scrolling="yes" frameborder="0" src="{{ URL::asset('/admin/welcome') }}"></iframe>
            </div>
        </div>
    </section>

    <div class="contextMenu" id="Huiadminmenu">
        <ul>
            <li id="closethis">关闭当前</li>
            <li id="closeall">关闭全部</li>
        </ul>
    </div>
@endsection

@section('script')
    <script type="text/javascript">
        $(function () {

        });
        /*资讯-添加*/
        function mysqlf_edit(title,url){
            var index = layer.open({
                type: 2,
                title: title,
                content: url
            });
            layer.full(index);
        }
    </script>
@endsection