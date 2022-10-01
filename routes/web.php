<?php

use App\Http\Controllers\DashboardController;

Auth::routes();

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', 'DashboardController@index')->name('dashboard');

    Route::get('/posts', 'PostController@index')->name('posts.page');

    Route::get('/users', 'UserController@index')->name('users.page');
});

Route::get('/', function () {
    return view('blog');
});
