<?php

use Illuminate\Support\Facades\Route;

Route::resource('admin/categories', App\Http\Controllers\Admin\CategoryController::class);



Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
