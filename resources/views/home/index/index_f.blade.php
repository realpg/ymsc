@extends('home.layouts.base')

@section('content')
    <style>
        body{background-color: #011931}
    </style>
    <div id="mydiv">
        <div class="text-center" id="logo">
            <img src="{{$common['base']['logo']}}" style="height:154px;" />
        </div>
        <div class="style-home-index-search padding-top-20">
            <form class="form-search-all" method="get" action="{{ URL::asset($column.'/search/') }}" id="form-search-all">
                <input type="text" id="search" name="search" class="style-home-index-form-control col-xs-9 col-sm-10 col-lg-11" style="height:40px;" placeholder="输入搜索内容" />
                <button type="submit" class="btn-default col-xs-3 col-sm-2 col-lg-1 style-home-index-form-control-button glyphicon glyphicon-search" style="height:40px;"></button>
            </form>
            <div class="clear"></div>
            <h5 class="line-height-30 index-font padding-bottom-0 margin-bottom-0 index-search margin-top-10 margin-bottom-10">
                @if(count($words)>0)
                    大家都在搜：
                    @foreach($words as $word)
                        <a href="javascript:" class="text-decoration-none" onclick="choiceWord('{{$word['name']}}')">
                            <span class="padding-right-5 padding-left-5 index-font text-decoration-none">{{$word['name']}}</span>
                        </a>
                    @endforeach
                @else
                    &nbsp;
                @endif
            </h5>
            <div class="row padding-right-15">
                <div class="col-sm-12 col-md-3">
                    <p><a class="btn btn-default style-home-index-btn" href="http://xueshu.baidu.com/" target="_blank" role="button">百度学术</a></p>
                </div>
                @foreach($menus as $menu)
                    @if($menu['status']==1)
                    <div class="col-sm-12 col-md-3">
                        <p><a class="btn btn-default style-home-index-btn" href="{{URL::asset($menu['route'])}}" role="button">{{$menu['name']}}</a></p>
                    </div>
                    @endif
                @endforeach
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script type="text/javascript" src="{{ URL::asset('/js/canvas-particle.js') }}"></script>
    <script type="text/javascript">
        $(function () {
            //初始化画布的size
            var winWidth=$(window).width();
            var winHeight=$(window).height();
            $('#mydiv').css('width',winWidth);
            $('#mydiv').css('min-height',winHeight-45);
            var config = {
                vx: 4,	//小球x轴速度,正为右，负为左
                vy: 4,	//小球y轴速度
                height: 3,	//小球高宽，其实为正方形，所以不宜太大
                width: 3,
                count: 130,		//点个数
                color: "0,193,184", 	//点颜色
                stroke: "0,102,112", 		//线条颜色
                dist: 10000, 	//点吸附距离
                e_dist: 20000, 	//鼠标吸附加速距离
                max_conn: 1 	//点到点最大连接数
            }
            //调用
            CanvasParticle(config);

            $('#logo').css('padding-top',winHeight*0.2)
        });
        function choiceWord(name){
            $('#search').val(name)
            $('#form-search-all').submit();
        }
    </script>
@endsection