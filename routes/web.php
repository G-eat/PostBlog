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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/profile','ProfilePic@index');
Route::get('/profile/edit/{id}','ProfilePic@edit');
Route::post('/profile/update/{id}','ProfilePic@update');
// Route::get('/profile/{id}/{name}','ProfilePic@find');

Route::resource('/posts','PostsController');

Route::get('/users','SearchUsersController@index');
Route::get('/user/{id}','SearchUsersController@show');

Route::post('posts/comment/{id}' , 'PostsComent@store');

Route::get('like/{id}' , 'PostsComent@like');
Route::get('dislike/{id}' , 'PostsComent@dislike');

Route::get('/add_friend/{id}', 'AddFriends@add');

Route::get('/chatrom' , 'AddFriends@chatrom');
Route::get('/chat/{id}' , 'AddFriends@chat' );
Route::get('/user/{id}' , 'AddFriends@postchat');
Route::post('/user' , 'AddFriends@ch');
