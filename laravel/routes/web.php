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

Route::get('/', function () {
    return view('welcome');
})->name('top');

Auth::routes();


//demo-app route
// Route::prefix('mypage')
//     ->namespace('MyPage')
//     ->middleware('auth')
//     ->group( function() {
//         Route::get('edit-profile', 'ProfileCotroller@showProfileEditForm')->name('mypage.edit-profile');
//     });

Route::prefix('mypage')
    ->namespace('MyPage')
    ->middleware('auth')
    ->group(function () {
        Route::get('edit-profile', 'ProfileController@showProfileEditForm')->name('mypage.edit-profile');
        Route::post('edit-profile', 'ProfileController@editProfile')->name('mypage.edit-profile');
    });


//userprofile router
Route::get('/home', 'HomeController@index')->name('home');
Route::get('/users/{user}', 'UserContoller@showProfile')->name('users.show_profile');

//post router
Route::get('/posts', 'PostContoller@index')->name('posts.index');
Route::get('/posts/create/', 'PostContoller@create')->name('posts.creat');
Route::post('/posts/{posts}', 'PostContoller@store')->name('posts.store');


//test route
Route::get('/lessons/{lesson}', 'LessonController@show')->name('lessons.show');
