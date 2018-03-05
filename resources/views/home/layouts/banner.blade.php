<div class="carousel-content" >
    <ul class="carousel" id="banner">
        @foreach($banners as $banner)
           <li>
                <img src="{{$banner['picture']}}">
           </li>
        @endforeach
    </ul>
    <ul class="img-index"></ul>
    {{--<div class="carousel-prev"><img src="{{URL::asset('img/left_btn1.png')}}"></div>--}}
    {{--<div class="carousel-next"><img src="{{URL::asset('img/right_btn1.png')}}"></div>--}}
</div>
<div class="container" id="side_bar_menus">
    <div class="col-xs-12 col-sm-3 padding-0 style-home-banner-nav" id="sidebar">
        <div class="list-group">
            <div href="#" class="style-home-banner-nav-title text-center font-size-16">全部商品分类</div>
            @foreach($menus as $menu)
                @if($menu['status']==1)
                <a href="{{URL::asset($column.'/lists/'.$menu['id'])}}" class="style-home-banner-nav-list">
                    <div class="float-left">
                        @if(!empty($menu['picture']))
                            <img src="{{URL::asset($menu['picture'])}}" style="width: 14px;border-radius: 100%;border: 1px solid #D1D2D4;" />
                        @endif
                        <span class="text-silver-grey">{{$menu['name']}}</span>
                    </div>
                    <div class="float-right">
                        <span class="glyphicon glyphicon-menu-right text-silver-grey margin-top-2" aria-hidden="true"></span>
                    </div>
                </a>
                @endif
            @endforeach
        </div>
    </div>
    @if($column=='machining')
        <div class="col-xs-12 col-sm-3 col-md-offset-6 padding-0" id="sidebar">
            <div class="common-text-align-center padding-10 margin-top-25 margin-bottom-25 white-bg height-400">
                <div class="padding-10 border-upload height-100">
                    <img src="{{URL::asset('img/machining_upload.png')}}" class="margin-bottom-20 margin-top-50 width-50" />
                    <h3 class="text-blue margin-bottom-30">点击上传零件图纸</h3>
                    <p class="common-text-align-left">温馨提示：<br />为了更精确地为您提供报价，最好同时提供2D和3D图纸，若只提供3D图纸，我们将按照常规精度报价。</p>
                </div>
            </div>
        </div>
    @endif
</div>