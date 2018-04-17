<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>404错误页面</title>
    <link rel="Bookmark" href="{{ URL::asset('img/favor.ico') }}">
    <link rel="Shortcut Icon" href="{{ URL::asset('img/favor.ico') }}"/>
    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" type="text/css" href="{{ URL::asset('css/bootstrap/bootstrap.css') }}"/>
    <!-- custom CSS here -->
    <link rel="stylesheet" type="text/css" href="{{ URL::asset('css/error/style.css') }}"/>
    <style>
        body {font-family:sans-serif;}
    </style>
</head>
<body>


<div class="container">

    <div class="row pad-top text-center">
        <div class="col-md-6 col-md-offset-3 text-center">
            <h1><b>  页 面 走 丢 了！ </b></h1>
            <span id="error-link"></span>
            <h2>! 错 误 检 测 !</h2>
        </div>
    </div>

    <div class="row text-center">
        <div class="col-md-8 col-md-offset-2">
            <h3>
                <a href="{{URL::asset('/')}}" class="btn btn-primary">返 回 首 页</a>
                <a href="javascript:history.go(-1)" class="btn btn-default">返 回 上 一 页</a>
            </h3>

        </div>
    </div>

</div>
<!-- /.container -->


<!--Core JavaScript file  -->
<script type="text/javascript" src="{{ URL::asset('dist/lib/jquery/1.9.1/jquery.min.js') }}"></script>
<!--bootstrap JavaScript file  -->
<script type="text/javascript" src="{{ URL::asset('js/bootstrap/bootstrap.js') }}"></script>
<!--Count Number JavaScript file  -->
<script type="text/javascript" src="{{ URL::asset('js/error/countUp.js') }}"></script>
<!--Custom JavaScript file  -->
<script type="text/javascript" src="{{ URL::asset('js/error/custom.js') }}"></script>
</body>
</html>
