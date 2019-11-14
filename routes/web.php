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


// Authentication Routes...
Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login');
Route::post('logout', 'Auth\LoginController@logout')->name('logout');

// Registration Routes..自分以外必要ないのでコメントアウト
// Route::prefix('register')->group(function () {
//     Route::get('/', 'Auth\RegisterController@showRegistrationForm')->name('register');
//     Route::post('/', 'Auth\RegisterController@register');
// });

Route::prefix('password')->group(static function () {
    // Password Reset Routes...
    Route::get('reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
    Route::post('email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
    Route::get('reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
    Route::post('reset', 'Auth\ResetPasswordController@reset')->name('password.update');
});

Route::prefix('admin')->name('admin.')->middleware('auth')->group(static function () {

    Route::get('/', 'Admin\HomeController@index')->name('home');
    Route::get('files', 'Admin\HomeController@files')->name('files');

    Route::prefix('post')->name('post.')->group(static function () {
        Route::get('/', 'Admin\PostController@index')->name('index');
        Route::get('create', 'Admin\PostController@create')->name('create');
        Route::get('edit/{id}', 'Admin\PostController@edit')->name('edit')->where('id', '[0-9]+');;
        Route::get('delete/{id}', 'Admin\PostController@delete')->name('delete')->where('id', '[0-9]+');;
        Route::get('{id}', 'Admin\PostController@show')->name('id')->where('id', '[0-9]+');

        Route::post('create', 'Admin\PostController@store')->name('store');
        Route::post('edit/{id}', 'Admin\PostController@update');
        Route::post('delete/{id}', 'Admin\PostController@destroy')->name('destroy');
    });

    Route::prefix('category')->name('category.')->group(static function () {
        Route::get('/', 'Admin\CategoryController@index')->name('index');
        Route::post('/', 'Admin\CategoryController@store');

        Route::get('edit/{category}', 'Admin\CategoryController@edit')->name('edit');
        Route::post('edit/{category}', 'Admin\CategoryController@update');

        Route::get('delete/{category}', 'Admin\CategoryController@delete')->name('destroy');
        Route::post('delete/{category}', 'Admin\CategoryController@destroy');
    });

    Route::prefix('tag')->name('tag.')->group(static function () {
        Route::get('/', 'Admin\TagController@index')->name('index');
        Route::post('/', 'Admin\TagController@store');

        Route::get('edit/{tag}', 'Admin\TagController@edit')->name('edit');
        Route::post('edit/{tag}', 'Admin\TagController@update');

        Route::get('delete/{tag}', 'Admin\TagController@delete')->name('destroy');
        Route::post('delete/{tag}', 'Admin\TagController@destroy');
    });
});

Route::get('/', 'Front\HomeController@index')->name('home');
Route::get('{id}', 'Front\HomeController@show')->where('id', '[0-9]+')->name('post');
Route::get('profile', 'Front\HomeController@profile')->name('profile');
Route::get('sitemap.xml', 'Front\HomeController@sitemap');

Route::get('contact', 'ContactController@input');
Route::post('contact', 'ContactController@send');
