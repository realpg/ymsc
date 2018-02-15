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
                <a href="#" class="style-home-banner-nav-list">
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
            @endforeach
        </div>
    </div>
</div>