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

Route::group(['middleware' => ['auth','verified']], function () {
    Route::get('/post', 'MainController@post');
    Route::post('/boxs', 'MainController@store');
    Route::post('/comment', 'MainController@comment');
    
    Route::get('/mypage', 'UserController@mypage');
    Route::delete('/box/{box}','UserController@destroy');
    Route::post('/edit/{box}','UserController@edit');
    Route::post('/update','UserController@update');
    
    Route::post('/like', 'LikeController@like')->name('reviews.like');
});

Route::group(['middleware' => 'auth'], function () {

});

Route::get('/mail','TestMailController@send');
Route::get('/', 'MainController@index');
Route::post('/myloc', 'MainController@myloc');
Route::get('/tutorial', 'MainController@tutorial');



// Route::get('/mail', 'MailSendController@index');

// 非同期テスト用
// Route::post('/job', 'MainController@job');
// Route::get('/contact', 'MainController@aa');


Auth::routes(['verify' => true]);

Route::get('/home', 'HomeController@index')->name('home');
