<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
//后台
//登录
Route::get('/admin/login', 'Admin\LoginController@login');        //登录
Route::post('/admin/login', 'Admin\LoginController@loginDo');   //post登录请求
Route::get('/admin/loginout', 'Admin\LoginController@loginout');  //注销
Route::group(['prefix' => 'admin', 'middleware' => ['admin.login']], function () {

    //首页
    Route::get('/', 'Admin\IndexController@index');       //首页
    Route::get('/index', 'Admin\IndexController@index');  //首页
    Route::get('/welcome', 'Admin\IndexController@welcome');  //欢迎页

    //错误页面
    Route::get('/error/500', 'Admin\IndexController@error');  //错误页面

    //管理员管理
    Route::get('/admin/index', 'Admin\AdminController@index');  //管理员管理首页
    Route::post('/admin/index', 'Admin\AdminController@index');  //搜索管理员
    Route::get('/admin/del', 'Admin\AdminController@del');  //删除管理员
    Route::get('/admin/edit', 'Admin\AdminController@edit');  //新建或编辑管理员
    Route::post('/admin/edit', 'Admin\AdminController@editDo');  //新建或编辑管理员
    Route::get('/admin/editMySelf', ['as' => 'editMySelf', 'uses' => 'Admin\AdminController@editMySelf']);  //新建或编辑管理员
    Route::post('/admin/editMySelf', 'Admin\AdminController@editMySelfDo');  //新建或编辑管理员
//    Route::post('/admin/testPassword', 'Admin\AdminController@testPassword');  //新建或编辑管理员

    //Banner管理
    Route::get('/banner/index', 'Admin\BannerController@index');  //Banner管理首页
    Route::post('/banner/index', 'Admin\BannerController@index');  //搜索Banner
    Route::get('/banner/del', 'Admin\BannerController@del');  //删除Banner
    Route::get('/banner/edit', 'Admin\BannerController@edit');  //创建或编辑Banner
    Route::post('/banner/edit', 'Admin\BannerController@editDo');  //创建或编辑Banner

    //网站基本设置
    Route::get('/base/edit', 'Admin\BaseController@edit');  //编辑网站基本设置
    Route::post('/baseInfo/edit', 'Admin\BaseController@baseInfoDo');  //编辑网站基本设置
    Route::post('/baseAbout/edit', 'Admin\BaseController@baseAboutDo');  //编辑关于我们
    Route::post('/baseSeo/edit', 'Admin\BaseController@baseSeoDo');  //编辑SEO

    //加盟信息管理
    Route::get('/league/index', 'Admin\LeagueController@index');  //加盟管理首页
    Route::post('/league/index', 'Admin\LeagueController@index');  //搜索加盟管理信息
    Route::get('/league/edit', 'Admin\LeagueController@edit');  //查看加盟信息详情
    Route::post('/league/stamp', 'Admin\LeagueController@stamp');  //标记已联系
    Route::get('/league/del', 'Admin\LeagueController@del');  //删除加盟信息
    Route::get('/league/delMore', 'Admin\LeagueController@delMore');  //批量删除加盟信息

    //投诉信息管理
    Route::get('/advice/index', 'Admin\AdviceController@index');  //投诉管理首页
    Route::post('/advice/index', 'Admin\AdviceController@index');  //搜索投诉管理信息
    Route::get('/advice/edit', 'Admin\AdviceController@edit');  //查看投诉信息详情
    Route::post('/advice/stamp', 'Admin\AdviceController@stamp');  //标记已联系
    Route::get('/advice/del', 'Admin\AdviceController@del');  //删除投诉信息
    Route::get('/advice/delMore', 'Admin\AdviceController@delMore');  //批量删除投诉信息

    //找货信息管理
    Route::get('/searching/index', 'Admin\SearchingController@index');  //找货管理首页
    Route::post('/searching/index', 'Admin\SearchingController@index');  //搜索找货管理信息
    Route::get('/searching/edit', 'Admin\SearchingController@edit');  //查看找货信息详情
    Route::post('/searching/stamp', 'Admin\SearchingController@stamp');  //标记已联系
    Route::get('/searching/del', 'Admin\SearchingController@del');  //删除找货信息
    Route::get('/searching/delMore', 'Admin\SearchingController@delMore');  //批量删除找货信息

    //客服管理
    Route::get('/service/index', 'Admin\ServiceController@index');  //客服管理首页
    Route::get('/service/edit', 'Admin\ServiceController@edit');  //编辑客服
    Route::post('/service/edit', 'Admin\ServiceController@editDo');  //编辑客服

    //栏目管理
    Route::get('/menu/index', 'Admin\MenuController@index');  //栏目管理首页
    Route::post('/menu/index', 'Admin\MenuController@index');  //搜索栏目
    Route::get('/menu/del', 'Admin\MenuController@del');  //删除栏目
    Route::get('/menu/edit', 'Admin\MenuController@edit');  //创建或编辑栏目
    Route::post('/menu/edit', 'Admin\MenuController@editDo');  //创建或编辑栏目

    //搜索属性管理
    Route::get('/attribute/index', 'Admin\AttributeController@index');  //搜索属性管理首页
    Route::post('/attribute/index', 'Admin\AttributeController@index');  //搜索属性
    Route::get('/attribute/del', 'Admin\AttributeController@del');  //删除搜索属性
    Route::get('/attribute/edit', 'Admin\AttributeController@edit');  //创建或编辑搜索属性
    Route::post('/attribute/edit', 'Admin\AttributeController@editDo');  //创建或编辑搜索属性

    //商品管理
    Route::get('/goods/index', 'Admin\GoodsController@index');  //商品管理首页
    Route::post('/goods/index', 'Admin\GoodsController@index');  //搜索商品
    Route::get('/goods/del', 'Admin\GoodsController@del');  //删除商品
    Route::get('/goods/delMore', 'Admin\GoodsController@delMore');  //批量删除商品

    //化学商品
    Route::get('/chem/index', 'Admin\ChemController@index');  //化学商品管理首页
    Route::post('/chem/index', 'Admin\ChemController@index');  //搜索化学商品大类
    Route::get('/chem/delClass', 'Admin\ChemController@delClass');  //删除化学商品大类
    Route::get('/chem/editClass', 'Admin\ChemController@editClass');  //创建或编辑化学商品大类
    Route::post('/chem/editClass', 'Admin\ChemController@editDoClass');  //创建或编辑化学商品大类
    Route::get('/chem/select', 'Admin\ChemController@select');  //化学商品首页
    Route::post('/chem/select', 'Admin\ChemController@select');  //搜索化学商品
    Route::get('/chem/del', 'Admin\ChemController@del');  //删除化学商品
    Route::get('/chem/delMore', 'Admin\ChemController@delMore');  //批量删除化学商品
    Route::get('/chem/edit', 'Admin\ChemController@edit');  //创建或编辑化学商品
    Route::post('/chem/edit', 'Admin\ChemController@editDo');  //创建或编辑化学商品

    //第三方检测商品
    Route::get('/testing/index', 'Admin\TestingController@index');  //第三方检测商品管理首页
    Route::post('/testing/index', 'Admin\TestingController@index');  //搜索第三方检测商品
    Route::get('/testing/del', 'Admin\TestingController@del');  //删除第三方检测商品
    Route::get('/testing/delMore', 'Admin\TestingController@delMore');  //批量删除第三方检测商品
    Route::get('/testing/edit', 'Admin\TestingController@edit');  //创建或编辑第三方检测商品
    Route::post('/testing/edit', 'Admin\TestingController@editDo');  //创建或编辑第三方检测商品
    Route::get('/testingdetail/del', 'Admin\TestingController@delDetail');  //删除第三方检测商品详情信息
    Route::post('/testingdetail/edit', 'Admin\TestingController@editDoDetail');  //编辑第三方检测商品详情信息

    //机加工商品
    Route::get('/machining/index', 'Admin\MachiningController@index');  //机加工商品管理首页
    Route::post('/machining/index', 'Admin\MachiningController@index');  //搜索机加工商品
    Route::get('/machining/del', 'Admin\MachiningController@del');  //删除机加工商品
    Route::get('/machining/delMore', 'Admin\MachiningController@delMore');  //批量删除机加工商品
    Route::get('/machining/add', 'Admin\MachiningController@add');  //创建机加工商品
    Route::post('/machining/add', 'Admin\MachiningController@addDo');  //创建机加工商品
    Route::get('/machining/editMachining', 'Admin\MachiningController@editMachining');  //编辑机加工商品
    Route::post('/machining/editMachining', 'Admin\MachiningController@editDoMachining');  //编辑机加工商品
    Route::get('/machining/editStandard', 'Admin\MachiningController@editStandard');  //编辑国标商品
    Route::post('/machining/editStandard', 'Admin\MachiningController@editDoStandard');  //编辑国标商品
    Route::get('/machiningdetail/del', 'Admin\MachiningController@delDetail');  //删除机加工商品商品详情信息（机加工一级栏目下的商品公用）
    Route::post('/machiningdetail/edit', 'Admin\MachiningController@editDoDetail');  //编辑机加工商品商品详情信息（机加工一级栏目下的商品公用）
    Route::get('/machiningcase/del', 'Admin\MachiningController@delCase');  //删除机加工商品案例信息
    Route::post('/machiningcase/edit', 'Admin\MachiningController@editDoCase');  //编辑机加工商品案例信息

//    //会员管理
//    Route::get('/member/index', 'Admin\MemberController@index');  //会员管理首页
//    Route::get('/member/edit', 'Admin\MemberController@edit');  //查看会员详情
//
//    //评论管理
//    Route::get('/comment/index', 'Admin\CommentController@index');  //评论管理首页
//    Route::get('/comment/edit', 'Admin\CommentController@edit');  //查看评论详情
//    Route::post('/comment/examine', 'Admin\CommentController@examine');  //审核评论
//    Route::get('/comment/del/{id}', 'Admin\CommentController@del');  //删除评论
});

//前台
Route::group(['prefix' => '', 'middleware' => ['WebBase']], function () {
    Route::get('/', 'Home\IndexController@index');        //首页
    Route::get('index', 'Home\IndexController@index');        //首页
    Route::get('league', 'Home\IndexController@league');        //合作与服务
    Route::post('league', 'Home\IndexController@leagueSignUp');        //合作与服务报名
    Route::get('about', 'Home\IndexController@about');        //关于我们

    Route::get('signUp', 'Home\SignController@signUp');        //注册
    Route::post('signUp', 'Home\SignController@signUpDo');      //通过手机注册
    Route::get('signIn', 'Home\SignController@signIn');        //登录
    Route::post('signIn', 'Home\SignController@signInDo');        //登录
    Route::get('reset', 'Home\SignController@reset');        //找回密码

    Route::get('code', 'Home\CodeController@captcha');        //图片验证码
    Route::get('smscode', 'Home\CodeController@sendVertifyCode');        //短信验证码
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
