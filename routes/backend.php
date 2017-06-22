<?php
/**
 * Created by PhpStorm.
 * User: xuebingwang
 * Date: 2017/6/6
 * Time: 下午7:34
 */


/**
 * 后台
 */

Route::group(['prefix' => 'myp', 'namespace' => 'Backend'], function () {
    Route::get('/', 'DashboardController@dashboard')->name('admin');
    Route::post('/auth/check', 'AuthController@check')->name('admin.login_check');
    Route::post('/auth/logout', 'AuthController@logout')->name('admin.logout');
    Route::post('/auth/login', 'AuthController@authenticate')->name('admin.login');
});

Route::group(['prefix' => 'myp', 'middleware' => 'auth', 'namespace' => 'Backend'], function () {
    Route::get('/dashboard/meta', 'DashboardController@meta');
    Route::get('/dashboard/shanbay', 'DashboardController@shanbay');
    Route::resource('/categorys', 'CategorysController');
    Route::resource('/posts', 'PostsController');
    Route::resource('/tags', 'TagsController');
    Route::resource('/links', 'LinksController');
    Route::resource('/options', 'OptionsController');
    Route::resource('/settings', 'SettingsController');
    Route::resource('/navigations', 'NavigationController');
    Route::resource('/uploads', 'FileController');
    Route::resource('/util', 'UtilController');
    Route::resource('/user', 'UserController');
    Route::resource('/comments', 'CommentController');
    Route::resource('/trash', 'TrashController');
});
