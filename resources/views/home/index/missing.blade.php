@extends('home.layouts.base')
@section('content')
<div id="main-body">
    <div class="style-home-nav-station"></div>
    <div class="container margin-top-20 padding-20">
        <h3 class="line-height-50">很抱歉，没有找到相关的商品！</h3>
        <div>
            <form class="form-search-all" method="get" action="{{ URL::asset($column.'/search/') }}" id="form-search-all">
                <div class="style-home-index-search-input" style="width:540px;float: left;">
                    <input type="text" id="search" name="search" class="style-home-index-form-control width-100" style="height:36px;" placeholder="输入搜索内容" />
                </div>
                <div class="style-home-index-search-btn" style="width:100px;float: left;">
                    <button type="submit" class="btn-default style-home-index-form-control-button glyphicon glyphicon-search width-100" style="height:36px;"></button>
                </div>
            </form>
        </div>
        <div class="clear"></div>
        <h4 class="line-height-30">我们温馨地向您提供以下建议：</h4>
        <h4 class="line-height-30">1.查看输入的文字或者参数是否有误，并重新查找；</h4>
        <h4 class="line-height-30">2.点击右侧栏<a href="javascript:" onclick="changeChannel(1)"><span class="text-blue">“帮你找货”</span>，让我们来帮您找货！</a></h4>
    </div>
</div>
@endsection

@section('script')
    <script type="text/javascript">
        $(function(){
            changeChannel(1)
        })
    </script>
@endsection