<?php

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });


Route::prefix('v1')->name('api.v1.')->namespace('Api')->group(function (){

    //登录后可以使用的接口
    Route::middleware('auth:api')->group(function (){
        Route::resource('topics','TopicsController')->only(['store','update']);
        // 当前登录用户信息
        Route::get('user', 'UsersController@me')
            ->name('user.show');
        //编辑资料
        Route::patch('user', 'UsersController@update')
            ->name('user.update');
        Route::resource('topics','TopicsController')->only(['update','destroy']);
        //发表话题
        Route::post('topics/create','TopicsController@store')->name('topics.create');
        // 发布回复
        Route::post('topics/{topic}/replies', 'RepliesController@store')
            ->name('topics.replies.store');
        Route::delete('topics/{topics}/replies/{reply}','RepliesController@destroy')
            ->name('replies.destroy');
        /*上传图片*/
        Route::post('images','ImagesController@store')->name('images.store');
    });
    //游客可以使用的接口
    Route::middleware('throttle:60,1')->group(function (){
        //图片验证码
        Route::any('captchas','CaptchasController@store');
        //手机验证码
        Route::middleware('throttle:1,1')
            ->any('verificationCodes','VerificationCodesController@store');
        //登录
        Route::post('authorizations','AuthorizationsController@store');
        //第三方登录
        Route::post('socials/{social_type}/authorizations', 'AuthorizationsController@socialStore')
            ->where('social_type', 'weixin')
            ->name('socials.authorizations.store');
        //微信小程序登录
        Route::post('weapp/authorizations','AuthorizationsController@weappStore');
        // 刷新token
        Route::put('authorizations/current', 'AuthorizationsController@update')
            ->name('authorizations.update');
        // 删除token
        Route::delete('authorizations/current', 'AuthorizationsController@destroy')
            ->name('authorizations.destroy');
        //用户注册
        Route::post('users','UsersController@store');
        Route::resource('categories','CategoriesController')->only(['index']);
        Route::resource('users','UsersController')->only(['show']);
        Route::resource('topics','TopicsController')->only(['index','show']);

        Route::post('topics/category','TopicsController@index')->name('topics.categoryIndex  ');

        // 话题回复列表
        Route::get('topics/{topic}/replies', 'RepliesController@index')
            ->name('topics.replies.index');
        // 某个用户的回复列表
        Route::get('users/{user}/replies', 'RepliesController@userIndex')
            ->name('users.replies.index');
    });
});


