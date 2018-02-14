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
                <a href="#" class="style-home-banner-nav-list"><span class="text-silver-grey">{{$menu['name']}}</span></a>
            @endforeach
        </div>
    </div>
</div>