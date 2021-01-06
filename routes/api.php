<?php

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
Route::get('/captcha',function (){return 233333;});


Route::prefix('v1')->name('api.v1')->namespace('Api')->group(function (){
    // Route::middleware(['auth'])->group(function (){
    //
    // });

    Route::middleware('throttle:60,1')->group(function (){
        Route::resource('categories','CategoriesController');
        Route::resource('topics','TopicsController');
        Route::resource('users','UsersController');
        Route::resource('topics','TopicsController');
        Route::resource('replies','RepliesController');
    });
});


