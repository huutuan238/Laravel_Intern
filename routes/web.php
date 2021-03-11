<?php

use Illuminate\Support\Facades\Route;
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


Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('logout', '\App\Http\Controllers\Auth\LoginController@logout');
//Post
Route::get('/post', 'PostController@index')->middleware('auth');
Route::get('/add-post', 'PostController@create')->middleware('auth');
Route::post('/save-post', 'PostController@store');
Route::get('/edit-post/{post_id}', 'PostController@edit')->middleware('auth');
Route::post('/update-post/{post_id}', 'PostController@update');
Route::get('/delete-post/{post_id}', 'PostController@destroy')->middleware('auth');
Route::get('/post/{post_id}', 'PostController@show')->middleware('auth');

//Comment
Route::get('/add-comment', 'CommentController@create')->middleware('auth');
Route::post('/save-comment/{post_id}', 'CommentController@store');
Route::get('/edit-comment/{post_id}/{comment_id}', 'CommentController@edit')->middleware('auth');
Route::post('/update-comment/{post_id}/{comment_id}', 'CommentController@update');
Route::get('/delete-comment/{post_id}/{comment_id}', 'CommentController@destroy')->middleware('auth');
Route::get('/like/{user_id}/{post_id}/{comment_id}', 'CommentController@like')->middleware('auth');
Route::get('/dislike/{user_id}/{post_id}/{comment_id}/{like_id}', 'CommentController@dislike')->middleware('auth');

//Reply
Route::get('/add-reply/{post_id}/{comment_id}', 'ReplyController@create')->middleware('auth');
Route::post('/save-reply/{post_id}/{comment_id}', 'ReplyController@store')->middleware('auth');
Route::get('/edit-reply/{post_id}/{comment_id}/{reply_id}', 'ReplyController@edit');
Route::post('/update-reply/{post_id}/{comment_id}/{reply_id}', 'ReplyController@update')->middleware('auth');
Route::get('/delete-reply/{post_id}/{comment_id}/{reply_id}', 'ReplyController@destroy')->middleware('auth');

//User
Route::get('/profile/{user_id}', 'UserController@show')->middleware('auth');
Route::get('/edit-profile/{user_id}', 'UserController@edit')->middleware('auth');
Route::post('/update-profile/{user_id}', 'UserController@update');
Route::get('/my-post/{user_id}', 'UserController@my_post')->middleware('auth');
