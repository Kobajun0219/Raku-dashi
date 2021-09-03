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
use App\Box;
use Illuminate\Http\Request;

Route::group(['middleware' => ['auth','verified']], function () {

Route::post('/comment', 'MainController@comment');
Route::get('/post', 'MainController@post');
Route::get('/mypage', 'UserController@mypage');
Route::post('/boxs', 'MainController@store');
Route::delete('/box/{box}','UserController@destroy' );
Route::post('/like', 'LikeController@like')->name('reviews.like');

});

Route::get('/mail','TestMailController@send');
// Route::get('/mail', 'MailSendController@index');

Route::get('/', 'MainController@index');
Route::post('/myloc', 'MainController@myloc');

// Route::post('/detail/{box_id}', 'MainController@detail');

// 非同期テスト用
// Route::post('/job', 'MainController@job');
// Route::get('/contact', 'MainController@aa');


Auth::routes(['verify' => true]);

Route::get('/home', 'HomeController@index')->name('home');
