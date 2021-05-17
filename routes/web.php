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
// Auth::routes();
Auth::routes(['verify' => true]);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('logout', '\App\Http\Controllers\Auth\LoginController@logout');

//Post
Route::post('/save-post', 'PostController@store');
Route::get('/edit-post/{post_id}', 'PostController@edit');
Route::post('/update-post/{post_id}', 'PostController@update');
Route::get('/delete-post/{post_id}', 'PostController@destroy');
Route::get('/post/{post_id}', 'PostController@show');

//Comment
Route::get('/add-comment', 'CommentController@create');
Route::post('/save-comment/{post_id}', 'CommentController@store');
Route::get('/edit-comment/{post_id}/{comment_id}', 'CommentController@edit');
Route::post('/update-comment/{post_id}/{comment_id}', 'CommentController@update');
Route::get('/delete-comment/{post_id}/{comment_id}', 'CommentController@destroy');
//Like
Route::get('/like/{user_id}/{post_id}/{comment_id}', 'CommentController@like');
Route::get('/dislike/{user_id}/{post_id}/{comment_id}/{like_id}', 'CommentController@dislike');

//Reply
Route::get('/add-reply/{post_id}/{comment_id}', 'ReplyController@create');
Route::post('/save-reply/{post_id}/{comment_id}', 'ReplyController@store');
Route::get('/edit-reply/{post_id}/{comment_id}/{reply_id}', 'ReplyController@edit');
Route::post('/update-reply/{post_id}/{comment_id}/{reply_id}', 'ReplyController@update');
Route::get('/delete-reply/{post_id}/{comment_id}/{reply_id}', 'ReplyController@destroy');

//User
Route::get('/profile/{user_id}', 'UserController@show');
Route::get('/edit-profile/{user_id}', 'UserController@edit');
Route::post('/update-profile/{user_id}', 'UserController@update');
Route::get('/my-post/{user_id}', 'UserController@mypost');
//email
Route::get('/email/verify', function () {
    return view('auth.verify');
})->middleware('auth')->name('verification.notice');

use Illuminate\Foundation\Auth\EmailVerificationRequest;

Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();

    return redirect('/home');
})->middleware(['auth', 'signed'])->name('verification.verify');

//notification realtime
Route::get('notification', 'SendNotification@create')->name('notification.create');
Route::post('postMessage', 'SendNotification@store')->name('postMessage');

Route::get('show-notification', 'SendNotification@show');
