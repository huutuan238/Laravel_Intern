<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
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
//Post
Route::get('/post', 'PostController@index');
Route::get('/add-post','PostController@create')->middleware('auth');
Route::post('/save-post','PostController@store');
Route::get('/edit-post/{post_id}', 'PostController@edit');
Route::post('/update-post/{post_id}', 'PostController@update');
Route::get('/delete-post/{post_id}', 'PostController@destroy');
Route::get('/post/{post_id}', 'PostController@show');

//Comment
Route::get('/add-comment', 'CommentController@create');
Route::post('/save-comment/{post_id}','CommentController@store');
Route::get('/edit-comment/{post_id}/{comment_id}', 'CommentController@edit');
Route::post('/update-comment/{post_id}/{comment_id}', 'CommentController@update');
Route::get('/delete-comment/{post_id}/{comment_id}', 'CommentController@destroy');
Route::get('/like/{user_id}/{post_id}/{comment_id}', 'CommentController@like');

//Reply
Route::get('/add-reply/{post_id}/{comment_id}', 'ReplyController@create');
Route::post('/save-reply/{post_id}/{comment_id}','ReplyController@store');
Route::get('/edit-reply/{reply_id}', 'ReplyController@edit');
Route::get('/delete-reply/{reply_id}', 'ReplyController@delete');

//User
Route::get('/profile/{user_id}', 'UserController@show');
Route::get('/edit-profile/{user_id}', 'UserController@edit');
Route::post('/update-profile/{user_id}','UserController@update');
