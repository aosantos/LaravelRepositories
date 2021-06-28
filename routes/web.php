<?php

use Illuminate\Support\Facades\Route;

Route::post('admin/categories/search',  'App\Http\Controllers\Admin\CategoryController@search')->name('categories.search');
Route::resource('admin/categories', App\Http\Controllers\Admin\CategoryController::class);


Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
