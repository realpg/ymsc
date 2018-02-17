<div class="container">
    <div class="style-home-header">
        <div class="style-home-header-container">
            <div class="col-xs-12 col-sm-4 col-lg-4 text-center">
                <img src="{{ URL::asset($common['base']['logo_page']) }}"  />
            </div>
            <div class="col-xs-12 col-sm-8 col-lg-8 padding-top-22 padding-bottom-22">
                <form class="form-search" method="get" action="{{ URL::asset($column.'/search/') }}">
                    <input type="text" id="search" name="search" class="style-home-header-search col-xs-7 col-sm-8 col-lg-10" placeholder="输入搜索内容" />
                    <button type="submit" class="btn-default col-xs-5 col-sm-4 col-lg-2 style-home-header-search-button">搜 索</button>
                </form>
            </div>
        </div>
    </div>
</div>