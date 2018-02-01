<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

//后台首页
Route::get('/',"Admins\IndexController@index");

//后台登录
Route::get('/admin/login',"Admins\LoginController@index");
//执行登录
Route::post('/admin/login',"Admins\LoginController@doLogin");

//验证码
Route::get('/captcha/{tmp}','CommonController@captcha');

//后台管理
Route::group(['prefix'=>'admin','middleware'=>'myauth'], function(){
    //退出后台
    Route::get('/login/logout','Admins\LoginController@logout');

    //管理员管理
    Route::resource('/admin','Admins\AdminController');

    //类别管理
    Route::get('/cate/create/{cid?}','Admins\CateController@create');
    Route::resource('/cate','Admins\CateController');

    //演出管理
    Route::resource('/show','Admins\ShowController');

    //场馆管理
    Route::resource('/venue','Admins\VenueController');

    //商品管理
    Route::resource('/good','Admins\GoodsController');
});

//404
/*Route::group([],function(){
    Route::get('/404',function(){
        abort(404,'not found!');
    });
});*/

//前台注册页面
Route::get('/register','Admins\LoginController@register');
Route::post('/register',"Admins\LoginController@doRegister");

//发送邮件
Route::get('/send','Admins\LoginController@send');

//用户的激活url设置
Route::get('/active','Admins\LoginController@active');

//前台登录
Route::get('/login',"Admins\LoginController@flogin");
//执行登录
Route::post('/login',"Admins\LoginController@doFlogin");
//前台找回密码
Route::get('/findpwd',"Admins\LoginController@findpwd");
//执行找回密码
Route::post('/findpwd',"Admins\LoginController@doFindpwd");
//重置密码
Route::get('/reset','Admins\LoginController@reset');
Route::post('/reset','Admins\LoginController@doReset');

//发送短信
Route::get('/message','CommonController@sendMessage');
Route::get('/verify','CommonController@verify');

//图片验证码
Route::get('service/validate_code/create','Service\ValidateController@create');
//手机短信验证码
Route::get('service/validate_phone/send','Service\ValidateController@sendSMS');

//详情页
Route::get('/show-{id}','Frontend\ShowController@show');

//列表
Route::get('/list','Frontend\ShowController@showlist');

//首页
Route::get('/','Frontend\ShowController@index');

//前台管理
Route::group(['middleware'=>'login'], function(){
    //添加评论
    Route::get('/comment-{id}','Frontend\CommentController@index');
    Route::post('/comment/add','Frontend\CommentController@add');
});

Route::get('/test',function(){

    //创建curl对象
    $curl = new Curl\Curl();
    //发送请求
    $curl->get('http://www.baidu.com/');

    return $curl->response;
});