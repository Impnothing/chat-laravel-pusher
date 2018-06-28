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

Auth::routes();

Route::get('/', 'TweetController@index');
Route::get('tweets', 'TweetController@showTweets')->middleware('auth');
Route::post('tweets', 'TweetController@sentTweet')->middleware('auth');
Route::get('profile/{id}', 'TweetController@myProfile')->middleware('auth');
Route::put('profile', 'TweetController@editUser')->middleware('auth');
