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
    Route::post('forgot_password', 'AuthController@forgotPassword')->name('api_forgot_password');

    Route::any('logout', 'AuthController@logout')->name('logout');
    Route::post('login', 'AuthController@login')->name('api_login');
    Route::post('save_apply', 'HomeController@saveApply')->name('api_save_apply');

});

Route::group(['namespace'=>'App','middleware' => 'member_auth'],function (){

    Route::get('star/works', 'MemberInfoController@starMemberWorks')->name('star_works');

    Route::get('art_circle', 'ArtCircleController@index')->name('art_circle');
    Route::get('art_circle/recommend', 'ArtCircleController@recommend')->name('art_circle_recommend');
    Route::get('art_circle/latest', 'ArtCircleController@latest')->name('art_circle_latest');
    Route::get('art_circle/add', 'ArtCircleController@add')->name('add_art_circle');
    Route::post('art_circle/save', 'ArtCircleController@save')->name('save_art_circle');

    Route::get('art_circle/star/{mu_id}', 'ArtCircleController@saveStar')->name('art_circle_star');

});

Route::group(['namespace'=>'App','prefix' => 'api','middleware' => ['web','member_auth']],function (){

    Route::post('msg/save', 'MessageController@save')->name('api_message_save');
    Route::get('content/like/{cid}', 'ContentController@saveLike')->name('api_content_like');
    Route::post('content/comment', 'ContentController@addComment')->name('api_content_comment');
    Route::post('member/content', 'ContentController@save')->name('api_content_save');
    Route::any('member/content/delete/{cid}', 'ContentController@delete')->name('api_content_delete');

    Route::get('member/star/{mid}', 'MemberInfoController@saveStar')->name('api_member_star');
    Route::get('work/like/{work_id}', 'WorkController@saveLike')->name('api_work_like');
    Route::post('work/comment', 'WorkController@addComment')->name('api_work_comment');

    Route::post('member/save_pic', 'MemberInfoController@savePic')->name('api_member_pic');
    Route::post('member/info', 'MemberInfoController@saveInfo')->name('api_member_info');
    Route::post('member/password', 'MemberInfoController@savePassword')->name('api_member_password');
    Route::post('member/privacy', 'MemberInfoController@savePrivacy')->name('api_member_privacy');
    Route::post('member/work/save', 'WorkController@saveWork')->name('api_work_save');
    Route::post('member/album/save', 'WorkController@saveAlbum')->name('api_album_save');
    Route::any('member/album/delete/{id}', 'WorkController@deleteAlbum')->name('api_album_delete');
    Route::any('member/work/delete/{work_id}', 'WorkController@delete')->name('api_work_delete');

    Route::any('upload_token', 'MemberInfoController@getQiniuUploadToken')->name('api_upload_token');

    Route::post('member/verify/apply', 'MemberInfoController@saveVerifyApply')->name('api_verify_apply');
});


Route::group(['namespace' => 'App'], function () {
    Route::get('/vrlist/{cate}', 'VrController@showList')->name('vr_list');
    Route::get('/member/list/{cate_id}', 'HomeController@memberList')->name('member_list');
    Route::get('/works', 'WorkController@showList')->name('work_list');

    Route::get('/contents/{id}/comments', 'ContentController@getComments')->name('content_comment_list');
    Route::get('/contents/{cate_id}', 'ContentController@showList')->name('contents_list');
    Route::get('/content/{id}', 'ContentController@info')->name('content_info');

    Route::any('/no_found', 'ErrorController@noFound')->name('no_found');

    Route::get('/search', 'HomeController@search')->name('search');
    Route::get('/member/works/{mid}', 'MemberInfoController@works')->name('member_works');

    Route::get('member/moments/{mid}', 'MemberInfoController@moments')->name('member_moments');
    Route::get('member/contents/{mid}', 'MemberInfoController@contents')->name('member_contents');

    Route::get('/works/album/{album_id}', 'WorkController@listByAlbum')->name('works_list_album');

    Route::any('/logout', 'AuthController@logout')->name('logout');
    Route::get('/login', 'AuthController@showLoginForm')->name('login');
    Route::get('/signup', 'AuthController@showSignupForm')->name('signup');
    Route::get('/forgot_password', 'AuthController@showForgotPasswordForm')->name('forgot_password');

    Route::get('/work/{id}', 'WorkController@info')->name('work_info');
    Route::get('/mid/{id}', 'MemberInfoController@home')->name('php');//person_home_page
    Route::get('/work/{id}/comments', 'WorkController@getComments')->name('work_comment_list');//person_home_page

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


    //个性化域名
    Route::get('/{domain}','MemberInfoController@home');
});
Route::group(['namespace'=>'App','prefix' => 'member','middleware' => ['web','member_auth']],function (){

    Route::get('contacts/fans', 'ContactsController@fans')->name('member_contacts_fans');
    Route::get('contacts/gz', 'ContactsController@gz')->name('member_contacts_gz');
    Route::get('contacts/friend', 'ContactsController@friend')->name('member_contacts_friend');

    Route::get('msg/{to_mid}', 'MessageController@infoList')->name('member_msg_info');

    Route::get('content/add', 'ContentController@showForm')->name('member_content_add');
    Route::get('content/info/{id}', 'ContentController@showForm')->name('member_content_info');

    Route::get('index', 'MemberController@index')->name('member_index');
    Route::get('verify', 'MemberInfoController@verify')->name('member_verify');
    Route::get('verify/apply', 'MemberInfoController@verifyApply')->name('member_verify_apply');
    Route::get('setting', 'MemberInfoController@showSetting')->name('member_setting');
    Route::get('info', 'MemberInfoController@showInfoForm')->name('member_info');
    Route::get('password', 'MemberInfoController@showPasswordForm')->name('member_password');
    Route::get('privacy', 'MemberInfoController@showPrivacyForm')->name('member_privacy');
    Route::get('work/add', 'WorkController@showForm')->name('member_work_add');
    Route::get('work/info/{id}', 'WorkController@showForm')->name('member_work_info');
    Route::get('album/add', 'WorkController@showAlbumForm')->name('member_album_add');
    Route::get('album/info/{id}', 'WorkController@showAlbumForm')->name('member_album_info');

});
