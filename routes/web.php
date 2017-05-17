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

auth()->loginUsingId(1);
Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');


Route::get('/dashboard', 'DashboardController@index')->name('dashboard');

Route::get('/dashboard', 'PostsController@index')->name('posts');

Route::post('/post', 'PostsController@store')->name('create.post');

Route::delete('/post/{post}', 'PostsController@destroy')->name('delete.post');
Route::patch('/posts/{post}', 'PostsController@update');

Route::get('/profile', 'UserController@index')->name('user');
Route::get('/profile/avatar/{avatar}', 'UserController@avatar')->name('user.avatar');
Route::patch('/profile/{user}', 'UserController@update')->name('user.update');


Route::post('/posts/{post}/like', 'LikeController@like');
Route::post('/posts/{post}/unlike', 'LikeController@unlike');
//Route::patch('/posts/{post}', 'PostsController@update');

Route::get('/laravel-filemanager', '\Unisharp\Laravelfilemanager\controllers\LfmController@show');
Route::post('/laravel-filemanager/upload', '\Unisharp\Laravelfilemanager\controllers\LfmController@upload');



Route::get('impersonate/{user}', 'ImpersonationController')
    ->middleware('can:admin')
    ->name('impersonate');


Route::prefix('admin')->group(function(){
	Route::get('/login','Auth\AdminLoginController@showLoginForm')->name('admin.login');
	Route::post('/login','Auth\AdminLoginController@login')->name('admin.login.submit');
	Route::get('/','AdminsController@index')->name('admin.dashboard');
});