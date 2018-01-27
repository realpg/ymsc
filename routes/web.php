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
    Route::post('/admin/testPassword', 'Admin\AdminController@testPassword');  //新建或编辑管理员

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

    //会员管理
    Route::get('/member/index', 'Admin\MemberController@index');  //会员管理首页
    Route::get('/member/edit', 'Admin\MemberController@edit');  //查看会员详情

    //评论管理
    Route::get('/comment/index', 'Admin\CommentController@index');  //评论管理首页
    Route::get('/comment/edit', 'Admin\CommentController@edit');  //查看评论详情
    Route::post('/comment/examine', 'Admin\CommentController@examine');  //审核评论
    Route::get('/comment/del/{id}', 'Admin\CommentController@del');  //删除评论
});
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
