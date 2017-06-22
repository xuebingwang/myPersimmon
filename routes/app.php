<?php
/**
 * Created by PhpStorm.
 * User: xuebingwang
 * Date: 2017/6/6
 * Time: 下午7:34
 */

/**
 * 前台
 */
Route::group(['namespace'=>'App','prefix' => 'api'],function (){

    Route::post('signup', 'AuthController@signup')->name('api_signup');
    Route::post('login', 'AuthController@login')->name('api_login');
});


Route::group(['namespace' => 'App'], function () {

    Route::get('/login', 'AuthController@showLoginForm')->name('login');
    Route::get('/signup', 'AuthController@showSignupForm')->name('signup');

    Route::get('/forgot_password', 'AuthController@showForgotPasswordForm')->name('forgot_password');

    Route::get('/', 'HomeController@index')->name('home');

    Route::get('/post/{flag}', 'HomeController@posts')->name('post');
    Route::get('/tags/{flag}', 'HomeController@tags')->name('tags');
    Route::get('/category/{flag}', 'HomeController@category')->name('category');
    Route::get('/feed', 'HomeController@feed');
    Route::get('/sitemap.xml', 'HomeController@siteMap');
    Route::get('/xmlrpc', 'XmlRpcController@errorMessage');
    Route::post('/xmlrpc', 'XmlRpcController@index')->name('xmlrpc');
    Route::get('/friends', 'HomeController@friends')->name('friends');
    Route::resource('/comment', 'CommentController');
    Route::get('/debug', 'HomeController@debug')->name('debug');
});
Route::group(['namespace'=>'App','prefix' => 'member','middleware' => 'member_auth'],function (){

    Route::get('index', 'MemberController@index')->name('member_index');
});

//Route::group(['namespace'=>'App','prefix' => 'api','middleware' => 'member_auth'],function (){
//
//    Route::post('member/index', 'AuthController@signup')->name('api_signup');
//});