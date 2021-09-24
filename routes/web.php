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
    Route::get('/edit/{box}','UserController@edit');
    Route::post('/update','UserController@update');
    Route::get('/change_mypage/{id}','UserController@change');
    Route::post('/edit_user','UserController@edit_user');
    
    Route::post('/like', 'LikeController@like')->name('reviews.like');
});

Route::group(['middleware' => 'auth'], function () {

});


Route::get('/', 'MainController@index');
Route::post('/myloc', 'MainController@myloc');
Route::get('/tutorial', 'MainController@tutorial');


//facebook認証画面に遷移
Route::get('login/facebook', 'Auth\LoginController@FacebookLogin');
//リダイレクト時に動くアクション
Route::get('login/facebook/callback', 'Auth\LoginController@FacebookLoginCallback'); 

// LINEの認証画面に遷移
Route::get('auth/line', 'Auth\LineOAuthController@redirectToProvider')->name('line.login');
// 認証後にリダイレクトされるURL(コールバックURL)
Route::get('auth/line/callback', 'Auth\LineOAuthController@handleProviderCallback');


//メールテスト関係
// Route::get('/mail', 'MailSendController@index');
// Route::get('/mail','TestMailController@send');

// 非同期テスト用
// Route::post('/job', 'MainController@job');
// Route::get('/contact', 'MainController@aa');




Auth::routes(['verify' => true]);

Route::get('/home', 'HomeController@index')->name('home');
