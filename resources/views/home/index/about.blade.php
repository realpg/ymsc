@extends('home.layouts.base')
@section('content')
    <div id="about-body">
        <div class="style-home-nav-station"></div>
        <div class="margin-bottom-20 style-home-about-content-div">
            <div class="container">
                <div class="row">
                    <div class="col-xs-12 col-md-5 text-center padding-top-45">
                        <img src="{{$common['base']['picture']}}?imageView2/0/w/330/h/225" />
                    </div>
                    <div class="col-xs-12 col-md-7">
                        <div class="page-header text-center style-home-about-title">
                            <h3>关于我们</h3>
                        </div>
                        <p class="padding-bottom-20">{{$common['base']['content']}}</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="style-home-about-contact-div">
            <div class="container">
                <div class="page-header style-home-about-title">
                    <h3>联系我们</h3>
                </div>
                <div class="row style-home-about-contact-content style-home-about-contact-content">
                    <div class="col-xs-12 col-md-3 ">
                        <i class="iconfont icon-gongsiyewu"></i>
                        {{$common['base']['name']}}
                    </div>
                    <div class="col-xs-12 col-md-3">
                        <i class="iconfont icon-dianhua"></i>
                        {{$common['base']['phonenum']}}
                    </div>
                    <div class="col-xs-12 col-md-3">
                        <i class="iconfont icon-QQ"></i>
                        {{$common['base']['qq']}}
                    </div>
                    <div class="col-xs-12 col-md-3">
                        <i class="iconfont icon-dingwei"></i>
                        {{$common['base']['address']}}
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div style="height:20px;background: #F2F2F2;"></div>
@endsection

@section('script')
    <script type="text/javascript">
        $(function () {
            var winHeight=$(window).height();
            $('#about-body').css('min-height',winHeight-80);
            $('#about-body').css('background','#F2F2F2');
        });
    </script>
@endsection