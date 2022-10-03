<?php

use App\Http\Controllers\DashboardController;

Auth::routes();

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', 'DashboardController@index')->name('dashboard');
    Route::get('/users', 'UserController@index')->name('users.page');
    Route::get('/supervisors', 'UserController@supervisors')->name('supervisors.page');
    Route::get('/blogs', 'PostController@index')->name('blogs.page');
});

Route::get('/', function () {
    return view('blog');
});
