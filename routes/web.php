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



// Auth::routes(['verify'=>true]);
Auth::routes();

Route::resource('home','HomeController',[ 'only' => ['index']]);
// Route::get('/', 'HomeController@index')->name('home')->middleware('verified');
Route::get('/', 'HomeController@index')->name('home');
Route::resource('users','UsersController',['only'=>['show','update','edit']]);


Route::resource('topics', 'TopicsController',
    ['only' => ['index', 'create', 'store', 'update', 'edit', 'destroy']]);
Route::get('topics/{topic}/{slug?}', 'TopicsController@show')->name('topics.show');
Route::resource('categories','CategoriesController',['only'=>'show']);

Route::post('upload_image', 'TopicsController@uploadImage')->name('topics.upload_image');

Route::resource('replies', 'RepliesController', ['only' => [ 'store',  'destroy']]);

Route::resource('notifications','NotificationsController',['only'=>'index']);


//收藏
Route::post('topics/{topic}/favorite','TopicsController@favorite')->name('topics.favorite');
Route::delete('topics/{topic}/favorite','TopicsController@unFavorite')->name('topics.unFavorite');
//关注
Route::post('topic/{topic}/follow','TopicsController@follow')->name('topics.follow');
Route::delete('topic/{topic}/follow','TopicsController@unFollow')->name('topics.unFollow');
