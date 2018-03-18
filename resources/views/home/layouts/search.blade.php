<div class="width-100" style="position:fixed;top:34px;left:0;right:0;z-index:999;">
    <div class="style-home-header white-bg">
        <div class="style-home-header-container">
            <div class="col-xs-12 col-sm-4 col-lg-4 text-center">
                <a href="{{URL::asset('/')}}">
                    <img src="{{ URL::asset($common['base']['logo_page']) }}"  />
                </a>
            </div>
            <div class="col-xs-12 col-sm-8 col-lg-8 padding-top-22 padding-bottom-22">
                <form class="form-search" method="get" action="{{ URL::asset($column.'/search/') }}">
                    <input type="text" id="search" name="search" class="style-home-header-search col-xs-7 col-sm-8 col-lg-10" value="{{isset($search)?$search:''}}" placeholder="输入搜索内容" />
                    <button type="submit" class="btn-default col-xs-5 col-sm-4 col-lg-2 style-home-header-search-button">搜 索</button>
                </form>
            </div>
        </div>
    </div>
</div>